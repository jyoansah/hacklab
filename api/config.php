<?php

include_once '.env.php';

//Status code methods
function getStatusCodeMessage($status)
{
    $codes = Array(
        100 => 'Continue',
        101 => 'Switching Protocols',
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        306 => '(Unused)',
        307 => 'Temporary Redirect',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Requested Range Not Satisfiable',
        417 => 'Expectation Failed',
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported'
    );

    return (isset($codes[$status])) ? $codes[$status] : '';
}

//Helper method to send a HTTP response code/message
function sendResponse($status = 200, $body = '', $content_type = 'text/html')
{
    $status_header = 'HTTP/1.1 ' . $status . ' ' . getStatusCodeMessage($status);
    header($status_header);
    header('Content-type: ' . $content_type);
    echo $body;
}


function OpenConnection()
{
    $error = "";
    $dbhost = HOST;
    $dbuser = USER;
    $dbport = PORT;
    $dbpass = PASSWORD;
    $dbname = DATABASE;
    $serverName = "tcp:$dbhost,$dbport";

    try {
        $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);

        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //Create Tables
        $sql = "CREATE DATABASE IF NOT EXISTS ".$dbname;
        $conn->exec($sql);
        

        //Create Tables
        $sql = "CREATE TABLE IF NOT EXISTS  Users
                    (
                        id int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
                        username varchar(50)  NULL,
                        email varchar(50)  NULL,
                        password varchar(50)  NOT NULL,
                        PRIMARY KEY (id)
                    )";
        $conn->exec($sql);


        //Create Database
        $sql = "CREATE TABLE IF NOT EXISTS Transactions
                    (
                      id int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
                      tdate TIMESTAMP  NULL,
                      amount varchar(50)  NULL,
                      user_id int UNSIGNED NULL,
                      PRIMARY KEY (id),
                      FOREIGN KEY (user_id) REFERENCES Users(id)
                    )";
        $conn->exec($sql);


        return $conn;

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }


}