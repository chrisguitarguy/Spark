<?php
/**
 * Spark
 *
 * @category    WordPress
 * @package     Spark
 * @copyright   2013 Christopher Davis <http://christopherdavis.me>
 * @license     http://opensource.org/licenses/GPL-2.0 GPL-2.0+
 */

namespace Spark;

/**
 * The central "application" class for the plugin. Serves as a service locator
 * and gets used a ton everywhere else in the plugin.
 *
 * Most of what you see happen here is setting up a bunch of services
 * that get called else where (see `doings_load`).
 *
 * @since   0.1
 * @author  Christopher Davis <http://christopherdavis.me>
 */
class Spark extends \Pimple
{
    const VERSION = '0.1';

    /**
     * A registry of instances of this class.
     *
     * @since   0.1
     * @access  private
     * @var     Spark\Spark[]
     * @static
     */
    private static $registry = array();

    /**
     * Constructor. Set up some services.
     *
     * @since   0.1
     * @access  public
     * @param   array $services
     * @return  void
     */
    public function __construct(array $services=array())
    {
        parent::__construct($services);

        $this['autoloader.class'] = __NAMESPACE__ . '\\Autoloader';
        $this['autoloader'] = $this->share(function ($doings) {
            return new $doings['autoloader.class']();
        });

        $this->registerTypes();
        $this->registerMeta();
    }

    /**
     * Get a already created instance of this class or create on and return it.
     *
     * @since   0.1
     * @access  public
     * @return  Spark\Spark
     * @static
     */
    public static function get($name)
    {
        if (empty(static::$registry[$name])) {
            static::$registry[$name] = new static(array('prefix' => $name));
        }

        return static::$registry[$name];
    }

    /**
     * Register all the appropriate type stuffs.
     *
     * @since   0.1
     * @access  protected
     * @return  void
     */
    protected function registerTypes()
    {
        $doings = $this;

        $this['types.manager.class'] = __NAMESPACE__ . '\\Type\\TypeManager';
        $this['types.manager_factory'] = $this->protect(function ($entity) use ($doings) {
            return new $doings['types.manager.class']($entity);
        });

        $this['types.post'] = $this->share(function ($doings) {
            $m = $doings['types.manager_factory'](__NAMESPACE__ . '\\Type\\PostType');
            add_action('init', array($m, 'register'), 99);
            return $m;
        });

        $this['types.taxonomy'] = $this->share(function ($doings) {
            $m = $doings['types.manager_factory'](__NAMESPACE__ . '\\Type\\Taxonomy');
            add_action('init', array($m, 'register'), 99);
            return $m;
        });
    }

    /**
     * Register all the fun meta stuff.
     *
     * @since   0.1
     * @access  protected
     * @return  void
     */
    protected function registerMeta()
    {
        $spark = $this;

        $this['meta.class'] = 'Spark\\Meta\\Meta';

        $this['meta.factory'] = $this->protect(function ($type) use ($spark) {
            return new $spark['meta.class']($type, $spark['prefix']);
        });

        $this['meta.post'] = $this->share(function ($spark) {
            return $spark['meta.factory']('post');
        });

        $this['meta.user'] = $this->share(function ($spark) {
            return $spark['meta.factory']('user');
        });

        $this['meta.comment'] = $this->share(function ($spark) {
            return $spark['meta.factory']('comment');
        });
    }
}
