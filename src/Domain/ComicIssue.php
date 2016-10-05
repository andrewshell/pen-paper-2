<?php
namespace PenPaper\Domain;

class ComicIssue
{
    private $repo;

    public function __construct(Repository\ComicIssues $repo)
    {
        $this->repo = $repo;
    }

    public function __invoke($params)
    {
        return [
            'success' => true,
            'comic_issue' => $this->repo->getComicIssueById($params['id']),
        ];
    }
}
