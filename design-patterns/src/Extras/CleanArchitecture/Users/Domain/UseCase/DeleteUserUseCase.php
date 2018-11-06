<?php

namespace DesignPatterns\Extras\CleanArchitecture\Users\Domain\UseCase;

use Damianopetrungaro\CleanArchitecture\UseCase\Request\Request;
use Damianopetrungaro\CleanArchitecture\UseCase\Response\Response;
use Damianopetrungaro\CleanArchitecture\UseCase\Validation\ValidableUseCase;
use DesignPatterns\Extras\CleanArchitecture\Common\Error\ApplicationErrorFactory;
use DesignPatterns\Extras\CleanArchitecture\Common\Error\ApplicationErrorType;
use DesignPatterns\Extras\CleanArchitecture\Users\Domain\Mapper\UserMapper;
use DesignPatterns\Extras\CleanArchitecture\Users\Domain\Repository\Exception\UserPersistenceException;
use DesignPatterns\Extras\CleanArchitecture\Users\Domain\Repository\UserRepositoryInterface;
use DesignPatterns\Extras\CleanArchitecture\Users\Domain\ValueObjects\UserId;

final class DeleteUserUseCase implements ValidableUseCase
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
     * DeleteUserUseCase constructor.
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

        // Criar userId para checar se User existe
        $userId = $this->createUserId($request);

        try {
            // Se o usuário não for encontrado, deixa a resposta como falha, adicione o erro e retorne.
            if (!$this->userRepository->findByUserId($userId)) {
                $response->setAsFailed();
                $response->replaceError('generic', $this->applicationErrorFactory->build('user_not_found', ApplicationErrorType::NOT_FOUND_ENTITY));

                return;
            }

            // Delete user using the UserId
            $this->userRepository->deleteByUserId($userId);
        } catch (UserPersistenceException $e) {
            // If there's an error on deleting set response as failed, add the error and return
            $response->setAsFailed();
            $response->replaceError('generic', $this->applicationErrorFactory->build($e->getMessage(), ApplicationErrorType::PERSISTENCE_ERROR));

            return;
        }

        // Set the response as success and return
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
}