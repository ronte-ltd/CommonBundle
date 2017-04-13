<?php

namespace RonteLtd\CommonBundle\Exception;

use Symfony\Component\Validator\ConstraintViolationListInterface;
use Throwable;

/**
 * EntityValidateException
 *
 * @author Alexey Astafev <efsneiron@gmail.com>
 */
class EntityValidateException extends \Exception
{
    /**
     * @var ConstraintViolationListInterface
     */
    private $list;

    /**
     * EntityValidateException constructor.
     * @param string $message
     * @param ConstraintViolationListInterface $list
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "", ConstraintViolationListInterface $list, $code = 0, Throwable $previous = null)
    {
        $this->list = $list;
        parent::__construct($message, $code, $previous);
    }

    /**
     * Gets violation list
     *
     * @return ConstraintViolationListInterface
     */
    public function getViolationList(): ConstraintViolationListInterface
    {
        return $this->list;
    }

    /**
     * Gets the list of errors
     *
     * @return array
     */
    public function getErrors(): array
    {
        $error = [];

        foreach ($this->list as $r) {
            $error[$r->getPropertyPath()] = $r->getMessage();
        }

        return $error;
    }

}