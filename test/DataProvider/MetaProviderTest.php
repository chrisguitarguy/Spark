<?php
/**
 * Spark
 *
 * @category    WordPress
 * @package     Spark
 * @copyright   2013 Christopher Davis <http://christopherdavis.me>
 * @license     http://opensource.org/licenses/GPL-2.0 GPL-2.0+
 */

namespace Spark\Test\DataProvider;

use Spark\DataProvider\MetaProvider;

class MetaProviderTest extends \WP_UnitTestCase
{
    private $meta, $provider;

    public function testGet()
    {
        $this->meta->expects($this->once())
            ->method('get')
            ->with(1, 'key', null)
            ->will($this->returnValue('yes'));

        $this->assertEquals('yes', $this->provider->get('key'));
    }

    public function testSave()
    {
        $this->meta->expects($this->once())
            ->method('save')
            ->with(1, 'key', 'nope')
            ->will($this->returnValue(true));

        $this->assertTrue($this->provider->save('key', 'nope'));
    }

    public function testDelete()
    {
        $this->meta->expects($this->once())
            ->method('delete')
            ->with(1, 'key')
            ->will($this->returnValue(true));

        $this->assertTrue($this->provider->delete('key'));
    }

    public function setUp()
    {
        parent::setUp();
        $this->meta = $this->getMock('Spark\\Meta\\MetaInterface');
        $this->provider = new MetaProvider($this->meta, 1);
    }
}
