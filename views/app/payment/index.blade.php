@extends('layouts.app')

@section('content')
<?php
error_reporting(E_ALL);
include_once(app_path() . '\Classes\Payment\PaymentClass.php');
include_once(app_path() . '\Classes\Payment\PaysafeLogger.php');
/**
 *
 * Check config.php for configuration
 *
 */
include_once(app_path() . '\Classes\Payment\config.php');

// Set correlation ID for referencing (optional), default = ""
$correlation_id = "testCorrID_" . uniqid();

// create new Payment Controller
$pscpayment = new PaysafecardPaymentController($config['psc_key'], $config['environment']);

if ($config['logging']) {
    $logger = new PaysafeLogger();
}

//checking for actual action
if (count($_POST) > 0) {

    // Amount of this Payment, i.e. "10.00"
    $amount = $_POST["amount"];

    // Currency of this Payment , i.e. "EUR"
    $currency = 'RON';

    // the customer ID (merchant client id)
    $customer_id = $user->player_id;

    // the customers IP address
    $customer_ip = $_SERVER['REMOTE_ADDR'];

    // the redirect url after a successful Payment, the customer will be sent to this url on success
    $success_url = getURL() . "success?payment_id={payment_id}";

    // the redirect url after a failed / aborted Payment, the customer will be redirected to this url on failure
    $failure_url = getURL() . "failure?payment_id={payment_id}";

    // your scripts notification URL, this url is called to notify your script a Payment has been processed
    $notification_url = getURL() . "notification?payment_id={payment_id}";

    /*
     * // This is a sample how to use the optional parameters
     *
     * // only allow customers of a certain country, default: ""
     * $country_restriction = "DE";
     *
     * // set the minimum age of the customer, , default: ""
     * $min_age = 18;
     *
     * // only allow customers with a certain kyc level, default: ""
     * $kyc_restriction = "FULL";
     *
     * // chose the shop id to use for this Payment, default: ""
     * $shop_id = 1;
     *
     * // Reporting Criteria, default = ""
     * $submerchant_id = "1";
     *
     * // create a new Payment with the optional parameters, use this if you want to use the optional parameters
     * $response = $pscpayment->createPayment($amount, $currency, $customer_id, $customer_ip, $success_url, $failure_url, $notification_url, $correlation_id, $country_restriction, $kyc_restriction, $min_age, $shop_id, $submerchant_id);
     *
     */

    // creating a Payment and receive the response
    $response = $pscpayment->createPayment($amount, $currency, $customer_id, $customer_ip, $success_url, $failure_url, $notification_url, $correlation_id);

    // log requests and responses to log file (may be turned off in production mode)
    if ($config['logging']) {
        $logger->log($pscpayment->getRequest(), $pscpayment->getCurl(), $pscpayment->getResponse());
    }

    // response handling
    if ($response == false) {
        $error = $pscpayment->getError();

        if ($config['debug_level'] == 0) {

            if (($error["number"] == 4003) || ($error["number"] == 3001) || ($error["number"] == "HTTP:403")) {
                echo '
                <div class="alert alert-danger" role="alert">
                    <strong>ERROR: ' . $error["number"] . '</strong> ' . $error["message"] . '
                </div>';
            } else {
                echo '
                <div class="alert alert-danger" role="alert">
                    Transaction could not be initiated due to connection problems. If the problem persists, please contact our support.
                </div>';
            }
        }

        if ($config['debug_level'] >= 1) {
            echo '
            <div class="alert alert-danger" role="alert">
                Transaction could not be initiated due to connection problems. If the problem persists, please contact our support.
            </div>';

        }

        if ($config['debug_level'] == 2) {
            echo '
            <div class="alert alert-warning" role="alert">
                Request: <pre>';
            print_r($pscpayment->getRequest());
            echo '</pre>
            </div>';
            echo '
            <div class="alert alert-warning" role="alert">
                CURL: <pre>';
            print_r($pscpayment->getCurl());
            echo '</pre>
            </div>';
            echo '
            <div class="alert alert-warning" role="alert">
                Response: <pre>';
            print_r($pscpayment->getResponse());
            echo '</pre>
            </div>';

        }

    } else if (isset($response["object"])) {
        if (isset($response["redirect"])) {
            header("Location: " . $response["redirect"]['auth_url']);
            exit;
        }
    }
}

function getURL()
{
    $s        = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
    $sp       = strtolower($_SERVER["SERVER_PROTOCOL"]);
    $protocol = substr($sp, 0, strpos($sp, "/")) . $s;
    return $protocol . "://" . $_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']);
}
?>

<div style="margin:auto; max-width: 600px;">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title">Cumpara puncte premium</h2>
        </div>
        <div class="panel-body">
            <form method="POST">
                <div class="form-group">
                    <label for="amount">Suma:</label>
                    <select name="amount" id="amount" class="form-control">
                        <option value="25" selected>25 Lei - 60 PP</option>
                        <option value="50">50 Lei - 120 + 15 PP</option>
                        <option value="100">100 Lei - 240 + 25 PP</option>
                        <option value="150">150 Lei - 360 + 40 PP</option>
                        <option value="250">250 Lei - 620 + 50 PP</option>
                    </select>
                </div>

                <p>Daca intampinati probleme cu o plata efecutata, nu ezitati sa deschideti un tichet!</p>
                <br/>
                <button type="submit" name="action" value="payment" class="btn btn-success">pay with paysafecard</button>
            </form>
        </div>
    </div>


</div>
@endsection