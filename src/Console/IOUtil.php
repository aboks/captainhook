<?php
/**
 * This file is part of CaptainHook.
 *
 * (c) Sebastian Feldmann <sf@sebastian.feldmann.info>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace CaptainHook\App\Console;

/**
 * IOUtil class
 *
 * @package CaptainHook
 * @author  Sebastian Feldmann <sf@sebastian-feldmann.info>
 * @link    https://github.com/captainhookphp/captainhook
 * @since   Class available since Release 0.9.0
 */
abstract class IOUtil
{
    /**
     * Convert a user answer to boolean
     *
     * @param  string $answer
     * @return bool
     */
    public static function answerToBool($answer) : bool
    {
        return in_array($answer, ['y', 'yes', 'ok']);
    }

    /**
     * Return cli line separator string
     *
     * @param  int    $length
     * @param  string $char
     * @return string
     */
    public static function getLineSeparator(int $length = 80, string $char = '=') : string
    {
        return str_repeat($char, $length);
    }
}
