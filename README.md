# Documentación de la API - Inventario_Api

## Descripción General
Esta API RESTful gestiona un sistema de inventario con autenticación mediante tokens Bearer.  
Permite la administración de productos, usuarios, categorías, y control de sesión (login/logout).

---

## Endpoints por Módulo

### 1. Productos (`/api/products`)

| Método | Ruta             | Descripción                       | Autenticación       | Parámetros principales                                  |
|--------|------------------|---------------------------------|---------------------|--------------------------------------------------------|
| GET    | `/products`      | Obtiene la lista de productos   | Requiere token      | —                                                      |
| POST   | `/products`      | Crea un nuevo producto           | Requiere token      | `name` (string), `description` (string), `category_id` (int), `price` (number), `stock` (int) |
| PUT    | `/products/{id}` | Actualiza un producto existente | Requiere token      | `name`, `description`, `category_id`, `price`, `stock` (todos en JSON)                |
| DELETE | `/products/{id}` | Elimina un producto por ID       | Requiere token      | —                                                      |

---

### 2. Usuarios (`/api/users` y `/api/user`)

| Método | Ruta             | Descripción                           | Autenticación       | Parámetros principales                               |
|--------|------------------|-------------------------------------|---------------------|-----------------------------------------------------|
| GET    | `/user`          | Obtiene información del usuario autenticado | Requiere token | —                                                   |
| GET    | `/users`         | Lista usuarios registrados           | Requiere token      | —                                                   |
| PUT    | `/users/{id}`    | Actualiza datos de un usuario        | Requiere token      | `name`, `email`, `password`, `rol` (en JSON)       |
| DELETE | `/users/{id}`    | Elimina un usuario por ID            | Requiere token      | —                                                   |
| POST   | `/register`      | Crea un nuevo usuario                | Requiere token      | `name`, `email`, `password`, `rol`                  |

---

### 3. Categorías (`/api/category`)

| Método | Ruta             | Descripción                         | Autenticación       | Parámetros principales                 |
|--------|------------------|-----------------------------------|---------------------|---------------------------------------|
| GET    | `/category`      | Lista todas las categorías         | Requiere token      | —                                     |
| POST   | `/category`      | Crea una nueva categoría           | Requiere token      | `name`, `description`                  |
| PUT    | `/category/{id}` | Actualiza una categoría existente  | Requiere token      | `name`, `description` (en JSON)        |
| DELETE | `/category/{id}` | Elimina una categoría por ID       | Requiere token      | —                                     |

---

### 4. Autenticación

| Método | Ruta           | Descripción                               | Parámetros                  |
|--------|----------------|-------------------------------------------|-----------------------------|
| POST   | `/login`       | Inicia sesión y recibe token Bearer       | `email`, `password`          |
| POST   | `/logout`      | Cierra sesión y revoca el token actual    | —                           |

---

## Notas de uso

- Todos los endpoints, excepto `/login`, requieren enviar el token Bearer válido en la cabecera `Authorization`.  
  Ejemplo: `Authorization: Bearer <tu_token>`

- El token se obtiene tras hacer login y debe almacenarse para autenticaciones posteriores.

- Los parámetros de creación y edición pueden enviarse en formato `form-data` o JSON según el endpoint.

---

## Ejemplo de llamada `curl` para login

```bash
curl -X POST https://tu-api.com/api/login \
-H "Content-Type: application/json" \
-d '{"email":"admin@gmail.com", "password":"12345678"}'