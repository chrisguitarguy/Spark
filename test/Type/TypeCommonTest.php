<?php
/**
 * Spark
 *
 * @category    WordPress
 * @package     Spark
 * @copyright   2013 Christopher Davis <http://christopherdavis.me>
 * @license     http://opensource.org/licenses/GPL-2.0 GPL-2.0+
 */

namespace Spark\Test\Type;

use Spark\Type\PostType;
use Spark\Type\Taxonomy;

class TypeCommonTest extends \WP_UnitTestCase
{
    /** Data Providers **********/

    public function typeInstanceProvider()
    {
        return array(
            array(new PostType()),
            array(new Taxonomy()),
        );
    }

    /**
     * @dataProvider typeInstanceProvider
     */
    public function testGenerateLabels($type)
    {
        $type->setSingularName('here');
        $type->setPluralName('there');
        $labels = $type->generateLabels();

        $this->assertTrue(is_array($labels));
        $this->assertArrayHasKey('singular_name', $labels);
        $this->assertEquals('here', $labels['singular_name']);
        $this->assertArrayHasKey('name', $labels);
        $this->assertEquals('there', $labels['name']);
    }

    public function testPostTypeRegister()
    {
        global $wp_post_types;

        $this->assertArrayNotHasKey('spark_type', $wp_post_types);

        $type = new PostType();
        $type
            ->setSlug('spark_type')
            ->register();

        $this->assertArrayHasKey('spark_type', $wp_post_types);
    }

    public function testTaxonomyRegister()
    {
        global $wp_taxonomies;

        $this->assertArrayNotHasKey('spark_tax', $wp_taxonomies);

        $type = new Taxonomy();
        $type
            ->setSlug('spark_tax')
            ->register();

        $this->assertArrayHasKey('spark_tax', $wp_taxonomies);
    }
}
