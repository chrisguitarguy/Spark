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
 * Type managers provide a nice interface for interacting with the various
 * types we create.
 *
 * @since   0.1
 * @author  Christopher Davis <http://christopherdavis.me>
 */
interface TypeManagerInterface
{
    /**
     * Set the "entity" class to be used for type create.
     *
     * @since   0.1
     * @access  public
     * @param   string $classname A class name
     * @return  $this
     * @chainable
     */
    public function setEntity($classname);

    /**
     * Get the "entity" class to be use for type creation.
     *
     * @since   0.1
     * @access  public
     * @return  string
     */
    public function getEntity();

    /**
     * Create a new type (via a TypeBuilderInterface)
     *
     * @since   0.1
     * @access  public
     * @param   Spark\Type\TypeBuilderInterface
     * @return  $this
     * @chainable
     */
    public function create(TypeBuilderInterface $builder);

    /**
     * See if the given type is in the registry.
     *
     * @since   0.1
     * @access  public
     * @param   string $slug
     * @return  boolean
     */
    public function has($slug);

    /**
     * Get the type from the register if it exists.
     *
     * @since   0.1
     * @access  public
     * @param   string $slug
     * @throws  InvalidArgumentException for a $slug that doesn't exist
     * @return  Spark\Type\TypeInterface
     */
    public function get($slug);

    /**
     * Put a new type in the registery.
     *
     * @since   0.1
     * @access  public
     * @param   Spark\Type\TypeInterface $type
     * @return  $this
     * @chainable
     */
    public function put(TypeInterface $type);

    /**
     * Remove a type from the registery.
     *
     * @since   0.1
     * @access  public
     * @param   string $slug
     * @throws  InvalidArgumentException if the $slug doesn't exist
     * @return  boolean
     */
    public function remove($slug);

    /**
     * Register all the types! Hooked into `init`.
     *
     * @since   0.1
     * @access  public
     * @return  void
     */
    public function register();
}
