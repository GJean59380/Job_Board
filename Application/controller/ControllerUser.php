<?php

class ControllerUser
{

    public function __construct($url)
    {

        if ((count($url) == 1) && $url[0] == "user") {
            if (isset($_SESSION["User"]) && $_SESSION["User"]["privileges"] == 3) {
                $data = curlGet("https://job-board.fun/user");
                require_once "./views/viewAllUsers.php";
            } else {
                $err = "Vous devez possèder les droits administrateurs";
                require_once "./views/viewErrors.php";
            }
        }





        if ((count($url) == 2) && $url[0] == "user" && is_numeric($url[1])) {

            $data = curlGet("https://job-board.fun/user/" . $url[1]);
            $events = curlGet("https://job-board.fun/events/user/" . $url[1]);
            require_once "./views/viewOneUser.php";
        }










        if ((count($url) == 2) && $url[0] == "user" && $url[1] == "login") {
            require_once "./views/viewLogin.php";
        }

        if ((count($url) == 3) && $url[0] == "user" && $url[1] == "login" && $url[2] == "validate") {
            $response = curlPost('https://job-board.fun/user/log');
            if ($response == "1") {
                $err = "L'adresse mail est incorrect";
                require_once "./views/viewLogin.php";
            } else if ($response == "0") {
                $err = "Le mot est incorrect";
                require_once "./views/viewLogin.php";
            } else {
                $user = (array) $response[0];
                session_start();
                $_SESSION["User"] = $user;
                header("location: ".Router::makeURL("/"));
            }
        }

        if ((count($url) == 2) && $url[0] == "user" && $url[1] == "logout") {
            session_destroy();
            header("location: ".Router::makeURL("/"));
        }

        if ((count($url) == 2) && $url[0] == "user" && $url[1] == "register") {

            require_once "./views/viewRegister.php";
        }

        if ((count($url) == 3) && $url[0] == "user" && $url[1] == "register" && $url[2] == "validate") {
            $response = curlPost('https://job-board.fun/user/new');
            if ($response == "0") {
                $msg = "Votre compte a été crée veuillez vous connecter";
                require_once "./views/viewRegisterValidate.php";
            } else {
                $err = $response;
                require_once "./views/viewRegister.php";
            }
        }
        if ((count($url) == 3) && $url[0] == "user" && is_numeric($url[2]) == true && $url[1] == "delete") {
            if ($_SESSION["User"]["privileges"] == 3) {
                $response = curlDelete('https://job-board.fun/user/delete/' . $url[2]);
                if ($response == "0") {
                    header("location: ".Router::makeURL("/user"));
                }
            }
        }
        if ((count($url) == 3) && $url[0] == "user" && is_numeric($url[2]) == true && $url[1] == "update") {
            if ($_SESSION["User"]["privileges"] == 3) {
                $response = curlPut('https://job-board.fun/user/update/' . $url[2]);
                var_dump($response);die();
            }
        }
    }
}



function curlPut($url)
{
    $curl = curl_init();

    curl_setopt_array(
        $curl,
        array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_HTTPHEADER => $_POST
        )
    );

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}



function curlDelete($url)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'DELETE',
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return json_decode($response);
}



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

function curlPost($url)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $_POST,
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    return json_decode($response);
}
