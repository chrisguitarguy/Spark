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
 * Data provider with the settings API as a backend. Assumes that the $setting
 * passed into the constructor is saved as a array in the DB.
 *
 * @since   0.1
 * @author  Christopher Davis <http://christopherdavis.me>
 */
class SettingProvider implements DataProviderInterface
{
    /**
     * The setting name.
     *
     * @since   0.1
     * @access  protected
     * @var     string
     */
    protected $setting = null;

    /**
     * Constructor. Set the settings name.
     *
     * @since   0.1
     * @access  public
     * @param   string $setting
     * @return  void
     */
    public function __construct($setting)
    {
        $this->setting = $setting;
    }

    /**
     * {@inheritdoc}
     */
    public function get($key, $default=null)
    {
        $opts = $this->getOption();
        return array_key_exists($key, $opts) ? $opts[$key] : $default;
    }

    /**
     * {@inheritdoc}
     */
    public function has($key)
    {
        $opts = $this->getOption();
        return array_key_exists($key, $opts);
    }

    /**
     * {@inheritdoc}
     */
    public function save($key, $data)
    {
        $opts = $this->getOption();
        $opts[$key] = $data;
        return update_option($this->setting, $opts);
    }

    /**
     * {@inheritdoc}
     */
    public function delete($key)
    {
        $opts = $this->getOption();
        if (array_key_exists($key, $opts)) {
            unset($opts[$key]);
            return update_option($this->setting, $opts);
        }

        return false;
    }

    /**
     * Thin wrapper around get_option since we use it a ton.
     *
     * @since   0.1
     * @access  protected
     * @return  array
     */
    protected function getOption()
    {
        return get_option($this->setting, array());
    }
}
