<?php
namespace PenPaper\Domain;

class MagazineIssue
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
            'magazine_issue' => $this->repo->getMagazineIssueById($params['id']),
        ];
    }
}
