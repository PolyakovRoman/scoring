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