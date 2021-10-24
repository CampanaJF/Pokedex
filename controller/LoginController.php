
<?php

class LoginController {
    
    private $printer;
    private LoginModel $model;

    public function __construct($printer, $model) {
        $this->printer = $printer;
        $this->model = $model;
    }

    public function show() {
        if (isset($_SESSION['role'])) {
            header("Location: /pokedexView"); }
        
        echo $this->printer->render( "view/loginView.html");
        
    }

    public function login() {
        $nombre = $_POST["nombre"];
        $contraseña = md5($_POST["contraseña"]);

        $result = $this->model->login($nombre, $contraseña);

        if (!empty($result)) {
            $hash = $result[0]["hash"];

            if ($hash == null) {
                $_SESSION['role']=$result;
                header("Location: /pokedexView");
            } 
        } else {
            header("Location: /login");
        }
    }

    
}

?>