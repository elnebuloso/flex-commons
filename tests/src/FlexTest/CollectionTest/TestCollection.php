<?php
namespace elnebuloso\FlexTest\CollectionTest;

use elnebuloso\Flex\Collection;

/**
 * Class TestCollection
 *
 * @author Jeff Tunessen <jeff.tunessen@gmail.com>
 */
class TestCollection extends Collection
{
    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'nickname' => 'foo',
        ];
    }
}
