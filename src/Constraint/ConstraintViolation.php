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
 * Throw when a constraint fails to validate.
 *
 * @since   0.1
 * @author  Christopher Davis <http://christopherdavis.me>
 */
class ConstraintViolation extends \InvalidArgumentException
{
    // noop
}
