<?php

    header("access-control-allow-origin: *");
    include_once '../api/api.php';
    global $conn, $api;
    session_start();

    include_once 'Integrator.class.php';


    $paylive="https://test.slydepay.com/payLIVE/detailsnew.aspx?pay_token=";
    $ns="http://www.i-walletlive.com/payLIVE"; 
    $wsdl="https://test.slydepay.com/webservices/paymentservice.asmx?wsdl";

    $settings = parse_ini_file("slydepay.ini");

    $api_version=$settings["slydepay.api_version"];
    $merchant_email=$settings["slydepay.merchant_email"];
    $merchant_secret_key=$settings["slydepay.merchant_key"];


    $service_type="C2B";
    $integration_mode=true;

    $slyde = new SlydepayConnector($ns, $wsdl, $api_version, $merchant_email, $merchant_secret_key, $service_type, $integration_mode);

    if(isset($_GET['status']) && isset($_GET['transac_id']) && $_GET['status'] === 0 ){
        $slyde->ConfirmTransaction($_GET['pay_token'], $_GET['$transac_id']);
        
        
        $transaction = new Transaction(date("Y-m-d H:i:s"),$_SESSION["user_id"],$_SESSION["amount"]);
        addTransaction($conn, $transaction);
        unset($_SESSION['amount']);
        header("Location: ../transactions.php");
    } else{
        echo "error!";
    }


    $order_id= GUID();


    //me:

    $transaction = new Transaction(date("Y-m-d H:i:s"),$_POST["user_id"],$_POST["amount"]);
    $_SESSION['current_amount'] = $_POST["amount"];

    $order_items[0] = $slyde->buildOrderItem($transaction->getId(), $transaction->getUserId(), $transaction->getId(), $transaction->getAmount(), 1, $transaction->getAmount());


    $response = $slyde->ProcessPaymentOrder($order_id, $transaction->getAmount(), 0, 0, $transaction->getAmount(), "", "", $order_items);
            // var_dump($response);
            // var_dump($response->ProcessPaymentOrderResult);

    $redirect = $paylive.$response->ProcessPaymentOrderResult;

    header("Location: $redirect");

    function GUID()
    {
        if (function_exists('com_create_guid') === true)
        {
            return trim(com_create_guid(), '{}');
        }

        return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
    }

?>

