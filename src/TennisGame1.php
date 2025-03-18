<?php

namespace Feature;

class TennisGame1 implements TennisGame
{
    private int $player1Score = 0;
    private int $player2Score = 0;

    public function __construct(private readonly string $player1Name, private readonly string $player2Name)
    {
    }

    public function wonPoint(string $playerName): void
    {
        $this->player1Name == $playerName ? $this->player1Score++ : $this->player2Score++;
    }

    public function getScore(): string
    {
        $score = "";
        if ($this->player1Score == $this->player2Score) {
            if ($this->player1Score == 0) {
                return "Love-All";
            }
            if ($this->player1Score == 1) {
                return "Fifteen-All";
            }
            if ($this->player1Score == 2) {
                return "Thirty-All";
            }
                return "Deuce";
        }
        if ($this->player1Score >= 4 || $this->player2Score >= 4) {
            $minusResult = $this->player1Score - $this->player2Score;
            if ($minusResult == 1) {
                return "Advantage " . $this->player1Name;
            }
            if ($minusResult == -1) {
                return "Advantage ". $this->player2Name;
            }
            if ($minusResult >= 2) {
                return "Win for ". $this->player1Name;
            }
            return "Win for ". $this->player2Name;
        }
        for ($player = 1; $player < 3; $player++) {
            if ($player == 1) {
                $tempScore = $this->player1Score;
            } else {
                $score .= "-";
                $tempScore = $this->player2Score;
            }
            if ($tempScore == 0) {
                $score .= "Love";
            }
            if ($tempScore == 1) {
                $score .= "Fifteen";
            }
            if ($tempScore == 2) {
                $score .= "Thirty";
            }
            if ($tempScore == 3) {
                $score .= "Forty";
            }
        }
        return $score;
    }
}

