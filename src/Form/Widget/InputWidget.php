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
 * Widget for rendering the various `<input ... />` form fields.
 *
 * @since   0.1
 * @author  Christopher Davis <http://christopherdavis.me>
 */
class InputWidget extends WidgetBase
{
    /**
     * From WidgetInterface
     * {@inheritdoc}
     */
    public function render(array $attr)
    {
        return '<input ' . $this->renderAttributes($attr) . ' />';
    }

    /**
     * {@inheritdoc}
     */
    protected function getAttributeWhitelist()
    {
        return array_merge(parent::getAttributeWhitelist(), array(
            'type',
            'value',
        ));
    }

    /**
     * Get the "type" attribute value for our field.
     *
     * @since   0.1
     * @access  protected
     * @return  string
     */
    protected function getType()
    {
        return 'text';
    }
}
