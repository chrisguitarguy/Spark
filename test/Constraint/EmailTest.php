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

use Spark\Constraint\Email;

class EmailTest extends \WP_UnitTestCase
{
    private $constraint;

    public function emailProvider()
    {
        return array(
            array('some+thing@gmail.com'),
            array('info@classicalguitar.org'),
        );
    }

    /**
     * @dataProvider emailProvider
     */
    public function testValidEmails($email)
    {
        $this->assertTrue($this->constraint->check($email));
    }

    /**
     * @expectedException Spark\Constraint\ConstraintViolation
     */
    public function testBadEmail()
    {
        $this->constraint->check('nope');
    }

    public function setUp()
    {
        parent::setUp();
        $this->constraint = new Email();
    }
}
