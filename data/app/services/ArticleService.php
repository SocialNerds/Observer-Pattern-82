<?php

namespace App\Services;

use App\Models\Article;
use App\Models\Author;

class ArticleService
{

    /**
     * Service that connects to DB.
     *
     * @var OrmService
     */
    protected $ormService;

    /**
     * Author service.
     *
     * @var AuthorService
     */
    protected $authorService;

    /**
     * ArticleService constructor.
     *
     * @param OrmService $ormService Service that connects to DB.
     * @param AuthorService $authorService Author service.
     */
    public function __construct(OrmService $ormService, AuthorService $authorService)
    {
        $this->ormService = $ormService;
        $this->authorService = $authorService;
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
    public function create(string $title, string $body, Author $author)
    {
        return new Article(0, $title, $body, $author);
    }

    /**
     * Save article.
     *
     * @param Article $article Article object.
     *
     * @return Article Saved article.
     */
    public function save(Article $article): Article
    {
        return $this->unserialize($this->ormService->save('article', $this->serialize($article)));
    }

    /**
     * Unserialize an array of values to Article object.
     *
     * @param array $values Array of values.
     *
     * @return Article Article object.
     */
    private function unserialize(array $values): Article
    {
        return new Article(
            $values['id'],
            $values['title'],
            $values['body'],
            $this->authorService->getAuthorById($values['author'])
        );
    }

    /**
     * Serialize an article to array.
     *
     * @param Article $article Article object.
     *
     * @return array Serialized object to array.
     */
    private function serialize(Article $article): array
    {
        return [
            'id' => $article->getId(),
            'title' => $article->getTitle(),
            'body' => $article->getBody(),
            'author' => $article->getAuthor()->getId(),
        ];
    }

    /**
     * Delete an article.
     *
     * @param int $id Article ID.
     *
     * @return bool True if article found and deleted.
     */
    public function delete(int $id): bool
    {
        return $this->ormService->delete('article', $id);
    }
}
