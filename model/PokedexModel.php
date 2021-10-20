<?php

class PokedexModel {
    private MyDatabase $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function getPokemons(){
        $query = "SELECT nombre, tipo1, tipo2, numero FROM pokemon ORDER BY numero";

        $respond = $this->database->query($query);
        $data["pokemons"] = $respond;

        return $data;
    }

    public function search($search) {
        $query = "SELECT nombre, numero, tipo1, tipo2 FROM pokemon WHERE nombre LIKE '%" .$search.
            "%' OR numero LIKE  '%" .$search. "%' OR tipo1 LIKE '%" .$search.
            "%' OR tipo2 LIKE '%" .$search. "%' ORDER BY numero";

        $respond = $this->database->query($query);

        $data[] = [];

        if (empty($respond)) {
            $data["error"] = true;
            $data = array_merge($data, $this->getPokemons());
        } else {
            $data["pokemons"] = $respond;
        }

        return $data;
    }

    public function getPokemonById($id){
    $query = " SELECT  nombre, numero, tipo1, tipo2, descripcion, img  FROM pokemon WHERE id= ". $id;

    $respond= $this->database->query($query);

    $data["pokemons"]= $respond;

    return $data;


    }

    public function nuevo($nombre, $numero,$tipo,$tipo2,$descripcion,$imagen){
       $query = "INSERT INTO pokemon(numero,nombre,tipo1,tipo2,descripcion, img) 
            VALUES ($numero, '$nombre', '$tipo','$tipo2','$descripcion','$imagen')";



        return $this->database->execute($query);

    }


}