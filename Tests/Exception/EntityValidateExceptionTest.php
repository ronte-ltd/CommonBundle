<?php

namespace RonteLtd\CommonBundle\Tests\Exception;

use Liip\FunctionalTestBundle\Test\WebTestCase;
use RonteLtd\CommonBundle\Entity\Test\Entity;
use RonteLtd\CommonBundle\Exception\EntityValidateException;
use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * EntityValidateExceptionTest
 *
 * @author Alexey Astafev <efsneiron@gmail.com>
 */
class EntityValidateExceptionTest extends WebTestCase
{
    /**
     * @var EntityValidateException
     */
    private $exception;

    /**
     * @inheritdoc
     */
    public function setUp()
    {
        $client = self::createClient();
        $validator = $client->getContainer()->get('validator');
        $list = $validator->validate(new Entity());
        $this->exception = new EntityValidateException('validation error', $list, 400);
        parent::setUp();
    }

    /**
     * Tests getter for violation list
     *
     * @covers \RonteLtd\CommonBundle\Exception\EntityValidateException::getViolationList()
     */
    public function testGetViolationList()
    {
        $list = $this->exception->getViolationList();
        self::assertEquals(1, $list->count());
        self::assertInstanceOf(ConstraintViolationListInterface::class, $list);
    }

    /**
     * Tests getter for errors
     *
     * @covers \RonteLtd\CommonBundle\Exception\EntityValidateException::getErrors()
     */
    public function testGetErrors()
    {
        $errors = $this->exception->getErrors();
        self::assertTrue(is_array($errors));
        self::assertNotEmpty($errors);
    }
}