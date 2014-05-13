<?php

namespace Com\PaulDevelop\Library\Common;

class BaseObject extends Base
{
    private $_value = 'property value';

    public function getProperty()
    {
        return $this->_value;
    }

    public function setProperty($value = null)
    {
        $this->_value = $value;
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


}

