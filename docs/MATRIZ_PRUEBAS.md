# Matriz de pruebas manuales

Esta matriz sirve para registrar la verificación de permisos y adjuntar evidencias en Coda o en la documentación final.

| ID | Rol | Acción | Resultado esperado | Resultado obtenido | Estado | Evidencia |
| --- | --- | --- | --- | --- | --- | --- |
| P-01 | Administrador | Iniciar sesión | Accede al dashboard general |  | Pendiente |  |
| P-02 | Administrador | Crear usuario | La cuenta aparece con el rol seleccionado |  | Pendiente |  |
| P-03 | Administrador | Crear proyecto | El proyecto guarda gerente y miembros |  | Pendiente |  |
| P-04 | Administrador | Consultar tareas | Puede ver todas las tareas |  | Pendiente |  |
| P-05 | Gerente | Abrir proyecto propio | Acceso permitido |  | Pendiente |  |
| P-06 | Gerente | Abrir proyecto ajeno | Acceso denegado |  | Pendiente |  |
| P-07 | Gerente | Crear tarea en proyecto propio | La tarea queda asignada al miembro seleccionado |  | Pendiente |  |
| P-08 | Gerente | Crear tarea en proyecto ajeno | Acceso denegado |  | Pendiente |  |
| P-09 | Miembro | Consultar tarea asignada | Acceso permitido |  | Pendiente |  |
| P-10 | Miembro | Consultar tarea ajena | Acceso denegado |  | Pendiente |  |
| P-11 | Miembro | Cambiar estado de su tarea | Estado actualizado |  | Pendiente |  |
| P-12 | Miembro | Editar título de tarea | Acceso denegado |  | Pendiente |  |
| P-13 | Invitado | Abrir dashboard | Redirección al login |  | Pendiente |  |
| P-14 | Cualquier rol | Cerrar sesión | La sesión se invalida y vuelve al login |  | Pendiente |  |

## Formato de evidencia

Para cada prueba se recomienda guardar:

1. Captura antes de ejecutar la acción.
2. Captura del resultado obtenido.
3. Fecha y nombre de quien realizó la prueba.
4. Descripción del error si el resultado no coincide.
5. Confirmación de la corrección en una segunda ejecución.
