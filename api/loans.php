<?php

	header("access-control-allow-origin: *");
    include_once '../api/api.php';
    global $conn, $api;
    session_start();
	
    
    if(isset($_POST['loan-submit'])){
        
        if (empty($_POST['amount'])) {
            $error = "You must enter and amount!";
        }
        else{
        
            $user_id = $_SESSION['login_user'];
            $sdate = date("Y-m-d H:i:s");
            $amount = $_POST['amount'];

            $conn = openConnection();

            $user = getUserWithId($conn, $user_id);

            $loanID = addLoan($conn, new Loan($sdate, $user_id, $amount, Loan::REQUESTED));

            if(!empty($loanID)){
                header("location: ../dashboard.php"); // Redirecting To Other Page
            }
        }
    }


?>
