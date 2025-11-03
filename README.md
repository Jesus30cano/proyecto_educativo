# 🎓 Sistema Escolar Cognia

Sistema de gestión educativa desarrollado con PHP y PostgreSQL, diseñado para administrar cursos, estudiantes, profesores, competencias, evaluaciones y actividades académicas.

## 📋 Descripción

Cognia es una plataforma integral de gestión escolar que permite la administración completa de procesos educativos, incluyendo:

- **Gestión de usuarios** (administradores, profesores y estudiantes)
- **Administración de cursos** y asignación de estudiantes
- **Control de asistencias** con estados personalizables
- **Competencias educativas** y su evaluación
- **Evaluaciones automatizadas** con preguntas de opción múltiple
- **Actividades y entregas** de trabajos
- **Expedientes estudiantiles** digitalizados
- **Contactos de emergencia**
- **Sistema de notificaciones**
- **Registro de actividades (logs)**

## 🏗️ Arquitectura del Sistema

### Modelo de Base de Datos

El sistema utiliza PostgreSQL con las siguientes entidades principales:

#### 👥 Gestión de Usuarios
- **Tb_usuario**: Credenciales y autenticación
- **Tb_rol**: Tipos de usuario (administrador, profesor, estudiante)
- **Tb_datos_personales**: Información personal completa
- **Tb_contacto_emergencia**: Contactos de emergencia para cualquier usuario

#### 📚 Gestión Académica
- **Tb_curso**: Cursos con fichas y profesores asignados
- **Tb_estudiante_curso**: Relación estudiantes-cursos
- **Tb_competencia**: Competencias educativas por profesor
- **Tb_competencia_curso**: Asociación competencias-cursos

#### ✅ Evaluación y Calificación
- **Tb_evaluacion**: Evaluaciones con duración y descripción
- **Tb_preguntas**: Preguntas de evaluación
- **Tb_opciones_respuesta**: Opciones de respuesta (correcta/incorrecta)
- **Tb_respuestas_estudiante**: Respuestas registradas por estudiantes
- **Tb_calificacion**: Calificaciones finales
- **Tb_resultado_competencia**: Resultados por competencia (aprobado/reprobado)

#### 📝 Actividades y Entregas
- **Tb_actividad**: Actividades creadas por profesores
- **Tb_entrega_actividad**: Entregas de estudiantes con calificación

#### 📊 Control y Seguimiento
- **Tb_asistencia**: Registro de asistencias (presente, excusa, ausente)
- **Tb_estado_estudiante**: Estados del estudiante (activo/inactivo)
- **Tb_expediente_estudiante**: Documentos digitalizados
- **Tb_notificaciones**: Sistema de notificaciones
- **Tb_log_actividades**: Auditoría de acciones

## 🚀 Tecnologías

- **Backend**: PHP
- **Base de datos**: PostgreSQL 
- **Contenedores**: Docker & Docker Compose
- **Tipos personalizados**: ENUMs para estados y roles

## 📦 Requisitos Previos

- Docker Desktop instalado
- Docker Compose
- Git
- Puertos disponibles: 80 (PHP) y 5432 (PostgreSQL)

## ⚙️ Instalación y Configuración

### 1. Clonar el repositorio

```bash
git clone https://github.com/Jesus30cano/proyecto_educativo.git
cd proyecto_educativo
```

### 2. Configurar variables de entorno

Crear archivo `.env` en la raíz del proyecto:

```env
# PostgreSQL
POSTGRES_DB=cognia_db
POSTGRES_USER=cognia_user
POSTGRES_PASSWORD=tu_password_seguro
POSTGRES_PORT=5432

# PHP
PHP_PORT=80
```

### 3. Estructura del proyecto

```
proyecto_educativo/
├── docker-compose.yml
├── Dockerfile
├── .env
├── .gitignore
├── README.md
├── src/
│   ├── index.php
│   ├── config/
│   │   └── database.php
│   ├── controllers/
│   ├── models/
│   ├── views/
│   └── assets/
│       ├── css/
│       ├── js/
│       └── img/
├── database/
│   └── schema.sql
└── uploads/
    ├── documentos/
    ├── actividades/
    └── entregas/
```

### 4. Iniciar los contenedores

```bash
# Construir e iniciar los contenedores
docker-compose up -d --build

# Ver el estado de los contenedores
docker-compose ps
```

### 5. Verificar la instalación

```bash
# Ver logs
docker-compose logs -f

# Verificar contenedores activos
docker ps
```

### 6. Acceder a la aplicación

Abrir en el navegador:
```
http://localhost
```

### 7. Inicializar la base de datos

La base de datos se inicializa automáticamente al levantar los contenedores. Si necesitas ejecutarla manualmente:

```bash
# Acceder al contenedor de PostgreSQL
docker exec -it cognia_postgres psql -U cognia_user -d cognia_db

# Ejecutar el script
\i /docker-entrypoint-initdb.d/schema.sql

# Salir
\q
```

## 🔧 Configuración de Docker

### docker-compose.yml

```yaml
version: '3.8'

services:
  postgres:
    image: postgres:15-alpine
    container_name: cognia_postgres
    environment:
      POSTGRES_DB: ${POSTGRES_DB}
      POSTGRES_USER: ${POSTGRES_USER}
      POSTGRES_PASSWORD: ${POSTGRES_PASSWORD}
    volumes:
      - postgres_data:/var/lib/postgresql/data
      - ./database/schema.sql:/docker-entrypoint-initdb.d/schema.sql
    ports:
      - "${POSTGRES_PORT}:5432"
    networks:
      - cognia_network
    restart: unless-stopped

  php:
    build: .
    container_name: cognia_php
    environment:
      - DB_HOST=postgres
      - DB_PORT=5432
      - DB_NAME=${POSTGRES_DB}
      - DB_USER=${POSTGRES_USER}
      - DB_PASSWORD=${POSTGRES_PASSWORD}
    volumes:
      - ./src:/var/www/html
      - ./uploads:/var/www/html/uploads
    ports:
      - "${PHP_PORT}:80"
    depends_on:
      - postgres
    networks:
      - cognia_network
    restart: unless-stopped

volumes:
  postgres_data:

networks:
  cognia_network:
    driver: bridge
```

### Dockerfile

```dockerfile
FROM php:8.2-apache

# Instalar extensiones de PHP necesarias
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql pgsql

# Habilitar mod_rewrite
RUN a2enmod rewrite

# Configurar permisos
RUN chown -R www-data:www-data /var/www/html

# Exponer puerto 80
EXPOSE 80
```

### .gitignore

```gitignore
# Environment variables
.env

# Docker volumes
postgres_data/

# Uploads
uploads/*
!uploads/.gitkeep

# IDE
.vscode/
.idea/

# OS
.DS_Store
Thumbs.db

# Logs
*.log

# Temporary files
*.tmp
*.temp
```

## 📱 Características Principales

### Roles de Usuario

1. **Administrador**
   - Gestión completa de usuarios
   - Asignación de roles
   - Configuración del sistema
   - Acceso a logs de actividad

2. **Profesor**
   - Crear y gestionar cursos
   - Definir competencias
   - Crear evaluaciones y actividades
   - Calificar estudiantes
   - Registrar asistencias
   - Gestionar expedientes

3. **Estudiante**
   - Ver cursos asignados
   - Realizar evaluaciones
   - Entregar actividades
   - Consultar calificaciones
   - Ver notificaciones
   - Actualizar datos personales

### Tipos de Documento

- 📄 Cédula de Ciudadanía
- 🆔 Tarjeta de Identidad
- 🌎 Cédula de Extranjería

### Estados de Asistencia

- ✅ **Presente**: El estudiante asistió a clase
- 📋 **Excusa**: Falta justificada con evidencia
- ❌ **Ausente**: Falta sin justificar

### Calificaciones

- ✔️ **Aprobado**: Cumple con los criterios de la competencia
- ❌ **Reprobado**: No cumple con los criterios

## 🔐 Seguridad

- ✅ Contraseñas encriptadas (campo `password` en `Tb_usuario`)
- ✅ Control de acceso basado en roles
- ✅ Registro de actividades (auditoría)
- ✅ Validación de documentos únicos
- ✅ Relaciones integrales en la base de datos
- ✅ Prevención de SQL Injection con PDO
- ✅ Validación de archivos subidos

## 📊 Funcionalidades Avanzadas

### Sistema de Evaluaciones
- Preguntas de opción múltiple
- Respuestas automáticas
- Duración controlada por evaluación
- Activación/desactivación de evaluaciones
- Registro de respuestas por estudiante
- Cálculo automático de calificaciones

### Gestión de Actividades
- Publicación con fechas de entrega
- Carga de archivos por profesores (PDF, DOCX, etc.)
- Entregas de estudiantes con seguimiento
- Calificación y retroalimentación
- Control de entregas tardías

### Expedientes Digitales
- Almacenamiento seguro de documentos
- Historial de subidas con fechas
- Descripciones y categorización
- Acceso controlado por rol

### Sistema de Notificaciones
- Notificaciones por tipo
- Estado de lectura
- Alertas de fechas de entrega
- Avisos de calificaciones
- Comunicados generales

## 🛠️ Comandos Útiles

```bash
# Detener contenedores
docker-compose down

# Detener y eliminar volúmenes (CUIDADO: borra la BD)
docker-compose down -v

# Reiniciar contenedores
docker-compose restart

# Reconstruir contenedores
docker-compose up -d --build

# Ver logs en tiempo real
docker-compose logs -f php

# Ver logs de PostgreSQL
docker-compose logs -f postgres

# Acceder al contenedor PHP
docker exec -it cognia_php bash

# Acceder a PostgreSQL
docker exec -it cognia_postgres psql -U cognia_user -d cognia_db

# Backup de la base de datos
docker exec cognia_postgres pg_dump -U cognia_user cognia_db > backup_$(date +%Y%m%d).sql

# Restaurar base de datos
docker exec -i cognia_postgres psql -U cognia_user cognia_db < backup_20240101.sql

# Ver espacio usado por volúmenes
docker system df -v

# Limpiar recursos no usados
docker system prune -a
```

## 🗃️ Consultas SQL Útiles

```sql
-- Ver todos los usuarios por rol
SELECT u.email, dp.nombre, dp.apellido, r.nombre_rol 
FROM Tb_usuario u
JOIN Tb_datos_personales dp ON u.id_usuario = dp.id_usuario
JOIN Tb_rol r ON u.id_rol = r.id_rol;

-- Ver estudiantes por curso
SELECT c.nombre_curso, c.ficha, dp.nombre, dp.apellido
FROM Tb_estudiante_curso ec
JOIN Tb_curso c ON ec.id_curso = c.id_curso
JOIN Tb_usuario u ON ec.id_usuario = u.id_usuario
JOIN Tb_datos_personales dp ON u.id_usuario = dp.id_usuario;

-- Ver asistencias de un estudiante
SELECT a.fecha, a.estado, c.nombre_curso
FROM Tb_asistencia a
JOIN Tb_estudiante_curso ec ON a.id_estudiante_curso = ec.id_estudiante_curso
JOIN Tb_curso c ON ec.id_curso = c.id_curso
WHERE ec.id_usuario = 1;

-- Ver resultados de competencias por estudiante
SELECT dp.nombre, dp.apellido, comp.nombre, rc.estado, rc.fecha_evaluacion
FROM Tb_resultado_competencia rc
JOIN Tb_usuario u ON rc.id_usuario = u.id_usuario
JOIN Tb_datos_personales dp ON u.id_usuario = dp.id_usuario
JOIN Tb_competencia comp ON rc.id_competencia = comp.id_competencia;
```

## 📈 Próximas Mejoras

- [ ] API RESTful completa
- [ ] Autenticación JWT
- [ ] Dashboard con estadísticas y gráficos
- [ ] Reportes en PDF (certificados, boletines)
- [ ] Sistema de mensajería interno
- [ ] Integración con calendario académico
- [ ] Aplicación móvil (React Native)
- [ ] Notificaciones push
- [ ] Videollamadas integradas
- [ ] Sistema de foros por curso
- [ ] Gamificación y logros

## 🤝 Contribución

1. Fork el proyecto
2. Crea una rama para tu feature (`git checkout -b feature/NuevaCaracteristica`)
3. Commit tus cambios (`git commit -m 'Agregar nueva característica'`)
4. Push a la rama (`git push origin feature/NuevaCaracteristica`)
5. Abre un Pull Request

### Guía de Estilo

- Usar PSR-12 para código PHP
- Comentar funciones complejas
- Nombres de variables en español descriptivos
- Commits en español con mensajes claros
- Probar antes de hacer push

## 🐛 Reportar Bugs

Crea un issue en GitHub con:
- Descripción clara del problema
- Pasos para reproducir
- Comportamiento esperado vs actual
- Screenshots si aplica
- Versión de Docker y sistema operativo

## 📄 Licencia

Este proyecto está bajo la Licencia MIT - ver el archivo [LICENSE](LICENSE) para más detalles.

## 👨‍💻 Autores

**Jesús Cano** - [GitHub](https://github.com/Jesus30cano)

## 📞 Soporte

Para reportar bugs o solicitar nuevas características:
- 📧 Abre un issue en: https://github.com/Jesus30cano/proyecto_educativo/issues
- 💬 Discusiones: https://github.com/Jesus30cano/proyecto_educativo/discussions

## 🙏 Agradecimientos

- Comunidad de desarrolladores PHP
- Documentación de PostgreSQL
- Docker Hub por las imágenes oficiales

---

**Cognia** - Gestión Educativa Inteligente 🎓

⭐ Si este proyecto te fue útil, considera darle una estrella en GitHub