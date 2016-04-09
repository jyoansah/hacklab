<?php

function userGetter($conn, $condition){
    try
    {

        $conn = OpenConnection();

        if(empty($condition)) {
            $sql = "SELECT id, username, email, password, balance FROM Users";
        }
        else{
            $sql = "SELECT id, username, email, password, balance FROM Users WHERE ".$condition;       
        }

        foreach ($conn->query($sql) as $row) {
                $user = new User($row["username"], $row["email"], $row["password"]);
                $user->setBalance($row["balance"]);
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

function getUserWithID($conn, $id){
    $cond = "id = \"$id\"";
    $user = userGetter($conn, $cond);

    if (empty($user)){
        return "not found";
    }

    return $user[0];
}

function getUserWithUsername($conn, $username){
    $cond = "username = \"$username\"";
    $users = userGetter($conn, $cond);

    if (empty($users)){
        return "not found";
    }
    return $users[0];
}

function addUser($conn, $user){

    try{
        $username = $user->getUsername();
        $email = $user->getEmail();
        $password = $user->getPassword();

        $sql = "INSERT INTO Users (username, email, password)
                VALUES ('$username','$email','$password')";
       
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

function updateUser($conn, $user){

    try{
        $id = $user->getId();
        $username = $user->getUsername();
        $email = $user->getEmail();
        $password = $user->getPassword();
        $balance = $user->getBalance();

        $sql = "UPDATE Users
                SET username = '$username', email = '$email', password = '$password', balance = '$balance'
                WHERE id = \"$id\"";
       
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

function editUserBalance($conn, $userId, $amount){

    $user = getUserWithID($conn, $userId);
    $newbal = $user->getBalance() + $amount;
    $user->setBalance($newbal);
    $user->setId($userId);
    updateUser($conn, $user);

}

function transactionGetter($conn, $condition){

    try {

        $conn = OpenConnection();

        if (empty($condition)) {
            $sql = "SELECT id, tdate, amount, user_id FROM Transactions";
        } else {
            $sql = "SELECT id, tdate, amount, user_id FROM Transactions WHERE $condition";
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

function getTransactionWithID($conn, $id){
    
    $cond = "id = \"$id\"";
    $transactions = transactionGetter($conn, $cond);

    if (empty($transactions)){
        return null;
    }else{
        return $transactions[0];
    }
}

function getTransactions($conn){
    $transactions = transactionGetter($conn, null);
    if (empty($transactions)){
        return "No transactions available";
    }
    return $transactions;
}

function getUserTransactions($conn, $user_id){

    $cond = "user_id = \"$user_id\"";
    $transactions = transactionGetter($conn, $cond);

    if (empty($transactions)){
        return null;
    }else{
        return $transactions;
    }
}

function addTransaction($conn, $transaction){

    $user_id = $transaction->getUserID();
    $tdate = $transaction->getTDate();
    $amount = $transaction->getAmount();

    try {

        $sql = "INSERT INTO transactions (tdate, amount, user_id)
                VALUES ('$tdate','$amount','$user_id')";
        //Insert query
        $conn = OpenConnection();
        $conn->exec($sql);

        $new_id = $conn->lastInsertId();

        $conn = null;

        if (empty($new_id)){
            return null;
        }else{

            editUserBalance($conn, $user_id, $amount);
            return $new_id;

        }

    }
    catch(PDOException $e)
    {
        echo $sql . "<br>" . $e->getMessage();
    }

}



function loanGetter($conn, $condition){

    try {

        $conn = OpenConnection();

        if (empty($condition)) {
            $sql = "SELECT id, sdate, amount, user_id, status FROM loans";
        } else {
            $sql = "SELECT id, sdate, amount, user_id, status FROM loans WHERE $condition";
        }


        foreach($conn->query($sql) as $row) {
            $loan = new loan($row["sdate"], $row["user_id"], $row["amount"], $row["status"]);
            $loan->setId($row["id"]);
            $loans[] = $loan;
        }

        $conn = null;

        if (!empty($loans)) {
            return $loans;
        } else {
            return null;
        }

    }
    catch(PDOException $e)
    {
        echo $sql . "<br>" . $e->getMessage();
    }
}

function getloanWithID($conn, $id){
    
    $cond = "id = \"$id\"";
    $loans = loanGetter($conn, $cond);

    if (empty($loans)){
        return null;
    }else{
        return $loans[0];
    }
}

function getloans($conn){
    $loans = loanGetter($conn, null);
    if (empty($loans)){
        return "No loans available";
    }
    return $loans;
}

function getUserloans($conn, $user_id){

    $cond = "user_id = \"$user_id\"";
    $loans = loanGetter($conn, $cond);

    if (empty($loans)){
        return null;
    }else{
        return $loans;
    }
}

function addloan($conn, $loan){

    $user_id = $loan->getUserID();
    $sdate = $loan->getSDate();
    $amount = $loan->getAmount();
    $status = $loan->getStatus();

    try {

        $sql = "INSERT INTO loans (sdate, amount, user_id, status)
                VALUES ('$sdate','$amount','$user_id', '$status')";
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