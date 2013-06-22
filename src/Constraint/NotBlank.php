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
 * See if a value is not blank: `!empty($value)`
 *
 * @since   0.1
 * @author  Christopher Davis <http://christopherdavis.me>
 */
class NotBlank extends Constraint
{
    /**
     * {@inheritdoc}
     */
    protected function getErrorMessage()
    {
        return __('Value must not be empty', SPARK_TD);
    }

    /**
     * {@inheritdoc}
     */
    protected function _check($value)
    {
        return !empty($value);
    }
}
