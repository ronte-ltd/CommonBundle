<?php

namespace RonteLtd\CommonBundle\Tests\Entity;

use RonteLtd\CommonBundle\Entity\EntityError;

/**
 * EntityErrorTest
 *
 * @author Alexey Astafev <efsneiron@gmail.com>
 */
class EntityErrorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests setter and getter for errors
     *
     * @covers \RonteLtd\CommonBundle\Entity\EntityError::addErrors()
     * @covers \RonteLtd\CommonBundle\Entity\EntityError::getErrors()
     */
    public function testAddGetErrors()
    {
        $errors = new EntityError();
        $errors->addErrors('username', 'Field \'username\' cannot be null');
        self::assertTrue(is_array($errors->getErrors()));
        self::assertTrue(in_array('username', array_keys($errors->getErrors())));
    }
}