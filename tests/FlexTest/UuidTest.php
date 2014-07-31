<?php
namespace FlexTest;

use Flex\Uuid;

/**
 * Class UuidTest
 *
 * @package FlexTest
 * @author Jeff Tunessen <jeff.tunessen@gmail.com>
 */
class UuidTest extends \PHPUnit_Framework_TestCase {

    /**
     * @return void
     */
    public function test_uuidLength() {
        $this->assertEquals(36, strlen(Uuid::get()), 'strlen of uuid must be 36');
    }

    /**
     * @return void
     */
    public function test_uuidPattern() {
        $this->assertEquals(36, strlen(Uuid::get()), 'strlen of uuid must be 36');
    }
}