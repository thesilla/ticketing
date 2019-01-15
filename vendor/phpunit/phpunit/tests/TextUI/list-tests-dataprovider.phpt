--TEST--
phpunit --list-tests dataProviderTest ../_files/dataProviderTest.php
--FILE--
<?php
$_SERVER['argv'][1] = '--no-configuration';
$_SERVER['argv'][2] = '--list-tests';
$_SERVER['argv'][3] = 'dataProviderTest';
$_SERVER['argv'][4] = __DIR__ . '/../_files/dataProviderTest.php';

require __DIR__ . '/../bootstrap.php';
PHPUnit\TextUI\Command::main();
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.

Available test(s):
 - dataProviderTest::testAdd#0
 - dataProviderTest::testAdd#1
 - dataProviderTest::testAdd#2
 - dataProviderTest::testAdd#3
