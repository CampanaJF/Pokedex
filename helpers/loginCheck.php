<?php

class LoginChecker{
    public function loginCheck() {

        if(isset($_GET["logout"])){
            session_unset();
            header('Location: /');
            exit();
        }

        if (isset($_SESSION['rol'])) {
            $data["logged"]= $_SESSION["rol"];
                
        }   else {
            $data["notLogged"]= true;
            
        }
        return $data;

    }

}
?>