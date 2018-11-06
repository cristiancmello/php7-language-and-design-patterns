# Clean Architecture Example

## Components

### Common

* Application Error entities; 

### Users

#### Domain

* *Entity* **User**

* *Value Objects*: **UserId**, **Name**, **Surname**, **Email**, **Password**;

* *Use Cases*:
  * **AddUserUseCase**: create an **User**;
  * **GetUserUseCase**: get an **User** by **UserId**;
  * **ListUserUseCase**: list all **User** objects;
  * **UpdateUserUseCase**: update an **User** by **UserId**;
  * **DeleteUserUseCase**: remove an **User** by **UserId**;

* *Mapper* (**Data Mapper** pattern):
  * **Strategies** (**Strategy** pattern):
    - **UserIdStrategy**: contains methods to get `id` string and get **UserId** object with the passed `id` string;
    - **NameStrategy**: contains methods to get `name` string and get **Name** object with the passed `name` string;
    - **SurnameStrategy**: contains methods to get `surname` string and get **Surname** object with the passed `surname` string;
    - **EmailStrategy**: contains methods to get `email` string and get **Email** object with the passed `email` string;
    - **PasswordStrategy**: contains methods to get `password` string and get **Password** object with the passed `password` string;
  * **HydratorUserMapper**: A classe to use for transform **User** instances into **array** and viceversa.

* *Repository* (**Repository** pattern):
  * **UserRepositoryInterface**: A contract to **UserRepository** implementation.

#### Application

* *Mapper*:
  * **ZendHydratorFactory**: implements a **Hydrator** factory to convert **array** to **User** and viceversa;

## External Dependencies

* **Clean Architecture package** : `compose require damianopetrungaro/clean-architecture`;
* **Ramsey UUID package** : `composer require ramsey/uuid`;
* **Zend Hydrator** : `composer require zendframework/zend-hydrator`;
