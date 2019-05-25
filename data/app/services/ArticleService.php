<?php

namespace App\Services;

use App\Events\AuthorDeletedEvent;
use App\Models\Article;
use App\Models\Author;
use Symfony\Component\EventDispatcher\EventDispatcher;

class ArticleService
{

    /*
     * Type.
     */
    const TYPE = 'article';

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
     * @param EventDispatcher $dispatcher Event dispatcher.
     */
    public function __construct(OrmService $ormService, AuthorService $authorService, EventDispatcher $dispatcher)
    {
        $this->ormService = $ormService;
        $this->authorService = $authorService;
        $this->dispatcher = $dispatcher;

        $this->dispatcher->addListener('author.deleted', [$this, 'authorDeleted']);
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
        return $this->unserialize($this->ormService->save(self::TYPE, $this->serialize($article)));
    }

    /**
     * Get article by id.
     *
     * @param int $id Article id.
     *
     * @return Article|false Author.
     */
    public function getById(int $id)
    {
        $array = $this->ormService->get(self::TYPE, $id);
        if (count($array) === 0) {
            return false;
        }

        return $this->unserialize($array);
    }

    /**
     * Delete all articles of author.
     *
     * @param int $authorId Author ID.
     *
     * @return int The number of deleted articles.
     */
    public function deleteByAuthorId(int $authorId): int
    {
        $articlesArray = $this->getByAuthorId($authorId);
        foreach ($articlesArray as $article) {
            $this->ormService->delete(self::TYPE, $article->getId());
        }

        return count($articlesArray);
    }

    /**
     * @param AuthorDeletedEvent $event
     */
    public function authorDeleted(AuthorDeletedEvent $event)
    {
        $this->deleteByAuthorId($event->getAuthorId());
    }

    /**
     * Get all articles of author.
     *
     * @param int $authorId Author ID.
     *
     * @return array Array of articles.
     */
    public function getByAuthorId(int $authorId): array
    {
        $articlesDataArray = $this->ormService->search(self::TYPE, ['author' => $authorId]);

        $articlesArray = [];
        foreach ($articlesDataArray as $articleDataItem) {
            $articlesArray[] = $this->unserialize($articleDataItem);
        }

        return $articlesArray;
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
            $this->authorService->getById($values['author'])
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
        return $this->ormService->delete(self::TYPE, $id);
    }
}
