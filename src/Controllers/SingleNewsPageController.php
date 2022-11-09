<?php


namespace NewsSite\Controllers;
use NewsSite\PostMapper;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Twig\Environment;

class SingleNewsPageController
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

    public  function execute(Request $request, Response $response, array $args): Response {
        $post = $this->postMapper->getPostByUrlKey($args['url_key']);
        if(empty($post)) {
            $body = $this->view->render('404.twig');
        } else {
            $body = $this->view->render('post.twig', [
                'post' => $post
            ]);
        }
        $response->getBody()->write($body);
        return $response;
    }
}