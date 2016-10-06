<?php
namespace PenPaper\Domain;

class ShortStories
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
            'short_stories' => $this->repo->getShortStoriesStartingWith($params['prefix']),
            'prefix' => $params['prefix'],
        ];
    }
}
