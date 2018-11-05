<?php
/**
 * Created by PhpStorm.
 * User: cristian
 * Date: 04/11/18
 * Time: 21:14
 */

namespace DesignPatterns\Extras\CleanArchitecture\Common\Error;

use Damianopetrungaro\CleanArchitecture\Common\Enum\Enum;
use Damianopetrungaro\CleanArchitecture\UseCase\Error\AbstractErrorType;

/**
 * @method static ApplicationErrorType NOT_FOUND_ENTITY()
 * @method static ApplicationErrorType VALIDATION_ERROR()
 * @method static ApplicationErrorType PERSISTENCE_ERROR()
 * @method static ApplicationErrorType USER_PASSWORD_MISMATCH()
 */
class ApplicationErrorType extends AbstractErrorType
{
    public const NOT_FOUND_ENTITY = 'NOT_FOUND_ENTITY';
    public const VALIDATION_ERROR = 'VALIDATION_ERROR';
    public const PERSISTENCE_ERROR = 'PERSISTENCE_ERROR';
    public const USER_PASSWORD_MISMATCH = 'USER_PASSWORD_MISMATCH';

    /**
     * {@inheritDoc}
     */
    public function equals(Enum $enum): bool
    {
        return $enum->getValue() == $this->getValue();
    }
}