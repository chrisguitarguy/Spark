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
 * See if a value is is equivalent to boolean true.
 *
 * See the BooleanTrue documenation for some examples of valid "true" values.
 * Anything else will be false, which is a very wide net.
 *
 * @since   0.1
 * @author  Christopher Davis <http://christopherdavis.me>
 */
class BooleanFalse extends Constraint
{
    /**
     * {@inheritdoc}
     */
    protected function getErrorMessage()
    {
        return __('Value must false', SPARK_TD);
    }

    /**
     * {@inheritdoc}
     */
    protected function _check($value)
    {
        return !filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }
}
