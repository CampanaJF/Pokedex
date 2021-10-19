<?php

class PokedexModel {
    private MyDatabase $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function getPokemons() {
        $query = "SELECT nombre, tipo1, tipo2, numero FROM pokemon";

        return $this->database->query($query);
    }
}