<?php
require_once "init.php";
class Router
{
    //Liste des actions de l'application :
    // www.monsite.fr/ads   => Renvoie toutes les annonces
    // www.monsite.fr/ads/{categorie}   => Renvoie toutes les annonces d'une catégorie
    // www.monsite.fr/ads/{id}   => Renvoie une annonce spécifique
    // www.monsite.fr/ad/new   => Créer une annonce
    // www.monsite.fr/ad/{id}/delete   => Supprime une annonce

    // www.monsite.fr/users   => Renvoie tous les utilisateurs
    // www.monsite.fr/user/{id}   => Renvoie un utilisateur spécifique
    // www.monsite.fr/user/{id}/delete   => Supprime un utilisateur

    // En réalité l'url qui est traitée est de forme www.monsite.fr?url=ads par exemple c'est ici l'interêt de la réécriture du .htaccess


    /*
    Make URL : crée et renvoie l'URL complète associée au chemin fourni en paramètre 
    @param mixed $path [optional]
    @return string 
     */
    public static function makeURL($path = "")
    {
        if (is_array($path)) {
            return (APP_URL . implode("/", $path));
        }
        return (APP_URL . $path);
    }

    /*==================
    Méthode qui renvoie true si la sessions est démarrée
    ==================*/
    private function is_session_started()
    {
        if (php_sapi_name() !== 'cli') {
            if (version_compare(phpversion(), '5.4.0', '>=')) {
                return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
            } else {
                return session_id() === '' ? FALSE : TRUE;
            }
        }
        return FALSE;
    }



    public function routeReq()
    {
        try {

            if ($this->is_session_started() === FALSE) session_start();


            if (isset($_GET['url'])) {
                //Décomposer l'URL
                $url = explode('/', filter_var($_GET['url'], FILTER_SANITIZE_URL));

                // Le nom du controller commence par une majuscule (ucfirst) puis est suivi de l'url 0 en minuscules
                $controller = ucfirst(strtolower($url[0]));
                $controllerClass = "Controller" . $controller;
                $controllerFile = "controller/" . $controllerClass . ".php";
                if (file_exists($controllerFile)) {
                    require_once($controllerFile);
                    $this->_ctrl = new $controllerClass($url);
                } else
                    throw new Exception('Contrôleur introuvable');
            } else //index.php a été appelé sans paramètre 
            {
                $url[0] = "advertisements";
                $controllerFile = "controller/ControllerAdvertisements.php";
                require_once($controllerFile);
                $this->_ctrl = new ControllerAdvertisements($url);
            }
        } //fin du bloc try

        catch (Exception $e) {
            $erreur = [
                "message" => $e->getMessage(),
                "code" => $e->getCode()
            ];
            print_r($erreur);
        }
    }
}
