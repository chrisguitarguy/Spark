<?php
/**
 * Spark
 *
 * @category    WordPress
 * @package     Spark
 * @copyright   2013 Christopher Davis <http://christopherdavis.me>
 * @license     http://opensource.org/licenses/GPL-2.0 GPL-2.0+
 */

namespace Spark\DataProvider;

/**
 * Data providers provide a nice interface for fetching data from things like
 * settings or meta. They get used fairly extensively with forms and such and
 * serve as an adapter for Meta items as well.
 *
 * Generally these are not used directly.
 *
 * @since   0.1
 * @author  Christopher Davis <http://christopherdavis.me>
 */
interface DataProviderInterface
{
    /**
     * Get a value from the backend or return default if it doesn't exist.
     *
     * @since   0.1
     * @access  public
     * @param   string $key
     * @param   mixed $default
     * @return  mixed
     */
    public function get($key, $default=null);

    /**
     * Check if a key is in the backend.
     *
     * @since   0.1
     * @access  public
     * @param   string $key
     * @return  boolean
     */
    public function has($key);

    /**
     * Save a single value in the backend.
     *
     * @since   0.1
     * @access  public
     * @param   string $key
     * @param   mixed $data
     * @return  boolean
     */
    public function save($key, $data);

    /**
     * Delete a value from the backend.
     *
     * @since   0.1
     * @access  public
     * @param   string $key
     * @return  boolean
     */
    public function delete($key);
}
