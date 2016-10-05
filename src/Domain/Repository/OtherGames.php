<?php
namespace PenPaper\Domain\Repository;

interface OtherGames
{
    public function getOtherGamesStartingWith($letter);
    public function getOtherGameById($id);
}
