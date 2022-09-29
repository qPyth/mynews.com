<?php


namespace NewsSite\Routes;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Twig\Environment;

class NewsPageRoute
{
    private Environment $view;

    public function __construct(Environment $view)
    {
        $this->view = $view;
    }

    /**
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     * @throws \Twig\Error\LoaderError
     */
    public function execute(Request $request, Response $response, array $args): Response
    {
        $body = $this->view->render('about.twig', [
            'name' => 'Ded'
        ]);
        $response->getBody()->write($body);
        return $response;
    }
}