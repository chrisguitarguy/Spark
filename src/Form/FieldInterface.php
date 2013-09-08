<?php
/**
 * Spark
 *
 * @category    WordPress
 * @package     Spark
 * @copyright   2013 Christopher Davis <http://christopherdavis.me>
 * @license     http://opensource.org/licenses/GPL-2.0 GPL-2.0+
 */

namespace Spark\Form\Field;

use Spark\Form\Widget\WidgetInterface;

/**
 * Common interface for all fields.
 *
 * @since   0.1
 * @author  Christopher Davis <http://christopherdavis.me>
 */
interface FieldInterface extends \ArrayAccess
{
    public function setWidget(WidgetInterface $widget);

    public function getWidget(WidgetInterface $widget);

    public function validate();

    public function getName();

    public function getData();
}
