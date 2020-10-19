<?php

declare(strict_types=1);

namespace TennisGame;

class TennisGameRefactor1 implements TennisGame
{
    /**
     * Scores
     */
    public const LOVE_ALL = 'Love-All';

    public const FIFTEEN_ALL = 'Fifteen-All';

    public const THIRTY_ALL = 'Thirty-All';

    public const LOVE = 'Love';

    public const FIFTEEN = 'Fifteen';

    public const THIRTY = 'Thirty';

    public const FORTY = 'Forty';

    public const DEUCE = 'Deuce';

    /**
     * Advantages
     */
    public const ADVANTAGE_PLAYER_1 = 'Advantage player1';

    public const ADVANTAGE_PLAYER_2 = 'Advantage player2';

    /**
     * Wins
     */
    public const WIN_PLAYER_1 = 'Win for player1';

    public const WIN_PLAYER_2 = 'Win for player2';

    /**
     * Points to temp scores
     */
    public const POINTS_TO_LOVE = 0;

    public const POINTS_TO_FIFTEEN = 1;

    public const POINTS_TO_THIRTY = 2;

    public const POINTS_TO_FORTY = 3;

    /**
     * Arrays mapping scores
     */
    public const SCORES = [
        self::POINTS_TO_LOVE => self::LOVE,
        self::POINTS_TO_FIFTEEN => self::FIFTEEN,
        self::POINTS_TO_THIRTY => self::THIRTY,
        self::POINTS_TO_FORTY => self::FORTY,
    ];

    /**
     * Arrays mapping scores
     */
    public const SCORES_ALL = [
        self::POINTS_TO_LOVE => self::LOVE_ALL,
        self::POINTS_TO_FIFTEEN => self::FIFTEEN_ALL,
        self::POINTS_TO_THIRTY => self::THIRTY_ALL,
    ];

    private $m_score1;

    private $m_score2;

    private $player1Name;

    private $player2Name;

    public function __construct($player1Name, $player2Name)
    {
        $this->player1Name = $player1Name;
        $this->player2Name = $player2Name;
        $this->m_score1 = 0;
        $this->m_score2 = 0;
    }

    public function wonPoint($playerName): void
    {
        $playerName === $this->player1Name ? $this->m_score1++ : $this->m_score2++;
    }

    public function getScore(): string
    {
        if ($this->m_score1 === $this->m_score2) {
            return $this->getTiesScores($this->m_score1);
        }
        if ($this->m_score1 >= 4 || $this->m_score2 >= 4) {
            return $this->firstFourPoints($this->m_score1, $this->m_score2);
        }

        return $this->getDefaultScore($this->m_score1, $this->m_score2);
    }

    private function getTiesScores(int $score): string
    {
        return self::SCORES_ALL[$score] ?? self::DEUCE;
    }

    private function firstFourPoints(int $markPlayer1, int $markPlayer2): string
    {
        $minusResult = $markPlayer1 - $markPlayer2;

        if ($minusResult === 1) {
            return self::ADVANTAGE_PLAYER_1;
        }
        if ($minusResult === -1) {
            return self::ADVANTAGE_PLAYER_2;
        }
        if ($minusResult >= 2) {
            return self::WIN_PLAYER_1;
        }

        return self::WIN_PLAYER_2;
    }

    private function getDefaultScore(int $markPlayer1, int $markPlayer2): string
    {
        return $this->getScoreByPoints($markPlayer1) . '-' . $this->getScoreByPoints($markPlayer2);
    }

    private function getScoreByPoints(int $points): string
    {
        return self::SCORES[$points];
    }
}
