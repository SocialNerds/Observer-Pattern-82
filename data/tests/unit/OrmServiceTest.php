<?php

class OrmServiceTest extends \PHPUnit\Framework\TestCase
{
    public function testOrmService()
    {
        $ormService = new \App\Services\OrmService();
        $type = 'article';
        $title = 'SocialNerds';
        $body = 'New article.';
        $authorId = 1;
        $values = [
            'id' => 0,
            'title' => $title,
            'body' => $body,
            'author' => $authorId,
        ];

        $articleValues = $ormService->save($type, $values);
        $this->assertTrue(isset($articleValues['id']));
        $this->assertNotEquals(0, $articleValues['id']);
        $this->assertEquals($title, $articleValues['title']);
        $this->assertEquals($body, $articleValues['body']);
        $this->assertEquals($authorId, $articleValues['author']);

        // Create a new article and search.
        $values = [
            'id' => 0,
            'title' => 'New title',
            'body' => 'New body',
            'author' => $authorId,
        ];
        $articleValues2 = $ormService->save($type, $values);

        $result = $ormService->search($type, ['title' => $title]);
        $this->assertTrue(count($result) === 1);
        $result = $ormService->search($type, ['author' => $authorId]);
        $this->assertTrue(count($result) === 2);

        $this->assertEquals($title, $ormService->get($type, $articleValues['id'])['title']);

        $this->assertFalse($ormService->delete($type, -1000));
        $this->assertTrue($ormService->delete($type, $articleValues2['id']));

        $result = $ormService->search($type, ['author' => $authorId]);
        $this->assertTrue(count($result) === 1);
    }

}
