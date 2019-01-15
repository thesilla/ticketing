--TEST--
phpunit --process-isolation --filter @false.* dataProviderFilterTest ../_files/dataProviderFilterTest.php
--FILE--
<?php
$_SERVER['argv'][1] = '--no-configuration';
$_SERVER['argv'][2] = '--process-isolation';
$_SERVER['argv'][3] = '--filter';
$_SERVER['argv'][4] = '@false.*';
$_SERVER['argv'][5] = 'dataProviderFilterTest';
$_SERVER['argv'][6] = __DIR__ . '/../_files/dataProviderFilterTest.php';

require __DIR__ . '/../bootstrap.php';
PHPUnit\TextUI\Command::main();
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.

..                                                                  2 / 2 (100%)

Time: %s, Memory: %s

OK (2 tests, 2 assertions)
