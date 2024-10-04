<?php
declare(strict_types = 1);

class Player {
    // Attributes
    protected string $name;
    protected int $matchesWon;

    // Constructor
    public function __construct(string $name, int $matchesWon = 0)
    {
        $this->name = $name;
        $this->matchesWon = $matchesWon;
    }

    // Getters
    public function getName() : string {
        return $this->name;
    }
    public function getMatchesWon() : int {
        return $this->matchesWon;
    }

    // Setters
    public function setName(string $name) {
        $this->name = $name;
    }
    public function setMatchesWon(int $matchesWon) {
        $this->matchesWon = $matchesWon;
    }
}
?>