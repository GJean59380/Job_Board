<?php

include "lib.php";

class ControllerEvents
{

    public function __construct($url)
    {

        //Events from a publication
        if (count($url) == 2 && $url[0] == "events" && is_numeric($url[1])) {
            $pdo = connect();
            $req = "SELECT * FROM ad_events where id_publication =" . $url[1];
            $stmt = $pdo->prepare($req);
            $stmt->execute();
            $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
            sendJson($events);
        }

        //Add an event like an apply
        if (count($url) == 3 && $url[0] == "events" && is_numeric($url[2]) && $url[1] == "new") {
            $pdo = connect();
            $req = "INSERT INTO `ad_events` (`id`, `content`, `id_publication`, `id_user`) VALUES (NULL, '" . $_POST['apply_content'] . "', '" . $url[2] . "', '" . $_POST["user"] . "')";
            $stmt = $pdo->prepare($req);
            $stmt->execute();
            sendJson("0");
        }

        //Events of an user
        if (count($url) == 3 && $url[0] == "events" && $url[1] == "user" && is_numeric($url[2])) {
            $pdo = connect();
            $req = "SELECT * FROM ad_events where id_user =" . $url[2];
            $stmt = $pdo->prepare($req);
            $stmt->execute();
            $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
            sendJson($events);
        }
    }
}

