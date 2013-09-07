<?php
/**
 * Spark
 *
 * @category    WordPress
 * @package     Spark
 * @copyright   2013 Christopher Davis <http://christopherdavis.me>
 * @license     http://opensource.org/licenses/GPL-2.0 GPL-2.0+
 */

namespace Spark\Form\Widget;

/**
 * <input type="week" ... />
 *
 * @since   0.1
 * @author  Christopher Davis <chris@pmg.co>
 */
class WeekWidget extends InputWidget
{
    /**
     * {@inheritdoc}
     */
    protected function getType()
    {
        return 'week';
    }
}
