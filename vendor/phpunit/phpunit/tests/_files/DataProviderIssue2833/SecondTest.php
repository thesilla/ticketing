<?php

namespace Foo\dataProviderIssue2833;

use PHPUnit\Framework\TestCase;

class SecondTest extends TestCase
{
    const DUMMY = 'dummy';

    public function testSecond()
    {
        $this->assertTrue(true);
    }
}
