<?php
    // TODO: move to .env file?
    const BACKEND_URL = "http://192.168.64.3";
    const BACKEND_PORT = "84";
    const BACKEND_PATH = "/competitionResult.php";

    const TEMPLATE_PATH = "./template/";

    $upper = file_get_contents(TEMPLATE_PATH . "upper.html");
    $lower = file_get_contents(TEMPLATE_PATH . "lower.html");

    $data = array('packCode' => $_POST['packCode'], 'bestPlayer' => $_POST['bestPlayer']);

    $options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded",
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
    );

    $url = BACKEND_URL . ":" . BACKEND_PORT . BACKEND_PATH;
    $context  = stream_context_create($options);
    $response = file_get_contents($url, false, $context);

    /**
     * Dynamically generate the result page, depending on the response
     * from the backend.
     */

    $result = "";

    $col = <<<COL
        <div class="col">
COL;

    if ($response == "VOUCHER_FOOTBALL") // free football
    {
        $result = <<<RESULT
            <h4 class="text-light">Congratulations - you have won a voucher code fro a <b>free football!</b></h4>    
            <p class="text-light">Please check your email address for the code!</p> 
RESULT;
    } 
    else if ($response == "VOUCHER_CRISPS") // 10% off
    {
        $result = <<<RESULT
            <h4 class="text-light">Better luck next time!</h4>
            <p class="text-light">Check your email address for a voucher worth 10% off your next bag of Runners Crisps!</p>    
RESULT;
    }
    else if ($response == "INVALID_CODE") // Invalid code
    {
        $result = <<<RESULT
            <h4 class="text-light">Invalid code</h4>
            <p class="text-light">The code you have entered is invalid! Please check you have entered it correctly, and try again.</p>    
RESULT;
    }
    else if ($response == "CODE_USED") // Code has been used already
    {
        $result = <<<RESULT
            <h4 class="text-light">Code used aready</h4>
            <p class="text-light">Oops - it looks like this code has been used before! Please try a new code.</p>    
RESULT;
    }
    else if ($response == "INVALID_DATA") // Invalid data
    {
        $result = <<<RESULT
            <h4 class="text-light">Oops!</h4>
            <p class="text-light">Some of the data you have entered is invalid! Please try again.</p>    
RESULT;
    }
    else // unexpected response
    {
        $result = <<<RESULT
            <h4 class="text-light">An error has occurred!</h4>
            <p class="text-light">(response: $response)</p>
RESULT;
    }

    $closeDiv = <<<CLOSEDIV
        </div>
CLOSEDIV;

    $content = $col . $result . $closeDiv;

    echo $upper . $content . $lower;
?>