<?php
/**
 * Spark
 *
 * @category    WordPress
 * @package     Spark
 * @copyright   2013 Christopher Davis <http://christopherdavis.me>
 * @license     http://opensource.org/licenses/GPL-2.0 GPL-2.0+
 */

namespace Spark\Form\View;

/**
 * Views do the integration work with WordPress.
 *
 * @since   0.1
 * @author  Christopher Davis <http://christopherdavis.me>
 */
interface ViewInterface
{
    /**
     * Render the HTML for the form. The implementation of this will
     * vary from view to view. SettingView's, for instance, will use render
     * to call the various `add_settings_*` functions.
     *
     * @since   0.1
     * @access  public
     * @return  void
     */
    public function render();

    /**
     * Show any validation errors for the form. Again, this varies from view
     * to view. Settings pages, for instance, can't really do great validation
     * but we can show errors via add_settings_error.
     *
     * @since   0.1
     * @access  public
     * @return  void
     */
    public function renderErrors();

    /**
     * Render the scripts of the form.
     *
     * @since   0.1
     * @access  public
     * @return  void
     */
    public function renderScripts();

    /**
     * Render the styles of the form
     *
     * @since   0.1
     * @access  public
     * @return  void
     */
    public function renderStyles();
}
