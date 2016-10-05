<?php
namespace PenPaper\Domain\Repository;

interface Publishers
{
    public function getPublishersStartingWith($letter);
    public function getPublisherById($id);
}
