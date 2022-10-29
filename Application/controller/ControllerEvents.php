<?php

class ControllerEvents
{

    public function __construct($url)
    {
        //  job-board/event/idAnnonce/apply
        // On veut postuler

        if (count($url) == 3 && $url[0] == "events" && is_numeric($url[2]) && $url[1] == "apply") {

            if (isset($_SESSION["User"]) && $_SESSION["User"]["privileges"] == 1) {
                require_once "./views/viewApply.php";
            } else {
                $err = "Please connect you before applying to a job advertisements";
                require_once "./views/viewErrors.php";
            }
        }


        if (count($url) == 4 && $url[0] == "events" && $url[1] == "apply" && is_numeric($url[2])  && $url[3] == "validate") {
            if (isset($_SESSION["User"])) {
                if (isset($_POST["apply_content"]) && $_POST["apply_content"] != "") {
                    $_POST["user"]=$_SESSION["User"]["id"];
                    $response = curlPost("https://job-board.fun/events/new/" . $url[2] );

                    if ($response == "0") {
                        $msg = "Apply done an email has been send";
                        require_once "./views/viewApply.php";
                    }
                } else {
                    $msg = "Please fill the field";
                    require_once "./views/viewApply.php";
                }
            } else {
                $err = "We couldn't validate the post since you are not connected";
                require_once "./views/viewErrors.php";
            }
        }
    }
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
