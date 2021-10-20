<?php

class PokedexModel {
    private MyDatabase $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function getPokemons(): array {
        $query = "SELECT nombre, tipo1, tipo2, numero FROM pokemon ORDER BY numero";

        $respond = $this->database->query($query);
        $data["pokemons"] = $respond;

        return $data;
    }

    public function search($search): array {
        $query = "select nombre, numero, tipo1, tipo2 from pokemon where nombre like '%" .$search.
            "%' or numero = '" .$search. "' or tipo1 like '%" .$search.
            "%' or tipo2 like '%" .$search. "%' order by numero";

        $respond = $this->database->query($query);

        $data[] = [];

        if (empty($respond)) {
            $data["error"] = "No se encontró resultados";
            $data = array_merge($data, $this->getPokemons());
        } else {
            $data["pokemons"] = $respond;
        }

        return $data;
    }
}