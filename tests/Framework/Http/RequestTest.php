<?php

namespace Tests\Framework\Http;

use Zend\Diactoros\ServerRequest;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    public function testEmpty(): void
    {
        $request = new ServerRequest();
        self::assertEquals([], $request->getQueryParams());
        self::assertNull($request->getParsedBody());
    }
    public function testQueryParams(): void
    {
        $request = (new ServerRequest())
            ->withQueryParams($data = [
                'name' => 'Foo',
                'age' => 25,
            ]);
        self::assertEquals($data, $request->getQueryParams());
        self::assertNull($request->getParsedBody());
    }
    public function testParsedBody(): void
    {
        $request = (new ServerRequest())
            ->withParsedBody($data = ['title' => 'title']);
        self::assertEquals([], $request->getQueryParams());
        self::assertEquals($data, $request->getParsedBody());
    }
}