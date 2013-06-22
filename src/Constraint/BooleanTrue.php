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
 * This uses `filter_var($value, FILTER_VALIDATE_BOOLEAN)` so the behavior
 * is the same. Some exampel "true" values:
 *  - "true"
 *  - true
 *  - "1"
 *  - 1
 *  - "on"
 *
 * @since   0.1
 * @author  Christopher Davis <http://christopherdavis.me>
 */
class BooleanTrue extends Constraint
{
    /**
     * {@inheritdoc}
     */
    protected function getErrorMessage()
    {
        return __('Value must true', SPARK_TD);
    }

    /**
     * {@inheritdoc}
     */
    protected function _check($value)
    {
        return filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }
}
