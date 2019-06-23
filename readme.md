## **Rahatlatıcı Sesler**

**Kurulum**

###### **Adım 1**

`git clone git@github.com:ismailcaakir/tk-challenge.git tk-challenge`

###### **Adım 2**

`cd tk-challenge && docker-compose up --build -d`

###### **Adım 3**

` docker exec -it --user=www-data tk-challenge_php_1 bash`

###### **Adım 4**
`composer install`


**Bilgiler**

###### **MYSQL**
`http://localhost:9999 Host: mysql Username: root Password: 123456`

###### **Döküman**
https://documenter.getpostman.com/view/6358839/S1a1b9WJ

Postman Collection -> TK-Challange.postman_collection.json

Swagger YAML -> Tk-Challange.swagger.yaml

Swagger UI -> http://localhost/swagger

###### **Araçlar**
`Telescope: http://localhost/telescope`

###### **Notlar**
Uygulamanın debug edilebilmesi ve telescope kullanılabilimesi için .env dosyasında APP_ENV=local olarak değiştirilmeli. Ayırca APP_DEBUG=true olarak değiştirilmelidir.
