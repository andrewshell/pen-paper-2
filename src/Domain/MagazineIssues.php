<?php
namespace PenPaper\Domain;

class MagazineIssues
{
    private $repo;

    public function __construct(Repository\MagazineIssues $repo)
    {
        $this->repo = $repo;
    }

    public function __invoke($params)
    {
        return [
            'success' => true,
            'magazine_issues' => $this->repo->getMagazineIssuesStartingWith($params['prefix']),
            'prefix' => $params['prefix'],
        ];
    }
}
