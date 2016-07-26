<?php
namespace elnebuloso\FlexTest;

use elnebuloso\Flex\Collection;
use elnebuloso\FlexTest\CollectionTest\TestCollection;
use PHPUnit_Framework_TestCase;

/**
 * Class CollectionTest
 *
 * @author Jeff Tunessen <jeff.tunessen@gmail.com>
 */
class CollectionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function testConstruct()
    {
        $collectionData = [
            'foo',
            'bar',
        ];
        $totalCount = 2;

        $collection = new Collection($collectionData, $totalCount);

        $this->assertEquals($collectionData, $collection->getElements());
        $this->assertEquals($totalCount, $collection->getTotalCount());
    }

    /**
     * @test
     */
    public function testElements()
    {
        $collectionData = [
            'foo',
            'bar',
        ];

        $collection = new Collection();
        $collection->setElements($collectionData);

        $this->assertEquals($collectionData, $collection->getElements());
    }

    /**
     * @test
     */
    public function testAddElement()
    {
        $data = 'element';

        $collection = new Collection();
        $collection->addElement($data);
        $collection->addElement($data, 'foo');

        $elements = $collection->getElements();
        $this->assertEquals($data, $elements[0]);
        $this->assertEquals($data, $elements['foo']);
    }

    /**
     * @test
     */
    public function testGetElement()
    {
        $data = 'element';

        $collection = new Collection();
        $collection->addElement($data, 'foo');

        $this->assertEquals('element', $collection->getElement('foo'));
        $this->assertNull($collection->getElement('bar'));
    }

    /**
     * @test
     */
    public function testRemoveElement()
    {
        $data = 'element';

        $collection = new Collection();
        $collection->addElement($data, 'foo');
        $collection->addElement($data, 'bar');
        $collection->removeElement('bar');

        $elements = $collection->getElements();
        $expected = [
            'foo' => 'element',
        ];

        $this->assertEquals($expected, $elements);
    }

    /**
     * @test
     */
    public function testTotalCount()
    {
        $collection = new Collection();
        $collection->setTotalCount(2);

        $this->assertEquals(2, $collection->getTotalCount());
    }

    /**
     * @test
     */
    public function testCountable()
    {
        $collectionData = [
            'foo',
            'bar',
        ];

        $collection = new Collection($collectionData);
        $this->assertEquals(2, $collection->count());
    }

    /**
     * @test
     */
    public function testArrayAccess()
    {
        $collectionData = [
            'foo',
            'bar',
        ];

        $collection = new Collection($collectionData);

        $this->assertEquals(true, $collection->offsetExists(0));
        $this->assertEquals(false, $collection->offsetExists(3));

        $this->assertEquals('foo', $collection->offsetGet(0));
        $this->assertEquals(null, $collection->offsetGet(2));

        $collection->offsetSet(null, 'baz');
        $this->assertEquals(true, $collection->offsetExists(2));

        $collection->offsetSet(3, 'foobaz');
        $this->assertEquals(true, $collection->offsetExists(3));

        $collection->offsetUnset(3);
        $this->assertEquals(false, $collection->offsetExists(3));
    }

    /**
     * @test
     */
    public function testToArray()
    {
        $object1 = new TestCollection();
        $object2 = new TestCollection();

        $collectionData = [
            $object1,
            $object2,
            'foo',
        ];

        $collection = new Collection($collectionData);
        $elements = $collection->toArray();

        $equals = [
            [
                'nickname' => 'foo',
            ],
            [
                'nickname' => 'foo',
            ],
            'foo',
        ];

        $this->assertEquals($equals, $elements);
    }

    /**
     * @test
     */
    public function testToJson()
    {
        $object1 = new TestCollection();
        $object2 = new TestCollection();

        $collectionData = [
            $object1,
            $object2,
            'foo',
        ];

        $equals = [
            [
                'nickname' => 'foo',
            ],
            [
                'nickname' => 'foo',
            ],
            'foo',
        ];
        $equals = json_encode($equals);

        $collection = new Collection($collectionData);
        $this->assertEquals($equals, $collection->toJson());
    }

    /**
     * @test
     */
    public function testIterator()
    {
        $collectionData = [
            'foo',
            'bar',
            'baz',
        ];

        $collection = new Collection($collectionData);

        $element = $collection->current();
        $this->assertEquals('foo', $element);

        $key = $collection->key();
        $this->assertEquals(0, $key);

        $element = $collection->next();
        $this->assertEquals('bar', $element);

        $valid = $collection->current();
        $this->assertEquals('bar', $element);

        $element = $collection->next();
        $this->assertEquals('baz', $element);

        $valid = $collection->valid();
        $this->assertEquals(true, $valid);

        $collection->rewind();
        $element = $collection->current();
        $this->assertEquals('foo', $element);
    }
}
