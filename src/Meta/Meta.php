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
 * Wrapper around the (get|update|delete)_metadata API.
 *
 * @since   0.1
 * @author  Christopher Davis <http://christopherdavis.me>
 */
class Meta extends MetaBase implements MetaInterface
{
    /**
     * The meta type.
     *
     * @since   0.1
     * @access  protected
     * @var     string
     */
    protected $meta_type = 'post';

    /**
     * Constructor. Set the type and prefix.
     *
     * @since   0.1
     * @access  public
     * @param   string $type user, post, or comment
     * @param   string $prefix
     * @return  void
     */
    public function __construct($meta_type, $prefix)
    {
        $this->meta_type = $meta_type;
        $this->setPrefix($prefix);
    }

    /**
     * {@inheritdoc}
     */
    public function get($obj_id, $key, $default=null)
    {
        $meta = get_metadata(
            $this->meta_type,
            $obj_id,
            $this->buildKey($key),
            true
        );

        return $meta ?: $default;
    }

    /**
     * {@inheritdoc}
     */
    public function save($obj_id, $key, $value, $old_value='')
    {
        return (bool) update_metadata(
            $this->meta_type,
            $obj_id,
            $this->buildKey($key),
            $value,
            $old_value
        );
    }

    /**
     * {@inheritdoc}
     */
    public function delete($obj_id, $key, $old_val='')
    {
        return (bool) delete_metadata(
            $this->meta_type,
            $obj_id,
            $this->buildKey($key),
            $old_val
        );
    }
}
