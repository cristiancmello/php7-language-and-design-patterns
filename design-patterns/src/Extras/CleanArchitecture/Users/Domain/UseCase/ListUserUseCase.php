<?php

namespace DesignPatterns\Extras\CleanArchitecture\Users\Domain\UseCase;

use Damianopetrungaro\CleanArchitecture\UseCase\Request\Request;
use Damianopetrungaro\CleanArchitecture\UseCase\Response\Response;
use Damianopetrungaro\CleanArchitecture\UseCase\UseCase;
use DesignPatterns\Extras\CleanArchitecture\Common\Error\ApplicationErrorFactory;
use DesignPatterns\Extras\CleanArchitecture\Common\Error\ApplicationErrorType;
use DesignPatterns\Extras\CleanArchitecture\Users\Domain\Mapper\UserMapper;
use DesignPatterns\Extras\CleanArchitecture\Users\Domain\Repository\Exception\UserPersistenceException;
use DesignPatterns\Extras\CleanArchitecture\Users\Domain\Repository\UserRepositoryInterface;

final class ListUserUseCase implements UseCase
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
     * ListUserUseCase constructor.
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
        try {
            // Obter Users do repository
            $userCollection = $this->userRepository->all();

        } catch (UserPersistenceException $e) {
            // Se houver um erro, deixe response as falha, adicione erro e retorne
            $response->setAsFailed();
            $response->replaceError('generic', $this->applicationErrorFactory->build($e->getMessage(), ApplicationErrorType::PERSISTENCE_ERROR));

            return;
        }

        $users = $this->userMapper->toMultipleArray($userCollection);
        $response->replaceData('users', $users);
        $response->setAsSuccess();
    }
}