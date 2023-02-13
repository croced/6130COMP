<?php

    const HEX_REGEX = '^[a-fA-F0-9]+$';     // https://stackoverflow.com/q/11877554
    const WIN_PERCENTAGE = 1;               // 1 in 100 chance of winning a football

    // if (isset($_POST['submit']))
    // {
        $packCode       = strtolower($_POST['packCode']);
        $bestPlayer     = strtolower($_POST['bestPlayer']);

        /**
         * Validation:
         *  - pack code must be a 10 characters long hex string
         *  - player name must be at least 3 characters long
         */

        if (strlen($packCode) != 10)
        {
            echo "Invalid pack code!";
            exit();
        }

        if (strlen($bestPlayer) <= 3)
        {
            echo "Invalid player name!";
            exit();
        }

        /**
         * Check if the user has won a free football.
         * If not, they should receive a 10% discount for their
         * next packet of Runners Crisps.
         */

        $hasWon = (mt_rand(0, 99) < WIN_PERCENTAGE);

        if ($hasWon)
        {
            echo "VOUCHER_FOOTBALL";
        }
        else
        {
            echo "VOUCHER_CRISPS";
        }
    // }
?>