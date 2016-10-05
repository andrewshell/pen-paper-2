<?php
namespace PenPaper\Domain\Repository;

interface ShortStories
{
    public function getShortStoriesStartingWith($letter);
    public function getShortStoryById($id);
}
