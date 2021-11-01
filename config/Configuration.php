<?php
class Configuration{

    private $config;

    private function createLoginModel(){
        require_once "model/LoginModel.php";
        $database = $this->getDatabase();
        return new LoginModel($database);
    }

    public function createLoginController(){
        require_once "controller/LoginController.php";
        return new LoginController($this->createPrinter(),$this->createLoginModel(), );
    }

    private function createPokedexModel() {
        require_once "model/PokedexModel.php";
        return new PokedexModel($this->getDatabase());
    }

    public function createPokedexController() {
        require_once "controller/PokedexController.php";
        return new PokedexController($this->createPrinter(), $this->createPokedexModel());
    }

    private  function getDatabase(){
        require_once("helpers/MyDatabase.php");
        $config = $this->getConfig();
        return new MyDatabase($config["servername"], $config["username"], $config["password"], $config["dbname"], $config["port"]);
    }

    private  function getConfig(){
        if( is_null( $this->config ))
            $this->config = parse_ini_file("config/config.ini");

        return  $this->config;
    }

    private function getLogger(){
        require_once("helpers/Logger.php");
        return new Logger();
    }

    public function createRouter($defaultController, $defaultAction){
        include_once("helpers/Router.php");
        return new Router($this,$defaultController,$defaultAction);
    }

    private function createPrinter(){
        require_once ('third-party/mustache/src/Mustache/Autoloader.php');
        require_once("helpers/MustachePrinter.php");
        return new MustachePrinter("view/partials",$this->createLoginChecker());
    }

    private function createLoginChecker(): LoginChecker {
        require_once "helpers/LoginCheck.php";

        return new LoginChecker();
    }

}