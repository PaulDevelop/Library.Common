<?php

namespace Com\PaulDevelop\Library\Common;

class BaseObject extends Base
{
    private $property = 'property value';

    public function getProperty()
    {
        return $this->property;
    }

    public function setProperty($value = null)
    {
        $this->property = $value;
    }
}

class BaseNode extends Base implements INode {
    private $parentNode = null;
    private $nodes = null;

    /**
     * Convert to string.
     *
     * @return string
     */
    public function toString()
    {
        // TODO: Implement toString() method.
    }

    /**
     * Get parent node.
     *
     * @return INode
     */
    public function getParentNode()
    {
        // TODO: Implement getParentNode() method.
    }

    /**
     * Get nodes.
     *
     * @return NodeCollection
     */
    public function getNodes()
    {
        // TODO: Implement getNodes() method.
    }
}

class BaseFoo extends Base {
    private $foo = 'foo';
    private $bar = null;
    private $nodeCollection = null;

    public function __construct() {
        $this->bar = new BaseBar();
        $this->nodeCollection = new NodeCollection();
        $this->nodeCollection->add(new BaseNode(), 'test');
    }

    public function getFoo() {
        return $this->foo;
    }

    public function getBar() {
        return $this->bar;
    }

    public function getNodeCollection() {
        return $this->nodeCollection;
    }
}

class BaseBar extends Base {
    private $bar = 'bar';

    public function getBar() {
        return $this->bar;
    }

    public function getStdClass() {
        // init
        $result = new \stdClass();

        // action
        $result->this_is_bar = '^_^ '.$this->bar.' ^_^';

        // return
        return $result;
    }
}

class BaseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function testGetProperty()
    {
        $baseObj = new BaseObject();
        $this->assertEquals('property value', $baseObj->Property);
    }

    /**
     * @test
     * @expectedException \Com\PaulDevelop\Library\Common\NonExistingPropertyException
     */
    public function testGetNonExistingProperty()
    {
        $baseObj = new BaseObject();
        $baseObj->NonExistingProperty;
    }

    /**
     * @test
     */
    public function testSetProperty()
    {
        $baseObj = new BaseObject();
        $baseObj->Property = 'other property value';
        $this->assertEquals('other property value', $baseObj->Property);
    }

    /**
     * @test
     * @expectedException \Com\PaulDevelop\Library\Common\NonExistingPropertyException
     */
    public function testSetNonExistingProperty()
    {
        $baseObj = new BaseObject();
        $baseObj->NonExistingProperty = 'other property value';
    }

    /**
     * @test
     */
    public function testGetStdClass()
    {
        $baseObj = new BaseObject();
        $assertObj = new \stdClass();
        $assertObj->property = 'property value';
        $this->assertEquals($assertObj, $baseObj->getStdClass());

        $fooObj = new BaseFoo();
        $assertObj = new \stdClass();
        $assertObj->foo = 'foo';
        $assertObj->bar = new \stdClass();
        $assertObj->bar->this_is_bar = '^_^ bar ^_^';
        $assertObj->nodeCollection = new \stdClass();
        $assertObj->nodeCollection->collection = array();
        $assertObj->nodeCollection->collection[0] = new \stdClass();
        $assertObj->nodeCollection->collection[0]->parentNode = null;
        $assertObj->nodeCollection->collection[0]->nodes = null;
        $assertObj->nodeCollection->test = new \stdClass();
        $assertObj->nodeCollection->test->parentNode = null;
        $assertObj->nodeCollection->test->nodes = null;
        $this->assertEquals($assertObj, $fooObj->getStdClass());
    }
}

