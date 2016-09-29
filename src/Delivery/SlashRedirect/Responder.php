<?php
namespace PenPaper\Delivery\SlashRedirect;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class Responder
{
    public function __invoke(
        Request $request,
        Response $response,
        array $payload
    ) {
        return $response
            ->withStatus(302)
            ->withHeader('Location', $payload['path'] . '/');
    }
}
