<?php
// session_start() has to go right at the top, before any output!
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Customer satisfaction survey</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script   src="https://code.jquery.com/jquery-3.1.0.min.js"   integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s="   crossorigin="anonymous"></script>

    <style>

        body {
            text-align: center;
            background-color: #2c7db7;
            color: #fff;
        }
    </style>
</head>
    <body>

            <h1>Thank you !</h1>
            <h3>Your survey has been sent to our team <br/>and will help us serve you better</h3>
    </body>
</html>

<?php

require_once ('soapclient/SforcePartnerClient.php');
require_once ('soapclient/SforceEnterpriseClient.php');

define("USERNAME", "YOUR_USERNAME");
define("PASSWORD", "YOUR_PASSWORD");
define("SECURITY_TOKEN", "YOUR_TOKEN");

$callId = $_POST['callId'];
// echo $callId;
$surveyInfo =  $_POST['textarea'];
$surveyScore = $_POST['radios'];

try {

    $mySforceConnection = new SforceEnterpriseClient();
    $mySforceConnection->createConnection("soapclient/enterprise.wsdl.xml");

    // Simple example of session management - first call will do
    // login, refresh will use session ID and location cached in
    // PHP session
    if (isset($_SESSION['enterpriseSessionId'])) {
        $location = $_SESSION['enterpriseLocation'];
        $sessionId = $_SESSION['enterpriseSessionId'];

        $mySforceConnection->setEndpoint($location);
        $mySforceConnection->setSessionHeader($sessionId);

    } else {
        $mySforceConnection->login(USERNAME, PASSWORD.SECURITY_TOKEN);

        $_SESSION['enterpriseLocation'] = $mySforceConnection->getLocation();
        $_SESSION['enterpriseSessionId'] = $mySforceConnection->getSessionId();
    }

    $query = "SELECT Id,WhoId,OdigoCti__Survey_information__c, OdigoCti__Survey_name__c, OdigoCti__Survey_score__c from Task where OdigoCti__Call_reference__c ='".$callId."'";
    $response = $mySforceConnection->query($query);

    foreach ($response->records as $record) {
        $taskId = $record->Id;
        //echo $taskId ."<br/>\n";
    }


    $response = $mySforceConnection->retrieve('Id, OdigoCti__Survey_name__c, OdigoCti__Survey_information__c, OdigoCti__Survey_score__c',
        'Task', $taskId);

    $newTask = array();

    $newTask[0] = new stdclass();
    $newTask[0]->id = $taskId;
    $newTask[0]->OdigoCti__Survey_information__c = $surveyInfo;
    $newTask[0]->OdigoCti__Survey_score__c = $surveyScore;
    $newTask[0]->OdigoCti__Survey_name__c = "Customer Satisfaction Survey";

    //print_r($newTask);

    $response = $mySforceConnection->update($newTask, 'Task');

    // print_r($response);



} catch (Exception $e) {
    echo "Exception ".$e->faultstring."<br/><br/>\n";
    echo "Last Request:<br/><br/>\n";
    echo $mySforceConnection->getLastRequestHeaders();
    echo "<br/><br/>\n";
    echo $mySforceConnection->getLastRequest();
    echo "<br/><br/>\n";
    echo "Last Response:<br/><br/>\n";
    echo $mySforceConnection->getLastResponseHeaders();
    echo "<br/><br/>\n";
    echo $mySforceConnection->getLastResponse();
}
?>
