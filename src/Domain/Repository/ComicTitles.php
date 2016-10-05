<?php
namespace PenPaper\Domain\Repository;

interface ComicTitles
{
    public function getComicTitlesStartingWith($letter);
    public function getComicTitleById($id);
}
