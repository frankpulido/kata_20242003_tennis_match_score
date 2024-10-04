<?php
declare(strict_types = 1);
require "player.php";

class Play {
    // Atributes
    protected Player $player1;
    protected Player $player2;

    // Constructor
    public function __construct(Player $player1, Player $player2)
    {
        $this->player1 = $player1;
        $this->player2 = $player2;
    }

    // Getter
    public function getPlayer1() : Player {
        return $this->player1;
    }
    public function getPlayer2() : Player {
        return $this->player2;
    }

    // Function GAME : Binary function assigns winner
    public function Game() : string {
        $winner = random_int(0,1);
        $game = [];
        if($winner == 0) {$game = $this->player1->getName();}
        if($winner == 1) {$game = $this->player2->getName();}
        return $game;
    }

    // function SET : The Set winner is first to win 6 or 7 games
    public function Set() : array {
        $set = 6;
        $game = NULL;
        //$games = [];
        $gamesWithKeys = [$this->getPlayer1()->getName() => 0, $this->getPlayer2()->getName() => 0];
        //$checkTiedFive = [];
        do {
            $game = $this->Game();
            if($this->getPlayer1()->getName() == $game) {$gamesWithKeys[$this->getPlayer1()->getName()] += 1;}
            if($this->getPlayer2()->getName() == $game) {$gamesWithKeys[$this->getPlayer2()->getName()] += 1;}
            if($gamesWithKeys[$this->getPlayer1()->getName()] == 5 && $gamesWithKeys[$this->getPlayer2()->getName()] == 5) {$set = 7;}
        } while (max($gamesWithKeys) < $set);
        return $gamesWithKeys;
    }

    // function MATCH : Match winner is first to win 3 sets. Therefore, a match ranges from 3 to 5 Sets.
    public function Match() {
        //https://stackoverflow.com/questions/7068724/getting-an-array-key-using-the-max-function
        $set = NULL;
        //$sets = [];
        $match = [];
        $matchWithKeys = [$this->getPlayer1()->getName() => 0, $this->getPlayer2()->getName() => 0];
        $matchesWonPlayer1 = $this->getPlayer1()->getMatchesWon();
        $matchesWonPlayer2 = $this->getPlayer2()->getMatchesWon();
        do {
            $set = $this->Set();
            $winner_name = array_keys($set, max($set));
            if($this->getPlayer1()->getName() == $winner_name[0]) {$matchWithKeys[$this->getPlayer1()->getName()] += 1;}
            if($this->getPlayer2()->getName() == $winner_name[0]) {$matchWithKeys[$this->getPlayer2()->getName()] += 1;}
            
            var_dump($matchWithKeys);
            
        } while (max($matchWithKeys) < 3);

        if($matchWithKeys[$this->getPlayer1()->getName()] == 3) {$matchesWonPlayer1++; $this->getPlayer1()->setMatchesWon($matchesWonPlayer1);}
        if($matchWithKeys[$this->getPlayer2()->getName()] == 3) {$matchesWonPlayer2++; $this->getPlayer2()->setMatchesWon($matchesWonPlayer2);}

        return $matchWithKeys;
    }
}
?>