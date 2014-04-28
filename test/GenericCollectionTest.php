<?php

namespace Com\PaulDevelop\Library\Common;

class Item
{
    public $property;

    public function __construct($property = '')
    {
        $this->property = $property;
    }
}

class ItemCollection extends GenericCollection
{
    public function __construct()
    {
        parent::__construct('Com\PaulDevelop\Library\Common\Item');
    }
}

class GenericCollectionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function testAddItemToCollection()
    {
        $ic = new ItemCollection();

        $this->assertEquals(0, sizeof($ic));
        $ic->add(new Item());
        $this->assertEquals(1, sizeof($ic));
    }

    /**
     * @test
     */
    public function testGetItemFromCollection()
    {
        $ic = new ItemCollection();
        $ic->add(new Item('Test'));
        $item = $ic[0];
        /* @var $item Item */
        $this->assertEquals('Test', $item->property);
    }

    /**
     * @test
     */
    public function testIfCollectionIsEmptyByDefault()
    {
        $gc = $this->getMockForAbstractClass(
            'Com\PaulDevelop\Library\Common\GenericCollection',
            array('Com\PaulDevelop\Library\Common\Item')
        );
        $this->assertSame(0, $gc->count());
    }

    /**
     * @test
     * @expectedException \Com\PaulDevelop\Library\Common\TypeCheckException
     */
    public function testIfAddingItemOfWrongTypeThrowsException()
    {
        $gc = $this->getMockForAbstractClass(
            'Com\PaulDevelop\Library\Common\GenericCollection',
            array('Com\PaulDevelop\Library\Common\Item')
        );
        $gc->add('string is wrong type here');
    }
}
