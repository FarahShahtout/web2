
<!DOCTYPE html>
<html>
<head>

<style>
		form {
			display: flex;
			flex-direction: column;
			align-items: center;
			margin-top: 50px;
		}
		input[type=text], input[type=email], input[type=password] {
			margin-top: 10px;
			padding: 10px;
			border-radius: 5px;
			border: none;
			box-shadow: 1px 1px 5px rgba(0,0,0,0.2);
			width: 100%;
			max-width: 400px;
		}
		input[type=radio] {
			margin-top: 10px;
			margin-bottom: 10px;
		}
		input[type=submit] {
			margin-top: 20px;
			padding: 10px 20px;
			background-color: #4CAF50;
			color: white;
			border: none;
			border-radius: 5px;
			cursor: pointer;
		}
		input[type=submit]:hover {
			background-color: #3e8e41;
		}
		.error {
			color: red;
			font-size: 14px;
			margin-bottom: 10px;
		}
	</style>
	
</head>
<body>
	<form method="POST" action="#" enctype="multipart/form-data">
		<label for="name">Name:</label>
		<input type="text" id="name" name="name" required>
		<label for="email">Email:</label>
		<input type="email" id="email" name="email" required>
		<label for="password">Password:</label>
		<input type="password" id="password" name="password" required>
		<label for="gender">Gender:</label>
		<input type="radio" id="male" name="gender" value="male" required>
		<label for="male">Male</label>
		<input type="radio" id="female" name="gender" value="female" required>
		<label for="female">Female</label>
		<input type="submit" value="Sign Up">
	</form>
    

	<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


	
	// get the form data
   $name = htmlspecialchars($_POST['name']);
   $email = htmlspecialchars($_POST['email']);
   $password = htmlspecialchars($_POST['password']);
   $gender = htmlspecialchars($_POST['gender']);

	
	
	// validate the form data
	$errors = array();
	if (empty($name)) {
		$errors[] = "Name is required";
	}
	if (empty($email)) {
		$errors[] = "Email is required";
	} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$errors[] = "Invalid email format";
	}
	if (empty($password)) {
		
		$errors[] = "Password is required";

	}
	if (empty($gender)) {
		$errors[] = "Gender is required";
	}
	
	// if there are errors, display them
	if (!empty($errors)) {
		echo "<h2>Error:</h2>";
		foreach ($errors as $error) {
			echo "<p>$error</p>";
		}
	}

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
	

    $host = 'localhost';
    $username = 'root';
   $password = '';
   $dbname = 'web2';

    $conn = mysqli_connect($host, $username, $password, $dbname);

   if (!$conn) {
         die("Connection failed: " . mysqli_connect_error());
    }



 
	$stmt = $conn->prepare("INSERT INTO users (name, email, password, gender) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $hashed_password, $gender);

	$stmt->execute();

	if($stmt==TRUE){
	
        echo 'Successfully added record';
    }


	$stmt->close();
    $conn->close();

 
   
    

	


}
    ?>


	
 </html>







