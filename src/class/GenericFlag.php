<?php

namespace Com\PaulDevelop\Library\Common;

abstract class GenericFlag
{
    #region member
    /**
     * @var int
     */
    protected $flags;
    /**
     * @var string
     */
    private $type;
    #endregion

    #region constructor
    public function __construct($type = 'unknown type')
    {
        $this->flags = null;

        if (!class_exists($type)) {
            throw new TypeCheckException('Type is not a class.');
        }
        $this->type = $type;
    }
    #endregion

    #region methods
    public function addFlag($flag)
    {
        // check, if flag value is valid
        $class = new \ReflectionClass($this->type);
        $constants = $class->getConstants();
        $foundValue = false;
        foreach ($constants as $value) {
            if ($value == $flag) {
                $foundValue = true;
            }
        }

        if (!$foundValue) {
            throw new \Exception('Flag not valid.');
        }

        $this->flags |= $flag;
    }

    public function removeFlag($flag)
    {
        $this->flags &= ~$flag;
    }

    public function check($flag)
    {
        if ($this->flags & $flag) {
            return true;
        } else {
            return false;
        }
    }
    #endregion
}
