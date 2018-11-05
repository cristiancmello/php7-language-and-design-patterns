<?php

namespace DesignPatterns\Extras\CleanArchitecture\Users\Domain\Mapper;

use Damianopetrungaro\CleanArchitecture\Mapper\Mapper;
use DesignPatterns\Extras\CleanArchitecture\Users\Domain\Entity\UserEntity;
use DesignPatterns\Extras\CleanArchitecture\Users\Domain\Collection\UsersArrayCollection;

interface UserMapper extends Mapper
{
    /**
     * {@inheritdoc}
     */
    public function toArray($object): array;

    /**
     * {@inheritdoc}
     */
    public function toObject($class, array $array): UserEntity;

    /**
     * Return an array with multiple user's array
     *
     * @param UsersArrayCollection $collection
     *
     * @return array
     */
    public function toMultipleArray(UsersArrayCollection $collection): array;

    /**
     * Return an UsersArrayCollection from an array of data
     *
     * @param $class
     * @param array $array
     *
     * @return UsersArrayCollection
     */
    public function toMultipleObject($class, array $array): UsersArrayCollection;
}