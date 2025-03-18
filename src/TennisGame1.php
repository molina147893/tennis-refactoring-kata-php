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
        if ($this->isTie()) {
            return $this->getTieScore();
        }

        if ($this->isAdvantage()) {
            return $this->getAdvantageScore();
        }

        if ($this->isWin()) {
            return $this->getWinScore();
        }

        return $this->getDefaultScore($score);
    }

    public function isTie(): bool
    {
        return $this->player1Score == $this->player2Score;
    }

    public function getTieScore(): string
    {
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

    public function isAdvantage(): bool
    {
        return ($this->player1Score >= 4 || $this->player2Score >= 4) && abs($this->player1Score - $this->player2Score) == 1;
    }

    public function getAdvantageScore(): string
    {
        $minusResult = $this->player1Score - $this->player2Score;

        return "Advantage " . ($minusResult > 0 ? $this->player1Name : $this->player2Name);
    }

    /**
     * @param string $score
     * @return string
     */
    public function getDefaultScore(string $score): string
    {
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

    private function isWin(): bool
    {
        return ($this->player1Score >= 4 || $this->player2Score >= 4) && abs($this->player1Score - $this->player2Score) >= 2;
    }

    private function getWinScore(): string
    {
        $minusResult = $this->player1Score - $this->player2Score;

        return "Win for " . ($minusResult > 0 ? $this->player1Name : $this->player2Name);
    }
}

