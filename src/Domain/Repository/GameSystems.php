<?php
namespace PenPaper\Domain\Repository;

interface GameSystems
{
    public function getGameSystemsStartingWith($letter);
    public function getGameSystemById($id);
}
