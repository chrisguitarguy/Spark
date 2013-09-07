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
 * Base class for widgets. Takes care of most of the getter/setter crap
 *
 * @since   0.1
 * @author  Christopher Davis <http://christopherdavis.me>
 */
abstract class WidgetBase implements WidgetInterface
{
    /**
     * The scripts in $key => $args pairs
     *
     * @since   0.1
     * @access  protected
     * @var     array
     */
    protected $scripts = array();

    /**
     * The styles in $key => $args pairs
     *
     * @since   0.1
     * @access  protected
     * @var     array
     */
    protected $styles = array();

    /**
     * The images in $key => $args pairs.
     *
     * @since   0.1
     * @access  protected
     * @var     array
     */
    protected $images = array();

    /**
     * From WidgetInterface
     * {@inheritdoc}
     */
    public function addStyle($name, array $args=array())
    {
        $this->styles[$name] = $args ?: null;
        return $this;
    }

    /**
     * From WidgetInterface
     * {@inheritdoc}
     */
    public function removeStyle($name)
    {
        if (array_key_exists($name, $this->styles)) {
            unset($this->styles[$name]);
            return true;
        }

        return false;
    }

    /**
     * From WidgetInterface
     * {@inheritdoc}
     */
    public function hasStyle($name)
    {
        return array_key_exists($name, $this->styles);
    }

    /**
     * From WidgetInterface
     * {@inheritdoc}
     */
    public function getStyles()
    {
        return $this->styles;
    }

    /**
     * From WidgetInterface
     * {@inheritdoc}
     */
    public function addScript($name, array $args=array())
    {
        $this->scripts[$name] = $args ?: null;
        return $this;
    }

    /**
     * From WidgetInterface
     * {@inheritdoc}
     */
    public function removeScript($name)
    {
        if (array_key_exists($name, $this->scripts)) {
            unset($this->scripts[$name]);
            return true;
        }

        return false;
    }

    /**
     * From WidgetInterface
     * {@inheritdoc}
     */
    public function hasScript($name)
    {
        return array_key_exists($name, $this->scripts);
    }

    /**
     * From WidgetInterface
     * {@inheritdoc}
     */
    public function getScripts()
    {
        return $this->scripts;
    }

    /**
     * From WidgetInterface
     * {@inheritdoc}
     */
    public function addImage($name, array $args=array())
    {
        $this->images[$name] = $args ?: null;
        return $this;
    }

    /**
     * From WidgetInterface
     * {@inheritdoc}
     */
    public function removeImage($name)
    {
        if (array_key_exists($name, $this->images)) {
            unset($this->images[$name]);
            return true;
        }

        return false;
    }

    /**
     * From WidgetInterface
     * {@inheritdoc}
     */
    public function hasImage($name)
    {
        return array_key_exists($name, $this->images);
    }

    /**
     * From WidgetInterface
     * {@inheritdoc}
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Get a "whitelist" of allowed attributes. Used as a helper to render
     * attributes in WidgetInterface::render
     *
     *
     * @since   0.1
     * @access  protected
     * @return  string[]
     */
    protected function getAttributeWhitelist()
    {
        return array(
            'class',
            'id',
            'name',
            'disabled',
            'required',
            'placeholder',
        );
    }

    /**
     * Render the attributes ($attr) based on a whitelist.
     *
     * @since   0.1
     * @access  protected
     * @param   array $attr
     * @return  string
     */
    protected function renderAttributes(array $attr)
    {
        $to_render = array();
        foreach ($this->getAttributeWhitelist() as $key) {
            if (!array_key_exists($key, $attr)) {
                continue;
            }

            $to_render[] = sprintf('%s="%s"', $key, $this->escape($attr[$key] ?: $key));
        }

        return implode(' ', $to_render);
    }

    /**
     * Escape an attribute value. Thin wrapper around esc_attr for now.
     *
     * @since   0.1
     * @access  protected
     * @param   string $value
     * @return  string
     */
    protected function escape($value)
    {
        return esc_attr($value);
    }
}
