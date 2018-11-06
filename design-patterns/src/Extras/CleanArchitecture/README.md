# Clean Architecture Example

## Components

### Common

* Application Error entities; 

### Users

#### Domain

* *Entity* **User**

* *Value Objects*: **UserId**, **Name**, **Surname**, **Email**, **Password**;

* **Use Case**
  * **AddUserUseCase**: create an **User**;
  * **GetUserUseCase**: get an **User** by **UserId**;
  * **ListUserUseCase**: list all **User** objects;
  * **UpdateUserUseCase**: update an **User** by **UserId**;
  * **DeleteUserUseCase**: remove an **User** by **UserId**;

## External Dependencies

* **Clean Architecture package** : `compose require damianopetrungaro/clean-architecture`;
* **Ramsey UUID package** : `composer require ramsey/uuid`;
* **Zend Hydrator** : `composer require zendframework/zend-hydrator`;
