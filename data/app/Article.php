<?php

namespace App;

class Article
{
    /**
     * Article id.
     *
     * @var int
     */
    protected $id;

    /**
     * Article title.
     *
     * @var string
     */
    protected $title;

    /**
     * Article body.
     *
     * @var string
     */
    protected $body;

    /**
     * Article author.
     *
     * @var Author
     */
    protected $author;

    /**
     * Article constructor.
     *
     * @param string $title Article title.
     * @param string $body Article body.
     * @param Author $author Article author.
     */
    public function __construct(string $title, string $body, Author $author)
    {
        $this->id = uniqid();
        $this->title = $title;
        $this->body = $body;
        $this->author = $author;
    }

}
