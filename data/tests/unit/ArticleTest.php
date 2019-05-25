<?php

class ArticleTest extends \PHPUnit\Framework\TestCase
{
    public function testArticleModel()
    {
        $id = 0;
        $title = 'Article title';
        $body = 'Article title';
        $author = $this->createMock(\App\Models\Author::class);
        $authorId = 1;
        $author->method('getId')
            ->willReturn($authorId);
        $article = new \App\Models\Article($id, $title, $body, $author);

        $this->assertEquals($id, $article->getId());
        $this->assertEquals($title, $article->getTitle());
        $this->assertEquals($body, $article->getBody());
        $this->assertEquals($authorId, $article->getAuthor()->getId());
    }

}
