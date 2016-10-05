<?php
namespace PenPaper\Domain;

class ShortStory
{
    private $repo;

    public function __construct(Repository\ShortStories $repo)
    {
        $this->repo = $repo;
    }

    public function __invoke($params)
    {
        return [
            'success' => true,
            'short_story' => $this->repo->getShortStoryById($params['id']),
        ];
    }
}
