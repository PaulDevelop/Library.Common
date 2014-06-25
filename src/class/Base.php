<?php

namespace Com\PaulDevelop\Library\Common;

/**
 * Base
 *
 * @package  Com\PaulDevelop\Library\Common
 * @category Common
 * @author   Rüdiger Scheumann <code@pauldevelop.com>
 * @license  http://opensource.org/licenses/MIT MIT
 */
abstract class Base
{
    /**
     * Magic get property.
     *
     * @param string $propertyName Property name
     *
     * @return mixed
     * @throws NonExistingPropertyException
     */
    public function __get($propertyName = '')
    {
        // init
        $result = null;

        // action
        $methodName = 'get'.ucfirst($propertyName);
        if (method_exists($this, $methodName)) {
            $result = $this->$methodName();
        } else {
            throw new NonExistingPropertyException("Property \"".$propertyName."\" does not exist.");
        }

        // return
        return $result;
    }

    /**
     * Magic set property.
     *
     * @param string $propertyName
     * @param mixed  $propertyValue
     *
     * @throws NonExistingPropertyException
     */
    public function __set($propertyName = '', $propertyValue = null)
    {
        // action
        $methodName = 'set'.ucfirst($propertyName);
        if (method_exists($this, $methodName)) {
            $this->$methodName($propertyValue);
        } else {
            throw new NonExistingPropertyException("Property \"".$propertyName."\" does not exist.");
        }
    }

    /**
     * @return \stdClass
     */
    public function getStdClass() {
        // init
        $result = new \stdClass();

        // return
        return $result;
    }
}
