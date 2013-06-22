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
 * Make sure sure a value is a float.
 *
 * @since   0.1
 * @author  Christopher Davis <http://christopherdavis.me>
 */
class Float extends Constraint
{
    /**
     * {@inheritdoc}
     */
    protected function getErrorMessage()
    {
        return __('Value must be a float', SPARK_TD);
    }

    /**
     * {@inheritdoc}
     */
    protected function _check($val)
    {
        return filter_var($val, FILTER_VALIDATE_FLOAT, array(
            'flags'     => FILTER_FLAG_ALLOW_THOUSAND
        )) !== false;
    }
}
