<?php
namespace FlexTest;

use Exception;
use Flex\Registry;

/**
 * Class RegistryTest
 *
 * @author Jeff Tunessen <jeff.tunessen@gmail.com>
 */
class RegistryTest extends \PHPUnit_Framework_TestCase {

    /**
     * @test
     * @expectedException Exception
     * @expectedExceptionMessage no data for key foo
     */
    public function test_getNoDataForKey() {
        Registry::get('foo');
    }

    /**
     * @test
     */
    public function test_setDataForKey() {
        Registry::set('bar', 'barvalue');
        $this->assertEquals('barvalue', Registry::get('bar'));
    }

    /**
     * @test
     */
    public function test_isRegistered() {
        Registry::unsetInstance();
        $this->assertFalse(Registry::isRegistered('bar'));

        Registry::set('bar', 'barvalue');
        $this->assertTrue(Registry::isRegistered('bar'));
    }

    /**
     * @test
     */
    public function test_setInstanceNewInstance() {
        Registry::unsetInstance();

        $foo = new Registry(array('bar' => 'barvalue'));
        Registry::setInstance($foo);
        $this->assertEquals('barvalue', Registry::get('bar'));
    }

    /**
     * @test
     * @expectedException Exception
     * @expectedExceptionMessage registry is already initialized
     */
    public function test_setInstanceHasInstance() {
        Registry::unsetInstance();
        Registry::set('bar', 'barvalue');

        $foo = new Registry(array('bar' => 'barvalue'));
        Registry::setInstance($foo);
    }
}