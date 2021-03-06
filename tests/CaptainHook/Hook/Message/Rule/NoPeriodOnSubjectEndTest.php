<?php
/**
 * This file is part of CaptainHook.
 *
 * (c) Sebastian Feldmann <sf@sebastian.feldmann.info>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace CaptainHook\App\Hook\Message\Rule;

use SebastianFeldmann\Git\CommitMessage;
use PHPUnit\Framework\TestCase;

class NoPeriodOnSubjectEndTest extends TestCase
{
    /**
     * Tests NoPeriodOnSubjectEnd::pass
     */
    public function testPassSuccess()
    {
        $msg  = new CommitMessage('Foo bar');
        $rule = new NoPeriodOnSubjectEnd();

        $this->assertTrue($rule->pass($msg));
    }

    /**
     * Tests NoPeriodOnSubjectEnd::pass
     */
    public function testPassFail()
    {
        $msg  = new CommitMessage('Foo bar.');
        $rule = new NoPeriodOnSubjectEnd();

        $this->assertFalse($rule->pass($msg));
    }
}
