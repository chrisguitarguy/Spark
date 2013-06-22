<?php
/**
 * Spark
 *
 * @category    WordPress
 * @package     Spark
 * @copyright   2013 Christopher Davis <http://christopherdavis.me>
 * @license     http://opensource.org/licenses/GPL-2.0 GPL-2.0+
 */

namespace Spark\Form\Field;

/**
 * Widgets take care of spitting out the HTML for a form field and keeping
 * track of any media that might be needed with the field: images, styles,
 * scripts, etc.
 *
 * Generally, you don't need to use these: the form system takes care of 
 * itself. However, you may choose to use your own widgets to customize
 * how a given field renders.
 *
 * @since   0.1
 * @author  Christopher Davis <http://christopherdavis.me>
 */
interface WidgetInterface
{
    /**
     * Spit out the HTML for the field.
     *
     * @since   0.1
     * @access  public
     * @param   array $attr The attributes of the field. Eg. class, value, id, etc
     * @return  void
     */
    public function render(array $attr);

    /**
     * Add a stylsheet to the widget.
     *
     * @since   0.1
     * @access  public
     * @param   string $name the name of the stylesheet.
     * @param   array $args The array of arguments to go with it. These mimic
     *          the things found in `wp_enqueue_style:
     *              - url
     *              - version
     *              - dependencies
     *              - media
     *
     *          Leave the args empty and the widget will just attempt
     *          wp_enqueue_style($name);
     * @return  $this
     * @chainable
     */
    public function addStyle($name, array $args=array());

    /**
     * Remove a stylesheet.
     *
     * @since   0.1
     * @access  public
     * @param   string $name
     * @return  boolean
     */
    public function removeStyle($name);

    /**
     * Check to see if the widget has a stylesheet.
     *
     * @since   0.1
     * @access  public
     * @param   string $name
     * @return  boolean
     */
    public function hasStyle($name);

    /**
     * Get all the stylesheets in $name => $args pairs
     *
     * @since   0.1
     * @access  public
     * @return  array
     */
    public function getStyles();

    /**
     * Add a script to the widget.
     *
     * @since   0.1
     * @access  public
     * @param   string $name the name of the script
     * @param   array $args The array of arguments to go with the script
     *          things found in wp_enqueue_script:
     *              - url
     *              - version
     *              - dependencies
     *              - in_footer
     *
     *          Leave the args empty and the widget will just
     *          wp_enqueue_script($name)
     * @return  $this
     * @chainable
     */
    public function addScript($name, array $args=array());

    /**
     * Remove a script.
     *
     * @since   0.1
     * @access  public
     * @param   string $name
     * @return  boolean
     */
    public function removeScript($name);

    /**
     * Check to see if a script is registered with the widget.
     *
     * @since   0.1
     * @access  public
     * @param   string $name
     * @return  boolean
     */
    public function hasScript($name);

    /**
     * Get all the scripts in $name => $args pairs
     *
     * @since   0.1
     * @access  public
     * @return  array
     */
    public function getScripts();

    /**
     * Add an image.
     *
     * @since   0.1
     * @access  public
     * @param   string $name
     * @param   string $url
     * @return  $this
     * @chainable
     */
    public function addImage($name, $url);

    /**
     * Remove an image.
     *
     * @since   0.1
     * @access  public
     * @param   string $name
     * @return  boolean
     */
    public function removeImage($name);

    /**
     * Check to see if the widget has an image.
     *
     * @since   0.1
     * @access  public
     * @param   string $name
     * @return  boolean
     */
    public function hasImage($name);

    /**
     * Get all the images in $name => $url pairs. $url will 
     *
     * @since   0.1
     * @access  public
     * @return  array
     */
    public function getImages();
}
