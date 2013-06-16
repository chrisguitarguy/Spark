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
 * Encapsulates post type creation.
 *
 * @since   0.1
 * @author  Christopher Davis <http://christopherdavis.me>
 */
class PostType extends TypeBase
{
    /**
     * {@inheritdoc}
     */
    public function generateLabels()
    {
       if ($singular_name = $this->getSingularName()) {
            $singular = array(
                'singular_name'         => $singular_name,
                'add_new'               => sprintf(__('New %s', SPARK_TD), $singular_name),
                'edit_item'             => sprintf(__('Edit %s', SPARK_TD), $singular_name),
                'view_item'             => sprintf(__('View %s', SPARK_TD), $singular_name),
                'parent_item_colon'     => sprintf(__('Parent %s:', SPARK_TD), $singular_name),
            );
            $singular['add_new_item'] = $singular['add_new'];
            $singular['new_item'] = $singular['add_new'];
        } else {
            $singular = array();
        }

        if ($plural_name = $this->getPluralName()) {
            $plural = array(
                'name'                  => $plural_name,
                'all_items'             => sprintf(__('All %s', SPARK_TD), $plural_name),
                'search_items'          => sprintf(__('Search %s', SPARK_TD), $plural_name),
                'not_found'             => sprintf(__('No %s Found', SPARK_TD), $plural_name),
                'not_found_in_trash'    => sprintf(__('No %s Found in the Trash', SPARK_TD), $plural_name),
            );
        } else {
            $plural = array();
        }

        return array_merge($singular, $plural);
    }

    /**
     * {@inheritdoc}
     */
    public function register()
    {
        $args = $this->getArguments();

        $args['labels'] = $this->getLabels();

        register_post_type($this->getSlug(), $args);
    }
}
