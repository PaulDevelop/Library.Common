<?php

namespace Com\PaulDevelop\Library\Common;

/**
 * GenericCollection class.
 *
 * @package  Com\PaulDevelop\Library\Common
 * @category Common
 * @author   Rüdiger Scheumann <code@pauldevelop.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @property int $Count
 */
abstract class GenericCollection extends Base implements \IteratorAggregate, \arrayaccess, \Countable
{
    #region member
    /**
     * Collection.
     *
     * @var array
     */
    protected $collection;

    /**
     * Type.
     *
     * @var string
     */
    private $type;

    /**
     * Is class?
     *
     * @var boolean
     */
    private $isClass;
    #endregion

    #region constructor
    /**
     * Constructor.
     *
     * @param string $type
     * @param array  $initialValues
     *
     * @throws \Exception
     */
    public function __construct($type = 'unknown type', $initialValues = array(), $keyFieldName = '')
    {
        $this->collection = array();
        $this->type = $type;

        if ($type == 'resource'
            || $type == 'NULL'
            || $type == 'unknown type'
        ) {
            throw new \Exception('Types "resource", "NULL", and "unknown type" are not supported.');
        }

        $this->isClass = ($type != 'boolean'
            && $type != 'integer'
            && $type != 'double'
            && $type != 'float'
            && $type != 'string'
            && $type != 'array') ? true : false;
        //$this->isClass = is_object($)

        if (sizeof($initialValues) > 0) {
            foreach ($initialValues as $initialValue) {
                //$this->add($initialValue, $keyFieldName);
                $key = $this->tryToFindKey($initialValue, $keyFieldName);
                $this->add($initialValue, $key);
            }
        }
    }
    #endregion

    #region methods
    private function tryToFindKey($value = null, $keyFieldName = '')
    {
        // init
        $result = '';

        // action
        if ($keyFieldName != '') {
            if (is_array($value) && array_key_exists($keyFieldName, $value)) {
                $result = $value[$keyFieldName];
            } else {
                //if (is_object($value) && isset($value->{$keyFieldName})) {
                //    $result = $value->{$keyFieldName};
                //}
                if (is_object($value)) {
                    try {
                        $result = $value->{$keyFieldName};
                    } catch (NonExistingPropertyException $nepe) {

                    }
                }
            }
        }

        // return
        return $result;
    }

    /**
     * Add value to collection.
     *
     * @param mixed  $value
     * @param string $key
     *
     * @throws TypeCheckException
     * @throws ArgumentException
     */
    public
    function add(
        $value = null,
        $key = ''
    ) {
        //var_dump($this->type);
        //var_dump($value);
        //var_dump(is_object($value));
        //die;

        if ($this->isClass) {
            //echo "  isClass".PHP_EOL;
            if (!is_a($value, $this->type)) {
                //throw new TypeCheckException('Object type "'.get_class($value).'" is not of type "'.$this->type.'".');
                $type = is_object($value) ? get_class($value) : gettype($value);
                throw new TypeCheckException('Object type "'.$type.'" is not of type "'.$this->type.'".');
            } else {
                // add to collection
                if ($key != '') {
                    if (array_key_exists($key, $this->collection)) {
                        throw new ArgumentException(
                            'Can not add object to key "'.$key.'", because key already exists.'
                        );
                    } else {
                        $this->collection[$key] = $value;
                    }
                } else {
                    array_push($this->collection, $value);
                }
            }
        } else {
            //echo "  noClass".PHP_EOL;
            if ($this->type == gettype($value)) {
                // add to collection
                if ($key != '') {
                    if (array_key_exists($key, $this->collection)) {
                        throw new ArgumentException('Can not add value to key "'.$key.'", because key already exists.');
                    } else {
                        $this->collection[$key] = $value;
                    }
                } else {
                    array_push($this->collection, $value);
                }
            } else {
                throw new TypeCheckException('Value type "'.gettype($value).'" is not of type "'.$this->type.'".');
            }
        }
    }

//    public function InsertAt(
//        $position = 0,
//        $value = null
//    ) {
//        if ($this->isClass) {
//            if (!is_a($value, $this->type)) {
//                throw new \Exception('Object type "'.get_class($value).'" is not of type "'.$this->type.'".');
//            } else {
//                // add to collection
//                array_splice($this->collection, $position, 0, $value);
//            }
//        } else {
//            if ($this->type == gettype($value)) {
//                // add to collection
//                array_splice($this->collection, $position, 0, $value);
//            } else {
//                throw new \Exception('Value type "'.gettype($value).'" is not of type "'.$this->type.'".');
//            }
//        }
//    }

    public
    function clear()
    {
        $this->collection = array();
    }

    public
    function getIterator()
    {
        return new \ArrayIterator($this->collection);
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public
    function offsetSet(
        $offset = null,
        $value = null
    ) {
        $this->collection[$offset] = $value;
    }

    /**
     * @param mixed $offset
     *
     * @return bool
     */
    public
    function offsetExists(
        $offset = null
    ) {
        return isset($this->collection[$offset]);
    }

    /**
     * @param mixed $offset
     */
    public
    function offsetUnset(
        $offset = null
    ) {
        unset($this->collection[$offset]);
    }

    /**
     * @param mixed $offset
     *
     * @return mixed|null
     */
    public
    function offsetGet(
        $offset = null
    ) {
        return isset($this->collection[$offset]) ? $this->collection[$offset] : null;
    }

    public
    function count()
    {
        return count($this->collection);
    }

    public
    function getStdClass()
    {
        // init
        $result = new \stdClass();

        // action
        $result->collection = array();
        foreach ($this->collection as $key => $item) {
            if (is_a($item, '\Com\PaulDevelop\Library\Common\Base')) {
                /** @var Base $item */
                array_push($result->collection, $item->getStdClass());
                $result->$key = $item->getStdClass();
            }
        }

        // return
        return $result;
    }

#endregion

#region properties
    /**
     * @return int
     */
    public
    function getCount()
    {
        return count($this->collection);
    }
#endregion
}
