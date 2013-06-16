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
 * Encapsulates taxonomy creation.
 *
 * There is a "magic" argument value called "object_type" (this is used in the
 * core as well) to associate different post types (or users, etc).
 *
 * @since   0.1
 * @author  Christopher Davis <http://christopherdavis.me>
 */
class Taxonomy extends TypeBase
{
    const TYPE_KEY = 'object_type';

    /**
     * {@inheritdoc}
     */
    public function generateLabels()
    {
        if ($singular_name = $this->getSingularName()) {
            $singular = array(
                'singular_name'         => $singular_name,
                'edit_item'             => sprintf(__('Edit %s', SPARK_TD), $singular_name),
                'view_item'             => sprintf(__('View %s', SPARK_TD), $singular_name),
                'update_item'           => sprintf(__('Update %s', SPARK_TD), $singular_name),
                'add_new_item'          => sprintf(__('New %s', SPARK_TD), $singular_name),
                'new_item_name'         => sprintf(__('New %s Name', SPARK_TD), $singular_name),
                'parent_item'           => sprintf(__('Parent %s', SPARK_TD), $singular_name),
                'parent_item_colon'     => sprintf(__('Parent %s:', SPARK_TD), $singular_name),
            );
        } else {
            $singular = array();
        }

        if ($plural_name = $this->getPluralName()) {
            $plural = array(
                'name'                  => $plural_name,
                'all_item'              => sprintf(__('All %s', SPARK_TD), $plural_name),
                'search_items'          => sprintf(__('Search %s', SPARK_TD), $plural_name),
                'popular_items'         => sprintf(__('Popular %s', SPARK_TD), $plural_name),
                'separate_items_with_commas' => sprintf(__('Separate %s with commas', SPARK_TD), $plural_name),
                'add_or_remove_items'   => sprintf(__('Add or remove %s', SPARK_TD), $plural_name),
                'chose_from_most_used'  => sprintf(__('Choose from most used %s', SPARK_TD), $plural_name),
                'not_found'             => sprintf(__('No %s Found', SPARK_TD), $plural_name),
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

        register_taxonomy(
            $this->getSlug(),
            isset($args[static::TYPE_KEY]) ? $args[static::TYPE_KEY] : array(),
            $args
        );
    }
}
