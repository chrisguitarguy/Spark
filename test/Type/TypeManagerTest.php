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

use Spark\Type\TypeManager;

class TypeManagerTest extends \WP_UnitTestCase
{
    private $manager;

    public function testSetGetEntity()
    {
        $e = 'here';

        $this->assertSame($this->manager, $this->manager->setEntity($e));
        $this->assertEquals($e, $this->manager->getEntity());
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testGetWithBadArg()
    {
        $this->manager->get('noop');
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testRemovewithBadArg()
    {
        $this->manager->remove('noop');
    }

    public function testPutGetHasRemove()
    {
        $this->assertFalse($this->manager->has('noop'));

        $type = $this->getMock('Spark\\Type\\TypeInterface');
        $type->expects($this->once())
            ->method('getSlug')
            ->will($this->returnValue('noop'));

        $this->manager->put($type);

        $this->assertTrue($this->manager->has('noop'));

        $this->assertSame($type, $this->manager->get('noop'));

        $this->manager->remove('noop');

        $this->assertFalse($this->manager->has('noop'));
    }

    /**
     * @depends testSetGetEntity
     */
    public function testCreate()
    {
        $this->manager->setEntity('Spark\\Type\\PostType');

        $builder = $this->getMock('Spark\\Type\\TypeBuilderInterface');
        $builder->expects($this->once())
            ->method('build')
            ->with($this->isInstanceOf('Spark\\Type\\PostType'));

        $this->manager->create($builder);
    }

    /**
     * @depends testPutGetHasRemove
     */
    public function testRegister()
    {
        $type = $this->getMock('Spark\\Type\\TypeInterface');
        $type->expects($this->once())
            ->method('getSlug')
            ->will($this->returnValue('noop'));
        $type->expects($this->once())
            ->method('register');

        $this->manager->put($type);
        $this->manager->register();
    }

    public function setUp()
    {
        parent::setUp();
        $this->manager = new TypeManager('n/a');
    }
}
