<?php
namespace FlexTest;

use Flex\Uuid;

/**
 * Class UuidTest
 *
 * @author Jeff Tunessen <jeff.tunessen@gmail.com>
 */
class UuidTest extends \PHPUnit_Framework_TestCase {

    /**
     * c851db2f-f7b2-4e4f-9ea0-343f592f4cb7
     *
     * @test
     */
    public function test_uuidPattern() {
        $pattern = '`([a-f0-9]{8})-([a-f0-9]{4})-([a-f0-9]{4})-([a-f0-9]{4})-([a-f0-9]{12})`';
        $this->assertRegExp($pattern, Uuid::get(), 'uuid does not match the pattern');
    }
}