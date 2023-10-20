<?php

namespace drupol\PhpCsFixerConfigsDrupal\Tests;

use ArrayIterator;
use BadMethodCallException;
use PhpCsFixer\Cache\NullCacheManager;
use PhpCsFixer\Differ\UnifiedDiffer;
use PhpCsFixer\Error\ErrorsManager;
use PhpCsFixer\Linter\Linter;
use PhpCsFixer\PhpunitConstraintIsIdenticalString\Constraint\IsIdenticalString;
use PhpCsFixer\Runner\Runner;
use PHPUnit\Framework\TestCase;
use SplFileInfo;

/**
 * Provides setup methods for Scenario testing.
 */
abstract class IntegrationTestCase extends TestCase
{
    /**
     * Location Path of the Scenario fixtures files.
     *
     * A Scenario must have 2 files:
     * - bad.php
     * - good.php
     */
    protected function getScenarioPath(): string
    {
        throw new BadMethodCallException(sprintf('Method "%s" is not implemented.', __METHOD__));
    }

    protected function getTempFile(): SplFileInfo
    {
        $tmpFile = new SplFileInfo(sys_get_temp_dir() . \DIRECTORY_SEPARATOR . 'MyClass.php');
        $input = $this->getScenarioInputFileContent();
        if (false === @file_put_contents($tmpFile, $input)) {
            throw new IOException(sprintf('Failed to write to tmp. file "%s".', $tmpFile));
        }

        return $tmpFile;
    }

    /**
     * Location Path of the Scenario input (bad) file.
     */
    protected function getScenarioInputFileContent(): string
    {
        return file_get_contents($this->getScenarioPath() . DIRECTORY_SEPARATOR . 'bad.php');
    }

    /**
     * Location Path of the Scenario output/expected (good) file.
     */
    protected function getScenarioOutputFileContent(): string
    {
        return file_get_contents($this->getScenarioPath() . DIRECTORY_SEPARATOR . 'good.php');
    }

    /**
     * Run the Scenario tests.
     */
    protected function doTest(array $fixers = []): void
    {
        $tmpFile = $this->getTempFile();
        $runner = new Runner(
            new ArrayIterator([$tmpFile]),
            $fixers,
            new UnifiedDiffer(),
            null,
            new ErrorsManager(),
            new Linter(),
            false,
            new NullCacheManager()
        );
        $runner->fix();

        self::assertThat(file_get_contents($tmpFile), new IsIdenticalString($this->getScenarioOutputFileContent()), 'Code build on expected code must been fixed as expected.');
    }
}
