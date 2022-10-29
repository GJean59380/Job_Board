<?php

include "lib.php";

class ControllerAdvertisements
{
    public function __construct($url)
    {

        //All advertisements
        if ((count($url) == 1) && $url[0] == "advertisements") {
            $pdo = connect();
            $req = "SELECT * FROM advertisements ORDER BY id desc";
            $stmt = $pdo->prepare($req);
            $stmt->execute();
            $annonces = $stmt->fetchAll(PDO::FETCH_ASSOC);
            sendJson($annonces);
        }



        //Return only one advertisement
        if ((count($url) == 2) && $url[0] == "advertisements" && is_numeric($url[1])) {
            $pdo = connect();
            $req = "SELECT * FROM advertisements where id =" . $url[1];
            $stmt = $pdo->prepare($req);
            $stmt->execute();
            $annonces = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $data = $annonces;

            sendJson($data);
        }




        //Create an advertisement
        if (count($url) == 2 && $url[1] == "new" && $_SERVER['REQUEST_METHOD'] === "POST") {
            if (validAdvertisements() == "0") {
                $pdo = connect();
                $_POST['company_name'] = '"' . $_POST['company_name'] . '"';
                $_POST['job_title'] = '"' . $_POST['job_title'] . '"';
                $_POST['salary'] = '"' . $_POST['salary'] . '"';
                $_POST["type"] = '"' . $_POST["type"] . '"';
                $_POST['short_description'] = '"' . $_POST['short_description'] . '"';
                $_POST["long_description"] = '"' . $_POST["long_description"] . '"';
                $_POST['company_id'] = '"' . $_POST['company_id'] . '"';

                $req = "INSERT INTO `advertisements` (`id`, `company_name`, `title`, `salary`, `type`, `short_description`, `long_description`, `company_id`) VALUES (NULL, " . $_POST['company_name'] . ", " . $_POST['job_title'] . ", " . $_POST['salary'] . ", " . $_POST["type"] . ", " . $_POST['short_description'] . ", " . $_POST["long_description"] . ", " . $_POST['company_id'] . ")";
                $stmt = $pdo->prepare($req);
                $stmt->execute();
                sendJson("0");
            } else {
                sendJson(validAdvertisements());
            }
        }



        //Delete an advertisement
        if (count($url) === 3 && $url[0] == "advertisements" && is_numeric($url[2]) && $url[1] == "delete") {
            $pdo = connect();
            $req = "DELETE FROM `advertisements` WHERE `id` =" . $url[2] . "";
            $stmt = $pdo->prepare($req);
            $stmt->execute();
            sendJson("0");
        }

        //Update an advertisement
        if (count($url) === 3 && $url[0] == "advertisements"  && $url[1] == "update" && is_numeric($url[2])) {
            $pdo = connect();
            //???


        }
    }
}
