<?php
/**
 * Spark
 *
 * @category    WordPress
 * @package     Spark
 * @copyright   2013 Christopher Davis <http://christopherdavis.me>
 * @license     http://opensource.org/licenses/GPL-2.0 GPL-2.0+
 */

namespace Spark\Test\Constraint;

use Spark\Constraint\Choice;

class ChoiceTest extends \WP_UnitTestCase
{
    private $constraint;

    public function testMultipleWithNoChoices()
    {
        $this->constraint->multiple = true;
        $this->assertTrue($this->constraint->check(array('here', 'there')));
    }

    public function testWithNoChoices()
    {
        $this->assertTrue($this->constraint->check('yep'));
    }

    /**
     * @expectedException Spark\Constraint\ConstraintViolation
     */
    public function testMultipleWithBadChoice()
    {
        $this->constraint->choices = array('one', 'two');
        $this->constraint->multiple = true;
        $this->constraint->check(array('one', 'nope'));
    }

    public function testMultiplwWithGoodChoices()
    {
        $this->constraint->choices = array('one', 'two');
        $this->constraint->multiple = true;
        $this->assertTrue($this->constraint->check(array('one')));
    }

    /**
     * @expectedException Spark\Constraint\ConstraintViolation
     */
    public function testWithBadChoice()
    {
        $this->constraint->choices = array('one', 'two');
        $this->constraint->check('nope');
    }

    public function testWithGoodChoice()
    {
        $this->constraint->choices = array('one', 'two');
        $this->assertTrue($this->constraint->check('two'));
    }

    public function setUp()
    {
        parent::setUp();
        $this->constraint = new Choice();
    }
}
