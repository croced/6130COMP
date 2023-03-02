<?php
    require 'vendor/autoload.php';

    /**
     * MongoDB Database connection and setup
     * 
     * Error logging for connection errors (MongoConnectionException) and 
     * general mongo errors (MongoException).
     */

    try 
    { 
        $client = new MongoDB\Client(
            'mongodb://mongo-node1:27017,mongo-node2:27017,mongo-node3:27017/admin?replicaSet=rs0'
        );
    } 
    catch (MongoConnectionException $exception) 
    {
        die('[MongoConnectionException]: ' . $exception->getMessage());
    } 
    catch (MongoException $exception) 
    {
        die('[MongoException]: ' . $exception->getMessage());
    }
        
    $users = $client->runners_crisps->users;
    $codes = $client->runners_crisps->codes;

    // const HEX_REGEX = '^[a-fA-F0-9]+$';     // https://stackoverflow.com/q/11877554
    const WIN_PERCENTAGE = 1;                  // 1 in 100 chance of winning a football, todo: remove this!

    $packCode       = strtolower($_POST['packCode']);
    $bestPlayer     = strtolower($_POST['bestPlayer']);

    /**
     * Validation:
     *  - pack code must be a 10 characters long hex string
     *  - player name must be at least 3 characters long
     */

    if (strlen($_POST['packCode']) != 10)
    {
        echo "Invalid pack code!";
        exit();
    }

    if (strlen($_POST['bestPlayer']) < 3)
    {
        echo "Invalid player name!";
        exit();
    }

    /**
     * Check if the user has won a free football.
     * If not, they should receive a 10% discount for their
     * next packet of Runners Crisps.
     * 
     * TODO: Use database to do code checking!
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
 
?>