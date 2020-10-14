<?php 

include_once 'conn.php';
session_start();


if(isset($_GET['del'])){
    $id = $_GET['del'];
    $sqlDel = mysqli_query($link, "DELETE from cart where c_id ='$id'");
    if ($sqlDel) {
        header("Refresh: 0; url = ../cart.php");
    }
}

//login module
if (isset($_POST["login"])){
	$name = $_POST["username"];
	$pwd = $_POST["pwd"];
	$NeedLogin = $_POST["type"];

	$sqlAdminName = "SELECT * from admin where a_username ='$name'";
	$sqlUserName = "SELECT * from user where u_username = '$name'";
	$resultAdminName = mysqli_query($link,$sqlAdminName);
	$resultUserName  = mysqli_query($link,$sqlUserName);
	$numrowsAdmin = mysqli_num_rows($resultAdminName);
	$numrowsUser = mysqli_num_rows($resultUserName);

	$loggedIn = false;
	if(isset($_SESSION['loggedIn']) && isset($_SESSION['name'])){
		$loggedIn = true;
	}

if (empty($name) || empty($pwd)) {
	header("location: ../login.php?login=empty");
	exit();
} else {
	if ($numrowsUser > 0 or $numrowsAdmin > 0) {
		if ($row = mysqli_fetch_assoc($resultAdminName)) {
			if ($pwd == $row['a_password']) {
				$_SESSION['a_id'] = $row['a_id'];
				$_SESSION['a_name'] = $row['a_username'];
				header("location: ../admin/index.php");
				exit();
			} else {
				header("location: ../login.php?login=password&username=$name");
			}
		} else {
			echo "error!";
		}

		if($row1 = mysqli_fetch_assoc($resultUserName)){
			$pwdVerify = password_verify($pwd , $row1['u_password']);
				if ($pwdVerify == TRUE) {
					$_SESSION['u_id'] = $row1['u_id'];
					$_SESSION['u_name'] = $row1['u_username'];

					if ($NeedLogin == 'cart') {
						header("location: ../cart.php");
					}
					elseif ($NeedLogin == $NeedLogin) {
						header("location: ../viewProduct.php?id=".$NeedLogin);
					}
					elseif($NeedLogin == ''){
					header("location: ../products.php");
					}
				}
				else {
					header("location: ../login.php?login=password&username=$name&NeedLoginCart=$NeedLogin&NeedLoginBuy=$NeedLogin");
				}
		}
	} else{
		header("location: ../login.php?login=invalidUser");
	}
 }
}

//register module
if(isset($_POST["register"])) {
	$fname = mysqli_real_escape_string ($link,$_POST["fname"]);
	$lname = mysqli_real_escape_string($link, $_POST["lname"]);
	$email = mysqli_real_escape_string ($link,  $_POST["email"]);
	$address = mysqli_real_escape_string($link, $_POST["address"]);
	$number = mysqli_real_escape_string($link, $_POST["number"]);
	$userNameReg =  mysqli_real_escape_string ($link, $_POST[
    "username"]);
	$pwdReg = mysqli_real_escape_string ($link, $_POST["password"]);
	$pwdReg1 = mysqli_real_escape_string ($link, $_POST["cpassword"]);

	date_default_timezone_set("Asia/Manila");
	$d = strtotime("Now");
	$time= date("Y-m-d H:i:s, $d");
	
	$unq = strtoupper(substr(md5(time().rand(10000,99999)),0, 4));

	if(empty($fname) || empty($lname) || empty($email) || empty($address) || empty($number) || empty($pwdReg) || empty($pwdReg1) || empty($userNameReg)	) {
		echo "Please fill out all fields!";
		header("location: ../reg.php?reg=fill");
		exit();
} else {
	if (filter_var($email,FILTER_VALIDATE_EMAIL)) {
		$sqlEmail = mysqli_query($link,"SELECT * FROM user where u_email = '$email'");
		$resultEmail = mysqli_num_rows($sqlEmail);
			if ($resultEmail < 1) {
				$sqlRegUser = mysqli_query($link, "SELECT * FROM user where u_username = '$userNameReg'");
				$numRegUser = mysqli_num_rows($sqlRegUser);
				if (!$numRegUser < 1) {
					header("location: ../reg.php?reg=username&first=$fname&last=$lname&email=$email&number=$number&address=$address");
					exit();
				} else {
					if ($pwdReg == $pwdReg1) {
						$pwdhashed = password_hash($pwdReg,PASSWORD_DEFAULT);
						$sqlRegIns = "INSERT into user (u_id,u_username,u_password,u_email,u_address,u_number,u_firstname,u_lastname,date_created,date_updated,verify) values ('','$userNameReg','$pwdhashed','$email','$address','$number','$fname','$lname',NOW(),'','$unq')";
						mysqli_query($link,$sqlRegIns);
						header("location: ../registerSuccessful.html");
						exit();
					} else {
						header("location: ../reg.php?reg=password&first=$fname&last=$lname&number=$number&email=$email&username=$userNameReg&address=$address");
					}
				}
			} else {
				header("location: ../reg.php?reg=emailTaken&first=$fname&last=$lname&number=$number&address=$address&username=$userNameReg");
			}
	} else {
		header("location: ../reg.php?reg=email&first=$fname&last=$lname&number=$number&address=$address&username=$userNameReg");
	}
	
	}
}


//verify password
if(isset($_POST["chngPass"])) {
    $email = $_POST["email"];
    $username = $_POST["username"];
    
    $sqluser = "SELECT * from user where u_username ='$username'";
    $resultuser = mysqli_query ($link, $sqluser);
	$numuser = mysqli_num_rows($resultuser);
	if (empty($username) || empty($email)) {
		header("location: ../pwdverify.php?ver=empty");
		exit();
	} else {
		if  ($numuser > 0){
			$sqlemail = "SELECT * from user where u_email = '$email' and u_username='$username'; ";
			$resultuserEN = mysqli_query($link, $sqlemail);
			
					$numuserNE = mysqli_num_rows($resultuserEN);
				if($numuserNE > 0){
						if ($rowss = mysqli_fetch_assoc($resultuserEN)) {
							$_SESSION['u_id'] = $rowss['u_id'];
							$_SESSION['u_username'] = $rowss['u_username'];
							header('location: ../pwdchanged.php');
						}
				} else {
					header("location: ../pwdverify.php?ver=EmailInvalid&user=$username");
				}
		} else {
			header("location: ../pwdverify.php?ver=UsernameInvalid&email=$email");
		}
	}
}


//update password
if(isset($_POST["changePassword"])) {
	
	$user_id = $_POST["username"];
	$pwd = $_POST["pwd"];
	$cpwd = $_POST["cpwd"];
	
	if(empty($pwd) || empty($cpwd)){
		header("location: ../pwdchanged.php?ver=empty");
		exit();
} else {
	if(!$pwd == $cpwd) {
	header("location: ../pwdchanged.php?ver=Notmatch");
	exit();
} else {
	$pwdhashed = password_hash($pwd, PASSWORD_DEFAULT);
	$update = "UPDATE user set u_password = '$pwdhashed' where u_id = '$user_id'";
$numUpdate = mysqli_query($link, $update);
if($numUpdate) {
	echo "SUccessfully changed!";
	header("Refresh: 0.5; url = ../login.php");
	exit();
} else {
	echo "something went wrong!";
	}
	}
}
} 

//**admin**//
if (isset($_POST['a_submit'])) {
	$image = $_FILES['product_image']['name'];
	$pname = $_POST['product_name'];
	$price = $_POST['product_price'];
	$details = $_POST['product_details'];
	$quantity = $_POST['product_quantity'];

	$destination = 'image/product/'.($image);
	move_uploaded_file($_FILES['product_image']['tmp_name'],$destination);

	$a_sql = mysqli_query($link,"INSERT INTO products (p_id,p_name,p_image,p_price,p_details,p_quantity) values ('','$pname','$image','$price','$details','$quantity')");
	
	if ($a_sql) {
		echo "successfuly inserted";
		header("refresh: 0.5; url = ../admin/index.php");
	} else {
		echo "there's an error!";
		header("refresh: 0.5; url = ../admin/index.php");
	}
}

// Cart order
if (isset($_POST['order'])) {
	$name = asd;
}

//**admin**//
?>