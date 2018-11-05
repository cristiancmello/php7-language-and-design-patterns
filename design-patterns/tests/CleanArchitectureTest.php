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
}