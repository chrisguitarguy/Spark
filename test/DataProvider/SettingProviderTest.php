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

use Spark\DataProvider\SettingProvider;

class SettingProviderTest extends \WP_UnitTestCase
{
    const SETTING = '_spark_provider_test';

    private $provider;

    public function testGet()
    {
        update_option(static::SETTING, array('yep' => 1));
        $this->assertEquals(1, $this->provider->get('yep'));
    }

    public function testHas()
    {
        update_option(static::SETTING, array('yep' => 1));
        $this->assertTrue($this->provider->has('yep'));
    }

    public function testDelete()
    {
        update_option(static::SETTING, array('yep' => 1));
        $this->assertTrue($this->provider->delete('yep'));

        $opts = get_option(static::SETTING, array());
        $this->assertArrayNotHasKey('yep', $opts);
    }

    public function testSave()
    {
        update_option(static::SETTING, array('yep' => 1));
        $this->assertTrue($this->provider->save('yep', 2));

        $opts = get_option(static::SETTING, array());
        $this->assertNotEquals(1, $opts['yep']);
        $this->assertEquals(2, $opts['yep']);
    }

    public function setUp()
    {
        parent::setUp();

        $this->provider = new SettingProvider(static::SETTING);
    }
}
