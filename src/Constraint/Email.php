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
 * Check if the value is an email.
 *
 * @since   0.1
 * @author  Christopher Davis <http://christopherdavis.me>
 */
class Email extends Constraint
{
    /**
     * {@inheritdoc}
     */
    protected function getErrorMessage()
    {
        return __('Value is not a valid email', SPARK_TD);
    }

    /**
     * XXX this uses filter var instead of the usual is_email
     * {@inheritdoc}
     */
    protected function _check($value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
    }
}
