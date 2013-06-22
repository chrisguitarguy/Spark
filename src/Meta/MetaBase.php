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
 * Meta base class that provides (set|get)Prefix and buildKey
 *
 * @since   0.1
 * @author  Christopher Davis <http://christopherdavis.me>
 */
abstract class MetaBase
{
    /**
     * Container for the prefix.
     *
     * @since   0.1
     * @access  protected
     * @var     string
     */
    protected $prefix;

    /**
     * See MetaInterface
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
        return $this;
    }

    /**
     * See MetaInterface
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * see MetaInterface
     */
    public function buildKey($key)
    {
        return sprintf('_%s_%s', $this->getPrefix(), $key);
    }
}
