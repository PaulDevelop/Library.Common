<?php

namespace Com\PaulDevelop\Library\Common;

/**
 * EventHandlerCollection
 *
 * @package  Com\PaulDevelop\Library\Common
 * @category Common
 * @author   Rüdiger Scheumann <code@pauldevelop.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @property INode          $ParentNode
 * @property NodeCollection $Nodes
 */
class EventHandlerCollection extends GenericCollection
{
    public function __construct()
    {
        parent::__construct('\Com\PaulDevelop\Library\Common\EventHandler');
    }
}
