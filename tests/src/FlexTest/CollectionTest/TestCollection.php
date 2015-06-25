<?php
namespace FlexTest\CollectionTest;

use Flex\Collection;

/**
 * Class TestCollection
 * @author Jeff Tunessen <jeff.tunessen@gmail.com>
 */
class TestCollection extends Collection
{

    /**
     * @return array
     */
    public function toArray()
    {
        return array(
            'nickname' => 'foo'
        );
    }
}
