<?php
namespace Flex;

use ArrayObject;
use Exception;

/**
 * Class Registry
 * Inspired by Zendframework1 Registry Pattern
 *
 * @package Flex
 * @author Jeff Tunessen <jeff.tunessen@gmail.com>
 */
class Registry extends ArrayObject {

    /**
     * @var Registry
     */
    private static $registry = null;

    /**
     * @param array $array
     * @param int $flags
     */
    public function __construct($array = array(), $flags = parent::ARRAY_AS_PROPS) {
        parent::__construct($array, $flags);
    }

    /**
     * @return Registry
     */
    public static function getInstance() {
        if(self::$registry === null) {
            self::$registry = new self();
        }

        return self::$registry;
    }

    /**
     * @param string $key
     * @return mixed
     * @throws Exception
     */
    public static function get($key) {
        $instance = self::getInstance();

        if(!$instance->offsetExists($key)) {
            throw new Exception("no data for key {$key}");
        }

        return $instance->offsetGet($key);
    }

    /**
     * @param string $key
     * @param mixed $value
     */
    public static function set($key, $value) {
        $instance = self::getInstance();
        $instance->offsetSet($key, $value);
    }

    /**
     * @param string $key
     * @return bool
     */
    public static function isRegistered($key) {
        if(self::$registry === null) {
            return false;
        }

        return self::$registry->offsetExists($key);
    }

    /**
     * @param Registry $registry
     * @throws Exception
     */
    public static function setInstance(Registry $registry) {
        if(self::$registry !== null) {
            throw new Exception('registry is already initialized');
        }

        self::$registry = $registry;
    }

    /**
     * @return void
     */
    public static function unsetInstance() {
        self::$registry = null;
    }

    /**
     * workaround for http://bugs.php.net/bug.php?id=40442
     *
     * @param string $key
     * @return bool
     */
    public function offsetExists($key) {
        return array_key_exists($key, $this);
    }
}