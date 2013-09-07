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
 * A generic, almost PRS-0 compliant autoloader.
 *
 * @since   0.1
 * @author  Christopher Davis <http://christopherdavis.me>
 */
class Autoloader
{
    /**
     * Registery of $namespace => $directory pairs
     *
     * @since   0.1
     * @access  protected
     * @var     array
     */
    protected $registry = array();

    /**
     * An array of namespaces get striped of their "Prefix" -- eg the namespace
     * itself.
     *
     * @since   0.1
     * @access  protected
     * @var     array
     */
    protected $stripped = array();

    /**
     * Register the autoloader.
     *
     * @since   0.1
     * @access  public
     * @return  void
     */
    public function register()
    {
        spl_autoload_register($this);
    }

    /**
     * Unregister the autoloader.
     *
     * @since   0.1
     * @access  public
     * @return  void
     */
    public function unregister()
    {
        spl_autoload_unregister($this);
    }

    /**
     * The actual autoload callback.
     *
     * @since   0.1
     * @access  public
     * @param   string $cls The fully qualified class name
     * @return  boolean
     */
    public function __invoke($cls)
    {
        $cls = $this->strip($cls);

        $possibilities = $this->getPossiblities($cls);

        if (!$possibilities) {
            return false;
        }

        foreach ($possibilities as $namespace => $dir) {
            $_cls = $cls;
            if ($this->hasStripped($namespace)) {
                $_cls = $this->strip(
                    substr_replace($_cls, '', 0, strlen($namespace))
                );
            }

            $path = $this->pathJoin($dir, $this->replace($_cls) . '.php');

            if (file_exists($path)) {
                require_once $path;
                return true;
            }
        }

        return false;
    }

    /**
     * Register a new namespace with the autoloader.
     *
     * @since   0.1
     * @access  public
     * @param   string $namespace The namespace to register
     * @param   string $directory The directory in which to look for classes of
     *          namespace
     * @param   boolean $strip_prefix if true (the default), strip $namespace from
     *          the front of the classname. See the examples above
     * @api
     * @return  Spark\Autoloader
     * @chainable
     */
    public function addNamespace($namespace, $directory, $strip_prefix=true)
    {
        $namespace = $this->strip($namespace);

        $this->registry[$namespace] = $directory;

        if ($strip_prefix) {
            $this->stripped[$namespace] = true;
        }

        return $this;
    }

    /**
     * Remove a namespace from the autoloader.
     *
     * @since   0.1
     * @access  public
     * @param   string $namespace
     * @api
     * @return  boolean
     */
    public function removeNamespace($namespace)
    {
        $namespace = $this->strip($namespace);

        if ($this->hasNamespace($namespace)) {
            unset($this->register[$namespace]);

            if ($this->hasStripped($namespace)) {
                unset($this->stripped[$namespace]);
            }

            return true;
        }

        return false;
    }

    /**
     * Check if a namespace is in the register.
     *
     * @since   0.1
     * @access  public
     * @param   string $namespace
     * @api
     * @return  boolean
     */
    public function hasNamespace($namespace)
    {
        return array_key_exists($this->strip($namespace), $this->register);
    }

    /**
     * Is namespace set to be stripped?
     *
     * @since   0.1
     * @access  public
     * @param   string $namespace
     * @api
     * @return  boolean
     */
    public function hasStripped($namespace)
    {
        return !empty($this->stripped[$this->strip($namespace)]);
    }

    /**
     * Given a fully resolved class name, return an array of $namespace => $directory
     * pairs that might match up.
     *
     * @since   0.1
     * @access  private
     * @param   string $cls A fully qualified class name
     * @return  array
     */
    protected function getPossiblities($cls)
    {
        $out = array();

        foreach ($this->registry as $namespace => $dir) {
            if (strpos($cls, $namespace) !== 0) {
                continue; // $cls doesn't start with $namespace
            }

            $out[$namespace] = $dir;
        }

        return $out;
    }

    /**
     * Strip leading backslashes off of class names and such.
     *
     * @since   0.1
     * @access  protected
     * @param   string $to_strip
     * @return  string
     */
    protected function strip($to_strip)
    {
        return ltrim($to_strip, '\\');
    }

    /**
     * Replace underscores and backslashes with DIRECTORY_SEPARATOR
     *
     * @since   0.1
     * @access  protected
     * @param   string $cls
     * @return  string
     */
    protected function replace($cls)
    {
        return str_replace(array('_', '\\'), DIRECTORY_SEPARATOR, $cls);
    }

    /**
     * Join paths with DIRECTORY_SEPARATOR
     *
     * @since   0.1
     * @access  protected
     * @param   string[] $args
     * @return  string
     */
    protected function pathJoin()
    {
        $parts = array_map(function ($part) {
            return rtrim($part, DIRECTORY_SEPARATOR);
        }, func_get_args());

        return implode(DIRECTORY_SEPARATOR, $parts);
    }
}
