# Matriz de pruebas manuales

Esta matriz sirve para registrar la verificación de permisos y adjuntar evidencias en Coda o en la documentación final.

| ID | Rol | Acción | Resultado esperado | Resultado obtenido | Estado | Evidencia |
| --- | --- | --- | --- | --- | --- | --- |
| P-01 | Administrador | Iniciar sesión | Accede al dashboard general | Dashboard de Administrador visible | Aprobada | Navegador local, 15/11/2026 |
| P-02 | Administrador | Crear usuario | La cuenta aparece con el rol seleccionado | Se crearon cuentas QA con los roles seleccionados | Aprobada | Navegador local, 15/11/2026 |
| P-03 | Administrador | Crear proyecto | El proyecto guarda gerente y miembros | Proyecto QA creado con gerente y dos miembros | Aprobada | Navegador local, 15/11/2026 |
| P-04 | Administrador | Consultar tareas | Puede ver todas las tareas | El dashboard mostró las tareas existentes | Aprobada | Navegador local, 15/11/2026 |
| P-05 | Gerente | Abrir proyecto propio | Acceso permitido | Proyecto y tareas visibles después de la corrección INC-01 | Aprobada | Navegador local, 15/11/2026 |
| P-06 | Gerente | Abrir proyecto ajeno | Acceso denegado | Respuesta 403 con mensaje de acceso denegado | Aprobada | Navegador local, 15/11/2026 |
| P-07 | Gerente | Crear tarea en proyecto propio | La tarea queda asignada al miembro seleccionado | Tarea QA creada y asignada al miembro seleccionado | Aprobada | Navegador local, 15/11/2026 |
| P-08 | Gerente | Crear tarea en proyecto ajeno | Acceso denegado | La autorización impide acceder al proyecto ajeno | Aprobada | Navegador local, 15/11/2026 |
| P-09 | Miembro | Consultar tarea asignada | Acceso permitido | La tarea asignada mostró detalle y control de estado | Aprobada | Navegador local, 15/11/2026 |
| P-10 | Miembro | Consultar tarea ajena | Acceso denegado | Respuesta 403 con mensaje de acceso denegado | Aprobada | Navegador local, 15/11/2026 |
| P-11 | Miembro | Cambiar estado de su tarea | Estado actualizado | Estado cambiado de En proceso a Completado | Aprobada | Navegador local, 15/11/2026 |
| P-12 | Miembro | Editar título de tarea | Acceso denegado | Respuesta 403 al abrir la edición | Aprobada | Navegador local, 15/11/2026 |
| P-13 | Invitado | Abrir dashboard | Redirección al login | Redirección correcta al formulario de acceso | Aprobada | Navegador local, 15/11/2026 |
| P-14 | Cualquier rol | Cerrar sesión | La sesión se invalida y vuelve al login | Cierre correcto para los tres roles | Aprobada | Navegador local, 15/11/2026 |

## Incidencias encontradas

### INC-01: error 500 al abrir un proyecto

- **Ubicación:** `app/Http/Controllers/Web/ProjectController.php`, carga de la relación `tasks` en `show()`.
- **Pasos para reproducir:** iniciar sesión como Gerente y abrir un proyecto propio con tareas.
- **Resultado esperado:** mostrar el proyecto, su equipo y sus tareas.
- **Resultado obtenido:** error 500 porque Laravel entregó una relación `HasMany` a una función tipada como `Builder`.
- **Corrección aplicada localmente:** eliminar el tipo incompatible del parámetro externo de la carga restringida.
- **Verificación:** prueba de regresión aprobada, suite completa con 30 pruebas y 108 aserciones aprobadas, y flujo repetido correctamente en el navegador.

### INC-02: requisito de PHP desactualizado

- **Ubicación:** sección Tecnologías de `README.md`.
- **Resultado esperado:** indicar la versión mínima que realmente acepta el archivo de dependencias bloqueadas.
- **Resultado obtenido:** la documentación indicaba PHP 8.3+, pero Symfony 8.1 bloqueado exige PHP 8.4.1+.
- **Corrección aplicada localmente:** documentar PHP 8.4.1 o superior y el procedimiento con XAMPP.

## Formato de evidencia

Para cada prueba se recomienda guardar:

1. Captura antes de ejecutar la acción.
2. Captura del resultado obtenido.
3. Fecha y nombre de quien realizó la prueba.
4. Descripción del error si el resultado no coincide.
5. Confirmación de la corrección en una segunda ejecución.
