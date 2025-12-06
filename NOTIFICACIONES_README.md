# Sistema de Notificaciones - Documentación

## 📋 Descripción General

El sistema de notificaciones permite a los usuarios (estudiantes, profesores, administradores) recibir y gestionar notificaciones en tiempo real sobre eventos importantes en la plataforma educativa.

## 🎯 Características

- ✅ **Carga dinámica** de notificaciones desde la base de datos
- ✅ **Actualización automática** cada 60 segundos
- ✅ **Contador de notificaciones** no leídas
- ✅ **Marcado de notificaciones** como leídas
- ✅ **5 tipos de notificaciones** con diferentes estilos y colores
- ✅ **Vista previa** en dropdown (últimas 3 notificaciones)
- ✅ **Modal completo** con todas las notificaciones
- ✅ **Formato de fechas** amigable (Hoy, Ayer, fecha completa)

## 📊 Estructura de la Base de Datos

### Tabla: `Tb_notificaciones`

```sql
CREATE TABLE Tb_notificaciones (
    id_notificacion SERIAL PRIMARY KEY,
    tipo VARCHAR(100) NOT NULL,          -- Tipo de notificación
    titulo VARCHAR(200) NOT NULL,        -- Título de la notificación
    fecha_envio DATE NOT NULL DEFAULT CURRENT_DATE,
    mensaje TEXT NOT NULL,               -- Mensaje completo
    id_usuario INT,                      -- Usuario destinatario
    leida BOOLEAN DEFAULT FALSE,         -- Estado de lectura
    FOREIGN KEY (id_usuario) REFERENCES Tb_usuario (id_usuario)
);
```

## 🎨 Tipos de Notificaciones

| Tipo | Color | Ícono | Uso |
|------|-------|-------|-----|
| **aviso** | Azul (#4e73df) | `fas fa-bullhorn` | Anuncios generales |
| **recordatorio** | Amarillo (#f6c23e) | `fas fa-clock` | Recordatorios de fechas |
| **alerta** | Rojo (#e74a3b) | `fas fa-exclamation-triangle` | Alertas urgentes |
| **informacion** | Cyan (#36b9cc) | `fas fa-info-circle` | Información general |
| **exito** | Verde (#1cc88a) | `fas fa-check-circle` | Confirmaciones exitosas |

## 🔧 Funciones SQL

### 1. Obtener Notificaciones de un Usuario

```sql
SELECT * FROM obtener_notificaciones_usuario(:id_usuario);
```

**Retorna:** id_notificacion, tipo, titulo, fecha_envio, mensaje, leida, id_usuario

### 2. Marcar Notificación como Leída

```sql
SELECT marcar_notificacion_leida(:id_notificacion, :id_usuario);
```

**Retorna:** Mensaje de confirmación

### 3. Enviar Notificación General (a todos los usuarios de un rol)

```sql
SELECT enviar_notificacion_general('aviso', 'Título', 'Mensaje', :id_rol);
```

- Si `id_rol` es NULL, se envía a todos los usuarios
- Si se especifica un `id_rol`, solo se envía a usuarios con ese rol

### 4. Enviar Notificación a Usuario Específico

```sql
SELECT enviar_notificacion_a_usuario(:id_usuario, 'aviso', 'Título', 'Mensaje');
```

## 🚀 Uso del Sistema

### Backend (PHP)

#### Controlador: `NotificationsController.php`

**Endpoints disponibles:**

1. **Obtener notificaciones del usuario actual**
   ```
   POST /student/notifications/obtenerNotificacionesPorUsuario
   ```
   
2. **Marcar notificación como leída**
   ```
   POST /student/notifications/marcarNotificacionLeida
   Body: { "id_notificacion": 5 }
   ```

#### Modelo: `General.php`

```php
$general = new General();
$notificaciones = $general->mostar_notificaciones($id_usuario);
```

#### Modelo: `StudentModel.php`

```php
$studentModel = new StudentModel();
$mensaje = $studentModel->marcarNotificacionLeida($id_notificacion, $id_usuario);
```

### Frontend (JavaScript)

El archivo `notifications.js` maneja toda la lógica de frontend:

- **Carga automática** al cargar la página
- **Actualización periódica** cada 60 segundos
- **Renderizado dinámico** del dropdown y modal
- **Gestión de eventos** (clicks, marcar como leída)

## 📝 Insertar Notificaciones de Prueba

Ejecuta el archivo `notificaciones_prueba.sql` para insertar notificaciones de ejemplo:

```sql
-- Ejemplo: Notificación de aviso
INSERT INTO Tb_notificaciones (tipo, titulo, mensaje, id_usuario, leida, fecha_envio) 
VALUES (
    'aviso', 
    'Nueva actividad publicada', 
    'El profesor ha publicado una nueva actividad...', 
    5,  -- ID del usuario
    FALSE,
    CURRENT_DATE
);
```

**⚠️ Importante:** Ajusta los `id_usuario` según los usuarios existentes en tu base de datos.

## 🎯 Casos de Uso

### 1. Notificar a todos los estudiantes
```sql
SELECT enviar_notificacion_general(
    'aviso',
    'Mantenimiento programado',
    'El sistema estará en mantenimiento el día de mañana.',
    3  -- ID del rol estudiante
);
```

### 2. Notificar a un estudiante específico
```sql
SELECT enviar_notificacion_a_usuario(
    5,  -- ID del estudiante
    'exito',
    'Calificación actualizada',
    'Tu calificación en el proyecto final ha sido actualizada.'
);
```

### 3. Recordatorio de actividad próxima a vencer
```sql
SELECT enviar_notificacion_a_usuario(
    5,
    'alerta',
    '¡Actividad próxima a vencer!',
    'La actividad "Análisis de Sistemas" vence en 24 horas.'
);
```

## 🔍 Verificación

### Consultar notificaciones de un usuario
```sql
SELECT * FROM obtener_notificaciones_usuario(5);
```

### Ver todas las notificaciones
```sql
SELECT * FROM Tb_notificaciones ORDER BY fecha_envio DESC;
```

### Contar notificaciones no leídas
```sql
SELECT id_usuario, COUNT(*) as no_leidas 
FROM Tb_notificaciones 
WHERE leida = FALSE 
GROUP BY id_usuario;
```

## 🎨 Personalización

### Cambiar colores
Edita las funciones en `notifications.js`:
- `obtenerColorIcono(tipo)`
- `obtenerColorTexto(tipo)`
- `obtenerColorClase(tipo)`

### Modificar estilos
Edita los estilos en `showNotificationsEST.php` en la sección `<style>`.

### Cambiar iconos
Modifica la función `obtenerIcono(tipo)` en `notifications.js`.

## 🐛 Solución de Problemas

### Las notificaciones no se cargan
1. Verifica que el usuario tenga sesión activa
2. Revisa la consola del navegador (F12) para errores
3. Verifica que la ruta del controlador sea correcta
4. Comprueba que existan notificaciones para el usuario en la DB

### El contador no se actualiza
- Asegúrate de que el elemento con clase `.badge-counter` exista en el DOM
- Verifica que la función `actualizarContador()` se ejecute correctamente

### Las notificaciones no se marcan como leídas
- Verifica que la función SQL `marcar_notificacion_leida` exista
- Comprueba que el `id_notificacion` e `id_usuario` sean correctos
- Revisa los permisos de la base de datos

## 📱 Compatibilidad

- ✅ Desktop: Chrome, Firefox, Edge, Safari
- ✅ Mobile: Responsive design
- ✅ Bootstrap 4.x
- ✅ Font Awesome 5.x

## 🔐 Seguridad

- ✅ Validación de sesión en el backend
- ✅ Verificación de propiedad (usuario solo puede ver/modificar sus notificaciones)
- ✅ Protección contra inyección SQL (uso de prepared statements)
- ✅ Validación de parámetros en el frontend y backend

## 📚 Archivos Modificados/Creados

### Creados
- `src/public/js/student/notifications.js` - Lógica de notificaciones
- `notificaciones_prueba.sql` - Datos de prueba
- `NOTIFICACIONES_README.md` - Esta documentación

### Modificados
- `src/app/views/components/student/topnav.php` - Dropdown dinámico
- `src/app/views/components/student/showNotificationsEST.php` - Modal dinámico
- `src/app/controllers/student/NotificationsController.php` - Ya existía, verificado
- `src/app/models/General.php` - Ya existía, verificado
- `src/app/models/student/StudentModel.php` - Ya existía, verificado

## 🎓 Próximas Mejoras

- [ ] Notificaciones en tiempo real con WebSockets
- [ ] Sonido al recibir notificación nueva
- [ ] Filtros por tipo de notificación
- [ ] Búsqueda de notificaciones
- [ ] Paginación en el modal
- [ ] Eliminar notificaciones
- [ ] Configuración de preferencias de notificaciones

---

**Desarrollado para:** Sistema de Gestión Educativa  
**Última actualización:** Diciembre 2025
