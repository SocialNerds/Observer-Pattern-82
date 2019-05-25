<?php

namespace App\Events;

use Symfony\Component\EventDispatcher\Event;

/**
 * The author.deleted event is dispatched each time an author is deleted.
 */
class AuthorDeletedEvent extends Event
{
    public const NAME = 'author.deleted';

    /**
     * Author ID who is deleted.
     *
     * @var int
     */
    protected $authorId;

    /**
     * AuthorDeletedEvent constructor.
     *
     * @param int $author Author who is deleted.
     */
    public function __construct(int $authorId)
    {
        $this->authorId = $authorId;
    }

    /**
     * Get deleted author id.
     *
     * @return int
     */
    public function getAuthorId(): int
    {
        return $this->authorId;
    }

}
