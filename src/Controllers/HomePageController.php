<?php
declare(strict_types=1);

namespace NewsSite\Controllers;

use NewsSite\PostMapper;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Twig\Environment;


class HomePageController
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
        $username = $_SESSION['name'] = '';
        $mostViewedPost = $this->postMapper->getMostViewedPost();
        $latestPosts = $this->postMapper->getLatestPosts();
        $body = $this->view->render('index.twig', [
            'mostViewedPost' => $mostViewedPost,
            'latestPosts' => $latestPosts,
            'username' => $username
        ]);
        $response->getBody()->write($body);
        return $response;
    }
}

