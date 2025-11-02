-- ================================================
-- 🔹 SCRIPT DE CREACIÓN DE BASE DE DATOS - CORREGIDO
-- ================================================

-- ================================================
-- ROLES Y USUARIOS
-- ================================================
CREATE TABLE tb_rol (
    id_rol SERIAL PRIMARY KEY,
    nombre VARCHAR(30) NOT NULL
);

CREATE TABLE tb_usuario (
    id_usuario SERIAL PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    email_verified_at TIMESTAMP DEFAULT NULL,
    contrasena VARCHAR(255) NOT NULL,
    activo BOOLEAN DEFAULT TRUE,
    id_rol INT,
    remember_token VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_rol) REFERENCES tb_rol(id_rol)
);

-- ================================================
-- ENTIDADES DE USUARIOS
-- ================================================
CREATE TABLE tb_administrador (
    id_administrador SERIAL PRIMARY KEY,
    no_documento INT NOT NULL UNIQUE,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    fecha_nacimiento DATE NOT NULL,
    telefono VARCHAR(20),
    id_usuario INT,
    FOREIGN KEY (id_usuario) REFERENCES tb_usuario(id_usuario)
);

CREATE TABLE tb_profesor (
    id_profesor SERIAL PRIMARY KEY,
    no_documento INT UNIQUE NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    fecha_nacimiento DATE NOT NULL,
    titulo VARCHAR(100),
    id_usuario INT,
    FOREIGN KEY (id_usuario) REFERENCES tb_usuario(id_usuario)
);

CREATE TABLE tb_curso (
    id_curso SERIAL PRIMARY KEY,
    ficha VARCHAR(50) NOT NULL,
    nombre_curso VARCHAR(100) NOT NULL,
    id_profesor INT,
    FOREIGN KEY (id_profesor) REFERENCES tb_profesor(id_profesor)
);

CREATE TABLE tb_estudiante (
    id_estudiante SERIAL PRIMARY KEY,
    no_documento INT UNIQUE NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    fecha_nacimiento DATE NOT NULL,
    fecha_ingreso DATE NOT NULL,
    direccion VARCHAR(100),
    telefono VARCHAR(20),
    id_usuario INT,
    id_curso INT,
    FOREIGN KEY (id_usuario) REFERENCES tb_usuario(id_usuario),
    FOREIGN KEY (id_curso) REFERENCES tb_curso(id_curso)
);

CREATE TABLE tb_padre_familia (
    id_padre_familia SERIAL PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    telefono VARCHAR(20),
    id_usuario INT,
    FOREIGN KEY (id_usuario) REFERENCES tb_usuario(id_usuario)
);

-- ================================================
-- TABLAS DE LARAVEL (cache, jobs, tokens, etc.)
-- ================================================
CREATE TABLE migrations (
    id SERIAL PRIMARY KEY,
    migration VARCHAR(255) NOT NULL,
    batch INT NOT NULL
);

CREATE TABLE cache (
    key VARCHAR(255) PRIMARY KEY,
    value TEXT NOT NULL,
    expiration INT NOT NULL
);

CREATE TABLE cache_locks (
    key VARCHAR(255) PRIMARY KEY,
    owner VARCHAR(255) NOT NULL,
    expiration INT NOT NULL
);

CREATE TABLE failed_jobs (
    id BIGSERIAL PRIMARY KEY,
    uuid VARCHAR(255) NOT NULL UNIQUE,
    connection TEXT NOT NULL,
    queue TEXT NOT NULL,
    payload TEXT NOT NULL,
    exception TEXT NOT NULL,
    failed_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE jobs (
    id BIGSERIAL PRIMARY KEY,
    queue VARCHAR(255) NOT NULL,
    payload TEXT NOT NULL,
    attempts SMALLINT NOT NULL,
    reserved_at INT,
    available_at INT NOT NULL,
    created_at INT NOT NULL
);

CREATE TABLE job_batches (
    id VARCHAR(255) PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    total_jobs INT NOT NULL,
    pending_jobs INT NOT NULL,
    failed_jobs INT NOT NULL,
    failed_job_ids TEXT NOT NULL,
    options TEXT,
    cancelled_at INT,
    created_at INT NOT NULL,
    finished_at INT
);

CREATE TABLE password_reset_tokens (
    email VARCHAR(255) PRIMARY KEY,
    token VARCHAR(255) NOT NULL,
    created_at TIMESTAMP
);

CREATE TABLE personal_access_tokens (
    id BIGSERIAL PRIMARY KEY,
    tokenable_type VARCHAR(255) NOT NULL,
    tokenable_id BIGINT NOT NULL,
    name VARCHAR(255) NOT NULL,
    token VARCHAR(64) NOT NULL UNIQUE,
    abilities TEXT,
    last_used_at TIMESTAMP,
    expires_at TIMESTAMP,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);

CREATE TABLE sessions (
    id VARCHAR(255) PRIMARY KEY,
    user_id BIGINT,
    ip_address VARCHAR(45),
    user_agent TEXT,
    payload TEXT NOT NULL,
    last_activity INT
);

-- ================================================
-- ASISTENCIAS, EVALUACIONES, CALIFICACIONES
-- ================================================
CREATE TYPE estado_asistencia AS ENUM ('presente', 'excusa', 'ausente');

CREATE TABLE tb_asistencia (
    id_asistencia SERIAL PRIMARY KEY,
    fecha DATE NOT NULL,
    presente estado_asistencia,
    id_curso INT,
    id_estudiante INT,
    FOREIGN KEY (id_curso) REFERENCES tb_curso(id_curso),
    FOREIGN KEY (id_estudiante) REFERENCES tb_estudiante(id_estudiante)
);

CREATE TABLE tb_expediente_estudiante (
    id_expediente_estudiante SERIAL PRIMARY KEY,
    documento VARCHAR(500) NOT NULL,
    id_estudiante INT,
    FOREIGN KEY (id_estudiante) REFERENCES tb_estudiante(id_estudiante)
);

CREATE TYPE estado_est AS ENUM ('activo', 'inactivo');

CREATE TABLE tb_estado_estudiante (
    id_estado_estudiante SERIAL PRIMARY KEY,
    estado estado_est,
    id_estudiante INT,
    FOREIGN KEY (id_estudiante) REFERENCES tb_estudiante(id_estudiante)
);

CREATE TABLE tb_competencia (
    id_competencia SERIAL PRIMARY KEY,
    nombre VARCHAR(79) NOT NULL,
    id_profesor INT,
    FOREIGN KEY (id_profesor) REFERENCES tb_profesor(id_profesor)
);

CREATE TABLE tb_competencia_curso (
    id_curso INT,
    id_competencia INT,
    PRIMARY KEY (id_curso, id_competencia),
    FOREIGN KEY (id_curso) REFERENCES tb_curso(id_curso),
    FOREIGN KEY (id_competencia) REFERENCES tb_competencia(id_competencia)
);

CREATE TABLE tb_evaluacion (
    id_evaluacion SERIAL PRIMARY KEY,
    descripcion VARCHAR(500) NOT NULL,
    fecha DATE,
    id_curso INT,
    id_competencia INT,
    FOREIGN KEY (id_curso) REFERENCES tb_curso(id_curso),
    FOREIGN KEY (id_competencia) REFERENCES tb_competencia(id_competencia)
);

CREATE TABLE tb_preguntas (
    id_pregunta SERIAL PRIMARY KEY,
    pregunta TEXT NOT NULL,
    id_evaluacion INT,
    FOREIGN KEY (id_evaluacion) REFERENCES tb_evaluacion(id_evaluacion)
);

CREATE TABLE tb_opciones_respuesta (
    id_opcion SERIAL PRIMARY KEY,
    opcion TEXT NOT NULL,
    es_correcta BOOLEAN,
    id_pregunta INT,
    FOREIGN KEY (id_pregunta) REFERENCES tb_preguntas(id_pregunta)
);

CREATE TABLE tb_evaluacion_pregunta (
    id_evaluacion INT,
    id_pregunta INT,
    PRIMARY KEY (id_evaluacion, id_pregunta),
    FOREIGN KEY (id_evaluacion) REFERENCES tb_evaluacion(id_evaluacion),
    FOREIGN KEY (id_pregunta) REFERENCES tb_preguntas(id_pregunta)
);

CREATE TABLE tb_calificacion (
    id_calificacion SERIAL PRIMARY KEY,
    nota NUMERIC(5,2),
    id_profesor INT,
    id_competencia INT,
    id_estudiante INT,
    id_evaluacion INT,
    FOREIGN KEY (id_profesor) REFERENCES tb_profesor(id_profesor),
    FOREIGN KEY (id_competencia) REFERENCES tb_competencia(id_competencia),
    FOREIGN KEY (id_estudiante) REFERENCES tb_estudiante(id_estudiante),
    FOREIGN KEY (id_evaluacion) REFERENCES tb_evaluacion(id_evaluacion)
);

CREATE TABLE tb_notificaciones (
    id_notificacion SERIAL PRIMARY KEY,
    fecha_envio DATE NOT NULL,
    mensaje TEXT NOT NULL,
    id_usuario INT,
    FOREIGN KEY (id_usuario) REFERENCES tb_usuario(id_usuario)
);

CREATE TABLE tb_log_actividades (
    id_log SERIAL PRIMARY KEY,
    actividad VARCHAR(255) NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    id_usuario INT,
    FOREIGN KEY (id_usuario) REFERENCES tb_usuario(id_usuario)
);
