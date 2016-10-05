<?php
namespace PenPaper\Domain\Repository;

interface FictionBooks
{
    public function getFictionBooksStartingWith($letter);
    public function getFictionBookById($id);
}
