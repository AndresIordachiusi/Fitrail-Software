# Aplicación CRUD con Laravel - Sistema de Gestión de Gimnasio - Maquinistas

## Finalidad de la aplicación
 
La aplicación implementa un sistema completo de gestión para un gimnasio que permite **crear, listar, editar y eliminar** diversas entidades de forma sencilla mediante una interfaz web intuitiva. El sistema gestiona clientes, planes de suscripción, sedes, entrenadores, entrenamientos y reservas, con todas sus relaciones correspondientes.


## Pasos para arrancar el proyecto - Code Review 2

1. Clonar el Repositorio https://gitlab.com/maquinistas/fitrail-software.git.
2. git switch calender_api_fitrail y confirmar con un git pull los cambios más recientes.
2. Si en tu maquina ya existe un archivo laravel, debe cambiarlo de nombre.
3. Usar make fix-perms.
4.Ejecutar make npm cmd="install" y make composer cmd="install"
5. Importar la base de datos SQL proporcionada.
6. No deberia tener ningun problema con el archivo .env, ya que en nuestro caso por facilidad no lo ocultamos en .gitIgnore,
igualmente adjuntamos la configuracion.

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=fitrail
DB_USERNAME=root
DB_PASSWORD=root

6. Si ha entrado correctamente, debe dirigirse a http://localhost:8001/, registrarse si no lo ha hecho.

## Resumen del desarrollo del proyecto actual: 

1. Ya está implementado un sistema de autenticación con verificación de email y control de acceso por rol (`admin`, `client`, `entrenador`) mediante middlewares personalizados.
2. El alta inicial de administrador se mantiene vía seeder (`database/seeders/DatabaseSeeder.php`) con credenciales base:
  - Email: `admin@fitrail.com`
  - Password: `password`
3. El administrador dispone de dashboard con métricas (totales, últimas reservas, próximos entrenamientos, planes más contratados e ingresos potenciales) y CRUD completo para:
  - clientes, sedes, planes, entrenadores, entrenamientos, reservas, seguimientos y usuarios.
4. El flujo de cliente está activo de extremo a extremo:
  - registro + creación automática del perfil cliente,
  - paso de selección/compra de plan,
  - dashboard con entrenamientos disponibles,
  - reservas confirmadas,
  - cancelación de reservas con devolución de capacidad.
5. La compra de planes está integrada con Stripe Checkout y, tras pago correcto, se actualiza el pivot `client_plan` (desactivando plan anterior y activando el nuevo con vigencia mensual).
6. El dashboard de entrenador ya muestra sus entrenamientos y las clases con reservas confirmadas asociadas a su cuenta.
7. Se añadió la entidad **Seguimientos** (tabla, modelo, controlador y vistas) para registrar evolución del cliente (peso, altura, IMC, energía, adherencia, progreso, observaciones y próximos pasos).
8. La home pública consume contenido desde Contentful (cabeceras + listados de planes y entrenamientos), manteniendo contenido editable desde CMS.
9. Existe endpoint API para chatbot (`/api/dialogflow`) con respuestas por intención (saludo, planes, clases, etc.).
10. Estado general: el núcleo funcional del sistema (roles, CRUD principal, reservas, planes/pagos y seguimiento) está operativo y consolidado para demostración funcional.

### Integración de APIs y capa visual

En esta fase se ha trabajado especialmente la integración con servicios externos y el acabado visual del frontend.

#### Integraciones API activas

- **Stripe Checkout**
  - Flujo implementado en `PaymentController`: creación de sesión de pago, redirección a Stripe, retorno por `success`/`cancel` y activación del plan en `client_plan`.
  - Rutas principales: `POST /checkout/{plan}`, `GET /success/{plan}`, `GET /cancel`.
  - Configuración esperada en `.env`: `STRIPE_KEY` y `STRIPE_SECRET`.

- **Contentful (CMS)**
  - La home pública (`/`) carga cabeceras, planes y entrenamientos desde Contentful en `ContentfulController`.
  - Esto permite actualizar contenido de portada sin tocar código.
  - Variables de entorno usadas por la integración: `CONTENTFUL_SPACE_ID`, `CONTENTFUL_ENVIRONMENT_ID`, `CONTENTFUL_DELIVERY_TOKEN`, `CONTENTFUL_USE_PREVIEW`.

- **Dialogflow / chatbot**
  - Endpoint backend disponible en `POST /api/dialogflow` para responder por intención.
  - Widget de mensajería integrado en layouts (`df-messenger`) para acceso directo al asistente desde la UI.

#### Estilos y frontend (Tailwind)

- Se mantiene una UI consistente en modo oscuro con utilidades de **Tailwind CSS** sobre Blade.
- El proyecto usa `tailwind.config.js` con paleta extendida (base/surface/accent/muted), tipografía Geist y plugin `@tailwindcss/forms`.
- En `resources/css/app.css` se han añadido componentes reutilizables (`fit-card`, `fit-button-primary`, `fit-button-ghost`, etc.) y ajustes visuales del chatbot.
- El frontend se compila con Vite (`resources/css/app.css` + `resources/js/app.js`) y se han aplicado animaciones de entrada/scroll con GSAP para mejorar la experiencia en la home.


**Comandos Artisan utilizados**

Hemos usado comandos básicos para crear modelos y hacer migraciones sobre bbdd.

**Crear los modelos y las migraciones para las tablas**

 make art cmd="make:model Client -m"
 make art cmd="make:model Sede -m"
 make art cmd="make:model Plan -m"
 make art cmd="make:model Entrenador -m"
 make art cmd="make:model Entrenamiento -m"
 make art cmd="make:model Reserva -m"

**Ejecutar las migraciones para crear las tablas en la base de datos**

  Usamos el comando make art cmd="migrate"

**Organización del proyecto**

El proyecto está organizado siguiendo el patrón MVC (Modelo-Vista-Controlador) con las siguientes entidades principales:

## Modelos y sus relaciones

### Modelo (Client.php)

El modelo `Client` se encuentra en `app/Models/Client.php` y representa la entidad Cliente en la base de datos.

Aquí se define el array `$fillable` con los campos rellenables:

(nombre, email, edad, altura, peso, objetivo, password)

**Relaciones:**
- `belongsToMany(Plan::class)` - Un cliente puede tener múltiples planes y un plan puede tener múltiples clientes (relación muchos a muchos a través de la tabla pivot `client_plan`).
- `hasMany(Reserva::class)` - Un cliente puede tener múltiples reservas.

### Modelo (Sede.php)

El modelo `Sede` se encuentra en `app/Models/Sede.php` y representa las sedes o sucursales del gimnasio.

Campos rellenables: direccion, telefono, ciudad, horario_apertura, horario_cierre.

**Relaciones:**
- `hasMany(Entrenador::class)` - Una sede puede tener múltiples entrenadores.

### Modelo (Plan.php)

El modelo `Plan` se encuentra en `app/Models/Plan.php` y representa los planes de suscripción disponibles.

Campos rellenables: nombre, descripcion, precio.

**Relaciones:**
- `belongsToMany(Client::class)` - Un plan puede ser contratado por múltiples clientes (relación muchos a muchos).

### Modelo (Entrenador.php)

El modelo `Entrenador` se encuentra en `app/Models/Entrenador.php` y representa a los entrenadores del gimnasio.

Campos rellenables: nombre, email, telefono, direccion, especialidad, password, sede_id.

**Relaciones:**
- `belongsTo(Sede::class)` - Un entrenador pertenece a una sede específica.
- `hasMany(Entrenamiento::class)` - Un entrenador puede impartir múltiples entrenamientos.

### Modelo (Entrenamiento.php)

El modelo `Entrenamiento` se encuentra en `app/Models/Entrenamiento.php` y representa las sesiones de entrenamiento disponibles.

Campos rellenables: nombre, descripcion, capacidad, fecha_inicio, fecha_fin, entrenador_id.

**Relaciones:**
- `belongsTo(Entrenador::class)` - Un entrenamiento es impartido por un entrenador.
- `hasMany(Reserva::class)` - Un entrenamiento puede tener múltiples reservas.

### Modelo (Reserva.php)

El modelo `Reserva` se encuentra en `app/Models/reserva.php` y representa las reservas de los clientes para los entrenamientos.

Campos rellenables: client_id, entrenamiento_id, estado, fecha_reserva.

**Relaciones:**
- `belongsTo(Client::class)` - Una reserva pertenece a un cliente.
- `belongsTo(Entrenamiento::class)` - Una reserva pertenece a un entrenamiento específico.


## Controladores

Los controladores están ubicados en `app/Http/Controllers/` y gestionan toda la lógica del CRUD para cada entidad del sistema. Todos los controladores (ClientController, SedeController, PlanController, EntrenadorController, EntrenamientoController y ReservaController) siguen la misma estructura y patrón de implementación.

### Métodos implementados en todos los controladores

**`index()`**: Obtiene todos los registros de la entidad mediante `Entidad::all()` y los envía a la vista `index.blade.php` para mostrarlos en una tabla.

**`create()`**: Muestra el formulario para crear un nuevo registro cargando la vista `create.blade.php`. En controladores con relaciones (como EntrenadorController, EntrenamientoController y ReservaController), también se obtienen las entidades relacionadas necesarias para los selectores del formulario mediante `Entidad::all()`.

**`store()`**: Valida los datos del formulario mediante `$request->validate()` con reglas específicas para cada entidad y crea un nuevo registro en la base de datos. Las contraseñas se encriptan con `bcrypt()` antes de guardarlas (en clientes y entrenadores). Finalmente redirige al listado con un mensaje de confirmación.

**`edit($id o Entidad $entidad)`**: Busca el registro por su ID mediante `findOrFail()` o utiliza route model binding para inyectar la entidad directamente. Carga la vista `update.blade.php` con los datos actuales del registro. En controladores con relaciones, también obtiene las entidades relacionadas para los selectores.

**`update($id o Request $request, Entidad $entidad)`**: Valida los datos del formulario de edición y actualiza el registro en la base de datos. Las contraseñas solo se actualizan si se proporciona una nueva. Para campos únicos como emails, se excluye el ID actual de la validación de unicidad. Redirige al listado después de actualizar.

**`destroy($id o Entidad $entidad)`**: Elimina el registro de la base de datos mediante `delete()` y redirige al listado con un mensaje de confirmación.

### Particularidades específicas por controlador

**ClientController y EntrenadorController:** Implementan encriptación de contraseñas con `bcrypt()` y permiten contraseñas opcionales en la edición.

**SedeController:** Valida que la hora de cierre sea posterior a la hora de apertura, y que la ciudad sea Tarragona o Barcelona.

**EntrenadorController:** Valida especialidades predefinidas (Musculación, CrossFit, Funcional, Yoga, Rehabilitación) y la existencia de la sede asignada.

**EntrenamientoController:** Valida que la capacidad esté entre 1 y 30 personas, que la fecha de fin sea posterior a la fecha de inicio, y la existencia del entrenador asignado.

**ReservaController:** Valida la existencia del cliente y entrenamiento seleccionados, y actualmente incluye flujo completo de `create`, `store`, `edit`, `update` y `destroy`.


### **Rutas, middlewares y protección de acceso (fase actual)**

En esta fase hemos reforzado la seguridad de navegación y acceso con autenticación, verificación de email y autorización por rol.

#### Middleware de rol personalizados

Se han creado y registrado los siguientes middlewares en `app/Http/Middleware/` y `bootstrap/app.php`:

- `admin` (`IsAdmin`)  
- `client` (`IsClient`)  
- `entrenador` (`IsEntrenador`)

Cada uno comprueba `auth()->check()` y el valor de `auth()->user()->role`. Si no cumple, se devuelve `403`.

#### Protección de rutas por tipo de usuario

- `/` solo para usuarios no autenticados (`guest`).
- `/dashboard` protegido con `auth` + `verified`.
- Dashboard específico por rol:
  - `admin/dashboard` → middleware `auth, admin`
  - `clients/dashboard` → middleware `auth, client`
  - `entrenadors/dashboard` → middleware `auth, entrenador`

#### CRUD protegidos por permisos

- **Administrador** (`/admin/*`): acceso total mediante `Route::resource` a clientes, sedes, planes, entrenadores, entrenamientos, reservas y usuarios.
- **Entrenador** (`/entrenador/*`): CRUD de entrenamientos bajo middleware `auth, entrenador`.
- **Perfil de usuario** (`/profile`): edición, actualización y eliminación protegidas con `auth`.

Con esta estructura, cada rol ve solo sus rutas y funcionalidades autorizadas.


## **Vistas**

Las vistas están organizadas en carpetas separadas dentro de `resources/views/` según cada entidad y utilizan Blade como motor de plantillas.

### Estructura de vistas por entidad

**`layout.blade.php`**: Plantilla principal que define la estructura base de la aplicación. Las demás vistas extienden de esta mediante `@extends('layout')`.

Todas las entidades del sistema (clientes, sedes, planes, entrenadores, entrenamientos y reservas) siguen una estructura de vistas consistente organizada en sus respectivas carpetas dentro de `resources/views/`:

**`index.blade.php`**: Muestra el listado completo de registros en una tabla con todos sus datos relevantes. Incluye un botón para añadir nuevos registros y columnas con acciones para editar y eliminar cada elemento.

**`create.blade.php`**: Vista que contiene el formulario para crear un nuevo registro. Incluye parciales con formularios reutilizables (`_form.blade.php`) que contienen todos los campos necesarios según la entidad. En el caso de entidades con relaciones (como entrenadores con sedes, o entrenamientos con entrenadores), se muestran selectores desplegables para elegir las entidades relacionadas.

**`update.blade.php`**: Vista que muestra el formulario para editar un registro existente. Utiliza parciales de formulario (`_formupdate.blade.php` o `_form.blade.php`) y `@method('PUT')` para indicar que es una actualización. Los datos actuales se pre-cargan usando `old('campo', $entidad->campo)`. En campos sensibles como contraseñas, estos son opcionales durante la edición, manteniéndose el valor actual si no se proporciona uno nuevo.

## Funcionamiento de la aplicación

La aplicación funciona como un sistema completo de gestión de gimnasio con operaciones CRUD (Crear, Leer, Actualizar, Eliminar) implementadas para todas las entidades del sistema.

### Flujo general de operaciones

**Listar registros:**
Cada entidad muestra un listado completo en su vista `index.blade.php` con todos sus datos relevantes en formato de tabla. Cada fila incluye una columna de acciones con botones para editar y eliminar.

**Crear un registro:**
Al hacer clic en el botón de "Añadir" (Cliente, Sede, Plan, etc.), se carga el formulario de creación correspondiente donde se introducen todos los datos requeridos. Los datos se validan en el controlador mediante `$request->validate()` con reglas específicas para cada entidad. Si la validación es correcta, se guarda el nuevo registro y se redirige al listado con un mensaje de confirmación.

**Editar un registro:**
Al hacer clic en "Editar", se carga el formulario de edición con los datos actuales del registro ya pre-cargados mediante route model binding. Tras la validación y actualización, se redirige al listado.

**Eliminar un registro:**
Al hacer clic en "Eliminar", aparece un modal de confirmación mostrando información del registro. Si se confirma, se envía un formulario con el método DELETE que ejecuta la eliminación en el controlador y redirige al listado.

### Validaciones específicas por entidad

**Clientes:** Validación de edad mínima (15 años), altura (1.40-2.10m), peso (40-200kg), objetivos predefinidos y contraseñas encriptadas con `bcrypt()`.

**Sedes:** Validación de horarios en formato HH:MM, verificación de que la hora de cierre sea posterior a la apertura, y ciudades limitadas a Tarragona o Barcelona.

**Planes:** Validación de longitud de campos (nombre máx. 100 caracteres, descripción máx. 500) y precio numérico positivo menor a 9999.99.

**Entrenadores:** Validación de especialidades predefinidas (Musculación, CrossFit, Funcional, Yoga, Rehabilitación), verificación de existencia de la sede asignada, y emails únicos.

**Entrenamientos:** Validación de capacidad entre 1 y 30 personas, verificación de que la fecha de fin sea posterior a la fecha de inicio, y validación de existencia del entrenador asignado.

**Reservas:** Validación de existencia del cliente y entrenamiento seleccionados en sus respectivas tablas.

### Relaciones entre entidades

El sistema implementa las siguientes relaciones:

**Clientes y Planes (Muchos a Muchos):**
Un cliente puede contratar múltiples planes y un plan puede ser contratado por múltiples clientes.
La tabla pivot `client_plan` almacena la relación con campos adicionales: fecha_inicio, fecha_fin y estado.

**Sedes y Entrenadores (Uno a Muchos):**
Una sede puede tener múltiples entrenadores, pero cada entrenador pertenece a una única sede.

**Entrenadores y Entrenamientos (Uno a Muchos):**
Un entrenador puede impartir múltiples entrenamientos, pero cada entrenamiento es impartido por un único entrenador.

**Clientes y Reservas (Uno a Muchos):**
Un cliente puede hacer múltiples reservas.

**Entrenamientos y Reservas (Uno a Muchos):**
Un entrenamiento puede tener múltiples reservas (limitadas por su capacidad).

## Capturas de pantalla

  ### Entidad Usuarios

<img src="public/images/Entidad - Clientes/Listar.png" height="230px">

<img src="public/images/Entidad - Clientes/Crear.png" height="230px">

<img src="public/images/Entidad - Clientes/Editar.png" height="230px">

<img src="public/images/Entidad - Clientes/Eliminar.png" height="230px">

### Entidad Entrenadores

<img src="public/images/Entidad - Entrenadores/Listar.png" height="150px">

<img src="public/images/Entidad - Entrenadores/Crear.png" height="150px">

<img src="public/images/Entidad - Entrenadores/Editar.png" height="150px">

<img src="public/images/Entidad - Entrenadores/Eliminar.png" height="150px">

### Entidad Sedes

<img src="public/images/Entidad - Sedes/Listar.png" height="150px">

<img src="public/images/Entidad - Sedes/Crear.png" height="150px">

<img src="public/images/Entidad - Sedes/Editar.png" height="150px">

<img src="public/images/Entidad - Sedes/Eliminar.png" height="150px">

### Entidad Planes

<img src="public/images/Entidad - Planes/Listar.png" height="150px">

<img src="public/images/Entidad - Planes/Crear.png" height="150px">

<img src="public/images/Entidad - Planes/Editar.png" height="150px">

<img src="public/images/Entidad - Planes/Eliminar.png" height="150px">

### Entidad Entrenamientos

<img src="public/images/Entidad - Entrenamientos/Listar.png" height="150px">

<img src="public/images/Entidad - Entrenamientos/Crear.png" height="150px">

<img src="public/images/Entidad - Entrenamientos/Editar.png" height="150px">

<img src="public/images/Entidad - Entrenamientos/Eliminar.png" height="150px">

### Entidad Reserva

<img src="public/images/Entidad - Reserva/Listar.png" height="150px">

<img src="public/images/Entidad - Reserva/Crear.png" height="150px">

<img src="public/images/Entidad - Reserva/Editar.png" height="150px">

<img src="public/images/Entidad - Reserva/Eliminar.png" height="150px">