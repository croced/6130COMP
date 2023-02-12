<?php

    const TEMPLATE_PATH = "template/";
    const VIEWS_PATH = "views/";

    const DEFAULT_VIEW = "form.html";

    /**
     * HTML is split into 3 parts:
     *      - upper:   contains 'upper' portion of the HTML.
     *      - view:    contains the HTML for the form; this portion can be 
     *                          changed to display other views.
     *      - lower:   contains 'lower' portion of the HTML.
     * 
     * The 3 parts are then concatenated and displayed.
     * 
     * Templating was done this way (instead of using a templating engine) to
     * reduce the number of dependencies and simplify deployment.
     */

    $upper = file_get_contents(TEMPLATE_PATH . "upper.html");
    $view = file_get_contents(VIEWS_PATH . DEFAULT_VIEW);
    $lower = file_get_contents(TEMPLATE_PATH . "lower.html");

    echo $upper . $view . $foot;
?>