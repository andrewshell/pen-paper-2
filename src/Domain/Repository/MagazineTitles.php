<?php
namespace PenPaper\Domain\Repository;

interface MagazineTitles
{
    public function getMagazineTitlesStartingWith($letter);
    public function getMagazineTitleById($id);
}
