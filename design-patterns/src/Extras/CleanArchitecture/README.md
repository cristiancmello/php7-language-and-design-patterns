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
  * **HydratorUserMapper**: A classe to use for transform **User** instances into **array** and viceversa.

* *Repository* (**Repository** pattern):
  * **UserRepositoryInterface**: A contract to **UserRepository** implementation.

## External Dependencies

* **Clean Architecture package** : `compose require damianopetrungaro/clean-architecture`;
* **Ramsey UUID package** : `composer require ramsey/uuid`;
* **Zend Hydrator** : `composer require zendframework/zend-hydrator`;
