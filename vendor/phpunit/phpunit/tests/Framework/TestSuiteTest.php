<?php
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PHPUnit\Framework;

class TestSuiteTest extends TestCase
{
    /**
     * @var TestResult
     */
    private $result;

    protected function setUp(): void
    {
        $this->result = new TestResult;
    }

    protected function tearDown(): void
    {
        $this->result = null;
    }

    public static function suite()
    {
        $suite = new TestSuite;

        $suite->addTest(new self('testAddTestSuite'));
        $suite->addTest(new self('testInheritedTests'));
        $suite->addTest(new self('testNoTestCases'));
        $suite->addTest(new self('testNoTestCaseClass'));
        $suite->addTest(new self('testNotExistingTestCase'));
        $suite->addTest(new self('testNotPublicTestCase'));
        $suite->addTest(new self('testNotVoidTestCase'));
        $suite->addTest(new self('testOneTestCase'));
        $suite->addTest(new self('testShadowedTests'));
        $suite->addTest(new self('testBeforeClassAndAfterClassAnnotations'));
        $suite->addTest(new self('testBeforeClassWithdataProviders'));
        $suite->addTest(new self('testBeforeAnnotation'));
        $suite->addTest(new self('testTestWithAnnotation'));
        $suite->addTest(new self('testSkippedTestdataProvider'));
        $suite->addTest(new self('testTestdataProviderDependency'));
        $suite->addTest(new self('testIncompleteTestdataProvider'));
        $suite->addTest(new self('testRequirementsBeforeClassHook'));
        $suite->addTest(new self('testDoNotSkipInheritedClass'));

        return $suite;
    }

    public function testAddTestSuite(): void
    {
        $suite = new TestSuite(\OneTestCase::class);

        $suite->run($this->result);

        $this->assertCount(1, $this->result);
    }

    public function testInheritedTests(): void
    {
        $suite = new TestSuite(\InheritedTestCase::class);

        $suite->run($this->result);

        $this->assertTrue($this->result->wasSuccessful());
        $this->assertCount(2, $this->result);
    }

    public function testNoTestCases(): void
    {
        $suite = new TestSuite(\NoTestCases::class);

        $suite->run($this->result);

        $this->assertNotTrue($this->result->wasSuccessful());
        $this->assertEquals(0, $this->result->failureCount());
        $this->assertEquals(1, $this->result->warningCount());
        $this->assertCount(1, $this->result);
    }

    public function testNoTestCaseClass(): void
    {
        $this->expectException(Exception::class);

        new TestSuite(\NoTestCaseClass::class);
    }

    public function testNotExistingTestCase(): void
    {
        $suite = new self('notExistingMethod');

        $suite->run($this->result);

        $this->assertEquals(0, $this->result->errorCount());
        $this->assertEquals(1, $this->result->failureCount());
        $this->assertCount(1, $this->result);
    }

    public function testNotPublicTestCase(): void
    {
        $suite = new TestSuite(\NotPublicTestCase::class);

        $this->assertCount(2, $suite);
    }

    public function testNotVoidTestCase(): void
    {
        $suite = new TestSuite(\NotVoidTestCase::class);

        $this->assertCount(1, $suite);
    }

    public function testOneTestCase(): void
    {
        $suite = new TestSuite(\OneTestCase::class);

        $suite->run($this->result);

        $this->assertEquals(0, $this->result->errorCount());
        $this->assertEquals(0, $this->result->failureCount());
        $this->assertCount(1, $this->result);
        $this->assertTrue($this->result->wasSuccessful());
    }

    public function testShadowedTests(): void
    {
        $suite = new TestSuite(\OverrideTestCase::class);

        $suite->run($this->result);

        $this->assertCount(1, $this->result);
    }

    public function testBeforeClassAndAfterClassAnnotations(): void
    {
        $suite = new TestSuite(\BeforeClassAndAfterClassTest::class);

        \BeforeClassAndAfterClassTest::resetProperties();
        $suite->run($this->result);

        $this->assertEquals(1, \BeforeClassAndAfterClassTest::$beforeClassWasRun, '@beforeClass method was not run once for the whole suite.');
        $this->assertEquals(1, \BeforeClassAndAfterClassTest::$afterClassWasRun, '@afterClass method was not run once for the whole suite.');
    }

    public function testBeforeClassWithdataProviders(): void
    {
        $suite = new TestSuite(\BeforeClassWithOnlydataProviderTest::class);

        \BeforeClassWithOnlydataProviderTest::resetProperties();
        $suite->run($this->result);

        $this->assertTrue(\BeforeClassWithOnlydataProviderTest::$setUpBeforeClassWasCalled, 'setUpBeforeClass method was not run.');
        $this->assertTrue(\BeforeClassWithOnlydataProviderTest::$beforeClassWasCalled, '@beforeClass method was not run.');
    }

    public function testBeforeAnnotation(): void
    {
        $test = new TestSuite(\BeforeAndAfterTest::class);

        \BeforeAndAfterTest::resetProperties();
        $test->run();

        $this->assertEquals(2, \BeforeAndAfterTest::$beforeWasRun);
        $this->assertEquals(2, \BeforeAndAfterTest::$afterWasRun);
    }

    public function testTestWithAnnotation(): void
    {
        $test = new TestSuite(\TestWithTest::class);

        \BeforeAndAfterTest::resetProperties();
        $result = $test->run();

        $this->assertCount(4, $result->passed());
    }

    public function testSkippedTestdataProvider(): void
    {
        $suite = new TestSuite(\dataProviderSkippedTest::class);

        $suite->run($this->result);

        $this->assertEquals(3, $this->result->count());
        $this->assertEquals(1, $this->result->skippedCount());
    }

    public function testTestdataProviderDependency(): void
    {
        $suite = new TestSuite(\dataProviderDependencyTest::class);

        $suite->run($this->result);

        $skipped           = $this->result->skipped();
        $lastSkippedResult = \array_pop($skipped);
        $message           = $lastSkippedResult->thrownException()->getMessage();

        $this->assertContains('Test for dataProviderDependencyTest::testDependency skipped by data provider', $message);
    }

    public function testIncompleteTestdataProvider(): void
    {
        $suite = new TestSuite(\dataProviderIncompleteTest::class);

        $suite->run($this->result);

        $this->assertEquals(3, $this->result->count());
        $this->assertEquals(1, $this->result->notImplementedCount());
    }

    public function testRequirementsBeforeClassHook(): void
    {
        $suite = new TestSuite(\RequirementsClassBeforeClassHookTest::class);

        $suite->run($this->result);

        $this->assertEquals(0, $this->result->errorCount());
        $this->assertEquals(1, $this->result->skippedCount());
    }

    public function testDoNotSkipInheritedClass(): void
    {
        $suite = new TestSuite(
            'DontSkipInheritedClass'
        );

        $dir = \dirname(__DIR__) . DIRECTORY_SEPARATOR . '_files' . DIRECTORY_SEPARATOR . 'Inheritance' . DIRECTORY_SEPARATOR;

        $suite->addTestFile($dir . 'InheritanceA.php');
        $suite->addTestFile($dir . 'InheritanceB.php');

        $result = $suite->run();

        $this->assertCount(2, $result);
    }
}
