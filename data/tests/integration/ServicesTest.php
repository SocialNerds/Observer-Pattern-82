<?php

use AppContainer\ContainerFactory;

class ServicesTest extends \PHPUnit\Framework\TestCase
{

    public function testAuthorCreation()
    {
        $myContainer = ContainerFactory::getContainer();

        $authorService = $myContainer->get('author_service');
        $author = $authorService->create('Thanos');
        $this->assertEquals(0, $author->getId());
        $author = $authorService->save($author);
        $this->assertNotEquals(0, $author->getId());

    }

    public function testArticleCreation()
    {
        $myContainer = ContainerFactory::getContainer();

        $authorService = $myContainer->get('author_service');
        $author = $authorService->create('Thanos');
        $author = $authorService->save($author);

        $articleService = $myContainer->get('article_service');
        $article = $articleService->create('SocialNerds', 'Social Description', $author);
        $this->assertEquals(0, $article->getId());
        $article = $articleService->save($article);
        $this->assertNotEquals(0, $article->getId());
    }

    public function testArticlesAreDeletedWhenAuthorDeleted()
    {
        $myContainer = ContainerFactory::getContainer();

        $authorService = $myContainer->get('author_service');
        $author1 = $authorService->create('Thanos');
        $author1 = $authorService->save($author1);
        $author2 = $authorService->create('Nokas');
        $author2 = $authorService->save($author2);

        $articleService = $myContainer->get('article_service');
        $article11 = $articleService->create('SocialNerds', 'Social Description', $author1);
        $article11 = $articleService->save($article11);
        $article12 = $articleService->create('SocialNerds', 'Social Description', $author1);
        $article12 = $articleService->save($article12);

        $article21 = $articleService->create('SocialNerds', 'Social Description', $author2);
        $article21 = $articleService->save($article21);
        $article22 = $articleService->create('SocialNerds', 'Social Description', $author2);
        $article22 = $articleService->save($article22);

        $this->assertTrue($authorService->delete($author1->getId()));
        $this->assertFalse($authorService->getById($author1->getId()));

        $this->assertFalse($articleService->getById($article11->getId()));
    }

}
