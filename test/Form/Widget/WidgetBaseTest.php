<?php
/**
 * Spark
 *
 * @category    WordPress
 * @package     Spark
 * @copyright   2013 Christopher Davis <http://christopherdavis.me>
 * @license     http://opensource.org/licenses/GPL-2.0 GPL-2.0+
 */

namespace Spark\Test\Form\Widget;

class WidgetBaseTest extends \PHPUnit_Framework_TestCase
{
    private $widget;

    public function testAddRemoveHasStyle()
    {
        $this->assertFalse($this->widget->removeStyle('test'));
        $this->assertFalse($this->widget->hasStyle('test'));
        $this->assertSame($this->widget, $this->widget->addStyle('test'));
        $this->assertTrue($this->widget->hasStyle('test'));
        $this->assertTrue($this->widget->removeStyle('test'));
    }

    public function testAddRemoveHasScript()
    {
        $this->assertFalse($this->widget->removeScript('test'));
        $this->assertFalse($this->widget->hasScript('test'));
        $this->assertSame($this->widget, $this->widget->addScript('test'));
        $this->assertTrue($this->widget->hasScript('test'));
        $this->assertTrue($this->widget->removeScript('test'));
    }

    public function testAddRemoveHasImage()
    {
        $this->assertFalse($this->widget->removeImage('test'));
        $this->assertFalse($this->widget->hasImage('test'));
        $this->assertSame($this->widget, $this->widget->addImage('test'));
        $this->assertTrue($this->widget->hasImage('test'));
        $this->assertTrue($this->widget->removeImage('test'));
    }

    public function testGetStyles()
    {
        $this->assertInternalType('array', $this->widget->getStyles());
    }

    public function testGetScripts()
    {
        $this->assertInternalType('array', $this->widget->getScripts());
    }

    public function testGetImages()
    {
        $this->assertInternalType('array', $this->widget->getImages());
    }

    public function setUp()
    {
        $this->widget = $this->getMockForAbstractClass('Spark\\Form\\Widget\\WidgetBase');
    }
}
