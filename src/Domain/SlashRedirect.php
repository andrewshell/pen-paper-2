<?php
namespace PenPaper\Domain;

class SlashRedirect
{
    public function __invoke($params)
    {
        return [
            'success' => true,
            'path' => $params['path'],
        ];
    }
}
