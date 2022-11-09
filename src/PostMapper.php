<?php
    declare(strict_types=1);
    namespace NewsSite;
    class PostMapper
    {
        private Database $database;

        public function __construct(Database $database)
        {
            $this->database = $database;
        }

        /**
         * @param $urlKey
         * @return array|null
         */
        public function getPostByUrlKey($urlKey):?array {
             $stmt = $this->database->getConnection()->prepare('SELECT * from post where url_key = :url_key');
             $stmt->execute([
                 'url_key' => $urlKey
             ]);
             $result = $stmt->fetchAll();
             return array_shift($result);
        }

        public function getMostViewedPost():?array {
            $stmt = $this->database->getConnection()->prepare('SELECT * from post where views = (SELECT MAX(views) from post)');
            $stmt->execute();
            $result = $stmt->fetchAll();
            return array_shift($result);
        }

        public function getLatestPosts(): ?array {
            $stmt = $this->database->getConnection()->query('SELECT * FROM post ORDER BY published_date DESC LIMIT 3');
            $stmt->execute();
            return $stmt->fetchAll();
        }
    }

