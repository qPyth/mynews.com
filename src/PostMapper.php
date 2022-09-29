<?php
    declare(strict_types=1);
    namespace Iskakov\NewsSite;
    use PDO;
    class PostMapper
    {
        private PDO $connections;

        public function __construct($connections)
        {
            $this->connections = $connections;
        }

        /**
         * @param $urlKey
         * @return array|null
         */
        public function getByUrlKey($urlKey):?array {
             $stmt = $this->connections->prepare('SELECT * from post where url_key = :url_key');
             $stmt->execute([
                 'url_key' => $urlKey
             ]);
             $result = $stmt->fetchAll();
             return array_shift($result);
        }

        /**
         * @return array|null
         */
        public function getPosts():?array {
            $stmt = $this->connections->prepare('SELECT * FROM post order by published_date DESC');
            $stmt->execute();
            return $stmt->fetchAll();
        }
    }