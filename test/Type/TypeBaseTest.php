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

class TypeBaseTest extends \WP_UnitTestCase
{
    private $obj;

    public function testSetGetArgument()
    {
        $args = array(
            'one'   => 1,
            'two'   => 2,
        );

        $this->assertSame($this->obj, $this->obj->setArguments($args));
        $this->assertEquals($args, $this->obj->getArguments());
    }

    public function testSetGetSlug()
    {
        $slug = 'heres-a-slug';

        $this->assertSame($this->obj, $this->obj->setSlug($slug));
        $this->assertEquals($slug, $this->obj->getSlug());
    }

    public function testSetGetLabels()
    {
        $labels = array(
            'one'   => 1,
            'two'   => 2,
        );

        $this->assertSame($this->obj, $this->obj->setLabels($labels));
        $this->assertEquals($labels, $this->obj->getLabels());
    }

    public function testSetGetLabel()
    {
        $this->obj->expects($this->once())
            ->method('generateLabels')
            ->will($this->returnValue(array(
                'one'   => 'one here',
            )));

        $label = 'here';

        $this->assertSame($this->obj, $this->obj->setLabel('one', $label));
        $this->assertEquals($label, $this->obj->getLabel('one'));
    }

    public function testGetLabelWithoutSet()
    {
        $this->obj->expects($this->once())
            ->method('generateLabels')
            ->will($this->returnValue(array(
                'one'   => 'one here',
            )));

        $this->assertEquals('one here', $this->obj->getLabel('one'));
    }

    public function testSetGetSingularName()
    {
        $name = 'A post Type';

        $this->assertSame($this->obj, $this->obj->setSingularName($name));
        $this->assertEquals($name, $this->obj->getSingularName());
    }

    public function testSetGetPluralName()
    {
        $name = 'pages';

        $this->assertSame($this->obj, $this->obj->setPluralName($name));
        $this->assertEquals($name, $this->obj->getPluralName());
    }

    public function testArrayAccess()
    {
        $this->obj['here'] = 'there';
        $this->assertEquals('there', $this->obj['here']);
        $this->assertTrue(isset($this->obj['here']));
        unset($this->obj['here']);
        $this->assertFalse(isset($this->obj['here']));
    }

    public function setUp()
    {
        parent::setUp();

        $this->obj = $this->getMockForAbstractClass('Spark\\Type\\TypeBase');
    }
}
