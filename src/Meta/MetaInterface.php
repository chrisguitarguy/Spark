<?php
/**
 * Spark
 *
 * @category    WordPress
 * @package     Spark
 * @copyright   2013 Christopher Davis <http://christopherdavis.me>
 * @license     http://opensource.org/licenses/GPL-2.0 GPL-2.0+
 */

namespace Spark\Meta;

/**
 * Meta object provide an abstraction around prefix meta keys with an underscore
 * and a namespace.
 *
 * @since   0.1
 * @author  Christopher Davis <http://christopherdavis.me>
 */
interface MetaInterface
{
    /**
     * Get a value via the get_metadata api
     *
     * @since   0.1
     * @access  public
     * @param   int $obj_id
     * @param   string $key
     * @param   mixed $default
     * @return  mixed
     */
    public function get($obj_id, $key, $default=null);

    /**
     * Save a meta value.
     *
     * @since   0.1
     * @access  public
     * @param   int $obj_id
     * @param   string $key
     * @param   mixed $value
     * @param   mixed $old_value
     * @return  boolean
     */
    public function save($obj_id, $key, $value, $old_value='');

    /**
     * Delete a meta value.
     *
     * @since   0.1
     * @access  public
     * @param   int $obj_id
     * @param   string $key
     * @param   mixed $old_val
     * @return  boolean
     */
    public function delete($obj_id, $key, $old_val='');

    /**
     * Build a meta key based on a prefix.
     *
     * @since   0.1
     * @access  public
     * @param   string $key
     * @return  string
     */
    public function buildKey($key);

    /**
     * Set the prefix.
     *
     * @since   0.1
     * @access  public
     * @param   string $prefix
     * @return  $this
     * @chainable
     */
    public function setPrefix($prefix);

    /**
     * Get the prefix.
     *
     * @since   0.1
     * @access  public
     * @return  string
     */
    public function getPrefix();
}
