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
        if ($this->isTie()) {
            return $this->getTieScore();
        }

        if ($this->isAdvantage()) {
            return $this->getAdvantageScore();
        }

        if ($this->isWin()) {
            return $this->getWinScore();
        }

        return $this->getDefaultScore();
    }

    private function isTie(): bool
    {
        return $this->player1Score == $this->player2Score;
    }

    private function isAdvantage(): bool
    {
        return $this->hasMoreThanFourthPoints() && $this->getAbsoluteScoreDifference() == 1;
    }

    private function isWin(): bool
    {
        return $this->hasMoreThanFourthPoints() && $this->getAbsoluteScoreDifference() >= 2;
    }

    private function getTieScore(): string
    {
        $scoreResults = ["Love-All", "Fifteen-All", "Thirty-All"];

        if ($this->player1Score < 3) {
            return $scoreResults[$this->player1Score];
        }

        return "Deuce";
    }

    private function getAdvantageScore(): string
    {
        return "Advantage " . $this->getGoesAheadPlayerName();
    }

    private function getWinScore(): string
    {
        return "Win for " . $this->getGoesAheadPlayerName();
    }

    private function getDefaultScore(): string
    {
        $scoreResults = ["Love", "Fifteen", "Thirty", "Forty"];

        return implode("-", [$scoreResults[$this->player1Score], $scoreResults[$this->player2Score]]);
    }

    public function getGoesAheadPlayerName(): string
    {
        return ($this->getScoreDifference() > 0 ? $this->player1Name : $this->player2Name);
    }

    public function hasMoreThanFourthPoints(): bool
    {
        return $this->player1Score >= 4 || $this->player2Score >= 4;
    }

    private function getAbsoluteScoreDifference(): int
    {
        return abs($this->getScoreDifference());
    }

    public function getScoreDifference(): int|float
    {
        return $this->player1Score - $this->player2Score;
    }
}

