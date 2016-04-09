<?php  

    header("access-control-allow-origin: *");
    include_once 'api/api.php';
    global $conn, $api;
	session_start();


	if(isset($_POST['register'])){
		
		if (empty($_POST['username']) || empty($_POST['password'])) {
			$error = "Username or Password is empty";
		}
		else{
	    
	    	$username = $_POST['username'];
	    	$password = $_POST['password'];

	    	$conn-> OpenConnection();

	    	$user = getUserWithUsername($conn, $username);

	    	if($user == 'not found'){
	    		retrun "User not found";
	    	}else{
	    		$checkPass = $user->getPassword();

	    		if($checkPass !== $password){
    				return "Incorrect Password";
	    		}else{
	    			$_SESSION['user']=$user->getID();
	    			header("location: dashboard.php"); // Redirecting To Other Page
	    		}
			}
	    }
	}

?>