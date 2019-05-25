<?php

class AuthorServiceTest extends \PHPUnit\Framework\TestCase
{
    public function testAuthorService()
    {
        $id = 1;
        $name = 'thanos';
        $ormService = $this->createMock(\App\Services\OrmService::class);
        $ormService->method('save')
            ->willReturn(['id' => $id, 'name' => $name]);
        $ormService->method('get')
            ->willReturn(['id' => $id, 'name' => $name]);
        $ormService->method('delete')
            ->willReturn(true);

        $dispatcher = $this->createMock(\Symfony\Component\EventDispatcher\EventDispatcher::class);

        $authorService = new \App\Services\AuthorService($ormService, $dispatcher);
        $author = $authorService->create($name);
        $author = $authorService->save($author);
        $this->assertEquals($id, $author->getId());
        $this->assertEquals($name, $author->getName());

        $this->assertEquals($author, $authorService->getById($id));
        $this->assertEquals(true, $authorService->delete($id));
    }

}
