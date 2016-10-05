<?php
namespace PenPaper\Domain\Repository;

interface GameLines
{
    public function getGameLinesStartingWith($letter);
    public function getGameLineById($id);
}
