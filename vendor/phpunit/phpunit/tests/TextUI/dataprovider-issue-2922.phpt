--TEST--
phpunit --exclude-group=foo ../_files/dataProviderIssue2922
--FILE--
<?php
$_SERVER['argv'][1] = '--no-configuration';
$_SERVER['argv'][2] = '--exclude-group=foo';
$_SERVER['argv'][3] = __DIR__ . '/../_files/dataProviderIssue2922';

require __DIR__ . '/../bootstrap.php';
PHPUnit\TextUI\Command::main();
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.

.                                                                   1 / 1 (100%)

Time: %s, Memory: %s

OK (1 test, 1 assertion)
