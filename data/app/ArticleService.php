<?php

namespace App;

class ArticleService
{

    /**
     * Service that connects to DB.
     *
     * @var OrmService
     */
    protected $ormService;

    /**
     * ArticleService constructor.
     *
     * @param OrmService $ormService Service that connects to DB.
     */
    public function __construct(OrmService $ormService)
    {
        $this->ormService = $ormService;
    }

    /**
     * Create a new article.
     *
     * @param string $title Article title.
     * @param string $body Article body.
     * @param Author $author Article author.
     *
     * @return Article The new article.
     */
    public function createArticle(string $title, string $body, Author $author)
    {
        return new Article($title, $body, $author);
    }
}
