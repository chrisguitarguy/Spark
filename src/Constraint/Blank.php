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
 * See if a value is blank: `empty($value)`
 *
 * Possibly "blank" values:
 *  - null
 *  - false
 *  - 0
 *  - '0'
 *  - ''
 *  - array()
 *
 * @since   0.1
 * @author  Christopher Davis <http://christopherdavis.me>
 */
class Blank extends Constraint
{
    /**
     * {@inheritdoc}
     */
    protected function getErrorMessage()
    {
        return __('Value must be empty', SPARK_TD);
    }

    /**
     * {@inheritdoc}
     */
    protected function _check($value)
    {
        return empty($value);
    }
}
