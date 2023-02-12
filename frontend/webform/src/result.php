<?php
    // TODO: move to .env file?
    const BACKEND_URL = "http://172.17.0.1";
    const BACKEND_PORT = "3000";
    const BACKEND_PATH = "/competitionResult.php";

    const TEMPLATE_PATH = "./template/";

    $upper = file_get_contents(TEMPLATE_PATH . "upper.html");
    $lower = file_get_contents(TEMPLATE_PATH . "lower.html");
    $result = "";

    // $response = file_get_contents(BACKEND_URL . ":" . BACKEND_PORT . BACKEND_PATH . "?data=" . $_POST);

    /**
     * Dynamically generate the result page, depending on the response
     * from the backend.
     */
    $result = <<<RESULT
        <div class="col">
            <h1 class="text-light">Runners Crisps Competition</h1>
            <p class="text-light">Test result!</p>     
        </div>
RESULT;

    echo $upper . $result . $lower;
?>