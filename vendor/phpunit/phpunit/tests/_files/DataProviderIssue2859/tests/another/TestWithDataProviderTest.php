<?php

namespace Foo\dataProviderIssue2859;

use PHPUnit\Framework\TestCase;

class TestWithdataProviderTest extends TestCase
{
    /**
     * @dataProvider provide
     */
    public function testFirst($x)
    {
        $this->assertTrue(true);
    }

    public function provide()
    {
        return [[true]];
    }
}
