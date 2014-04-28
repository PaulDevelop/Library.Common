<?php

namespace Com\PaulDevelop\Library\Common;

    //require_once 'INode.interface.php';

/**
 * NodeCollection
 *
 * @package  Com\PaulDevelop\Library\Common
 * @category Common
 * @author   Rüdiger Scheumann <code@pauldevelop.com>
 * @license  http://opensource.org/licenses/MIT MIT
 */
class NodeCollection extends GenericCollection
{
    public function __construct()
    {
        parent::__construct('Com\PaulDevelop\Library\Common\INode');
    }

//    /**
//     * @param string $offset
//     *
//     * @return INode
//     */
//    public function offsetGet($offset = null)
//    {
//        return parent::offsetGet($offset);
//        //$result = nulll;
//        //$result = isset($this->collection[$offset]) ? $this->collection[$offset] : null;
//        //if ( $result != null ) {
//        //    $result = $this->casttoclass('Com\PaulDevelop\Library\Common\INode', $result);
//        //}
//    }

//    /**
//     * Cast an object to another class, keeping the properties, but changing the methods
//     *
//     * @param string $class  Class name
//     * @param object $object
//     * @return object
//     */
//    function casttoclass($class, $object)
//    {
//        return unserialize(
//            preg_replace('/^O:\d+:"[^"]++"/', 'O:' . strlen($class) . ':"' . $class . '"', serialize($object))
//        );
//    }

//    /**
//     * @param mixed $offset
//     *
//     * @return INode
//     */
//    public function offsetGet($offset = null)
//    {
//        return isset($this->collection[$offset]) ? $this->collection[$offset] : null;
//    }
}
