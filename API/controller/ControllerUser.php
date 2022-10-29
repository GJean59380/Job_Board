<?php

include "lib.php";

class ControllerUser
{
    public function __construct($url)
    {
        //Return all users
        if ((count($url) == 1) && $url[0] == "user") {
            $pdo = connect();
            $req = "SELECT * FROM users";
            $stmt = $pdo->prepare($req);
            $stmt->execute();
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            sendJson($users);
        }

        //Return only on user and his advertisements
        if ((count($url) == 2) && is_numeric($url[1])) {
            $pdo = connect();
            $req = "SELECT * FROM users where id =" . $url[1];
            $stmt = $pdo->prepare($req);
            $stmt->execute();
            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $pdo = connect();
            $req = "SELECT * FROM advertisements where company_id =" . $url[1];
            $stmt = $pdo->prepare($req);
            $stmt->execute();
            $annonces = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $data[0] = $user;
            $data[1] = $annonces;
            sendJson($data);
        }

        //Login
        if (count($url) == 2 && $url[1] == "log" && $_SERVER['REQUEST_METHOD'] === "POST") {
            $pdo = connect();
            $email = "'" . $_POST["email"] . "'";
            $req = "SELECT * FROM users where email =" . $email;
            $stmt = $pdo->prepare($req);
            $stmt->execute();
            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (count($user) == 1 && $user[0]["email"] == $_POST["email"]) {
                if (md5($_POST["pass"]) == $user[0]["password"]) {
                    sendJson($user);
                } else {
                    sendJson("0");
                }
            } else {
                sendJson("1");
            }
        }

        //Register  // Creation of an user
        if (count($url) == 2 && $url[1] == "new" && $_SERVER['REQUEST_METHOD'] === "POST") {
            if (validRegister() == "0") {
                
                $pdo = connect();
                $req = "INSERT INTO `users` (`id`, `name`, `surname`, `gender`, `email`, `password`, `privileges`) VALUES (NULL, '" . $_POST['name'] . "', '" . $_POST['surname'] . "', '" . $_POST["gender"] . "', '" . $_POST['email'] . "', '" . md5($_POST["password"]) . "', '" . $_POST['status'] . "')";
                $stmt = $pdo->prepare($req);
                $stmt->execute();
                sendJson("0");
            } else {
                sendJson(validRegister());
                
            }
            
        }


        //Delete an user
        if (count($url) === 3 && is_numeric($url[2]) && $url[1] == "delete") {
            $pdo = connect();
            $req = "DELETE FROM `users` WHERE `id` =" . $url[2] . "";
            $stmt = $pdo->prepare($req);
            $stmt->execute();
            sendJson("0");
        }

        //Update an user
        if (count($url) == 3 && $url[1] == "update" && is_numeric($url[2]) && $_SERVER['REQUEST_METHOD'] === "PUT") {
            sendJson(getallheaders());
        }
    }

}