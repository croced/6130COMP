<?php
    // TODO: move to .env file?
    const BACKEND_URL = "http://192.168.64.2";
    const BACKEND_PORT = "84";
    const BACKEND_PATH = "/competitionResult.php";

    const TEMPLATE_PATH = "./template/";

    $upper = file_get_contents(TEMPLATE_PATH . "upper.html");
    $lower = file_get_contents(TEMPLATE_PATH . "lower.html");

    $response = file_get_contents(BACKEND_URL . ":" . BACKEND_PORT . BACKEND_PATH . "?data=" . implode("", $_POST));

    /**
     * Dynamically generate the result page, depending on the response
     * from the backend.
     */

    $result = "";

    $col = <<<COL
        <div class="col">
            <h1 class="text-light">Runners Crisps Competition</h1>
COL;

    if ($response == "VOUCHER_FOOTBALL") // free football
    {
        $result = <<<RESULT
        <p class="text-light">Congratulations - you have won a voucher code fro a <b>free football!</b></p>    
        <p>Please check your email address for the code!</p> 
RESULT;
    } 
    else if ($response == "VOUCHER_CRISPS") // 10% off
    {
        $result = <<<RESULT
        <p class="text-light">Better luck next time!</p>
        <p>Check your email address for a voucher worth 10% off your next bag of Runners Crisps!</p>    
RESULT;
    }
    else // unexpected response
    {
        $result = <<<RESULT
        <p class="text-light">An error has occurred!</p>
        <p class="text-light">(response: $response)</p>
RESULT;
    }

    $closeDiv = <<<CLOSEDIV
        </div>
CLOSEDIV;

    $content = $col . $result . $closeDiv;

    echo $upper . $content . $lower;
?>