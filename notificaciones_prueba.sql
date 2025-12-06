-- ============================================================
-- SCRIPT DE PRUEBA: Insertar Notificaciones de Ejemplo
-- ============================================================
-- Este script inserta notificaciones de prueba para diferentes usuarios
-- Asegúrate de ejecutarlo después de tener usuarios en tu base de datos

-- Nota: Reemplaza los ID de usuario (1, 2, 3, etc.) con los IDs reales de tu base de datos

-- ============================================================
-- Notificaciones para Estudiantes
-- ============================================================

-- Notificación de Aviso (estudiante con id_usuario = 5, ajusta según tu DB)
INSERT INTO Tb_notificaciones (tipo, titulo, mensaje, id_usuario, leida, fecha_envio) 
VALUES 
(
    'aviso', 
    'Nueva actividad publicada', 
    'El profesor ha publicado una nueva actividad en el curso de Programación Web. Fecha de entrega: 15 de diciembre.', 
    5, 
    FALSE,
    CURRENT_DATE
);

-- Notificación de Recordatorio
INSERT INTO Tb_notificaciones (tipo, titulo, mensaje, id_usuario, leida, fecha_envio) 
VALUES 
(
    'recordatorio', 
    'Recordatorio: Entrega pendiente', 
    'Recuerda que tienes una actividad pendiente de entrega para mañana en el curso de Base de Datos.', 
    5, 
    FALSE,
    CURRENT_DATE
);

-- Notificación de Éxito
INSERT INTO Tb_notificaciones (tipo, titulo, mensaje, id_usuario, leida, fecha_envio) 
VALUES 
(
    'exito', 
    'Calificación actualizada', 
    'Tu calificación en la actividad "Proyecto Final" ha sido actualizada. ¡Felicitaciones, obtuviste Aprobado!', 
    5, 
    TRUE,
    CURRENT_DATE - INTERVAL '1 day'
);

-- Notificación de Información
INSERT INTO Tb_notificaciones (tipo, titulo, mensaje, id_usuario, leida, fecha_envio) 
VALUES 
(
    'informacion', 
    'Actualización del curso', 
    'Se ha actualizado el material de estudio del módulo 3. Por favor, revisa los nuevos recursos disponibles.', 
    5, 
    FALSE,
    CURRENT_DATE - INTERVAL '2 days'
);

-- Notificación de Alerta
INSERT INTO Tb_notificaciones (tipo, titulo, mensaje, id_usuario, leida, fecha_envio) 
VALUES 
(
    'alerta', 
    '¡Actividad próxima a vencer!', 
    'La actividad "Análisis de Sistemas" vence en 24 horas. No olvides hacer tu entrega.', 
    5, 
    FALSE,
    CURRENT_DATE
);

-- Notificación Leída (más antigua)
INSERT INTO Tb_notificaciones (tipo, titulo, mensaje, id_usuario, leida, fecha_envio) 
VALUES 
(
    'aviso', 
    'Bienvenido al sistema', 
    'Bienvenido al sistema de gestión académica. Aquí podrás gestionar tus actividades, calificaciones y más.', 
    5, 
    TRUE,
    CURRENT_DATE - INTERVAL '7 days'
);

-- ============================================================
-- Notificaciones para Profesores (si aplica)
-- ============================================================

-- Notificación para profesor (ajusta el id_usuario según tu DB)
INSERT INTO Tb_notificaciones (tipo, titulo, mensaje, id_usuario, leida, fecha_envio) 
VALUES 
(
    'informacion', 
    'Nuevas entregas recibidas', 
    'Has recibido 5 nuevas entregas de estudiantes en la actividad "Proyecto Final". Por favor, revísalas.', 
    2, 
    FALSE,
    CURRENT_DATE
);

-- ============================================================
-- Consulta para verificar las notificaciones insertadas
-- ============================================================

-- Ver todas las notificaciones de un usuario específico
-- SELECT * FROM obtener_notificaciones_usuario(5);

-- Ver todas las notificaciones en la tabla
-- SELECT * FROM Tb_notificaciones ORDER BY fecha_envio DESC;

-- Contar notificaciones no leídas por usuario
-- SELECT id_usuario, COUNT(*) as no_leidas 
-- FROM Tb_notificaciones 
-- WHERE leida = FALSE 
-- GROUP BY id_usuario;
