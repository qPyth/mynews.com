<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Iskakov\NewsSite\PostMapper;

require __DIR__ . '/../../vendor/autoload.php';

$loader = new FilesystemLoader('../templates');
$view = new Environment($loader);

// DB connecting

$config = include __DIR__ . '/../../src/config/db.php';
$dsn = $config['dsn'];
$username = $config['username'];
$password = $config['password'];

try {
    $connections = new PDO($dsn, $username, $password);
    $connections->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connections->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $exception) {
    echo 'Database connection error: '.$exception->getMessage();
    die();
}
$postMapper = new PostMapper($connections);
// Routing

$app = AppFactory::create();

$app->get('/', function (Request $request, Response $response, array $args) use ($view, $postMapper) {
    $posts = $postMapper->getPosts();
    $body = $view->render('index.twig', [
        'posts'=>$posts
    ]);
    $response->getBody()->write($body);
    return $response;
});

$app->get('/about', function (Request $request, Response $response, array $args) use ($view) {
    $body = $view->render('about.twig', [
        'name' => 'Ded'
    ]);
    $response->getBody()->write($body);
    return $response;
});

$app->get('/{url_key}', function (Request $request, Response $response, array $args) use ($view, $postMapper) {
    $post = $postMapper->getByUrlKey($args['url_key']);
    if(empty($post)) {
        $body = $view->render('404.twig');
    } else {
        $body = $view->render('post.twig', [
            'post' => $post
        ]);
    }
    $response->getBody()->write($body);
    return $response;
});
$app->run();
