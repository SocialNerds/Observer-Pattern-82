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

}
