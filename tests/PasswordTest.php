<?php
declare(strict_types = 1);

namespace SilexFriends\Tests\Password;

use SilexFriends\Password\Password;
use PHPUnit_Framework_TestCase;
use Silex\Application;

/**
 * Password Test Case
 *
 * @author Thiago Paes <mrprompt@gmail.com>
 */
class PasswordTest extends PHPUnit_Framework_TestCase
{
    /**
     * @const int
     */
    const DEFAULT_COST = 12;

    /**
     * @var Application
     */
    private $app;

    /**
     * Bootstrap
     */
    public function setUp()
    {
        parent::setUp();

        $app = new Application;
        $app->register(new Password(self::DEFAULT_COST));

        $this->app = $app;
    }

    /**
     * Shutdown
     */
    public function tearDown()
    {
        $this->app = null;

        parent::tearDown();
    }

    /**
     * @test
     */
    public function generateWithPasswordWithoutCostMustBeReturnNotEmpty()
    {
        $result = $this->app[Password::GENERATE]('foo');

        $this->assertNotEmpty($result);
    }

    /**
     * @test
     */
    public function generateWithPasswordWithCostMustBeReturnNotEmpty()
    {
        $result = $this->app[Password::GENERATE]('foo', self::DEFAULT_COST);

        $this->assertNotEmpty($result);
    }

    /**
     * @test
     */
    public function verifyMustBeReturnTrueWithValidPassword()
    {
        $clean      = 'foo';
        $encrypted  = '$2y$12$7ytxUXW5xwRMJyGYWRUKquUQEaCs7qhQlYOgs/S64u5jODYDE9shS';

        $verify     = $this->app[Password::VERIFY]($clean, $encrypted);

        $this->assertTrue($verify);
    }

    /**
     * @test
     */
    public function verifyMustBeReturnFalseWithInvalidPassword()
    {
        $clean      = 'foobarbar';
        $encrypted  = '$2y$12$7ytxUXW5xwRMJyGYWRUKquUQEaCs7qhQlYOgs/S64u5jODYDE9shS';

        $verify     = $this->app[Password::VERIFY]($clean, $encrypted);

        $this->assertFalse($verify);
    }
}
