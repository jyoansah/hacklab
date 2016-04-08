<?php
//Encode result in json format
function sanitizeResult($result, $code = 200) {
    if (count($result) > 0) {
        sendResponse($code, json_encode($result));
        return true;
    } else {
        sendResponse($code, json_encode("ERROR"));
        return true;
    }
}

function GeSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") {
    if (PHP_VERSION < 6) {
        $theValue_ = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
    }
    switch ($theType) {
        case "text":
            $theValue_ = ($theValue != "") ? $theValue : "NULL";
            break;
        case "long":
        case "int":
            $theValue_ = ($theValue != "") ? intval($theValue) : "NULL";
            break;
        case "double":
            $theValue_ = ($theValue != "") ? doubleval($theValue) : "NULL";
            break;
        case "date":
            $theValue_ = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
            break;
        case "defined":
            $theValue_ = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
            break;
    }
    return $theValue_;
}



function userGetter($conn, $condition){
    try
    {

        $conn = OpenConnection();

        if(empty($condition)) {
            $sql = "SELECT id, username, password FROM Users";
        }
        else{
            $sql = "SELECT id, username, password FROM Users WHERE ".$condition;

        }

        foreach ($conn->query($sql) as $row) {
                $user = new User($row["username"]);
                $user->setPosition($row["password"]);
                $user->setId($row["id"]);
                $users[] = $user;
        }

        $conn = null;

        if (!empty($users)) {
            return  $users;
        }else{
            return null;
        }
    }
    catch(PDOException $e)
    {
        echo $sql . "<br>" . $e->getMessage();
    }
}

function getUser($conn, $id){
    $cond = "id =$id";
    $users = userGetter($conn, $cond);

    if (empty($users)){
        return "not found";
    }
    return $users;
}

function addUser($conn, $user){

    try{
        $username = $user->getUsername();
        $password = $user->getPassword();

        $sql = "INSERT INTO Users (username, password)
                VALUES ('$username','$password')";
       
        $conn = OpenConnection();
        $conn->exec($sql);

        $conn = null;

        $new_id = $conn->lastInsertId();

        $conn = null;

        if (empty($new_id)){
            return null;
        }else{
            return $new_id;
        }
    }
    catch(PDOException $e)
    {
        echo $sql . "<br>" . $e->getMessage();
    }
}

// function addUser($conn, $user){
//     $array = [
//         'transaction_id' => $user->gettransactionId(),
//         "transaction" => gettransaction($conn, $user->gettransactionId())->getName(),
//         "position" => addUserDB($conn,$user),
//         "serving" => getfirstInLine($conn, $user->gettransactionId())
//     ];
//     return $array;
// }




function transactionGetter($conn, $condition){

    try {

        $conn = OpenConnection();

        if (empty($condition)) {
            $sql = "SELECT id, tdate, amount, user_id FROM Transactions";
        } else {
            $sql = "SELECT id, tdate, amount, user_id FROM Transaction WHERE $condition";
        }


        foreach($conn->query($sql) as $row) {
                $transaction = new transaction($row["tdate"], $row["user_id"], $row["amount"]);
                $transaction->setId($row["id"]);
                $transactions[] = $transaction;
        }

        $conn = null;

        if (!empty($transactions)) {
            return $transactions;
        } else {
            return null;
        }

    }
    catch(PDOException $e)
    {
        echo $sql . "<br>" . $e->getMessage();
    }
}

function gettransaction($conn, $id){
    
    $cond = "id =".intval($id);
    $transactions = transactionGetter($conn, $cond);

    if (empty($transactions)){
        return null;
    }else{
        return $transactions[0];
    }

}

function gettransactions($conn){
    $transactions = transactionGetter($conn, null);
    if (empty($transactions)){
        return "No transactions available";
    }
    return $transactions;
}

function addtransaction($conn, $transaction){

    $user_id = $transaction->getUserID();
    $tdate = $transaction->getTDate();
    $amount = $transaction->getAmount();

    try {
        $sql = "INSERT INTO transaction (tdate, amount, user_id)
                VALUES ('$tdate','$amount','user_id')";
        //Insert query
        $conn = OpenConnection();
        $conn->exec($sql);

        $new_id = $conn->lastInsertId();

        $conn = null;

        if (empty($new_id)){
            return null;
        }else{
            return $new_id;
        }

    }
    catch(PDOException $e)
    {
        echo $sql . "<br>" . $e->getMessage();
    }

}



// function getfirstInLine($conn, $transaction_id){

//     try{

//         $conn = OpenConnection();

//         $sql = "SELECT position FROM Users WHERE transaction_id=".$transaction_id." ORDER BY position ASC LIMIT 1";

//         foreach ($conn->query($sql) as $row) {
//             $result = $row["position"];
//         }

//         $conn = null;

//         if (!empty($result)) {
//             return  $result;
//         }else{
//             return null;
//         }
//     }
//     catch(PDOException $e){
//         echo $sql . "<br>" . $e->getMessage();
//     }
// }

// function getLastInLine($conn, $transaction_id){
//     try{

//         $conn = OpenConnection();

//         $sql = "SELECT position FROM Users WHERE transaction_id=".$transaction_id." ORDER BY position DESC LIMIT 1";

//         foreach ($conn->query($sql) as $row) {
//             $result = $row["position"];
//         }

//         $conn = null;

//         if (!empty($result)) {
//             return  $result;
//         }else{
//             return null;
//         }
//     }
//     catch(PDOException $e){
//         echo $sql . "<br>" . $e->getMessage();
//     }
// }

// function detransactionUser($conn, $transaction_id){
//     try{

//         $conn = OpenConnection();

//         $sql = "DELETE FROM Users where position = (Select * from
//               (SELECT position FROM Users WHERE transaction_id=".$transaction_id." ORDER BY position ASC LIMIT 1) as q)";

//         $conn->query($sql);

//         $conn = null;

//     }
//     catch(PDOException $e){
//         echo $sql . "<br>" . $e->getMessage();
//     }
// }

