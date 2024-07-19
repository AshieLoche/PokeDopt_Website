<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\TestFixture\Event;

use function error_get_last;
use function trigger_error;
use PHPUnit\Framework\Attributes\IgnoreDeprecations;
use PHPUnit\Framework\TestCase;

final class IgnoreDeprecationsTest extends TestCase
{
    #[IgnoreDeprecations]
    public function testOne(): void
    {
        trigger_error('message', E_USER_DEPRECATED);

        $this->assertTrue(true);
    }

    public function testTwo(): void
    {
        trigger_error('message', E_USER_DEPRECATED);

        $this->assertTrue(true);
    }

    #[IgnoreDeprecations]
    public function testOneErrorGetLast(): void
    {
        $this->assertNull(error_get_last());
        trigger_error('message', E_USER_DEPRECATED);
        $this->assertIsArray(error_get_last());
    }

    public function testTwoErrorGetLast(): void
    {
        $this->assertNull(error_get_last());
        trigger_error('message', E_USER_DEPRECATED);
        $this->assertIsArray(error_get_last());
    }
}
