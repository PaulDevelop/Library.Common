<?php

namespace Com\PaulDevelop\Library\Common;

/**
 * ITemplate
 *
 * @package  Com\PaulDevelop\Library\Common
 * @category Common
 * @author   Rüdiger Scheumann <code@pauldevelop.com>
 * @license  http://opensource.org/licenses/MIT MIT
 *
 * @property string $TemplateFileName
 */
interface ITemplate
{
    /**
     * @return string
     */
    public function process();

    public function setTemplateFileName($templateFileName = '');

    public function bindVariable($variableName = '', $content = null, $force = false);

    public function readVariable($variableName = '');

    public function registerCallback($name = '', $object = null, $function = '');
}
