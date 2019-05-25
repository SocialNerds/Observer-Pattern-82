<?php

namespace App\Services;

use App\Models\Author;

class AuthorService
{

    /**
     * Service that connects to DB.
     *
     * @var OrmService
     */
    protected $ormService;

    /**
     * AuthorService constructor.
     *
     * @param OrmService $ormService Service that connects to DB.
     */
    public function __construct(OrmService $ormService)
    {
        $this->ormService = $ormService;
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
        return $this->unserialize($this->ormService->save('author', $this->serialize($author)));
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
        $array = $this->ormService->get('author', $id);
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
        return $this->ormService->delete('author', $id);
    }


}
