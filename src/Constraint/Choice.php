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
 * Check if $value is in the the array of choices.
 *
 * Expects `choices` in the agument array passed to the constructor.
 *
 * @since   0.1
 * @author  Christopher Davis <http://christopherdavis.me>
 */
class Choice extends Constraint
{
    /**
     * {@inheritdoc}
     */
    protected function getErrorMessage()
    {
        return __('Value is not a valid choice', SPARK_TD);
    }

    /**
     * {@inheritdoc}
     */
    protected function _check($value)
    {
        if ($this->args['multiple']) {
            foreach ($value as $val) {
                if (!$this->inArray($val)) {
                    return false;
                }
            }

            return true;
        }

        if (!$this->inArray($value)) {
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
        $args['choices'] = null;
        $args['strict'] = false;
        $args['multiple'] = false;

        return $args;
    }

    private function inArray($val)
    {
        if (
            null !== $this->args['choices'] &&
            !in_array($val, $this->args['choices'], $this->args['strict'])
        ) {
            return false;
        }

        return true;
    }
}
