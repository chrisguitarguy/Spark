<?php
/**
 * Spark
 *
 * @category    WordPress
 * @package     Spark
 * @copyright   2013 Christopher Davis <http://christopherdavis.me>
 * @license     http://opensource.org/licenses/GPL-2.0 GPL-2.0+
 */

namespace Spark\Test\Meta;

use Spark\Meta\Meta;

class MetaTest extends \WP_UnitTestCase
{
    public function metaProvider()
    {
        return array(
            array(new Meta('post', 'pf')),
            array(new Meta('user', 'pf')),
            array(new Meta('comment', 'pf')),
        );
    }

    /**
     * @dataProvider metaProvider
     */
    public function testSaveGetDelete($meta)
    {
        $this->assertNull($meta->get(1, 'nope'));
        $this->assertTrue($meta->save(1, 'nope', 'here'));
        $this->assertEquals('here', $meta->get(1, 'nope'));
        $this->assertTrue($meta->delete(1, 'nope'));
        $this->assertNull($meta->get(1, 'nope'));
    }
}
