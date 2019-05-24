<?php

namespace App;

class Author
{
    /**
     * Author id.
     *
     * @var int
     */
    protected $id;

    /**
     * Author name.
     *
     * @var string
     */
    protected $name;

    /**
     * Author constructor.
     *
     * @param string $name Author name.
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * Get author id.
     *
     * @return int Author id.
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get author name.
     *
     * @return string Author name.
     */
    public function getName(): string
    {
        return $this->name;
    }



}
