<?php
namespace PenPaper\Delivery;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Twig_Environment;

class DefaultResponder
{
    protected $request;
    protected $response;
    protected $twig;

    public function __construct(Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    public function __invoke(
        Request $request,
        Response $response,
        array $payload
    ) {
        $this->request = $request;
        $this->response = $response;
        if (isset($payload['success']) && true === $payload['success']) {
            $this->success($payload);
        } else {
            $this->error($payload);
        }
        return $this->response;
    }

    protected function htmlBody(array $data)
    {
        $view = $this->request->getAttribute('_view', 'index.html.twig');
        $body = $this->twig->render($view, $data);
        $this->response = $this->response->withHeader('Content-Type', 'text/html');
        $this->response->getBody()->write($body);
    }

    protected function success($payload)
    {
        $this->response = $this->response->withStatus(200);
        $this->htmlBody($payload);
    }

    protected function error($payload)
    {
        $this->response = $this->response->withStatus(500);
        $this->request = $this->request->withAttribute('_view', 'error.html.twig');
        $this->htmlBody($payload);
    }
}
