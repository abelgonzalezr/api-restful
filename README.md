### Prerrequisitos

- PHP >= 7.3
- Composer
- MySQL

### Instalación

1. Clona el repositorio:
    ```sh
    git clone https://github.com/abelgonzalezr/api-restful
    cd api-restful
    ```

2. Instala las dependencias:
    ```sh
    composer install
    ```

3. Copia el archivo `.env.example` a `.env` y actualiza tus variables de entorno:
    ```sh
    cp .env.example .env
    ```

4. Genera la clave de la aplicación:
    ```sh
    php artisan key:generate
    ```

5. Corre las migraciones:
    ```sh
    php artisan migrate
    ```

6. Inicia el servidor de desarrollo:
    ```sh
    php artisan serve
    ```

### Probando los Endpoints

Puedes probar los endpoints usando herramientas como Postman o cURL. A continuación se muestran los endpoints disponibles:

- **Obtener todos los clientes**
    ```sh
    GET /api/clientes
    ```

- **Obtener todos los artículos**
    ```sh
    GET /api/articulos
    ```

- **Obtener todos los pedidos**
    ```sh
    GET /api/pedidos
    ```

- **Obtener todas las facturas**
    ```sh
    GET /api/facturas
    ```

- **Obtener todos los usuarios**
    ```sh
    GET /api/usuarios
    ```



