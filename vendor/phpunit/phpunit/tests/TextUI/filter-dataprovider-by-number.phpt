--TEST--
phpunit --filter testTrue#3 dataProviderFilterTest ../_files/dataProviderFilterTest.php
--FILE--
<?php
$_SERVER['argv'][1] = '--no-configuration';
$_SERVER['argv'][2] = '--filter';
$_SERVER['argv'][3] = 'testTrue#3';
$_SERVER['argv'][4] = 'dataProviderFilterTest';
$_SERVER['argv'][5] = __DIR__ . '/../_files/dataProviderFilterTest.php';

require __DIR__ . '/../bootstrap.php';
PHPUnit\TextUI\Command::main();
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.

.                                                                   1 / 1 (100%)

Time: %s, Memory: %s

OK (1 test, 1 assertion)
