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
 * Default implementation of TypeManagerInterface
 *
 * @since   0.1
 * @author  Christopher Davis <http://christopherdavis.me>
 */
class TypeManager
{
    /**
     * The entity class
     *
     * @since   0.1
     * @access  protected
     * @var     string
     */
    protected $entity;

    /**
     * Registry of all the types this manager is aware of.
     *
     * @since   0.1
     * @access  public
     * @var     array
     */
    protected $registry = array();

    /**
     * Constructor. Set the entity classname.
     *
     * @since   0.1
     * @access  public
     * @param   string $entity
     * @return  void
     */
    public function __construct($entity)
    {
        $this->setEntity($entity);
    }

    /**
     * {@inheritdoc}
     */
    public function setEntity($classname)
    {
        $this->entity = $classname;
        return $this;
    }


    /**
     * {@inheritdoc}
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * {@inheritdoc}
     */
    public function create(TypeBuilderInterface $builder)
    {
        $cls = $this->getEntity();

        $type = new $cls();

        $builder->build($type);

        $this->put($type);
    }

    /**
     * {@inheritdoc}
     */
    public function has($slug)
    {
        return array_key_exists($slug, $this->registry);
    }

    /**
     * {@inheritdoc}
     */
    public function get($slug)
    {
        if (!$this->has($slug)) {
            throw new \InvalidArgumentException(sprintf('"%s" does not exist', $slug));
        }

        return $this->registry[$slug];
    }

    /**
     * {@inheritdoc}
     */
    public function put(TypeInterface $type)
    {
        $this->registry[$type->getSlug()] = $type;
    }

    /**
     * {@inheritdoc}
     */
    public function remove($slug)
    {
        if (!$this->has($slug)) {
            throw new \InvalidArgumentException(sprintf('"%s" does not exist', $slug));
        }

        unset($this->registry[$slug]);

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function register()
    {
        foreach ($this->registry as $type) {
            $type->register();
        }
    }
}
