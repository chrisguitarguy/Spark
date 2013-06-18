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
 * Constraints take care of check to see if a value is valid.
 *
 * @since   0.1
 * @author  Christopher Davis <http://christopherdavis.me>
 */
interface ConstraintInterface
{
    /**
     * Check $value to see if it's valid.
     *
     * @since   0.1
     * @access  public
     * @param   mixed $value
     * @throws  Spark\Constraint\ConstraintViolation on failure
     * @return  true
     */
    public function check($value);
}
