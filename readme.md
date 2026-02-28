### **Запуск проекта**
- docker compose up -d --build
- docker exec -it scoring-php bash
- cd scoring-app/
- composer install
- php bin/console doctrine:database:create
- php bin/console doctrine:migrations:migrate

### **Точки входа**

- http://localhost:8080/client/registration - Регистрация клиента
- http://localhost:8080/clients - Список клиентов
- http://localhost:8080/client/{id} - Страница клиента
- http://localhost:8080/client/{id}/edit - Редактирование клиента

### **Консольные команды**

- php bin/console app:scoring-calc - Расчет скоринга для все клиентов с детализацией
- php bin/console app:scoring-calc - {ID клиента} Расчет скоринга для конкретного клиента с детализацией

### **Фикстура**

- php bin/console doctrine:fixtures:load