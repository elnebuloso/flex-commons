<?php
namespace elnebuloso\Flex;

/**
 * Class ToJsonInterface
 *
 * @author Jeff Tunessen <jeff.tunessen@gmail.com>
 */
interface HasToJson
{
    /**
     * @return array
     */
    public function toJson();
}
