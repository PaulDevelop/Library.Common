<?php

namespace Com\PaulDevelop\Library\Common;

/**
 * INode
 *
 * @package  Com\PaulDevelop\Library\Common
 * @category Common
 * @author   Rüdiger Scheumann <code@pauldevelop.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @property INode          $ParentNode
 * @property NodeCollection $Nodes
 */
interface INode
{
    #region member
    #endregion

    #region methods
    /**
     * Convert to string.
     *
     * @return string
     */
    public function toString();
    #endregion

    #region properties
    /**
     * Get parent node.
     *
     * @return INode
     */
    public function getParentNode();

    /**
     * Get nodes.
     *
     * @return NodeCollection
     */
    public function getNodes();
    #endregion
}
