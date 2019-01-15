<?php

use PHPUnit\Framework\TestCase;

class Issue498Test extends TestCase
{
    /**
     * @test
     * @dataProvider shouldbeTruedataProvider
     * @group falseOnly
     */
    public function shouldbeTrue($testdata)
    {
        $this->assertTrue(true);
    }

    /**
     * @test
     * @dataProvider shouldbeFalsedataProvider
     * @group trueOnly
     */
    public function shouldbeFalse($testdata)
    {
        $this->assertFalse(false);
    }

    public function shouldbeTruedataProvider()
    {

        //throw new Exception("Can't create the data");
        return [
            [true],
            [false]
        ];
    }

    public function shouldbeFalsedataProvider()
    {
        throw new Exception("Can't create the data");

        return [
            [true],
            [false]
        ];
    }
}
