--TEST--
phpunit --filter @false.* dataProviderFilterTest ../_files/dataProviderFilterTest.php
--FILE--
<?php
$_SERVER['argv'][1] = '--no-configuration';
$_SERVER['argv'][2] = '--filter';
$_SERVER['argv'][3] = '@false.*';
$_SERVER['argv'][4] = 'dataProviderFilterTest';
$_SERVER['argv'][5] = __DIR__ . '/../_files/dataProviderFilterTest.php';

require __DIR__ . '/../bootstrap.php';
PHPUnit\TextUI\Command::main();
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.

..                                                                  2 / 2 (100%)

Time: %s, Memory: %s

OK (2 tests, 2 assertions)
