<?php

namespace DesignPatterns\Extras\CleanArchitecture\Users\Domain\UseCase;

use Damianopetrungaro\CleanArchitecture\UseCase\Request\Request;
use Damianopetrungaro\CleanArchitecture\UseCase\Response\Response;
use Damianopetrungaro\CleanArchitecture\UseCase\Validation\ValidableUseCase;
use DesignPatterns\Extras\CleanArchitecture\Common\Error\ApplicationErrorFactory;
use DesignPatterns\Extras\CleanArchitecture\Common\Error\ApplicationErrorType;
use DesignPatterns\Extras\CleanArchitecture\Users\Domain\Entity\UserEntity;
use DesignPatterns\Extras\CleanArchitecture\Users\Domain\Mapper\UserMapper;
use DesignPatterns\Extras\CleanArchitecture\Users\Domain\Repository\Exception\UserPersistenceException;
use DesignPatterns\Extras\CleanArchitecture\Users\Domain\Repository\UserRepositoryInterface;
use DesignPatterns\Extras\CleanArchitecture\Users\Domain\ValueObjects\Email;
use DesignPatterns\Extras\CleanArchitecture\Users\Domain\ValueObjects\Name;
use DesignPatterns\Extras\CleanArchitecture\Users\Domain\ValueObjects\Password;
use DesignPatterns\Extras\CleanArchitecture\Users\Domain\ValueObjects\Surname;

final class AddUserUseCase implements ValidableUseCase
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
     * AddUserUseCase constructor.
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
        // Se a request é inválida, configure response como inválido e retorne.
        if (!$this->isValid($request, $response)) {
            $response->setAsFailed();
            return;
        }

        // Criar usuário
        $user = $this->createUser($request);

        try {
            // Adicionar usuário ao repository.
            $this->userRepository->add($user);

        } catch (UserPersistenceException $e) {
            // Se houver um erro enquanto salva, adiciona erro e retorna
            $response->setAsFailed();
            $response->replaceError('generic', $this->applicationErrorFactory->build($e->getMessage(), ApplicationErrorType::PERSISTENCE_ERROR));

            return;
        }

        // Transforme instâncias de User em array
        // Defina a response como válida, adicione o usuário a mesma e retorne
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
            $name = new Name($request->get('name', ''));
            unset($name);
        } catch (\InvalidArgumentException | \Throwable $e) {
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
            $password = new Password($request->get('password', ''));
            unset($password);
        } catch (\InvalidArgumentException $e) {
            $response->replaceError('password', $this->applicationErrorFactory->build($e->getMessage(), ApplicationErrorType::VALIDATION_ERROR));
        }

        return !$response->hasErrors();
    }

    /**
     * Criar novo usuário.
     * Extraído como método para melhor testabilidade.
     *
     * @param Request $request
     *
     * @return UserEntity
     */
    private function createUser(Request $request): UserEntity
    {
        // Criando novo usuário com objetos de valores.
        return new UserEntity(
            $this->userRepository->nextId(),
            new Name($request->get('name')),
            new Surname($request->get('surname')),
            new Email($request->get('email')),
            new Password($request->get('password'))
        );
    }
}