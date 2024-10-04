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

    // Binary function assigns winner
    public function Game() : string {
        $winner = random_int(0,1);
        $game = [];
        if($winner == 0) {$game = $this->player1->getName();}
        if($winner == 1) {$game = $this->player2->getName();}
        return $game;
    }

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
            //$games[] = $this->Game();
            //$gamesWithKeys = array_count_values($games);
            /*
            unset($checkTiedFive);
            foreach ($gamesWithKeys as $key=>$value) {
                $checkTiedFive[] = $value;
            }
            if($checkTiedFive[0] == 5 && $checkTiedFive[1] == 5){$set = 7;}
            */
        } while (max($gamesWithKeys) < $set);
        return $gamesWithKeys;
    }

    public function Match() {
        $sets = [];
        $match = [];
        $matchWithKeys = [];
        $matchesWonPlayer1 = $this->getPlayer1()->getMatchesWon();
        $matchesWonPlayer2 = $this->getPlayer2()->getMatchesWon();
        do {           
            $sets[] = $this->Set();
            foreach($sets as $set) {
                foreach($set as $key=>$value) {
                    if(max($set) == $value) {$match[] = $key;}
                }
            }
            $matchWithKeys = array_count_values($match);
            foreach($matchWithKeys as $player=>$setsWon) {
                if($setsWon == 3){
                    if($this->getPlayer1()->getName() == $player) {$matchesWonPlayer1++; $this->getPlayer1()->setMatchesWon($matchesWonPlayer1);}
                    if($this->getPlayer2()->getName() == $player) {$matchesWonPlayer2++; $this->getPlayer2()->setMatchesWon($matchesWonPlayer2);}
                }
            }
        } while (max($matchWithKeys) <= 3);
        return $sets;
    }
}
?>