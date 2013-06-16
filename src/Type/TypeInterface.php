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
 * Interface for "Types" -- eg a post type or a taxonomy.
 *
 * the ArrayAccess portion of this should take care of setting all the generic
 * arguments for the type.
 *
 * @since   0.1
 * @author  Christopher Davis <http://christopherdavis.me>
 */
interface TypeInterface extends \ArrayAccess
{
    /**
     * Set all the args.
     *
     * @since   0.1
     * @access  public
     * @param   array $args
     * @api
     * @return  $this
     * @chainable
     */
    public function setArguments(array $args);

    /**
     * Get all the arguments.
     *
     * @since   0.1
     * @access  public
     * @api
     * @return  array
     */
    public function getArguments();

    /**
     * Set the slug.
     *
     * @since   0.1
     * @access  public
     * @param   string $slug
     * @api
     * @return  $this
     * @chainable
     */
    public function setSlug($slug);

    /**
     * Get the slug.
     *
     * @since   0.1
     * @access  public
     * @api
     * @return  string
     */
    public function getSlug();

    /**
     * Set all the labels.
     *
     * @since   0.1
     * @access  public
     * @param   array $labels
     * @api
     * @return  $this
     * @chainable
     */
    public function setLabels(array $labels);

    /**
     * Get all the labels. If lables happen to be empty, this will request them
     * from generateLabels.
     *
     * @since   0.1
     * @access  public
     * @return  array
     */
    public function getLabels();

    /**
     * Set a single label. This will call generateLabels first before setting
     * a label.
     *
     * @since   0.1
     * @access  public
     * @param   string $name The label "key"
     * @param   string $label
     * @api
     * @return  $this
     * @chainable
     */
    public function setLabel($name, $label);

    /**
     * Get a single label.
     *
     * @since   0.1
     * @access  public
     * @param   string $name
     * @api
     * @return  string|null
     */
    public function getLabel($name);

    /**
     * Generate an appropriate set of labels for the type.
     *
     * @since   0.1
     * @access  public
     * @return  array
     */
    public function generateLabels();

    /**
     * Set the singular name of the type.
     *
     * @since   0.1
     * @access  public
     * @param   string $singular
     * @return  Spark\Type\TypeInterface
     * @chainable
     */
    public function setSingularName($singular);

    /**
     * Get the singular name of the type.
     *
     * @since   0.1
     * @access  public
     * @return  string
     */
    public function getSingularName();

    /**
     * Set the plural name of the type.
     *
     * @since   0.1
     * @access  public
     * @param   string $plural
     * @return  Spark\Type\TypeInterface
     * @chainable
     */
    public function setPluralName($plural);

    /**
     * Get the plural name of the type.
     *
     * @since   0.1
     * @access  public
     * @return  string
     */
    public function getPluralName();

    /**
     * Hooked into `init` to register the types.
     *
     * @since   0.1
     * @access  public
     * @return  void
     */
    public function register();
}
