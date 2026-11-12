# Sistema de Gestión de Tareas por Equipos

Proyecto de la Clase Práctica 5 de Programación Web Avanzada de la Universidad Bolivariana del Ecuador. La aplicación usa Laravel, MySQL, Bootstrap 5 y JavaScript para gestionar proyectos y tareas con permisos por rol.

## Roles

- **Administrador:** gestiona usuarios, asigna roles, crea proyectos y supervisa todos los proyectos y tareas.
- **Gerente de proyecto:** crea, edita, elimina y asigna las tareas de los proyectos que dirige.
- **Miembro del equipo:** consulta sus proyectos y cambia únicamente el estado de las tareas que tiene asignadas.

## Requisitos locales

- PHP 8.3 o superior con las extensiones requeridas por Laravel.
- Composer.
- MySQL 8.
- Node.js y npm para los recursos visuales.
- Laragon es la opción recomendada para el equipo porque agrupa estas herramientas.

## Instalación

1. Clona el repositorio dentro de `D:\laragon\www` y entra en su carpeta.
2. Instala las dependencias:

   ```powershell
   composer install
   npm install
   ```

3. Crea el archivo local de configuración y la clave de la aplicación:

   ```powershell
   Copy-Item .env.example .env
   php artisan key:generate
   ```

4. Crea una base de datos MySQL llamada `pwapractica5` y configura estas variables en `.env`:

   ```dotenv
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=pwapractica5
   DB_USERNAME=root
   DB_PASSWORD=
   ```

   La contraseña depende de la instalación local de cada integrante. El archivo `.env` no debe subirse a GitHub.

5. Crea las tablas y los roles:

   ```powershell
   php artisan migrate --seed
   ```

6. Crea el primer administrador sin guardar su contraseña en el repositorio:

   ```powershell
   php artisan app:create-administrator
   ```

7. Inicia el entorno:

   ```powershell
   composer run dev
   ```

También se puede usar el dominio automático de Laragon cuando Apache y MySQL estén iniciados.

## API del backend

Las rutas usan sesiones de Laravel y requieren autenticación, excepto el inicio de sesión.

| Método | Ruta | Función |
|---|---|---|
| POST | `/api/login` | Iniciar sesión |
| POST | `/api/logout` | Cerrar sesión |
| GET | `/api/me` | Consultar usuario actual |
| GET/POST | `/api/users` | Listar o crear usuarios (administrador) |
| GET/PATCH/DELETE | `/api/users/{user}` | Consultar, actualizar o eliminar usuario |
| GET/POST | `/api/projects` | Listar proyectos visibles o crear uno |
| GET/PATCH/DELETE | `/api/projects/{project}` | Consultar, actualizar o eliminar proyecto |
| GET/POST | `/api/projects/{project}/tasks` | Listar o crear tareas del proyecto |
| GET | `/api/tasks` | Listar las tareas visibles según el rol |
| GET/PATCH/DELETE | `/api/tasks/{task}` | Consultar, actualizar o eliminar tarea |
| PATCH | `/api/tasks/{task}/status` | Cambiar el estado de una tarea asignada |

Estados permitidos: `Pendiente`, `En proceso` y `Completado`.

## Verificación

Antes de subir cambios, ejecuta:

```powershell
vendor\bin\pint --dirty
php artisan test --compact
```

## Trabajo colaborativo

- `main` conserva únicamente cambios revisados e integrados.
- Cada integrante trabaja en una rama propia (`backend/...`, `frontend/...`, `testing/...`).
- Se recomienda un commit por cambio lógico y un pull request para integrar a `main`.
- Nunca se suben `.env`, contraseñas, `vendor` ni `node_modules`.
