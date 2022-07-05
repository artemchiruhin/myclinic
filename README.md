# :hospital: Веб-сайт для клиники

Проект был создан во время выполнения дипломного проекта. Имеется разделение прав пользователя и администратора. Администратор может управлять всей информацией (CRUD). Все маршруты администратора защищены от пользователя с помощью middleware. Пользователь может записываться на услуги. Записаться можно только в свободное время.

Использованные технологии: **Laravel**, **Livewire**, **Swiper**, **GSAP**

Все модули проекта распределены по своим директориям. Названия файлов отражают их суть. При наименовании чего-либо придерживался ресурсного стиля, принятого в Laravel.

База данных была создана с помощью миграций.

## :cinema: Демонстрация проекта:

Главная, регистрация, авторизация

![Demo](https://media.giphy.com/media/CbQiBaWLqrv1nnEKhk/giphy.gif)

Панель администратора

![Demo](https://media.giphy.com/media/evyjioFBIWo1s5m51F/giphy.gif)

Функционал пользователя

![Demo](https://media.giphy.com/media/Ke6xRaBpKCcvU5IupU/giphy.gif)

## :twisted_rightwards_arrows: Созданные маршруты

| № | Путь                                | Название                         | Http метод | Middleware  | Контроллер, метод              |
| -- |-------------------------------------|----------------------------------|------------|-------------|--------------------------------|
| 1 | /                                   | index                            | GET        | x           | IndexController, index         |
| 2 | /register                           | auth.register                    | GET        | guest       | RegisterController, index      |
| 3 | /register                           | auth.register                    | POST       | guest       | RegisterController, store      |
| 4 | /login                              | auth.login                       | GET        | guest       | LoginController, index         |
| 5 | /login                              | auth.login                       | POST       | guest       | LoginController, store         |
| 6 | /logout                             | auth.logout                      | GET        | auth        | LoginController, logout        |
| 7 | /profile                            | user.profile                     | GET        | auth        | IndexController, profile       |
| 8 | /services/{service}                 | user.services.show               | GET        | x           | User\ServiceController, show   |
| 9 | /{booking}/cancel                   | user.cancel-booking              | DELETE     | auth        | IndexController, cancelBooking |
| 10 | /admin                              | admin.index                      | GET        | auth, admin | IndexController, dashboard     |
| 11 | /admin                              | admin.index                      | PUT        | auth, admin | IndexController, saveGeneralData     |
| 12 | /admin/service-categories                   | admin.service-categories.index      | GET        | auth, admin | ServiceCategoryController, index      |
| 13 | /admin/service-categories/create            | admin.service-categories.create | GET        | auth, admin | ServiceCategoryController, create     |
| 14 | /admin/service-categories/store            | admin.service-categories.store | POST       | auth, admin | ServiceCategoryController, store      |
| 15 | /admin/service-categories/{serviceCategory}/edit   | admin.service-categories.edit   | GET        | auth, admin | ServiceCategoryController, edit       |
| 16 | /admin/service-categories/{serviceCategory}/update   | admin.service-categories.update   | PUT        | auth, admin | ServiceCategoryController, update     |
| 17 | /admin/service-categories/{serviceCategory}        | admin.service-categories.destroy | DELETE     | auth, admin | ServiceCategoryController, destroy    |
| Маршруты | для                                 | услуг и сотрудников                            | аналогичны | маршрутам   | категорий                      |
| 18 | /admin/bookings                       | admin.bookings.index              | GET        | auth, admin | BookingController, index         |
| 19 | /admin/bookings/{booking} | admin.bookings.destroy | DELETE        | auth, admin | BookingController, destroy    |
| 20 | /admin/feedbacks | admin.feedbacks.index | GET       | auth, admin | FeedbackController, index  |
| 21 | /admin/feedbacks/{feedback}/approve | admin.feedbacks.approve | PUT       | auth, admin | FeedbackController, approve  |
| 22 | /admin/feedbacks/{feedback} | admin.feedbacks.destroy | DELETE       | auth, admin | FeedbackController, destroy  |

## :deciduous_tree: Структура функциональной части проекта проекта

Что создано мной и **важно** показать. Как видите, всё распределено по своим разделам.
```
.
├── app
|   ├── Http
|   |   ├── Controllers
|   |   |   ├── Admin
|   |   |   |   ├── BookingController.php
|   |   |   |   ├── EmployeeController.php
|   |   |   |   ├── FeedbackController.php
|   |   |   |   ├── ServiceCategoryController.php
|   |   |   |   └── ServiceController.php
|   |   |   ├── Auth
|   |   |   |   ├── RegisterController.php
|   |   |   |   └── LoginController.php
|   |   |   ├── User
|   |   |   |   └── ServiceController.php
|   |   |   └── IndexController.php
|   |   ├── Livewire
|   |   |   ├── Admin
|   |   |   |   ├── BookingsList.php
|   |   |   |   ├── EmployeesList.php
|   |   |   |   ├── FeedbacksList.php
|   |   |   |   └── ServicesList.php
|   |   |   └── User
|   |   |       ├── FeedbackForm.php
|   |   |       ├── ServiceBookingFeedbacks.php
|   |   |       └── ServiceBookingForm.php
|   |   ├── Middleware
|   |   |   └── IsAdmin.php
|   |   └── Requests
|   |       ├── EmployeeCreateFormRequest.php
|   |       ├── EmployeeUpdateFormRequest.php
|   |       ├── GeneralDataRequest.php
|   |       ├── LoginFormRequest.php
|   |       ├── RegisterFormRequest.php
|   |       ├── ServiceCategoryFormRequest.php
|   |       ├── ServiceCreateFormRequest.php
|   |       └── ServiceUpdateFormRequest.php
|   ├── Mail
|   |   └── BookingMail.php
|   ├── Models
|   |   ├── Booking.php
|   |   ├── Employee.php
|   |   ├── Feedback.php
|   |   ├── Service.php
|   |   ├── ServiceCategory.php
|   |   └── User.php
|   └── helpers.php
```
