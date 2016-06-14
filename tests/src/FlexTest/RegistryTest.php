<?php
namespace elnebuloso\FlexTest;

use elnebuloso\Flex\Registry;
use Exception;
use PHPUnit_Framework_TestCase;

/**
 * Class RegistryTest
 *
 * @author Jeff Tunessen <jeff.tunessen@gmail.com>
 */
class RegistryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @expectedException Exception
     * @expectedExceptionMessage no data for key foo
     */
    public function testGetNoDataForKey()
    {
        Registry::get('foo');
    }

    /**
     * @test
     */
    public function testSetDataForKey()
    {
        Registry::set('bar', 'barvalue');
        $this->assertEquals('barvalue', Registry::get('bar'));
    }

    /**
     * @test
     */
    public function testIsRegistered()
    {
        Registry::unsetInstance();
        $this->assertFalse(Registry::isRegistered('bar'));

        Registry::set('bar', 'barvalue');
        $this->assertTrue(Registry::isRegistered('bar'));
    }

    /**
     * @test
     */
    public function testSetInstanceNewInstance()
    {
        Registry::unsetInstance();

        $foo = new Registry(['bar' => 'barvalue']);
        Registry::setInstance($foo);
        $this->assertEquals('barvalue', Registry::get('bar'));
    }

    /**
     * @test
     * @expectedException Exception
     * @expectedExceptionMessage registry is already initialized
     */
    public function testSetInstanceHasInstance()
    {
        Registry::unsetInstance();
        Registry::set('bar', 'barvalue');

        $foo = new Registry(['bar' => 'barvalue']);
        Registry::setInstance($foo);
    }
}
