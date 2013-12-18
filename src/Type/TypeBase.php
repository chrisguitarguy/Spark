<?php
/**
 * Spark
 *
 * @category    WordPress
 * @package     Spark
 * @copyright   2013 Christopher Davis <http://christopherdavis.me>
 * @license     http://opensource.org/licenses/GPL-2.0 GPL-2.0+
 */

namespace Spark\Type;

/**
 * Base class for the objects that encapsulate the functionality of "building"
 * types.
 *
 * @since   0.1
 * @author  Christopher Davis <http://christopherdavis.me>
 */
abstract class TypeBase implements TypeInterface
{
    /**
     * Container for all "args" that don't relate to lables.
     *
     * @since   0.1
     * @access  protected
     * @var     array
     */
    protected $args = array();

    /**
     * The "slug" -- a unique string identifier for the type.
     *
     * @since   0.1
     * @access  protected
     * @var     string
     */
    protected $slug = null;

    /**
     * The singular name.
     *
     * @since   0.1
     * @access  protected
     * @var     string
     */
    protected $singular_name = null;

    /**
     * The plural name.
     *
     * @since   0.1
     * @access  protected
     * @var     string
     */
    protected $plural_name = null;

    /**
     * Container for labels.
     *
     * @since   0.1
     * @access  protected
     * @var     array
     */
    protected $labels = array();

    /**
     * {@inheritdoc}
     */
    public function setArguments(array $args)
    {
        $this->args = $args;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getArguments()
    {
        return $this->args;
    }

    /**
     * {@inheritdoc}
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * {@inheritdoc}
     */
    public function setLabels(array $labels)
    {
        $this->labels = $labels;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getLabels()
    {
        if (empty($this->labels)) {
            $this->labels = $this->generateLabels();
        }

        return $this->labels;
    }

    /**
     * {@inheritdoc}
     */
    public function setLabel($name, $label)
    {
        if (empty($this->labels)) {
            $this->labels = $this->generateLabels();
        }

        $this->labels[$name] = $label;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getLabel($name)
    {
        if (empty($this->labels)) {
            $this->labels = $this->generateLabels();
        }

        return array_key_exists($name, $this->labels) ? $this->labels[$name] : null;
    }

    /**
     * {@inheritdoc}
     */
    public function setSingularName($singular)
    {
        $this->singular_name = $singular;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getSingularName()
    {
        return $this->singular_name;
    }

    /**
     * {@inheritdoc}
     */
    public function setPluralName($plural)
    {
        $this->plural_name = $plural;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getPluralName()
    {
        return $this->plural_name;
    }

    /** ArrayAccess *********/

    public function offsetSet($name, $val)
    {
        $this->args[$name] = $val;
    }

    public function offsetGet($name)
    {
        if (!$this->offsetExists($name)) {
            return $this->error($name);
        }

        return $this->args[$name];
    }

    public function offsetExists($name)
    {
        return array_key_exists($name, $this->args);
    }

    public function offsetUnset($name)
    {
        if (!$this->offsetExists($name)) {
            return $this->error($name);
        }

        unset($this->args[$name]);
    }

    private function error($name)
    {
        trigger_error(sprintf('"%s" does not exist', $name), E_USER_WARNING);
    }
}
