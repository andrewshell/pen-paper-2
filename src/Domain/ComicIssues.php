<?php
namespace PenPaper\Domain;

class ComicIssues
{
    private $repo;

    public function __construct(Repository\ComicIssue $repo)
    {
        $this->repo = $repo;
    }

    public function __invoke($params)
    {
        return [
            'success' => true,
            'comic_issues' => $this->repo->getComicIssuesStartingWith($params['prefix']),
            'prefix' => $params['prefix'],
        ];
    }
}
