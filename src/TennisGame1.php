<?php

namespace Feature;

class TennisGame1 implements TennisGame
{
    private const LOVE_ALL = "Love-All";
    private const FIFTEEN_ALL = "Fifteen-All";
    private const THIRTY_ALL = "Thirty-All";
    private const DEUCE = "Deuce";
    private const ADVANTAGE = "Advantage ";
    private const WIN_FOR = "Win for ";
    private const LOVE = "Love";
    private const FIFTEEN = "Fifteen";
    private const THIRTY = "Thirty";
    private const FORTY = "Forty";
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
        $scoreResults = [self::LOVE_ALL, self::FIFTEEN_ALL, self::THIRTY_ALL];

        if ($this->player1Score < 3) {
            return $scoreResults[$this->player1Score];
        }

        return self::DEUCE;
    }

    private function getAdvantageScore(): string
    {
        return self::ADVANTAGE . $this->getGoesAheadPlayerName();
    }

    private function getWinScore(): string
    {
        return self::WIN_FOR . $this->getGoesAheadPlayerName();
    }

    private function getDefaultScore(): string
    {
        $scoreResults = [self::LOVE, self::FIFTEEN, self::THIRTY, self::FORTY];

        return implode("-", [$scoreResults[$this->player1Score], $scoreResults[$this->player2Score]]);
    }

    private function getGoesAheadPlayerName(): string
    {
        return ($this->getScoreDifference() > 0 ? $this->player1Name : $this->player2Name);
    }

    private function hasMoreThanFourthPoints(): bool
    {
        return $this->player1Score >= 4 || $this->player2Score >= 4;
    }

    private function getAbsoluteScoreDifference(): int
    {
        return abs($this->getScoreDifference());
    }

    private function getScoreDifference(): int|float
    {
        return $this->player1Score - $this->player2Score;
    }
}

