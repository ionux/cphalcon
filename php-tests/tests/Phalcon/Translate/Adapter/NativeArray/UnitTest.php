<?php
/**
 * UnitTest.php
 * \Phalcon\Translate\Adapter\NativeArray\UnitTest
 *
 * Tests the \Phalcon\Translate\Adapter\NativeArray component
 *
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

namespace Phalcon\Test\Translate\Adapter\NativeArray;

use \Phalcon\Test\UnitTestCase as PhTestUnitTestCase;

use \Phalcon\Translate\Exception as PhTranslateException;
use \Phalcon\Translate\Adapter\NativeArray as PhTranslateAdapterNativeArray;

class UnitTest extends PhTestUnitTestCase
{
    protected $langEN;
    protected $langES;
    protected $langFR;
    protected $paramsEN;
    protected $paramsES;
    protected $paramsFR;
    protected $transEN;
    protected $transES;
    protected $transFR;

    public function setup()
    {
        $this->langEN   = $this->config['tr']['en'];
        $this->paramsEN = array('content' => $this->langEN);
        $this->transEN  = new PhTranslateAdapterNativeArray($this->paramsEN);

        $this->langES   = $this->config['tr']['es'];
        $this->paramsES = array('content' => $this->langES);
        $this->transES  = new PhTranslateAdapterNativeArray($this->paramsES);

        $this->langFR   = $this->config['tr']['fr'];
        $this->paramsFR = array('content' => $this->langFR);
        $this->transFR  = new PhTranslateAdapterNativeArray($this->paramsFR);
    }

    /**
     * Tests Exists
     *
     * @author Nikos Dimopoulos <nikos@phalconphp.com>
     * @since  2012-10-30
     */
    public function testExists()
    {
        $found = $this->transEN->exists('hi');

        $this->assertTrue(
            $found,
            'EN translator key does not exist'
        );
    }

    /**
     * Tests offsetExists
     *
     * @author Nikos Dimopoulos <nikos@phalconphp.com>
     * @since  2012-10-30
     */
    public function testOffsetExists()
    {
        $found = $this->transEN->offsetExists('hi');

        $this->assertTrue(
            $found,
            'EN translator offset does not exist'
        );
    }

    /**
     * Tests offsetGet
     *
     * @author Nikos Dimopoulos <nikos@phalconphp.com>
     * @since  2012-10-30
     */
    public function testOffsetGet()
    {
        $expected = 'Hello';
        $actual   = $this->transEN->offsetGet('hi');

        $this->assertEquals(
            $expected,
            $actual,
            'EN translator does not return proper string with offsetGet'
        );
    }

    /**
     * Tests English
     *
     * @author Nikos Dimopoulos <nikos@phalconphp.com>
     * @since  2012-10-30
     */
    public function testQueryEnglish()
    {
        $expected = 'Hello';
        $actual   = $this->transEN->query('hi');

        $this->assertEquals(
            $expected,
            $actual,
            'EN translator does not translate the phrase "Hello" correctly'
        );

        $expected = 'Good Bye';
        $actual   = $this->transEN->query('bye');

        $this->assertEquals(
            $expected,
            $actual,
            'EN translator does not translate the phrase "Good Bye" correctly'
        );
    }

    /**
     * Tests Spanish
     *
     * @author Nikos Dimopoulos <nikos@phalconphp.com>
     * @since  2012-10-30
     */
    public function testQuerySpanish()
    {
        $expected = 'Hola';
        $actual   = $this->transES->query('hi');

        $this->assertEquals(
            $expected,
            $actual,
            'ES translator does not translate the phrase "Hola" correctly'
        );

        $expected = 'Adiós';
        $actual   = $this->transES->query('bye');

        $this->assertEquals(
            $expected,
            $actual,
            'ES translator does not translate the phrase "Adiós" correctly'
        );
    }

    /**
     * Tests French
     *
     * @author Nikos Dimopoulos <nikos@phalconphp.com>
     * @since  2012-10-30
     */
    public function testQueryFrench()
    {
        $expected = 'Bonjour';
        $actual   = $this->transFR->query('hi');

        $this->assertEquals(
            $expected,
            $actual,
            'FR translator does not translate the phrase "Bonjour" correctly'
        );

        $expected = 'Au revoir';
        $actual   = $this->transFR->query('bye');

        $this->assertEquals(
            $expected,
            $actual,
            'FR translator does not translate the phrase "Au revoir" correctly'
        );
    }

    /**
     * Tests English - alternative syntax
     *
     * @author Nikos Dimopoulos <nikos@phalconphp.com>
     * @since  2012-10-30
     */
    public function testQueryEnglishAlternative()
    {
        $expected = 'Hello';
        $actual   = $this->transEN->_('hi');

        $this->assertEquals(
            $expected,
            $actual,
            'EN alternative translator does not translate the phrase "Hello" correctly'
        );

        $expected = 'Good Bye';
        $actual   = $this->transEN->_('bye');

        $this->assertEquals(
            $expected,
            $actual,
            'EN alternative translator does not translate the phrase "Good Bye" correctly'
        );
    }

    /**
     * Tests Spanish - alternative syntax
     *
     * @author Nikos Dimopoulos <nikos@phalconphp.com>
     * @since  2012-10-30
     */
    public function testQuerySpanishAlternative()
    {
        $expected = 'Hola';
        $actual   = $this->transES->_('hi');

        $this->assertEquals(
            $expected,
            $actual,
            'ES alternative translator does not translate the phrase "Hello" correctly'
        );

        $expected = 'Adiós';
        $actual   = $this->transES->_('bye');

        $this->assertEquals(
            $expected,
            $actual,
            'Translator does not translate Spanish correctly'
        );
    }

    /**
     * Tests French - alternative syntax
     *
     * @author Nikos Dimopoulos <nikos@phalconphp.com>
     * @since  2012-10-30
     */
    public function testQueryFrenchAlternative()
    {
        $language   = $this->config['tr']['fr'];
        $params     = array('content' => $language);
        $translator = new PhTranslateAdapterNativeArray($params);

        $expected = 'Bonjour';
        $actual   = $translator->_('hi');

        $this->assertEquals(
            $expected,
            $actual,
            'Translator does not translate French correctly'
        );

        $expected = 'Au revoir';
        $actual   = $translator->_('bye');

        $this->assertEquals(
            $expected,
            $actual,
            'Translator does not translate French correctly'
        );
    }

    /**
     * Tests variable substitution in string with no variables - English
     *
     * @author Nikos Dimopoulos <nikos@phalconphp.com>
     * @since  2012-10-30
     */
    public function testVariableSubstitutionInStringWithNoVariablesEnglish()
    {
        $language   = $this->config['tr']['en'];
        $params     = array('content' => $language);
        $translator = new PhTranslateAdapterNativeArray($params);

        $vars     = array('name' => 'my friend');
        $expected = 'Hello';
        $actual   = $translator->_('hi', $vars);

        $this->assertEquals(
            $expected,
            $actual,
            'Translator does not translate English correctly with passed params'
        );
    }

    /**
     * Tests variable substitution in string (one variable) - English
     *
     * @author Nikos Dimopoulos <nikos@phalconphp.com>
     * @since  2012-10-30
     */
    public function testVariableSubstitutionOneEnglish()
    {
        $language   = $this->config['tr']['en'];
        $params     = array('content' => $language);
        $translator = new PhTranslateAdapterNativeArray($params);

        $vars     = array('name' => 'my friend');
        $expected = 'Hello my friend';
        $actual   = $translator->_('hello-key', $vars);

        $this->assertEquals(
            $expected,
            $actual,
            'Translator does not translate English correctly with parameters'
        );
    }

    /**
     * Tests variable substitution in string (two variable) - English
     *
     * @author Nikos Dimopoulos <nikos@phalconphp.com>
     * @since  2012-10-30
     */
    public function testVariableSubstitutionTwoEnglish()
    {
        $language   = $this->config['tr']['en'];
        $params     = array('content' => $language);
        $translator = new PhTranslateAdapterNativeArray($params);

        $vars     = array(
            'song'   => 'Dust in the wind',
            'artist' => 'Kansas',
        );
        $expected = 'This song is Dust in the wind (Kansas)';
        $actual   = $translator->_('song-key', $vars);

        $this->assertEquals(
            $expected,
            $actual,
            'Translator does not translate English correctly - many parameters'
        );
    }

    /**
     * Tests variable substitution in string with no variables - Spanish
     *
     * @author Nikos Dimopoulos <nikos@phalconphp.com>
     * @since  2012-10-30
     */
    public function testVariableSubstitutionInStringWithNoVariablesSpanish()
    {
        $language   = $this->config['tr']['es'];
        $params     = array('content' => $language);
        $translator = new PhTranslateAdapterNativeArray($params);

        $vars     = array('name' => 'amigo');
        $expected = 'Hola';
        $actual   = $translator->_('hi', $vars);

        $this->assertEquals(
            $expected,
            $actual,
            'Translator does not translate Spanish correctly with passed params'
        );
    }

    /**
     * Tests variable substitution in string (one variable) - Spanish
     *
     * @author Nikos Dimopoulos <nikos@phalconphp.com>
     * @since  2012-10-30
     */
    public function testVariableSubstitutionOneSpanish()
    {
        $language   = $this->config['tr']['es'];
        $params     = array('content' => $language);
        $translator = new PhTranslateAdapterNativeArray($params);

        $vars     = array('name' => 'amigo');
        $expected = 'Hola amigo';
        $actual   = $translator->_('hello-key', $vars);

        $this->assertEquals(
            $expected,
            $actual,
            'Translator does not translate Spanish correctly with parameters'
        );
    }

    /**
     * Tests variable substitution in string (two variable) - Spanish
     *
     * @author Nikos Dimopoulos <nikos@phalconphp.com>
     * @since  2012-10-30
     */
    public function testVariableSubstitutionTwoSpanish()
    {
        $language   = $this->config['tr']['es'];
        $params     = array('content' => $language);
        $translator = new PhTranslateAdapterNativeArray($params);

        $vars     = array(
                        'song'   => 'Dust in the wind',
                        'artist' => 'Kansas',
                    );
        $expected = 'La canción es Dust in the wind (Kansas)';
        $actual   = $translator->_('song-key', $vars);

        $this->assertEquals(
            $expected,
            $actual,
            'Translator does not translate French correctly - many parameters'
        );
    }

    /**
     * Tests variable substitution in string with no variables - French
     *
     * @author Nikos Dimopoulos <nikos@phalconphp.com>
     * @since  2012-10-30
     */
    public function testVariableSubstitutionInStringWithNoVariablesFrench()
    {
        $language   = $this->config['tr']['fr'];
        $params     = array('content' => $language);
        $translator = new PhTranslateAdapterNativeArray($params);

        $vars     = array('name' => 'mon ami');
        $expected = 'Bonjour';
        $actual   = $translator->_('hi', $vars);

        $this->assertEquals(
            $expected,
            $actual,
            'Translator does not translate French correctly with passed params'
        );
    }

    /**
     * Tests variable substitution in string (one variable) - French
     *
     * @author Nikos Dimopoulos <nikos@phalconphp.com>
     * @since  2012-10-30
     */
    public function testVariableSubstitutionOneFrench()
    {
        $language   = $this->config['tr']['fr'];
        $params     = array('content' => $language);
        $translator = new PhTranslateAdapterNativeArray($params);

        $vars     = array('name' => 'mon ami');
        $expected = 'Bonjour mon ami';
        $actual   = $translator->_('hello-key', $vars);

        $this->assertEquals(
            $expected,
            $actual,
            'Translator does not translate French correctly with parameters'
        );
    }

    /**
     * Tests variable substitution in string (two variable) - French
     *
     * @author Nikos Dimopoulos <nikos@phalconphp.com>
     * @since  2012-10-30
     */
    public function testVariableSubstitutionTwoFrench()
    {
        $language   = $this->config['tr']['fr'];
        $params     = array('content' => $language);
        $translator = new PhTranslateAdapterNativeArray($params);

        $vars     = array(
                        'song'   => 'Dust in the wind',
                        'artist' => 'Kansas',
                    );
        $expected = 'La chanson est Dust in the wind (Kansas)';
        $actual   = $translator->_('song-key', $vars);

        $this->assertEquals(
            $expected,
            $actual,
            'Translator does not translate French correctly - many parameters'
        );
    }
}
