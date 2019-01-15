<?php
use PHPUnit\Framework\TestCase;

class TestAutoreferenced extends TestCase
{
    public $myTestdata = null;

    public function testJsonEncodeException($data)
    {
        $this->myTestdata = $data;
    }
}
