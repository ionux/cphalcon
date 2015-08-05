<?php

/**
 * PhalconPHP Framework
 *
 * @copyright (c) 2011-2015 Phalcon Team
 * @link      http://www.phalconphp.com
 * @author    Andres Gutierrez <andres@phalconphp.com>
 * @author    Nikolaos Dimopoulos <nikos@phalconphp.com>
 *
 * The contents of this file are subject to the New BSD License that is
 * bundled with this package in the file docs/LICENSE.txt
 *
 * If you did not receive a copy of the license and are unable to obtain it
 * through the world-wide-web, please send an email to license@phalconphp.com
 * so that we can send you a copy immediately.
 */

class PHPTTestSuite extends PHPUnit_Framework_TestCase
{
    public static function suite()
    {
        if (empty($_ENV)) {
            $_ENV['PATH'] = (isset($_SERVER['PATH'])) ? $_SERVER['PATH'] : getenv('PATH');
        }

        $directory = __DIR__ . '/../../ext/tests/';

        $facade = new File_Iterator_Facade;
        $suite  = new PHPUnit_Framework_TestSuite();

        $files  = $facade->getFilesAsArray($directory, '.phpt');

        foreach ($files as $file) {
            $c = file_get_contents($file);
            if (!preg_match('/^--(?:PUT|(?:GZIP|DEFLATE)_POST|CGI)--$/m', $c)) {
                $suite->addTestFile($file);
            }
        }

        return $suite;
    }
}
