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
 * Check if a value is between is between `min` and `max`
 *
 * Expects to get `min` and `max` passed into the constructor $args array. `min`
 * is required, `max` is optional. If neither min or max are provide the constraint
 * will always be successful with numeric values.
 *
 * @since   0.1
 * @author  Christopher Davis <http://christopherdavis.me>
 */
class Range extends Constraint
{
    /**
     * {@inheritdoc}
     */
    protected function getErrorMessage()
    {
        if ($this->args['max']) {
            return __('Value must a number between {min} and {max}', SPARK_TD);
        }

        return __('Value must be a number greater than or equal to {min}', SPARK_TD);
    }

    /**
     * {@inheritdoc}
     */
    protected function _check($val)
    {
        if (!is_numeric($val)) {
            return false;
        }

        if (null !== $this->args['max'] && $val > $this->args['max']) {
            return false;
        }

        if (null !== $this->args['min'] && $val < $this->args['min']) {
            return false;
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    protected function getDefaultArguments()
    {
        $args = parent::getDefaultArguments();
        $args['min'] = null;
        $args['max'] = null;

        return $args;
    }

    /**
     * {@inheritdoc}
     */
    protected function getErrorContext()
    {
        return array(
            'min'   => $this->args['min'],
            'max'   => $this->args['max'],
        );
    }
}
