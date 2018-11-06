<?php

use PHPUnit\Framework\TestCase;

use DesignPatterns\Extras\CleanArchitecture\Users\Domain\UseCase\AddUserUseCase;
use DesignPatterns\Extras\CleanArchitecture\Common\Error\ApplicationErrorFactory;
use DesignPatterns\Extras\CleanArchitecture\Users\Application\Repository\InMemoryUserRepository;
use DesignPatterns\Extras\CleanArchitecture\Users\Domain\Mapper\HydratorUserMapper;
use DesignPatterns\Extras\CleanArchitecture\Users\Application\Mapper\ZendHydratorFactory;
use Damianopetrungaro\CleanArchitecture\UseCase\Request\CollectionRequest as DomainRequest;
use Damianopetrungaro\CleanArchitecture\UseCase\Response\CollectionResponse as DomainResponse;
use Damianopetrungaro\CleanArchitecture\Common\Collection\ArrayCollection;
use DesignPatterns\Extras\CleanArchitecture\Users\Domain\UseCase\GetUserUseCase;
use DesignPatterns\Extras\CleanArchitecture\Users\Domain\UseCase\ListUserUseCase;
use DesignPatterns\Extras\CleanArchitecture\Users\Application\Transformer\UserTransformer;

class CleanArchitectureTest extends TestCase
{
    /**
     * @var ApplicationErrorFactory
     */
    private $applicationErrorFactory;

    /**
     * @var HydratorUserMapper
     */
    private $hydratorUserMapper;

    /**
     * @var InMemoryUserRepository
     */
    private $userRepository;

    /**
     * @var UserTransformer
     */
    private $userTransformer;

    public function requestUserProvider()
    {
        return [
            [
                'user' => [
                    'name' => 'John',
                    'surname' => 'Doe',
                    'email' => 'john.doe@email.com',
                    'password' => '123456'
                ]
            ]
        ];
    }

    protected function setUp()
    {
        $this->applicationErrorFactory = new ApplicationErrorFactory();
        $this->hydratorUserMapper = new HydratorUserMapper(ZendHydratorFactory::build());
        $this->userRepository = new InMemoryUserRepository($this->hydratorUserMapper);
        $this->userTransformer = new UserTransformer();
    }

    /**
     * Teste do Caso de Uso de Cadastro de Usuário.
     *
     * @dataProvider requestUserProvider
     * @param $user
     * @return DomainResponse
     */
    public function testCanCreateUser($user)
    {
        $addUserUseCase = new AddUserUseCase(
            $this->applicationErrorFactory,
            $this->userRepository,
            $this->hydratorUserMapper
        );

        $entries = $user;

        $request = new DomainRequest(new ArrayCollection($entries));

        $data = new ArrayCollection(); $errors = new ArrayCollection();
        $response = new DomainResponse($data, $errors);

        $addUserUseCase($request, $response);

        $this->assertEquals('John', $response->getData()['user']['name']);
        $this->assertEquals('Doe', $response->getData()['user']['surname']);
        $this->assertEquals('john.doe@email.com', $response->getData()['user']['email']);
        $this->assertRegExp('/\w+\-\w+\-\w+\-\w+\-\w+/', $response->getData()['user']['id']);

        return $response;
    }

    /**
     * @dataProvider requestUserProvider
     * @param $user
     *
     * @depends testCanCreateUser
     */
    public function testCanGetUserById($user)
    {
        $getUserByIdUseCase = new GetUserUseCase(
            $this->applicationErrorFactory,
            $this->userRepository,
            $this->hydratorUserMapper
        );

        $response = $this->testCanCreateUser($user);

        $entries = [
            'id' => $response->getData()['user']['id']
        ];

        $request = new DomainRequest(new ArrayCollection($entries));
        $data = new ArrayCollection(); $errors = new ArrayCollection();
        $response = new DomainResponse($data, $errors);

        $getUserByIdUseCase($request, $response);

        $this->assertNotNull($response->getData()['user']['id']);
        $this->assertEquals($user['name'], $response->getData()['user']['name']);
        $this->assertEquals($user['surname'], $response->getData()['user']['surname']);
        $this->assertNotNull($response->getData()['user']['password']);
        $this->assertEquals($user['email'], $response->getData()['user']['email']);
    }

    /**
     * @dataProvider requestUserProvider
     * @param $user
     */
    public function testCanListAllUsers($user)
    {
        $this->hydratorUserMapper = new HydratorUserMapper(ZendHydratorFactory::build());
        $this->userRepository = new InMemoryUserRepository($this->hydratorUserMapper);

        $addUserUseCase = new AddUserUseCase(
            $this->applicationErrorFactory,
            $this->userRepository,
            $this->hydratorUserMapper
        );

        $listUsersUseCase = new ListUserUseCase(
            $this->applicationErrorFactory,
            $this->userRepository,
            $this->hydratorUserMapper
        );

        $entries = [
            'user1' => [
                'name' => 'John',
                'surname' => 'Doe',
                'email' => 'john.doe@email.com',
                'password' => '123456'
            ],
            'user2' => [
                'name' => 'Mary',
                'surname' => 'Falls',
                'email' => 'mary.falls@email.com',
                'password' => '654321'
            ]
        ];

        foreach ($entries as $entry) {
            $request = new DomainRequest(new ArrayCollection($entry));
            $data = new ArrayCollection(); $errors = new ArrayCollection();
            $response = new DomainResponse($data, $errors);

            $addUserUseCase($request, $response);
        }

        $request = new DomainRequest(new ArrayCollection());
        $data = new ArrayCollection(); $errors = new ArrayCollection();
        $response = new DomainResponse($data, $errors);

        $listUsersUseCase($request, $response);

        $users = $this->userTransformer->mapMultiple($response->getData()['users']);

        $this->assertCount(2, $this->userRepository->all());
        $this->assertContains('Mary', $users[1]);
    }
}