<?php
/**
 * Spark
 *
 * @category    WordPress
 * @package     Spark
 * @copyright   2013 Christopher Davis <http://christopherdavis.me>
 * @license     http://opensource.org/licenses/GPL-2.0 GPL-2.0+
 */

namespace Spark\Constraint;

/**
 * Base class for other constraints.
 *
 * @since   0.1
 * @author  Christopher Davis <http://christopherdavis.me>
 */
abstract class Constraint implements ConstraintInterface
{
    const ERR = 'errmsg';

    /**
     * Container for the args array pased to the constructor.
     *
     * @since   0.1
     * @access  protected
     * @var     array
     */
    protected $args = array();

    /**
     * Constructor. Sets up the arguments array and make sure that the constraint
     * has the array keys it expects.
     *
     * @since   0.1
     * @access  public
     * @param   array $args
     * @throws  InvalidArgumentException when the required args are not included.
     * @return  void
     */
    public function __construct(array $args=array())
    {
        $args = array_replace($this->getDefaultArguments(), $args);

        foreach ($this->getRequiredArguments() as $key) {
            if (!array_key_exists($key, $args)) {
                throw new \InvalidArgumentException(sprintf('"$args" must have key "%s"', $key));
            }
        }

        $this->args = $args;
    }

    /**
     * {@inheritdoc}
     */
    public function check($value)
    {
        if (!$this->_check($value)) {
            throw new ConstraintViolation($this->buildErrorMessage(), 1);
        }

        return true;
    }

    /** Magic Setters Getters ********/

    public function __set($key, $val)
    {
        $this->args[$key] = $val;
    }

    public function __get($key)
    {
        if (!array_key_exists($key, $this->args)) {
            $this->keyError($key);
            return null;
        }

        return $this->args[$key];
    }

    public function __isset($key)
    {
        return array_key_exists($key, $this->args);
    }

    public function __unset($key)
    {
        if (!array_key_exists($key, $this->args)) {
            $this->keyError($key, 'unset');
        }

        unset($this->args[$key]);
    }

    /**
     * Get the default arguments for the constraint.
     *
     * @since   0.1
     * @access  protected
     * @return  array
     */
    protected function getDefaultArguments()
    {
        return array(
            static::ERR => $this->getErrorMessage(),
        );
    }

    /**
     * Replace {some_key} values in the error message with the context returned
     * required from getErrorContext.  Done so we don't have to deal with sprintf
     * warnings and such. Also, obviously, makes it more difficult for translators.
     * An unfortunate side effect.
     *
     * @since   0.1
     * @access  protected
     * @return  string
     */
    protected function buildErrorMessage()
    {
        $ctx = $this->getErrorContext();
        $errmsg = isset($this->args[static::ERR]) ? $this->args[static::ERR] : 'Constraint Violation';

        if (!$ctx || false === strpos($errmsg, '{')) {
            return $errmsg;
        }

        $replacements = array();
        foreach ($ctx as $k => $v) {
            $replacements['{' . $k . '}'] = $v;
        }

        return strtr($errmsg, $replacements);
    }

    /**
     * Get the error context. Eg. values that should be replaced in error
     * messages in key => value pairs.
     *
     * @since   0.1
     * @access  protected
     * @return  array
     */
    protected function getErrorContext()
    {
        return array();
    }

    /**
     * Get the additional arguments required for this constraint.
     *
     * @since   0.1
     * @access  protected
     * @return  array
     */
    protected function getRequiredArguments()
    {
        return array();
    }

    /**
     * Get the default error message, which gets used in ConstraintViolations
     * and such.
     *
     * @since   0.1
     * @access  protected
     * @return  string
     */
    abstract protected function getErrorMessage();

    /**
     * Actually check the value.
     *
     * @since   0.1
     * @access  protected
     * @param   mixed $value
     * @return  boolean
     */
    abstract protected function _check($value);

    /**
     * Trigger an error for magic set/get etc.
     *
     * @since   0.1
     * @access  private
     * @return  void
     */
    private function keyError($key, $ctx='get')
    {
        trigger_error(sprintf(
            'Undefined property "%s" via __%s',
            $key, $ctx
        ), E_USER_WARNING);
    }
}
