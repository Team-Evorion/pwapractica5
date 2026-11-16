# 📋 Gestión de Tareas UBE

### Sistema de gestión de proyectos por equipos | Programación Web Avanzada

**Gestión de Tareas UBE** es una aplicación web desarrollada como proyecto académico para la asignatura de **Programación Web Avanzada** de la Universidad Bolivariana del Ecuador.

La plataforma permite administrar usuarios, proyectos, equipos y tareas mediante un sistema de permisos basado en tres roles: **Administrador**, **Gerente de proyecto** y **Miembro del equipo**. Cada usuario dispone únicamente de las funciones y la información correspondientes a sus responsabilidades.

El proyecto integra frontend, backend y base de datos mediante Laravel y MySQL, con una interfaz moderna, animada y adaptable a computadoras, tablets y teléfonos.

---

## 🌐 Enlaces del proyecto

- **Repositorio:** [GitHub — Team-Evorion/pwapractica5](https://github.com/Team-Evorion/pwapractica5)
- **Aplicación publicada:** [https://pwapractica5ube.infinityfreeapp.com](https://pwapractica5ube.infinityfreeapp.com)

---

## ✨ Características principales

- Autenticación mediante correo electrónico y contraseña.
- Administración de usuarios y asignación de roles.
- Creación y organización de proyectos.
- Selección de gerentes e integrantes por proyecto.
- Creación, asignación y seguimiento de tareas.
- Estados de tarea: **Pendiente**, **En proceso** y **Completado**.
- Autorización mediante políticas de Laravel.
- Aislamiento de información entre proyectos y usuarios.
- Dashboard con indicadores generales y actividad reciente.
- Portada pública con información institucional.
- Páginas independientes para presentar los roles y el equipo.
- Interfaz responsive para computadoras y dispositivos móviles.
- Validaciones del lado del servidor.
- Pruebas automáticas de autenticación, permisos y operaciones CRUD.

---

## 👥 Roles y permisos

### Administrador

El Administrador dispone de control general sobre el sistema:

- Crear, editar y eliminar usuarios.
- Asignar los roles disponibles.
- Crear, editar y eliminar proyectos.
- Seleccionar al gerente de cada proyecto.
- Incorporar integrantes a los proyectos.
- Consultar todos los proyectos y tareas.
- Supervisar indicadores generales desde el dashboard.
- Cambiar el estado de cualquier tarea.

### Gerente de proyecto

El Gerente administra únicamente los proyectos que tiene asignados:

- Consultar sus proyectos.
- Revisar los integrantes de cada equipo.
- Crear, editar, asignar y eliminar tareas.
- Cambiar el estado de las tareas de sus proyectos.
- Supervisar el avance del trabajo asignado.

El Gerente no puede modificar proyectos ajenos ni administrar usuarios.

### Miembro del equipo

El Miembro participa en los proyectos a los que fue incorporado:

- Consultar sus proyectos.
- Visualizar las tareas asignadas a su cuenta.
- Cambiar el estado de sus tareas.
- Revisar la información necesaria para completar su trabajo.

El Miembro no puede modificar el contenido de una tarea, eliminarla ni consultar tareas pertenecientes a otros usuarios.

---

## 🛠️ Tecnologías utilizadas

| Tecnología | Aplicación |
|---|---|
| **Laravel 13** | Arquitectura backend, rutas, autenticación y autorización |
| **PHP 8.4** | Lógica del servidor |
| **MySQL / MariaDB** | Persistencia de usuarios, proyectos, roles y tareas |
| **Blade** | Plantillas y componentes de la interfaz |
| **Bootstrap 5.3** | Componentes y diseño responsive |
| **CSS3** | Identidad visual, animaciones y adaptación móvil |
| **JavaScript** | Confirmaciones e interacciones de la interfaz |
| **Vite** | Compilación y optimización de recursos frontend |
| **PHPUnit** | Pruebas automáticas |
| **Composer** | Administración de dependencias PHP |
| **Git y GitHub** | Control de versiones y colaboración |
| **InfinityFree** | Publicación académica de la aplicación |

---

## 🗄️ Modelo de datos

La base de datos principal se denomina `pwapractica5` y contiene las entidades necesarias para gestionar el sistema:

- `users`: usuarios, credenciales y rol asignado.
- `roles`: roles disponibles y alcance de cada usuario.
- `projects`: información general de los proyectos y su gerente.
- `tasks`: tareas, responsables, estados y proyectos relacionados.
- `project_user`: relación entre proyectos y miembros.
- `sessions`: sesiones de autenticación.
- `migrations`: control de las migraciones ejecutadas.

### Relaciones principales

- Un usuario pertenece a un rol.
- Un gerente puede administrar varios proyectos.
- Un proyecto puede contener varios integrantes.
- Un proyecto puede tener varias tareas.
- Cada tarea pertenece a un proyecto.
- Una tarea puede estar asignada a un miembro del equipo.

---

## 🏗️ Estructura del proyecto

```text
pwapractica5/
├── app/
│   ├── Http/
│   │   ├── Controllers/          # Controladores de la API
│   │   ├── Controllers/Web/      # Controladores de la interfaz
│   │   └── Requests/             # Validación y autorización
│   ├── Models/                   # Usuarios, roles, proyectos y tareas
│   └── Policies/                 # Reglas de acceso
├── bootstrap/                    # Inicialización de Laravel
├── config/                       # Configuración del sistema
├── database/
│   ├── factories/                # Datos para pruebas
│   ├── migrations/               # Estructura de la base de datos
│   └── seeders/                  # Roles y datos demostrativos
├── public/
│   ├── build/                    # Recursos compilados por Vite
│   ├── css/                      # Estilos públicos
│   └── js/                       # Interactividad
├── resources/
│   ├── css/                      # Código fuente de estilos
│   ├── js/                       # Código fuente JavaScript
│   └── views/
│       ├── auth/                 # Inicio de sesión
│       ├── layouts/              # Plantillas generales
│       ├── projects/             # Gestión de proyectos
│       ├── tasks/                # Gestión de tareas
│       ├── users/                # Gestión de usuarios
│       ├── dashboard.blade.php   # Panel principal
│       ├── team.blade.php        # Presentación del equipo
│       ├── roles.blade.php       # Presentación de roles
│       └── welcome.blade.php     # Portada pública
├── routes/                       # Rutas web y de la API
├── storage/                      # Archivos temporales y registros
├── tests/                        # Pruebas automáticas
├── composer.json
├── package.json
└── README.md
```

---

## 🚀 Instalación local con XAMPP

### Requisitos

- XAMPP con PHP 8.4 o superior.
- MySQL 8 o MariaDB 10.11.
- Composer.
- Node.js y npm.
- Git.
- Navegador web moderno.

### 1. Clonar el repositorio

```powershell
git clone https://github.com/Team-Evorion/pwapractica5.git
cd pwapractica5
```

También puedes descargar el proyecto y colocarlo en:

```text
C:\xampp\htdocs\pwapractica5
```

### 2. Instalar las dependencias de PHP

```powershell
composer install
```

### 3. Crear el archivo de configuración

```powershell
Copy-Item .env.example .env
php artisan key:generate
```

### 4. Configurar la base de datos

Crea en phpMyAdmin una base de datos denominada `pwapractica5`.

Después, configura estas variables en el archivo `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pwapractica5
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Crear las tablas y roles

```powershell
php artisan migrate --seed
```

### 6. Crear los datos de demostración

Este paso es opcional y está destinado a pruebas locales:

```powershell
php artisan db:seed --class=DemoDataSeeder
```

### 7. Instalar y compilar los recursos frontend

```powershell
npm install
npm run build
```

Para trabajar con actualización automática durante el desarrollo:

```powershell
npm run dev
```

### 8. Iniciar la aplicación

Primero, inicia **MySQL** desde el panel de XAMPP. Luego ejecuta:

```powershell
php artisan serve
```

La aplicación estará disponible normalmente en:

```text
http://127.0.0.1:8000
```

---

## 🔑 Acceso de demostración

El seeder `DemoDataSeeder` genera cuentas para comprobar las funciones correspondientes a cada rol.

Por seguridad, las credenciales del entorno publicado no se incluyen en el repositorio. Para una revisión académica deben compartirse de forma privada con el docente.

Los datos de demostración no deben utilizarse en un entorno de producción sin cambiar previamente todas las contraseñas.

---

## 🧪 Pruebas automáticas

Para ejecutar la suite completa:

```powershell
php artisan test --compact
```

La suite comprueba:

- Autenticación y cierre de sesión.
- Permisos correspondientes a cada rol.
- Aislamiento entre proyectos.
- Gestión de usuarios.
- Gestión de proyectos y equipos.
- Creación, asignación y modificación de tareas.
- Actualización de estados.
- Protección frente al acceso a recursos ajenos.
- Navegación web según el rol autenticado.

La versión estable fue verificada con:

```text
34 pruebas superadas
136 verificaciones realizadas
```

---

## ✅ Flujo recomendado de prueba

1. Abrir la portada pública y revisar las páginas de roles y equipo.
2. Iniciar sesión como Administrador.
3. Crear usuarios con los roles Gerente y Miembro.
4. Crear un proyecto y seleccionar su gerente.
5. Incorporar miembros al proyecto.
6. Iniciar sesión como Gerente.
7. Crear una tarea y asignarla a un integrante.
8. Comprobar que el Gerente no pueda modificar proyectos ajenos.
9. Iniciar sesión como Miembro.
10. Cambiar el estado de la tarea asignada.
11. Confirmar que el Miembro no pueda editar ni eliminar la tarea.
12. Regresar al Administrador y supervisar el resultado desde el dashboard.

---

## 🌿 Flujo de ramas

- `backend/arquitectura-inicial`: respaldo del backend original.
- `integration/sistema-completo`: integración del backend, frontend y diseño responsive.
- `main`: versión estable, revisada y publicada.

Las nuevas funciones deben desarrollarse en ramas independientes y pasar las pruebas antes de integrarse en `main`.

---

## 👨‍💻 Equipo de desarrollo

Proyecto desarrollado por estudiantes de la **Universidad Bolivariana del Ecuador**:

- Jesús Rafael Fernández Pérez
- José Andrés Merlin Gamboa
- José Alberto Rosado Domínguez
- Terry Steven Ponce Farías
- Elkin Daniel Velastegui Zambrano
- Zahid Joel Zambrano Moreira

---

## 📚 Contexto académico

- **Institución:** Universidad Bolivariana del Ecuador
- **Asignatura:** Programación Web Avanzada
- **Actividad:** Clase Práctica 5
- **Año:** 2026

Este proyecto aplica conocimientos de arquitectura MVC, autenticación, autorización, bases de datos relacionales, diseño responsive, pruebas automáticas y colaboración mediante Git y GitHub.

---

## 🔒 Consideraciones de seguridad

- El archivo `.env` no debe subirse al repositorio.
- No deben publicarse contraseñas reales.
- Las credenciales demostrativas deben cambiarse antes de publicar.
- Las operaciones protegidas utilizan políticas de autorización.
- Las contraseñas se almacenan mediante hash.
- Los formularios emplean protección CSRF.
- La validación de datos se realiza en el servidor.
- `vendor`, `node_modules` y los archivos temporales no deben añadirse a Git.

---

## 📌 Alcance

La aplicación fue desarrollada con fines académicos. Permite simular la organización de proyectos y tareas dentro de un equipo, pero no representa un servicio comercial ni una plataforma institucional oficial de la Universidad Bolivariana del Ecuador.

---

### 📋 Gestión de Tareas UBE

**Organiza el trabajo. Protege cada permiso.**
