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

class CleanArchitectureTest extends TestCase
{
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

    /**
     * @dataProvider requestUserProvider
     * @param $user
     */
    public function testCanCreateUser($user)
    {
        $applicationErrorFactory = new ApplicationErrorFactory();
        $hydratorUserMapper = new HydratorUserMapper(ZendHydratorFactory::build());
        $userRepository = new InMemoryUserRepository($hydratorUserMapper);

        $addUserUseCase = new AddUserUseCase($applicationErrorFactory, $userRepository, $hydratorUserMapper);

        $entries = $user;

        $request = new DomainRequest(new ArrayCollection($entries));

        $data = new ArrayCollection(); $errors = new ArrayCollection();
        $response = new DomainResponse($data, $errors);

        $addUserUseCase($request, $response);

        $this->assertEquals('John', $response->getData()['user']['name']);
        $this->assertEquals('Doe', $response->getData()['user']['surname']);
        $this->assertEquals('john.doe@email.com', $response->getData()['user']['email']);
        $this->assertRegExp('/\w+\-\w+\-\w+\-\w+\-\w+/', $response->getData()['user']['id']);
    }

    /**
     * @dataProvider requestUserProvider
     * @param $user
     */
    public function testCanGetUserById($user)
    {
        $applicationErrorFactory = new ApplicationErrorFactory();
        $hydratorUserMapper = new HydratorUserMapper(ZendHydratorFactory::build());
        $userRepository = new InMemoryUserRepository($hydratorUserMapper);

        $addUserUseCase = new AddUserUseCase($applicationErrorFactory, $userRepository, $hydratorUserMapper);

        $entries = $user;

        $request = new DomainRequest(new ArrayCollection($entries));

        $data = new ArrayCollection(); $errors = new ArrayCollection();
        $response = new DomainResponse($data, $errors);

        $addUserUseCase($request, $response);

        $getUserByIdUseCase = new GetUserUseCase($applicationErrorFactory, $userRepository, $hydratorUserMapper);

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
}