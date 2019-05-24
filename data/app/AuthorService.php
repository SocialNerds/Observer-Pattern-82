<?php

namespace App;

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
     * Get author by id.
     *
     * @param int $id Author id.
     *
     * @return Author|false Author.
     */
    public function getAuthorById(int $id)
    {
        $authors = $this->ormService->getDb()->author()->where('id', $id);

        if (count($authors) == 0) {
            return false;
        }

        $author = $authors->author()->fetch();
        print($author);

        return new Author('Thanos');
    }

    /**
     * Create a new author.
     *
     * @param string $name Author name.
     *
     * @return Author
     */
    public function createAuthor(string $name) {

    }

}
