<?php

namespace Com\PaulDevelop\Library\Common;

/**
 * ITemplate
 *
 * @package  Com\PaulDevelop\Library\Common
 * @category Common
 * @author   Rüdiger Scheumann <code@pauldevelop.com>
 * @license  http://opensource.org/licenses/MIT MIT
 */
interface ITemplate
{
    /**
     * @return string
     */
    public function process();

    public function setTemplateFileName($templateFileName = '');
}
