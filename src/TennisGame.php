<?php

declare(strict_types=1);

namespace TennisGame;

interface TennisGame
{
    /**
     * @param  $playerName
     */
    public function wonPoint($playerName): void;

    /**
     * @return string
     */
    public function getScore();
}
