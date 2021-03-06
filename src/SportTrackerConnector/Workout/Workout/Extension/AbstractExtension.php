<?php

namespace SportTrackerConnector\Workout\Workout\Extension;

/**
 * Abstract extension.
 */
abstract class AbstractExtension implements ExtensionInterface
{

    const ID = 'GenericExtension';

    /**
     * Name fot the extension.
     *
     * @var string
     */
    protected $name;

    /**
     * Value of the extension.
     *
     * @var mixed
     */
    protected $value;

    /**
     * Constructor.
     *
     * @param mixed $value The value for the extension.
     */
    public function __construct($value = null)
    {
        $this->setValue($value);
    }

    /**
     * Set the value for the extension.
     *
     * @param mixed $value The value to set.
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * Get the ID of the extension.
     *
     * @return string
     */
    public function getID()
    {
        return static::ID;
    }

    /**
     * Get the value for the extension.
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Get the name of the extension.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
