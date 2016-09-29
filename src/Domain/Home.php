<?php
namespace PenPaper\Domain;

class Home
{
    public function __invoke()
    {
        return ['success' => true];
    }
}
