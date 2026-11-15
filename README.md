# Sistema de Gestión de Tareas por Equipos

Proyecto completo de la Clase Práctica 5 de Programación Web Avanzada de la Universidad Bolivariana del Ecuador. La aplicación permite administrar usuarios, proyectos, equipos y tareas mediante tres roles con permisos diferentes.

## Tecnologías

- Laravel 13 y PHP 8.3 o superior.
- MySQL 8.
- Blade, Bootstrap 5.3 y CSS3.
- JavaScript para confirmaciones e interacciones de la interfaz.
- PHPUnit para pruebas automáticas.

## Funciones implementadas

### Administrador

- Iniciar y cerrar sesión.
- Crear, editar y eliminar usuarios.
- Asignar los roles Administrador, Gerente de proyecto y Miembro del equipo.
- Crear, editar y eliminar proyectos.
- Seleccionar el gerente y los integrantes de cada proyecto.
- Consultar todos los proyectos y tareas.
- Visualizar indicadores generales en el dashboard.

### Gerente de proyecto

- Consultar únicamente los proyectos que administra.
- Consultar los integrantes de sus proyectos.
- Crear, editar, asignar y eliminar tareas de sus proyectos.
- Cambiar el estado de las tareas que administra.
- No puede modificar proyectos ajenos ni administrar usuarios.

### Miembro del equipo

- Consultar únicamente los proyectos donde participa.
- Consultar exclusivamente las tareas asignadas a su cuenta.
- Cambiar el estado de sus tareas entre Pendiente, En proceso y Completado.
- No puede modificar el contenido ni eliminar tareas.

## Instalación en Laragon

1. Descomprime el proyecto en `D:\laragon\www\pwapractica5`.
2. Abre la terminal de Laragon dentro de la carpeta del proyecto.
3. Instala las dependencias de PHP:

   ```powershell
   composer install
   ```

4. Crea el archivo de configuración y la clave de Laravel:

   ```powershell
   Copy-Item .env.example .env
   php artisan key:generate
   ```

5. Crea una base de datos MySQL llamada `pwapractica5` y configura `.env`:

   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=pwapractica5
   DB_USERNAME=root
   DB_PASSWORD=
   ```

6. Crea las tablas y los roles:

   ```powershell
   php artisan migrate --seed
   ```

7. Para una demostración local completa, crea las cuentas y datos de ejemplo:

   ```powershell
   php artisan db:seed --class=DemoDataSeeder
   ```

8. Inicia Apache y MySQL desde Laragon y abre `http://pwapractica5.test`.

También se puede iniciar con `php artisan serve` y abrir la dirección indicada por la terminal.

## Cuentas de demostración

Las siguientes cuentas existen únicamente después de ejecutar `DemoDataSeeder`:

| Rol | Correo | Contraseña |
| --- | --- | --- |
| Administrador | `admin@pwapractica5.test` | `Demo2026!` |
| Gerente | `gerente@pwapractica5.test` | `Demo2026!` |
| Miembro | `miembro@pwapractica5.test` | `Demo2026!` |

Estas credenciales son solo para localhost. Antes de publicar el sistema se deben eliminar los datos de demostración y crear contraseñas nuevas.

## Pruebas automáticas

```powershell
php artisan test --compact
```

La suite comprueba autenticación, permisos, aislamiento entre proyectos, CRUD de usuarios, proyectos y tareas, actualización de estados y navegación web por rol.

## Prueba manual recomendada

1. Inicia sesión como Administrador y crea una cuenta de cada rol.
2. Crea un proyecto, selecciona un gerente y agrega miembros.
3. Inicia sesión como el gerente y crea una tarea para un miembro.
4. Comprueba que el gerente no pueda abrir proyectos ajenos.
5. Inicia sesión como miembro y cambia el estado de su tarea.
6. Comprueba que el miembro no pueda editar el título ni abrir tareas ajenas.
7. Regresa al Administrador y confirma que puede supervisar todos los proyectos y tareas.

## Estructura principal

```text
app/
├── Http/Controllers/       API existente
├── Http/Controllers/Web/   Interfaz web completa
├── Http/Requests/          Validaciones y autorización
├── Models/                 Usuario, rol, proyecto y tarea
└── Policies/               Reglas de permisos

database/
├── migrations/             Estructura MySQL
├── factories/              Datos para pruebas
└── seeders/                Roles y demostración

resources/views/
├── auth/                   Inicio de sesión
├── layouts/                Plantillas generales
├── users/                  Gestión de usuarios
├── projects/               Gestión de proyectos
└── tasks/                  Gestión de tareas

public/
├── css/app.css             Diseño responsive
└── js/app.js               Interactividad
```

## Flujo de ramas recomendado

- `backend/arquitectura-inicial`: respaldo del backend original.
- `integration/sistema-completo`: versión integrada con interfaz.
- `main`: versión estable después de revisión y pruebas.

No se deben subir `.env`, contraseñas reales, `vendor` ni `node_modules` al repositorio.
