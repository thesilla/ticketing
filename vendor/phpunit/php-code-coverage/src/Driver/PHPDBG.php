<?php
/*
 * This file is part of the php-code-coverage package.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SebastianBergmann\CodeCoverage\Driver;

use SebastianBergmann\CodeCoverage\RuntimeException;

/**
 * Driver for PHPdbG's code coverage functionality.
 *
 * @codeCoverageIgnore
 */
final class PHPdbG implements Driver
{
    /**
     * @throws RuntimeException
     */
    public function __construct()
    {
        if (PHP_SAPI !== 'phpdbg') {
            throw new RuntimeException(
                'This driver requires the PHPdbG SAPI'
            );
        }

        if (!\function_exists('phpdbg_start_oplog')) {
            throw new RuntimeException(
                'This build of PHPdbG does not support code coverage'
            );
        }
    }

    /**
     * Start collection of code coverage information.
     */
    public function start(bool $determineUnusedAndDead = true): void
    {
        \phpdbg_start_oplog();
    }

    /**
     * Stop collection of code coverage information.
     */
    public function stop(): array
    {
        static $fetchedLines = [];

        $dbgdata = \phpdbg_end_oplog();

        if ($fetchedLines == []) {
            $sourceLines = \phpdbg_get_executable();
        } else {
            $newFiles = \array_diff(\get_included_files(), \array_keys($fetchedLines));

            $sourceLines = [];

            if ($newFiles) {
                $sourceLines = phpdbg_get_executable(['files' => $newFiles]);
            }
        }

        foreach ($sourceLines as $file => $lines) {
            foreach ($lines as $lineNo => $numExecuted) {
                $sourceLines[$file][$lineNo] = self::LINE_NOT_EXECUTED;
            }
        }

        $fetchedLines = \array_merge($fetchedLines, $sourceLines);

        return $this->detectExecutedLines($fetchedLines, $dbgdata);
    }

    /**
     * Convert phpdbg based data into the format CodeCoverage expects
     */
    private function detectExecutedLines(array $sourceLines, array $dbgdata): array
    {
        foreach ($dbgdata as $file => $coveredLines) {
            foreach ($coveredLines as $lineNo => $numExecuted) {
                // phpdbg also reports $lineNo=0 when e.g. exceptions get thrown.
                // make sure we only mark lines executed which are actually executable.
                if (isset($sourceLines[$file][$lineNo])) {
                    $sourceLines[$file][$lineNo] = self::LINE_EXECUTED;
                }
            }
        }

        return $sourceLines;
    }
}
