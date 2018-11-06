<?php

namespace DesignPatterns\Extras\CleanArchitecture\Users\Domain\UseCase;

use Damianopetrungaro\CleanArchitecture\UseCase\Request\Request;
use Damianopetrungaro\CleanArchitecture\UseCase\Response\Response;
use Damianopetrungaro\CleanArchitecture\UseCase\Validation\ValidableUseCase;
use DesignPatterns\Extras\CleanArchitecture\Common\Error\ApplicationErrorFactory;
use DesignPatterns\Extras\CleanArchitecture\Common\Error\ApplicationErrorType;
use DesignPatterns\Extras\CleanArchitecture\Users\Domain\Entity\UserEntity;
use DesignPatterns\Extras\CleanArchitecture\Users\Domain\Mapper\UserMapper;
use DesignPatterns\Extras\CleanArchitecture\Users\Domain\Repository\Exception\UserNotFoundException;
use DesignPatterns\Extras\CleanArchitecture\Users\Domain\Repository\Exception\UserPersistenceException;
use DesignPatterns\Extras\CleanArchitecture\Users\Domain\Repository\UserRepositoryInterface;
use DesignPatterns\Extras\CleanArchitecture\Users\Domain\ValueObjects\Email;
use DesignPatterns\Extras\CleanArchitecture\Users\Domain\ValueObjects\Name;
use DesignPatterns\Extras\CleanArchitecture\Users\Domain\ValueObjects\Password;
use DesignPatterns\Extras\CleanArchitecture\Users\Domain\ValueObjects\Surname;
use DesignPatterns\Extras\CleanArchitecture\Users\Domain\ValueObjects\UserId;

final class UpdateUserUseCase implements ValidableUseCase
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @var UserMapper
     */
    private $userMapper;

    /**
     * @var ApplicationErrorFactory
     */
    private $applicationErrorFactory;

    /**
     * UpdateUserUseCase constructor.
     *
     * @param ApplicationErrorFactory $applicationErrorFactory
     * @param UserRepositoryInterface $userRepository
     * @param UserMapper $userMapper
     */
    public function __construct(ApplicationErrorFactory $applicationErrorFactory, UserRepositoryInterface $userRepository, UserMapper $userMapper)
    {
        $this->applicationErrorFactory = $applicationErrorFactory;
        $this->userRepository = $userRepository;
        $this->userMapper = $userMapper;
    }

    /**
     * Método que chama o processo de inicialização do caso de uso.
     * Você deve usar uma referência a Response para retorna uma resposta.
     *
     * @param Request $request
     * @param Response $response
     *
     * @return void
     */
    public function __invoke(Request $request, Response $response): void
    {
        // If request is not valid set response as failed and return
        if (!$this->isValid($request, $response)) {
            $response->setAsFailed();

            return;
        }

        // Criar UserId para checar se User existe.
        $userId = $this->createUserId($request);

        try {
            // Obter usuário pelo UserId
            $user = $this->userRepository->getByUserId($userId);

            // Antes de atualizar os dados do usuário, verificar se a senha antiga coincide com a senha antiga passada na request
            if (!$user->password()->checkValidity($request->get('old_password'))) {
                $response->setAsFailed();
                $response->replaceError('generic', $this->applicationErrorFactory->build('password_mismatch', ApplicationErrorType::USER_PASSWORD_MISMATCH));

                return;
            }

            $this->updateUser($request, $user);

            $this->userRepository->update($user);

        } catch (UserNotFoundException $e) {
            $response->setAsFailed();
            $response->replaceError('generic', $this->applicationErrorFactory->build('user_not_found', ApplicationErrorType::NOT_FOUND_ENTITY));

            return;
        } catch (UserPersistenceException $e) {
            // Se houver um erro ao atualizar, deixe a response como falha, adicione erro e retorne
            $response->setAsFailed();
            $response->replaceError('generic', $this->applicationErrorFactory->build($e->getMessage(), ApplicationErrorType::PERSISTENCE_ERROR));

            return;
        }

        $user = $this->userMapper->toArray($user);
        $response->replaceData('user', $user);
        $response->setAsSuccess();
    }

    /**
     * Método para chamar a validação de um caso de uso.
     * Você deve usar Response para adicionar erros como resposta.
     *
     * @param Request $request
     * @param Response $response
     *
     * @return bool
     */
    public function isValid(Request $request, Response $response): bool
    {
        try {
            $userId = $this->createUserId($request);
            unset($userId);
        } catch (\InvalidArgumentException $e) {
            $response->replaceError('generics', $this->applicationErrorFactory->build($e->getMessage(), ApplicationErrorType::NOT_FOUND_ENTITY));
        }

        try {
            $name = new Name($request->get('name', ''));
            unset($name);
        } catch (\InvalidArgumentException $e) {
            $response->replaceError('name', $this->applicationErrorFactory->build($e->getMessage(), ApplicationErrorType::VALIDATION_ERROR));
        }

        try {
            $surname = new Surname($request->get('surname', ''));
            unset($surname);
        } catch (\InvalidArgumentException $e) {
            $response->replaceError('surname', $this->applicationErrorFactory->build($e->getMessage(), ApplicationErrorType::VALIDATION_ERROR));
        }

        try {
            $email = new Email($request->get('email', ''));
            unset($email);
        } catch (\InvalidArgumentException $e) {
            $response->replaceError('email', $this->applicationErrorFactory->build($e->getMessage(), ApplicationErrorType::VALIDATION_ERROR));
        }

        try {
            $password = new Password($request->get('old_password', ''));
            unset($password);
        } catch (\InvalidArgumentException $e) {
            $response->replaceError('old_password', $this->applicationErrorFactory->build($e->getMessage(), ApplicationErrorType::VALIDATION_ERROR));
        }

        try {
            $password = new Password($request->get('new_password', ''));
            unset($password);
        } catch (\InvalidArgumentException $e) {
            $response->replaceError('new_password', $this->applicationErrorFactory->build($e->getMessage(), ApplicationErrorType::VALIDATION_ERROR));
        }

        return !$response->hasErrors();
    }

    /**
     * Criar um UserId usango uma string.
     * Extraído como método para melhor testabilidade.
     *
     * @param Request $request
     *
     * @return UserId
     */
    private function createUserId(Request $request): UserId
    {
        return UserId::createFromString($request->get('id', ''));
    }

    /**
     * Atualiza os dados do usuário.
     * Extraído como método para melhor testabilidade.
     *
     * @param Request $request
     * @param $user
     *
     * @return void
     */
    private function updateUser(Request $request, UserEntity $user): void
    {
        $user->update(
            new Name($request->get('name')),
            new Surname($request->get('surname')),
            new Email($request->get('email')),
            new Password($request->get('new_password'))
        );
    }
}