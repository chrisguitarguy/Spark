<?php
/**
 * Spark
 *
 * @category    WordPress
 * @package     Spark
 * @copyright   2013 Christopher Davis <http://christopherdavis.me>
 * @license     http://opensource.org/licenses/GPL-2.0 GPL-2.0+
 */

namespace Spark\Form;

use Spark\Form\Field\FieldInterface;

/**
 * Forms are a combination of fields + views.
 *
 * See Spark\Form\Field for fields and Spark\Form\View for views.
 *
 * In a nutshell:
 *  - Form Fields are information about validation and rendering
 *  - Form views connect a form with WordPress's API (settings, meta boxes, etc)
 *  - Forms themselves combine the two.
 *
 * @since   0.1
 * @author  Christopher Davis <http://christopherdavis.me>
 */
interface FormInterface extends \ArrayAccess
{
    /**
     * Add a field to the form.
     *
     * @since   0.1
     * @access  public
     * @param   string|Spark\Form\Field\FieldInterface $field
     * @param   string $field_type Optional -- defualt: text
     * @param   array $args Optional.
     * @return  $this
     * @chainable
     */
    public function add($field, $field_type='text', array $args=array());

    /**
     * Remove a field.
     *
     * @since   0.1
     * @access  public
     * @param   string|Spark\Form\Field\FieldInterface $field
     * @return  boolean
     */
    public function remove($field);

    /**
     * Check if a field exists.
     *
     * @since   0.1
     * @access  public
     * @param   string|Spark\Form\Field\FieldInterface $field
     * @return  boolean
     */
    public function has($field);

    /**
     * Get all the fields in the form. in $name => FieldInterface pairs
     *
     * @since   0.1
     * @access  public
     * @return  array
     */
    public function getFields();

    /**
     * Create a form view.
     *
     * @since   0.1
     * @access  public
     * @param   string $type Optional.
     * @return  Spark\Form\View\ViewInterface
     */
    public function createView($type='default');

    /**
     * Bind form to some request data. (eg. the POST array). $bind can be an
     * array or something the implements ArrayAccess
     *
     * @since   0.1
     * @access  public
     * @param   array|ArrayAccess $bind
     * @return  void
     */
    public function bind($bind);

    /**
     * See if a form is valid. You can use with bind to to make sure things are
     * okay:
     *
     *  // create $form somewhere up here...
     *  if (isset($_SERVER['REQUEST_METHOD']) && 'POST' = $_SERVER['REQUEST_METHOD']) {
     *      $form->bind($_POST);
     *
     *      if ($form->isValid()) {
     *          // save stuff
     *
     *          wp_redirect('/the_page')
     *          exit;
     *      }
     *
     *      // let the form render as usual.
     *  }
     *
     *
     * @since   0.1
     * @access  public
     * @return  boolean
     */
    public function isValid();
}
