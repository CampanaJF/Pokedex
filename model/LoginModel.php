<?php

class LoginModel {

    private MyDatabase $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function login($nombre, $contraseña) {
        $query = "SELECT * FROM usuario WHERE nombre = ? AND contraseña = ?";
        $params = array($nombre, $contraseña);

        return $this->database->queryParams($params, $query);
    }
}