<?php

class AuthorTest extends \PHPUnit\Framework\TestCase
{
    public function testAuthorModel()
    {
        $id = 0;
        $name = 'Thanos';
        $author = new \App\Models\Author($id, $name);

        $this->assertEquals($id, $author->getId());
        $this->assertEquals($name, $author->getName());
    }

}
