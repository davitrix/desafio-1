# Desafio 1

## Requisitos previos

-   PHP >= 8.2
-   Composer
-   MySQL o MariaDB

## Instrucciones de instalación

1. **Clona el repositorio en tu PC local**

    ```bash
    git clone https://github.com/davitrix/desafio-1.git
    cd desafio-1
    ```

2. **Instala las dependencias de PHP**

    ```bash
    composer install
    ```

3. **Copia el archivo de entorno y configura tus variables**

    ```bash
    cp .env.example .env
    ```

    Edita el archivo `.env` y configura la conexión a tu base de datos:

    ```
    DB_DATABASE=nombre_de_tu_bd
    DB_USERNAME=tu_usuario
    DB_PASSWORD=tu_password
    ```

4. **Genera la clave de la aplicación**

    ```bash
    php artisan key:generate
    ```

5. **Ejecuta las migraciones de la base de datos**

    ```bash
    php artisan migrate
    ```

6. **Inicia el servidor de desarrollo**
    ```bash
    php artisan serve
    ```
    El proyecto estará disponible en [http://localhost:8000](http://localhost:8000)

---

## Notas adicionales

-   Si usas Laragon, asegúrate de que los servicios de Apache/MySQL estén activos.
-   Para pruebas de API, puedes usar Postman y la colección incluida en este repositorio.
-   Si tienes problemas con permisos, ejecuta los comandos con privilegios de administrador o ajusta los permisos de las carpetas `storage` y `bootstrap/cache`:
    ```bash
    chmod -R 775 storage bootstrap/cache
    ```

---

## Documentación de la API

### Variables de entorno

-   `{{domain}}`: Dominio base de la API (ejemplo: http://localhost:8000)
-   `{{token}}`: Token Bearer de autenticación (obtenido tras login)

---

### **Autenticación**

#### 1. Login

-   **Endpoint:** `POST /login`
-   **Headers:**
    -   Accept: application/json
    -   Content-Type: application/json
-   **Body (form-data):**
    -   `email`: string
    -   `password`: string
-   **Respuesta:**
    -   Token de autenticación

#### 2. Register

-   **Endpoint:** `POST /register`
-   **Headers:**
    -   Accept: application/json
    -   Content-Type: application/json
-   **Body (form-data):**
    -   `name`: string
    -   `email`: string
    -   `password`: string
    -   `password_confirmation`: string
-   **Respuesta:**
    -   Usuario creado y token

#### 3. Logout

-   **Endpoint:** `POST /logout`
-   **Headers:**
    -   Accept: application/json
    -   Content-Type: application/json
-   **Body (form-data):**
    -   (igual que register, aunque normalmente solo requiere el token)
-   **Respuesta:**
    -   Sesión cerrada

---

### **Monedas** (Requiere autenticación Bearer)

#### 1. Listar monedas

-   **Endpoint:** `GET /monedas`
-   **Headers:**
    -   Authorization: Bearer {{token}}
    -   Accept: application/json

#### 2. Crear moneda

-   **Endpoint:** `POST /monedas`
-   **Headers:**
    -   Authorization: Bearer {{token}}
    -   Accept: application/json
    -   Content-Type: application/json
-   **Body (JSON):**
    ```json
    {
        "nombre": "Dolar",
        "simbolo": "$",
        "pais": "Estados Unidos"
    }
    ```

#### 3. Ver moneda

-   **Endpoint:** `GET /monedas/{id}`
-   **Headers:**
    -   Authorization: Bearer {{token}}
    -   Accept: application/json

#### 4. Actualizar moneda

-   **Endpoint:** `PATCH /monedas/{id}`
-   **Headers:**
    -   Authorization: Bearer {{token}}
    -   Accept: application/json
    -   Content-Type: application/json
-   **Body (JSON):**
    ```json
    {
        "nombre": "Euro",
        "simbolo": "E",
        "pais": "España"
    }
    ```

#### 5. Eliminar moneda

-   **Endpoint:** `DELETE /monedas/{id}`
-   **Headers:**
    -   Authorization: Bearer {{token}}
    -   Accept: application/json

---

### **Criptomonedas**

#### 1. Listar criptomonedas

-   **Endpoint:** `GET /criptomonedas`
-   **Headers:**
    -   Accept: application/json

#### 2. Listar criptomonedas por moneda

-   **Endpoint:** `GET /criptomonedas?moneda_id={id}`
-   **Headers:**
    -   Accept: application/json

#### 3. Crear criptomoneda

-   **Endpoint:** `POST /criptomonedas`
-   **Headers:**
    -   Authorization: Bearer {{token}}
    -   Accept: application/json
    -   Content-Type: application/json
-   **Body (JSON):**
    ```json
    {
        "nombre": "Bitcoin",
        "simbolo": "BTC",
        "tecnologia": "Blockchain",
        "monedas": [
            { "id": 1, "precio": 2836 },
            { "id": 2, "precio": 20 }
        ]
    }
    ```

#### 4. Ver criptomoneda

-   **Endpoint:** `GET /criptomonedas/{id}`
-   **Headers:**
    -   Accept: application/json

#### 5. Actualizar criptomoneda

-   **Endpoint:** `PATCH /criptomonedas/{id}`
-   **Headers:**
    -   Authorization: Bearer {{token}}
    -   Accept: application/json
    -   Content-Type: application/json
-   **Body (JSON):**
    ```json
    {
        "nombre": "Bitcoin",
        "simbolo": "BTC",
        "tecnologia": "Blockchain",
        "monedas": [
            { "id": 1, "precio": 2836 },
            { "id": 2, "precio": 20 }
        ]
    }
    ```

#### 6. Eliminar criptomoneda

-   **Endpoint:** `DELETE /criptomonedas/{id}`
-   **Headers:**
    -   Authorization: Bearer {{token}}
    -   Accept: application/json

---

Para más detalles y pruebas, puedes importar la colección de Postman:  
[Enlace a la colección](https://www.postman.com/buisuch-4641/workspace/prueba/collection/12080732-84ffb539-d769-442d-9dc0-6da4fa97561a?action=share&source=collection_link&creator=12080732)
