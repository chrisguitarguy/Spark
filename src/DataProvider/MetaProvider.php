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

use Spark\Meta\MetaInterface;

/**
 * Use an instance of MetaInterface as a data provider.
 *
 * @since   0.1
 * @author Christopher Davis <http://christopherdavis.me>
 */
class MetaProvider implements DataProviderInterface
{
    /**
     * The MetaInterface backend.
     *
     * @since   0.1
     * @access  protected
     * @var     Spark\Meta\MetaInterface
     */
    protected $meta;

    /**
     * The current object ID.
     *
     * @since   0.1
     * @access  public
     * @var     int
     */
    protected $obj_id;

    /**
     * Constructor. Set up the meta and object ID.
     *
     * @since   0.1
     * @access  public
     * @param   Spark\Meta\MetaInterface $meta
     * @param   int $obj_id
     * @return  void
     */
    public function __construct(MetaInterface $meta, $obj_id)
    {
        $this->meta = $meta;
        $this->obj_id = $obj_id;
    }

    /**
     * {@inheritdoc}
     */
    public function get($key, $default=null)
    {
        return $this->meta->get($this->obj_id, $key, $default);
    }

    /**
     * This is kind of janky in this case...
     * {@inheritdoc}
     */
    public function has($key)
    {
        return (bool) $this->get($key);
    }

    /**
     * {@inheritdoc}
     */
    public function save($key, $data)
    {
        return $this->meta->save($this->obj_id, $key, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function delete($key)
    {
        return $this->meta->delete($this->obj_id, $key);
    }
}
