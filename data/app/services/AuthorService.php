<?php

namespace App\Services;

use App\Events\AuthorDeletedEvent;
use App\Models\Author;
use Symfony\Component\EventDispatcher\EventDispatcher;

class AuthorService
{
    /*
     * Type.
     */
    const TYPE = 'author';

    /**
     * Service that connects to DB.
     *
     * @var OrmService
     */
    protected $ormService;

    /**
     * Event dispatcher.
     *
     * @var EventDispatcher
     */
    protected $dispatcher;

    /**
     * AuthorService constructor.
     *
     * @param OrmService $ormService Service that connects to DB.
     * @param EventDispatcher $dispatcher Event dispatcher.
     */
    public function __construct(OrmService $ormService, EventDispatcher $dispatcher)
    {
        $this->ormService = $ormService;
        $this->dispatcher = $dispatcher;
    }

    /**
     * Create a new author.
     *
     * @param string $name Author name.
     *
     * @return Author
     */
    public function create(string $name): Author
    {
        return new Author(0, $name);
    }

    /**
     * Save author.
     *
     * @param Author $author Author object.
     *
     * @return Author Saved author object.
     */
    public function save(Author $author): Author
    {
        return $this->unserialize($this->ormService->save(self::TYPE, $this->serialize($author)));
    }

    /**
     * Unserialize author values to object.
     *
     * @param array $values Author values.
     *
     * @return Author Author object.
     */
    private function unserialize(array $values): Author
    {
        return new Author($values['id'], $values['name']);
    }

    /**
     * Serialize author object to array.
     *
     * @param Author $author Author object.
     *
     * @return array Array with values.
     */
    private function serialize(Author $author): array
    {
        return [
            'id' => $author->getId(),
            'name' => $author->getName(),
        ];
    }

    /**
     * Get author by id.
     *
     * @param int $id Author id.
     *
     * @return Author|false Author.
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
     * Delete an author.
     *
     * @param int $id Author ID.
     *
     * @return bool True if found and deleted.
     */
    public function delete(int $id): bool
    {
        $event = new AuthorDeletedEvent($id);
        $this->dispatcher->dispatch(AuthorDeletedEvent::NAME, $event);

        return $this->ormService->delete(self::TYPE, $id);
    }

}
