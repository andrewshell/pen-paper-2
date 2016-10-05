<?php
namespace PenPaper\Domain\Repository;

interface RpgBooks
{
    public function getRpgBooksStartingWith($letter);
    public function getRpgBookById($id);
}
