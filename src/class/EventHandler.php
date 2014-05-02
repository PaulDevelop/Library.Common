<?php

namespace Com\PaulDevelop\Library\Common;

/**
 * EventHandler
 *
 * @package  Com\PaulDevelop\Library\Common
 * @category Common
 * @author   Rüdiger Scheumann <code@pauldevelop.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @property INode          $ParentNode
 * @property NodeCollection $Nodes
 */
class EventHandler extends Base
{
    private $object;
    private $method;

    public function __construct($object = null, $method = '')
    {
        $this->object = $object;
        $this->method = $method;
    }

    protected function getObject()
    {
        return $this->object;
    }

    protected function getMethod()
    {
        return $this->method;
    }
}
