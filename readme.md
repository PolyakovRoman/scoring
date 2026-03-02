### **Запуск проекта**
- _docker compose up -d --build_
- _docker exec -it scoring-php bash_
- _cd scoring-app/_
- _composer install_
- _php bin/console doctrine:database:create_
- _php bin/console doctrine:migrations:migrate_

### **Точки входа**

- http://localhost:8080/client/registration - Регистрация клиента
- http://localhost:8080/clients - Список клиентов
- http://localhost:8080/client/{id} - Страница клиента
- http://localhost:8080/client/{id}/edit - Редактирование клиента

### **Консольные команды**

- _php bin/console app:scoring-calc_ - Расчет скоринга для все клиентов с детализацией
- _php bin/console app:scoring-calc {ID клиента}_ - Расчет скоринга для конкретного клиента с детализацией

### **Фикстура**

- _php bin/console doctrine:fixtures:load_

### **Тесты**

- _php bin/phpunit tests/Scoring/Rule/PhoneTest.php_ - Unit тест расчета скоринга для ноемра телефона
- _php bin/phpunit tests/Scoring/Rule/EmailTest.php_ - Unit тест расчета скоринга для Email
- _php bin/phpunit tests/Scoring/Rule/EducationTest.php_ - Unit тест расчета скоринга для Образвания


- _php bin/phpunit tests/Scoring/ScoringServiceTest.php_ - Интегративный тест ScoringService


- _php bin/phpunit tests/Command/ScoringCalcCommandTest.php_ Интегративный тест консольной команды

> Перед запуском интегративного теста консольной команды нужно создать тестовую базу
> - php bin/console doctrine:database:create --env=test
> - php bin/console doctrine:migrations:migrate -e test
> - php bin/console doctrine:fixtures:load -e test
