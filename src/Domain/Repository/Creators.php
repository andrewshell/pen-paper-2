<?php
namespace PenPaper\Domain\Repository;

interface Creators
{
    public function getCreatorsStartingWith($letter);
    public function getCreatorById($id);
}
