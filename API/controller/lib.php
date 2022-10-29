<?php

//Connect to our database
function connect()
{
    $database = "u848655856_job_board";
    $host = "153.92.220.51";
    $login = "u848655856_root";
    $password = "Admin@epitech59";
    $dbh = new PDO('mysql:dbname=' . $database . ';charset=utf8;host=' . $host, $login, $password);
    return $dbh;
}

//Return the data in Json
function sendJson($data)
{
    header("Access-Control-Allow-Origin: *");
    header("Content-type; application/json");
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
}

//Check if the Register form is valid
function validRegister()
{
    
    $err = "";
    if (!isset($_POST["name"]) || $_POST["name"] == "") {
        return $err = "Please fill the name field";
    } else if (!isset($_POST["surname"]) || $_POST["surname"] == "") {
        return $err = "Please fill the surname field";
    } else if (!isset($_POST["gender"])) {
        return $err = "Please fill the gender field";
    } else if (!isset($_POST["status"])) {
        return $err = "Please fill the status field";
    } else if (!isset($_POST["email"])) {
        return $err = "Please fill the email field";
    } else if (isset($_POST["email"]) && aviableEmail($_POST["email"])) {
        return $err = "The email is already taken";
    } else if (!isset($_POST["password"])) {
        return $err = "Please fill the password field";
    } else if (!isset($_POST["confirm-password"])) {
        return $err = "Please fill the confirm-password field";
    } else if ($_POST["confirm-password"] != $_POST["password"]) {
        return $err = "Please make sure you wrote the same password";
    } else if ($_POST["status"] == "NULL") {
        return $err = "Please choose a role";
    } else {
        
        return "0";
    }
}

//Check if the create advertisements form is valid
function validAdvertisements()
{
    $err = "";
    if (!isset($_POST["company_name"]) || $_POST["company_name"] == "") {
        return $err = "Please fill the company_name field";
    } else if (!isset($_POST["job_title"]) || $_POST["job_title"] == "") {
        return $err = "Please fill the title field";
    } else if (!isset($_POST["salary"]) || $_POST["salary"] == "") {
        return $err = "Please fill the salary field";
    } else if (!isset($_POST["type"]) || $_POST["type"] == "0") {
        return $err = "Please fill the type field";
    } else if (!isset($_POST["short_description"]) || $_POST["short_description"] == "") {
        return $err = "Please fill the short description field";
    } else if (!isset($_POST["long_description"]) || $_POST["long_description"] == "") {
        return $err = "Please fill the long description field";
    } else {
        return "0";
    }
}


//Check if the email choosed is free to use
function aviableEmail($email)
{
    
    $pdo = connect();
    $req = "SELECT * FROM users where email = '" . $email."'";
    $stmt = $pdo->prepare($req);
    $stmt->execute();
    $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if(count($user)==0){
        return false;
    }
    else{
        return true;
    }
}


//Get the data from an url of the API
function curlGet($url)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    $data = curl_exec($ch);
    curl_close($ch);
    return json_decode($data);
}
