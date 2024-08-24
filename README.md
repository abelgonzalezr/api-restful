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
    ```sh
    curl -X GET http://localhost:8000/api/clientes
    ```

- **Crear un nuevo cliente**
    ```sh
    POST /api/clientes
    ```
    ```sh
    curl -X POST http://localhost:8000/api/clientes -H "Content-Type: application/json" -d '{"nombre": "abel", "telefono": "8293798435", "tipo_cliente": "nuevo"}'
    ```

- **Actualizar un cliente**
    ```sh
    PUT /api/clientes/{id}
    ```
    ```sh
    curl -X PUT http://localhost:8000/api/clientes/{id} -H "Content-Type: application/json" -d '{"nombre": "updated name", "telefono": "8293798436", "tipo_cliente": "vip"}'
    ```

- **Eliminar un cliente**
    ```sh
    DELETE /api/clientes/{id}
    ```
    ```sh
    curl -X DELETE http://localhost:8000/api/clientes/{id}
    ```

- **Obtener todos los artículos**
    ```sh
    GET /api/articulos
    ```
    ```sh
    curl -X GET http://localhost:8000/api/articulos
    ```

- **Crear un nuevo artículo**
    ```sh
    POST /api/articulos
    ```
    ```sh
    curl -X POST http://localhost:8000/api/articulos -H "Content-Type: application/json" -d '{"codigo_barras": "1234567890123", "descripcion": "Descripción del artículo de prueba", "fabricante": "Fabricante de prueba"}'
    ```

- **Actualizar un artículo**
    ```sh
    PUT /api/articulos/{id}
    ```
    ```sh
    curl -X PUT http://localhost:8000/api/articulos/{id} -H "Content-Type: application/json" -d '{"codigo_barras": "9876543210987", "descripcion": "Descripción actualizada", "fabricante": "Fabricante actualizado"}'
    ```

- **Eliminar un artículo**
    ```sh
    DELETE /api/articulos/{id}
    ```
    ```sh
    curl -X DELETE http://localhost:8000/api/articulos/{id}
    ```

- **Obtener todos los pedidos**
    ```sh
    GET /api/pedidos
    ```
    ```sh
    curl -X GET http://localhost:8000/api/pedidos
    ```

- **Crear un nuevo pedido**
    ```sh
    POST /api/pedidos
    ```
    ```sh
    curl -X POST http://localhost:8000/api/pedidos -H "Content-Type: application/json" -d '{"ClienteId": 1, "fecha": "2023-10-01"}'
    ```

- **Actualizar un pedido**
    ```sh
    PUT /api/pedidos/{id}
    ```
    ```sh
    curl -X PUT http://localhost:8000/api/pedidos/{id} -H "Content-Type: application/json" -d '{"ClienteId": 1, "fecha": "2023-09-25"}'
    ```

- **Eliminar un pedido**
    ```sh
    DELETE /api/pedidos/{id}
    ```
    ```sh
    curl -X DELETE http://localhost:8000/api/pedidos/{id}
    ```

- **Obtener todas las facturas**
    ```sh
    GET /api/facturas
    ```
    ```sh
    curl -X GET http://localhost:8000/api/facturas
    ```

- **Crear una nueva factura**
    ```sh
    POST /api/facturas
    ```
    ```sh
    curl -X POST http://localhost:8000/api/facturas -H "Content-Type: application/json" -d '{"PedidoId": 1, "monto_total": 100.50, "fecha_emision": "2023-10-01"}'
    ```

- **Actualizar una factura**
    ```sh
    PUT /api/facturas/{id}
    ```
    ```sh
    curl -X PUT http://localhost:8000/api/facturas/{id} -H "Content-Type: application/json" -d '{"PedidoId": 1, "monto_total": 200.75, "fecha_emision": "2023-09-25"}'
    ```

- **Eliminar una factura**
    ```sh
    DELETE /api/facturas/{id}
    ```
    ```sh
    curl -X DELETE http://localhost:8000/api/facturas/{id}
    ```

- **Obtener todos los usuarios**
    ```sh
    GET /api/usuarios
    ```
    ```sh
    curl -X GET http://localhost:8000/api/usuarios
    ```

- **Crear un nuevo usuario**
    ```sh
    POST /api/usuarios
    ```
    ```sh
    curl -X POST http://localhost:8000/api/usuarios -H "Content-Type: application/json" -d '{"username": "testuser", "password": "password123", "cedula": "1234567890", "telefono": "0987654321", "tipo_sangre": "A+"}'
    ```

- **Actualizar un usuario**
    ```sh
    PUT /api/usuarios/{id}
    ```
    ```sh
    curl -X PUT http://localhost:8000/api/usuarios/{id} -H "Content-Type: application/json" -d '{"username": "updateduser", "telefono": "9876543210", "tipo_sangre": "B-"}'
    ```

- **Eliminar un usuario**
    ```sh
    DELETE /api/usuarios/{id}
    ```
    ```sh
    curl -X DELETE http://localhost:8000/api/usuarios/{id}
    ```

### Corriendo las Pruebas

Para correr las pruebas, utiliza el siguiente comando:
```sh
 php artisan test
```
