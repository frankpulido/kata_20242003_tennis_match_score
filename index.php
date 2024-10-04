<?php
declare(strict_types = 1);
require "play.php";
/*
Juego : hay que ganar 3 de 5 sets
puntuación del set : 1-6 (gana el que gane 6 juegos del set antes)... Si van empatados a 5 juegan hasta 7

Clases :
Jugador : sólo 1 atributo ($name)
Juego : jugador->name es key, puntuación es random. Array de 2 elementos
Debo incrementarlo asignando uno a uno los puntos con binario que vaya a cualquiera de los 2
Si empatan a 5 extiendo hasta 7.
Set : array de sets, se alimenta del anterior.
*/



$player1 = new Player("Pedro");
$player2 = new Player("Juan");
$tennis_match = new Play($player1, $player2);

echo PHP_EOL;
$game = $tennis_match->Game();
var_dump($game);

echo PHP_EOL;
$set = $tennis_match->Set();
var_dump($set);

echo PHP_EOL;
$match = $tennis_match->Match();
var_dump($match);


?>