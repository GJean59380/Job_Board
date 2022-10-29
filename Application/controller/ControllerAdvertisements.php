<?php

class ControllerAdvertisements
{

    public function __construct($url)
    {
        if ((count($url) == 1) && $url[0] == "advertisements") {
            $data = curlGet("https://job-board.fun/advertisements");
            require_once "./views/viewAllAds.php";
        }









        //On veut voir qu'une seule annonce
        if ((count($url) == 2) && $url[0] == "advertisements" && is_numeric($url[1])) {
            $data = curlGet("https://job-board.fun/advertisements/" . $url[1]);
            $events = curlGet("https://job-board.fun/events/" . $url[1]);
            require_once "./views/viewOneAd.php";
        }














        if ((count($url) == 2) && $url[0] == "advertisements" && $url[1] == "new") {
            if (isset($_SESSION["User"]) && $_SESSION["User"]["privileges"] == 2) {
                require_once "./views/viewNewAd.php";
            } else {
                $err = "Vous devez être une entreprise pour pouvoir créer une annonce";
                require_once "./views/viewErrors.php";
            }
        }
        if ((count($url) == 3) && $url[0] == "advertisements" && $url[1] == "new" && $url[2] == "validate") {

            if (strpos($_POST["job_title"], '"') === false) {
                if (strpos($_POST["company_name"], '"') === false) {
                    if (strpos($_POST["short_description"], '"') === false) {
                        if (strpos($_POST["long_description"], '"') === false) {
                            $_POST["company_id"] = $_SESSION["User"]["id"];
                            $response = curlPost('https://job-board.fun/advertisements/new');
                            if ($response == "0") {
                                header("location: " . Router::makeURL("/"));
                            } else {

                                $err = $response;
                                require_once "./views/viewNewAd.php";
                            }
                        }
                    }
                }
            }
            $err = "Please, Don't use double quote";
            require_once "./views/viewNewAd.php";
        }
        if ((count($url) == 3) && $url[0] == "advertisements" && is_numeric($url[2]) == true && $url[1] == "delete") {
            $data = curlGet("https://job-board.fun/advertisements/" . $url[2]);
            $data = $data[0];
            if ($_SESSION["User"]["privileges"] == 3 || $data->company_id == $_SESSION["User"]["id"]) {
                $response = curlDelete('https://job-board.fun/advertisements/delete/' . $url[2]);
                if ($response == "0") {
                    header("location: " . Router::makeURL("/"));
                } else {
                    echo ("Erreur de suppression");die();
                }
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
