<?php
use PHPUnit\Framework\TestCase;

class Issue2380Test extends TestCase
{
    /**
     * @dataProvider generatordata
     */
    public function testGeneratorProvider($data)
    {
        $this->assertNotEmpty($data);
    }

    /**
     * @return Generator
     */
    public function generatordata()
    {
        yield ['testing'];
    }
}
