<?php

class ArticleServiceTest extends \PHPUnit\Framework\TestCase
{
    public function testArticleService()
    {
        $articleId = 1;
        $title = 'SocialNerds';
        $body = 'This is a new article';
        $author = $this->createMock(\App\Models\Author::class);
        $authorId = 1;
        $author->method('getId')
            ->willReturn($authorId);

        $ormService = $this->createMock(\App\Services\OrmService::class);
        $ormService->method('save')
            ->willReturn(['id' => $articleId, 'title' => $title, 'body' => $body, 'author' => $authorId]);
        $ormService->method('delete')
            ->willReturn(true);

        $authorService = $this->createMock(\App\Services\AuthorService::class);
        $authorService->method('getById')
            ->willReturn($author);

        $articleService = new \App\Services\ArticleService($ormService, $authorService);

        $article = $articleService->create($title, $body, $author);
        $article = $articleService->save($article);
        $this->assertEquals($articleId, $article->getId());
        $this->assertEquals($title, $article->getTitle());
        $this->assertEquals($body, $article->getBody());
        $this->assertEquals($author, $article->getAuthor());
        $this->assertEquals(true, $articleService->delete($articleId));
    }

}
