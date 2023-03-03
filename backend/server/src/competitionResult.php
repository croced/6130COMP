<?php
    require 'vendor/autoload.php';

    $packCode       = strtolower($_POST['packCode']);
    $bestPlayer     = strtolower($_POST['bestPlayer']);

    /**
     * Data validation:
     *  - pack code must be a 10 characters long hex string
     *  - player name must be at least 3 characters long
     */

     if (strlen($_POST['packCode']) != 10)
        exit("INVALID_CODE");

     if (strlen($_POST['bestPlayer']) < 3)
        exit("INVALID_PLAYER");

    /**
     * MongoDB Database connection and setup
     * 
     * Error logging for:
     * - connection errors (MongoConnectionException). 
     * - general mongo errors (MongoException).
     */

    try 
    { 
        $client = new MongoDB\Client(
            'mongodb://mongo-node1:27017,mongo-node2:27017,mongo-node3:27017/admin?replicaSet=rs0'
        );
    } 
    catch (MongoConnectionException $exception) {
        die('[MongoConnectionException]: ' . $exception->getMessage());
    }
    catch (MongoException $exception) {
        die('[MongoException]: ' . $exception->getMessage());
    }
        
    $users = $client->runnersCrisps->users;
    $codes = $client->runnersCrisps->codes;

    /**
     * Find the code in the database and 
     * If not, they should receive a 10% discount for their
     * next packet of Runners Crisps.
     */

    $result = $codes->findOne(['code' => $packCode]);

    if ($result->used === TRUE)
        exit("CODE_USED");

    // voucher logic
    if ($result->wonFootball === TRUE) 
        echo "VOUCHER_FOOTBALL";
    else if ($result === NULL)
        echo "INVALID_CODE";
    else echo "VOUCHER_CRISPS";

    // set this code to 'used'
    $codes->updateOne(
        ['code' => $packCode], 
        ['$set' => ['used' => TRUE]]
    );

    // insert new user object, with the provided details from the web form
    $users->insertOne(
    [
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'address' => $_POST['address'],
        'bestPlayer' => $bestPlayer
    ]);
?>