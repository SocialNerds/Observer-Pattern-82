<?php

namespace App\Models;

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
     * @param int $id Article ID.
     * @param string $title Article title.
     * @param string $body Article body.
     * @param Author $author Article author.
     */
    public function __construct(int $id, string $title, string $body, Author $author)
    {
        $this->id = $id;
        $this->title = $title;
        $this->body = $body;
        $this->author = $author;
    }

    /**
     * Article ID.
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Article Title.
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Article body.
     *
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * Article author.
     *
     * @return Author
     */
    public function getAuthor(): Author
    {
        return $this->author;
    }

}
