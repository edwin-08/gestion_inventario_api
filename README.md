# Gestión Inventario API

API RESTful desarrollada con Laravel para la gestión de inventarios, con autenticación mediante tokens Bearer. Permite administrar productos, usuarios, categorías y control de sesión.

Repositorio: [https://github.com/edwin-08/gestion_inventario_api.git](https://github.com/edwin-08/gestion_inventario_api.git)

---

## Contenido

- [Requisitos Previos](#requisitos-previos)
- [Instalación y Configuración](#instalación-y-configuración)
- [Ejecución del Proyecto](#ejecución-del-proyecto)
- [Migraciones y Seeders](#migraciones-y-seeders)
- [Uso de la API](#uso-de-la-api)
- [Arquitectura por Capas](#arquitectura-por-capas)


---

## Requisitos Previos

- PHP >= 8.x
- Laravel >= 10.x
- Composer
- Servidor de base de datos (MySQL o compatible)
- Git

---

## Instalación y Configuración

1. **Clonar el repositorio**
- git clone https://github.com/edwin-08/gestion_inventario_api.git
- cd gestion_inventario_api

2. **Instalar dependencias**
- composer install

3. **Copiar archivo de configuración de entorno**
- cp .env.example .env

4. **Generar clave de aplicación**
- php artisan key:generate

5. **Migraciones y Seeders**
Para crear las tablas necesarias y datos iniciales, ejecuta:

- php artisan migrate
- php artisan db:seed

6. **Ejecución del Proyecto**
Para levantar el servidor local de desarrollo:

- php artisan serve

Por defecto, estará disponible en:
http://localhost:8000


---


# Documentación de la API - Inventario_Api

## Descripción General
Esta API RESTful gestiona un sistema de inventario con autenticación mediante tokens Bearer.  
Permite la administración de productos, usuarios, categorías, y control de sesión (login/logout).


## Despliegue de la Api
El código fuente está desplegado en la siguiente dirección:

https://gestion-inventario-api.up.railway.app/

---


## Ubicación del archivo de configuración
\public\postman\Inventario_Api.postman_collection.json

---

## Configuración para usar un entorno (Environment) con variable {{bearer_token}}
- En la esquina superior derecha de Postman haz clic en "Environments" (ícono de engranaje).
- Crea un entorno (ejm: Laravel API).
- Añade una variable llamada bearer_token
- Valor: vacio (Se asigna automaticamente al realizar la solicitud de autenticación)
- Guarda y selecciona este entorno activo (en el desplegable superior derecho).

- Luego, en cada solicitud:
- Ve a la pestaña Authorization.
- Selecciona Type: Bearer Token.
- En el campo Token, pon: {{bearer_token}}


---


## Configuración de script para actualizar la variable de entorno {{bearer_token}}
En la url designada para la autenticación (Login), se configura un script para que se ejecute cada vez que reciba una respuesta válida y actualice automáticamente el bearer_token para las demás solicitudes.

- En la sección de Scrips pegar la siguiente configuración:
- const res = pm.response.json();
- pm.environment.set("bearer_token", res.access_token);

Con esta configuración el bearer_token se actualizará cada vez que se retorne una respuesta válida desde el backend y será visible para el resto de endpoints configurados.


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

curl -X POST https://gestion-inventario-api.up.railway.app/api/login \
-H "Content-Type: application/json" \
-d '{"email":"admin@gmail.com", "password":"12345678"}'

---

# Arquitectura por Capas

Para mantener el código limpio, fácil de escalar y sencillo de mantener, en el proyecto **Inventario_Api** hemos organizado todo usando una arquitectura por capas, donde cada parte tiene su responsabilidad bien definida:

## 1. Controller (Capa de Entrada)  
Aquí es donde llegan las solicitudes HTTP. El controlador se encarga de recibir esas peticiones, coordinar qué se debe hacer y pasar el trabajo a las capas inferiores. Su función principal es manejar el flujo de datos y devolver respuestas en formato JSON. Eso sí, no debe contener lógica de negocio; solo es quien recibe y responde.

## 2. Service (Capa de Lógica de Negocio)  
Esta capa es donde reside toda la lógica compleja y las reglas del negocio. Aquí se procesan los datos, se validan las reglas y se coordinan las operaciones entre distintos componentes. Usamos el patrón *Service Layer* para centralizar esta lógica y que pueda reutilizarse fácilmente.

## 3. Repository (Capa de Acceso a Datos)  
El repositorio se encarga de toda la interacción con la base de datos. Aquí hacemos las consultas, filtros, búsquedas y operaciones específicas sobre los datos. Gracias al patrón *Repository*, desacoplamos la forma en que accedemos a la información del resto del sistema, lo que ayuda a mantener el código limpio y organizado.

## 4. Modelos (Eloquent / ORM)  
Los modelos representan las entidades de nuestro dominio y gestionan la interacción directa con la base de datos. Definen las relaciones, atributos y también pueden incluir lógica sencilla relacionada con cómo se guardan o recuperan los datos. Además, podemos extenderlos usando *Scopes*, *Accessors* y *Mutators* para añadir funcionalidades extras.

## 5. Request / Response (DTOs, FormRequests)  
- Los *FormRequests* se encargan de validar y autorizar los datos que llegan desde el cliente.  
- Por otro lado, los *Resources* (o DTOs) se usan para darle forma y transformar la información que enviamos en la respuesta de la API.  
Este enfoque sigue el patrón *DTO* (Data Transfer Object), que ayuda a manejar de manera estructurada la transferencia de datos entre capas y hacia afuera, asegurando que todo llegue en el formato correcto.