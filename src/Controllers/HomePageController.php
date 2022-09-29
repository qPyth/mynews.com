<?php


namespace NewsSite\Routes;

use NewsSite\PostMapper;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Twig\Environment;


class HomeRoute
{
    /**
     * @var PostMapper
     */
    private PostMapper $postMapper;

    /**
     * @var Environment
     */

    private Environment $view;

    public function __construct(PostMapper $postMapper,Environment $view)
    {
        $this->postMapper = $postMapper;
        $this->view = $view;
    }

    public function execute(Request $request, Response $response): Response
    {
            $body = $this->view->render('index.twig');
            $response->getBody()->write($body);
            return $response;
        }
}


