<?php
/**
 * This file is part of CaptainHook.
 *
 * (c) Sebastian Feldmann <sf@sebastian.feldmann.info>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace CaptainHook\App\Hook\Template;

use CaptainHook\App\Config;
use CaptainHook\App\Hook\Template;
use SebastianFeldmann\Git\Repository;
use Symfony\Component\Console\Input\InputInterface;

/**
 * Builder class
 *
 * Creates git hook Template objects regarding some provided input.
 *
 * @package CaptainHook
 * @author  Sebastian Feldmann <sf@sebastian-feldmann.info>
 * @link    https://github.com/captainhookphp/captainhook
 * @since   Class available since Release 4.3.0
 */
abstract class Builder
{
    /**
     * Creates a template that is responsible for the git hook template
     *
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \CaptainHook\App\Config                         $config
     * @param \SebastianFeldmann\Git\Repository               $repository
     *
     * @return \CaptainHook\App\Hook\Template
     */
    public static function build(InputInterface $input, Config $config, Repository $repository): Template
    {
        if ($input->getOption('run-mode') === Template::DOCKER) {
            // For docker we need to strip down the current working directory.
            // This is caused because docker will always connect to a specific working directory
            // where the absolute path will not be recognized.
            // E.g.:
            //   cwd => /docker
            //   path => /docker/captainhook-run
            // The actual path needs to be /captainhook-run to work
            $cwd = getcwd();

            $repoPath = ltrim(realpath($repository->getRoot()), $cwd . DIRECTORY_SEPARATOR);
            $vendorPath = ltrim(realpath(getcwd() . '/vendor'), $cwd . DIRECTORY_SEPARATOR);

            return new Docker(
                $repoPath,
                $vendorPath,
                $input->getOption('container')
            );
        }

        return new Local(
            realpath($repository->getRoot()),
            getcwd() . '/vendor',
            realpath($config->getPath())
        );
    }
}
