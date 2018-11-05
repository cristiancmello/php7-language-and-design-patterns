<?php

namespace DesignPatterns\Extras\CleanArchitecture\Common\Error;

use Damianopetrungaro\CleanArchitecture\UseCase\Error\AbstractError;
use Damianopetrungaro\CleanArchitecture\UseCase\Error\ErrorType;

class ApplicationError extends AbstractError
{
    /**
     * @var string
     */
    private $pointer;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $detail;

    /**
     * @var array
     */
    private $meta;

    /**
     * ApplicationError constructor.
     *
     * @param string $code
     * @param ErrorType $errorType
     * @param string $pointer
     * @param string $title
     * @param string $detail
     * @param array $meta
     */
    public function __construct($code, ErrorType $errorType, string $pointer = '', string $title = '', string $detail = '', array $meta = [])
    {
        parent::__construct($code, $errorType);
        $this->pointer = $pointer;
        $this->title = $title;
        $this->detail = $detail;
        $this->meta = $meta;
    }

    /**
     * Return the error pointer
     *
     * @return string
     */
    public function pointer()
    {
        return $this->pointer;
    }

    /**
     * Return the error title
     *
     * @return string
     */
    public function title()
    {
        return $this->title;
    }

    /**
     * Return the error detail
     *
     * @return string
     */
    public function detail(): string
    {
        return $this->detail;
    }

    /**
     * Return the error meta
     *
     * @return array
     */
    public function meta(): array
    {
        return $this->meta;
    }
}