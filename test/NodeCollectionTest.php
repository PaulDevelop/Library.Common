<?php

namespace Com\PaulDevelop\Library\Common;

class Tag extends Base implements INode
{
    #region member
    private $name;
    private $parentNode;
    private $nodes;
    #endregion

    #region constructor
    public function __construct(
        $name = '',
        $parentNode = null,
        $nodes = null
    ) {
        $this->name = $name;
        $this->parentNode = $parentNode;
        $this->nodes = ($nodes == null) ? new NodeCollection() : $nodes;
    }
    #endregion

    #region INode methods
    /**
     * Get parent node.
     *
     * @return INode
     */
    public function getParentNode()
    {
        return $this->parentNode;
    }

    /**
     * Get nodes.
     *
     * @return NodeCollection
     */
    public function getNodes()
    {
        return $this->nodes;
    }

    /**
     * Convert to string.
     *
     * @return string
     */
    public function toString()
    {
        return '';
    }
    #endregion
}

class NodeCollectionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function testAddItemToCollection()
    {
        $nc = new NodeCollection();

        $this->assertEquals(0, sizeof($nc));
        $nc->add(new Tag());
        $this->assertEquals(1, sizeof($nc));
    }

    /**
     * @test
     */
    public function testIfCollectionIsEmptyByDefault()
    {
        $nc = new NodeCollection();
        $this->assertEquals(0, count($nc));
    }

    /**
     * @test
     * @expectedException \Com\PaulDevelop\Library\Common\TypeCheckException
     */
    public function testIfAddingItemOfWrongTypeThrowsException()
    {
        $nc = new NodeCollection();
        $nc->add('string is wrong type here');
    }
}
