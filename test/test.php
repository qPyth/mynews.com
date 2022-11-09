<?php
    use NewsSite\PostMapper;
    use NewsSite\Database;
    $connection = new Database('mysql:host=localhost;dbname=news', 'user', 'LXLCZqHHYSqpGDRs');
    $postMapper = new PostMapper($connection);
    $latestPosts = $postMapper->getLatestPosts();
    print_r($latestPosts);

