-- ============================================================
-- ENUMERACIONES
-- ============================================================
CREATE TYPE tipo_documento AS ENUM ('cedula_de_ciudadania', 'tarjeta_identidad', 'cedula_extranjeria');
CREATE TYPE estado_asistencia AS ENUM ('presente', 'excusa', 'ausente');
CREATE TYPE tipo_rol AS ENUM ('administrador', 'profesor', 'estudiante');
CREATE TYPE estado_est AS ENUM ('activo', 'inactivo');
CREATE TYPE calificacion AS ENUM ('aprobado', 'reprobado');

-- ============================================================
-- TABLAS BASE
-- ============================================================
CREATE TABLE Tb_rol (
    id_rol SERIAL PRIMARY KEY,
    nombre_rol tipo_rol UNIQUE NOT NULL
);

INSERT INTO Tb_rol (nombre_rol) VALUES
('administrador'),
('profesor'),
('estudiante');

CREATE TABLE Tb_usuario (
    id_usuario SERIAL PRIMARY KEY,
    email VARCHAR(100) NOT NULL UNIQUE,
    tipo_documento tipo_documento,
    no_documento VARCHAR(20) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    activo BOOLEAN DEFAULT TRUE,
    id_rol INT NOT NULL,
    FOREIGN KEY (id_rol) REFERENCES Tb_rol(id_rol)
);

CREATE TABLE Tb_datos_personales (
    id_datos_personales SERIAL PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    fecha_nacimiento DATE NOT NULL,
    telefono VARCHAR(20),
    direccion VARCHAR(100),
    genero VARCHAR(20),
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    id_usuario INT UNIQUE NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES Tb_usuario(id_usuario)
);

-- ============================================================
--datos de prueba 
-- ============================================================
-- ============================================================
-- USUARIOS DE EJEMPLO
-- ============================================================
-- la clave es prueba123 para los tres usuarios
INSERT INTO Tb_usuario (email, tipo_documento, no_documento, password, activo, id_rol) VALUES
('admin@plataforma.com', 'cedula_de_ciudadania', '111111111', '$2y$10$mW/HS7/e6Q.0CDOaLVfroeEfBs.71Vp/ucuKkvDDRXyQy8bKfCX0S', TRUE, 1),
('profesor@plataforma.com', 'tarjeta_identidad', '222222222', '$2y$10$CN7vIzIwuKDayz3BSTOCG.N4vV2MkODNaQsL67smqNbPOBho88N3W', TRUE, 2),
('estudiante@plataforma.com', 'cedula_extranjeria', '333333333', '$2y$10$ovuBo/WrQBda2ANOk.TiU.sX3BXRm5cWygxgckwILOWQzL8OD.o.S', TRUE, 3);

-- ============================================================
-- DATOS PERSONALES (opcional)
-- ============================================================

INSERT INTO Tb_datos_personales (nombre, apellido, fecha_nacimiento, telefono, direccion, genero, id_usuario)
VALUES
('Carlos', 'Ramírez', '1985-06-15', '3001234567', 'Calle 10 #5-20', 'Masculino', 1),
('Laura', 'Gómez', '1990-04-22', '3109876543', 'Carrera 8 #12-45', 'Femenino', 2),
('Andrés', 'Torres', '2002-09-10', '3207654321', 'Avenida 15 #30-50', 'Masculino', 3);


-- ============================================================
-- CURSOS Y RELACIONES
-- ============================================================
CREATE TABLE Tb_curso (
    id_curso SERIAL PRIMARY KEY,
    ficha VARCHAR(50) NOT NULL UNIQUE,
    nombre_curso VARCHAR(100) NOT NULL, --ej:adso,sst
    id_profesor_lider INT NOT NULL,
    ficha_activa BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (id_profesor_lider) REFERENCES Tb_usuario(id_usuario)
);

CREATE TABLE Tb_estudiante_curso (
    id_estudiante_curso SERIAL PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_curso INT NOT NULL,
    UNIQUE (id_usuario, id_curso),
    FOREIGN KEY (id_usuario) REFERENCES Tb_usuario(id_usuario),
    FOREIGN KEY (id_curso) REFERENCES Tb_curso(id_curso)
);
CREATE TABLE Tb_profesor_curso (
    id_profesor_curso SERIAL PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_curso INT NOT NULL,
    UNIQUE (id_usuario, id_curso),
    FOREIGN KEY (id_usuario) REFERENCES Tb_usuario(id_usuario),
    FOREIGN KEY (id_curso) REFERENCES Tb_curso(id_curso)
);

-- ============================================================
-- CONTACTOS DE EMERGENCIA (para cualquier usuario)
-- ============================================================
CREATE TABLE Tb_contacto_emergencia (
    id_contacto_emergencia SERIAL PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    parentesco VARCHAR(50), -- Ej: madre, padre, amigo, colega
    direccion VARCHAR(150),
    correo VARCHAR(100),
    observaciones TEXT,
    id_usuario INT NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES Tb_usuario(id_usuario)
);

-- ============================================================
-- ASISTENCIAS
-- ============================================================
CREATE TABLE Tb_asistencia (
    id_asistencia SERIAL PRIMARY KEY,
    fecha DATE NOT NULL,
    estado estado_asistencia NOT NULL,
    observaciones TEXT,
    id_estudiante_curso INT NOT NULL,
    UNIQUE(fecha, id_estudiante_curso),
    FOREIGN KEY (id_estudiante_curso) REFERENCES Tb_estudiante_curso(id_estudiante_curso)
);

-- ============================================================
-- ESTADOS Y EXPEDIENTES DE ESTUDIANTES
-- ============================================================
CREATE TABLE Tb_expediente_estudiante (
    id_expediente_estudiante SERIAL PRIMARY KEY,
    tipo_documento VARCHAR(100) NOT NULL,
    fecha_subida DATE DEFAULT CURRENT_DATE,
    descripcion TEXT,
    nombre_archivo VARCHAR(200) NOT NULL,
    documento VARCHAR(500) NOT NULL, -- ruta o referencia al documento
    id_usuario INT NOT NULL, -- el estudiante también es usuario
    FOREIGN KEY (id_usuario) REFERENCES Tb_usuario(id_usuario)
);

CREATE TABLE Tb_estado_estudiante (
    id_estado_estudiante SERIAL PRIMARY KEY,
    estado estado_est NOT NULL,
    fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    observaciones TEXT,
    id_usuario INT NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES Tb_usuario(id_usuario)
);

-- ============================================================
-- COMPETENCIAS Y EVALUACIONES
-- ============================================================
CREATE TABLE Tb_competencia (
    id_competencia SERIAL PRIMARY KEY,
    codigo VARCHAR(50) NOT NULL UNIQUE,
    nombre VARCHAR(200) NOT NULL,
    descripcion TEXT,
    id_profesor INT NOT NULL,
    FOREIGN KEY (id_profesor) REFERENCES Tb_usuario(id_usuario)
);

CREATE TABLE Tb_competencia_curso (
    id_curso INT NOT NULL,
    id_competencia INT NOT NULL,
    PRIMARY KEY (id_curso, id_competencia),
    FOREIGN KEY (id_curso) REFERENCES Tb_curso(id_curso),
    FOREIGN KEY (id_competencia) REFERENCES Tb_competencia(id_competencia)
);

CREATE TABLE Tb_evaluacion (
    id_evaluacion SERIAL PRIMARY KEY,
    titulo VARCHAR(200) NOT NULL,
    duracion INT NOT NULL, -- duración en minutos
    activa BOOLEAN DEFAULT TRUE,
    descripcion VARCHAR(500) NOT NULL,
    fecha DATE DEFAULT CURRENT_DATE,
    id_curso INT,
    id_competencia INT,
    FOREIGN KEY (id_curso) REFERENCES Tb_curso(id_curso),
    FOREIGN KEY (id_competencia) REFERENCES Tb_competencia(id_competencia)
);

CREATE TABLE Tb_preguntas (
    id_pregunta SERIAL PRIMARY KEY,
    pregunta TEXT NOT NULL,
    id_evaluacion INT,
    FOREIGN KEY (id_evaluacion) REFERENCES Tb_evaluacion(id_evaluacion)
);

CREATE TABLE Tb_opciones_respuesta (
    id_opcion SERIAL PRIMARY KEY,
    opcion TEXT NOT NULL,
    es_correcta BOOLEAN,
    id_pregunta INT,
    FOREIGN KEY (id_pregunta) REFERENCES Tb_preguntas(id_pregunta)
);

CREATE TABLE Tb_evaluacion_pregunta (
    id_evaluacion INT,
    id_pregunta INT,
    PRIMARY KEY (id_evaluacion, id_pregunta),
    FOREIGN KEY (id_evaluacion) REFERENCES Tb_evaluacion(id_evaluacion),
    FOREIGN KEY (id_pregunta) REFERENCES Tb_preguntas(id_pregunta)
);

CREATE TABLE Tb_calificacion (
    id_calificacion SERIAL PRIMARY KEY,
    nota calificacion NOT NULL,
    id_profesor INT,
    id_competencia INT,
    id_usuario INT, -- estudiante
    id_evaluacion INT,
    FOREIGN KEY (id_profesor) REFERENCES Tb_usuario(id_usuario),
    FOREIGN KEY (id_competencia) REFERENCES Tb_competencia(id_competencia),
    FOREIGN KEY (id_usuario) REFERENCES Tb_usuario(id_usuario),
    FOREIGN KEY (id_evaluacion) REFERENCES Tb_evaluacion(id_evaluacion)
);

CREATE TABLE Tb_resultado_competencia (
    id_resultado SERIAL PRIMARY KEY,
    fecha_evaluacion DATE DEFAULT CURRENT_DATE,
    estado calificacion NOT NULL,
    observaciones TEXT,
    id_competencia INT NOT NULL,
    id_usuario INT NOT NULL,  -- estudiante
    id_profesor INT NOT NULL, -- profesor que evaluó
    FOREIGN KEY (id_competencia) REFERENCES Tb_competencia(id_competencia),
    FOREIGN KEY (id_usuario) REFERENCES Tb_usuario(id_usuario),
    FOREIGN KEY (id_profesor) REFERENCES Tb_usuario(id_usuario),
    UNIQUE (id_competencia, id_usuario)  -- un resultado por competencia y estudiante
);

CREATE TABLE Tb_respuestas_estudiante(
    id_respuesta SERIAL PRIMARY KEY,
    id_evaluacion INT,
    id_pregunta INT,
    id_opcion INT,
    id_usuario INT, -- estudiante
    FOREIGN KEY (id_evaluacion) REFERENCES Tb_evaluacion(id_evaluacion),
    FOREIGN KEY (id_pregunta) REFERENCES Tb_preguntas(id_pregunta),
    FOREIGN KEY (id_opcion) REFERENCES Tb_opciones_respuesta(id_opcion),
    FOREIGN KEY (id_usuario) REFERENCES Tb_usuario(id_usuario)
);

-- ============================================================
-- NOTIFICACIONES Y LOG
-- ============================================================
CREATE TABLE Tb_notificaciones (
    id_notificacion SERIAL PRIMARY KEY,
    tipo VARCHAR(100) NOT NULL,
    titulo VARCHAR(200) NOT NULL,
    fecha_envio DATE NOT NULL DEFAULT CURRENT_DATE,
    mensaje TEXT NOT NULL,
    id_usuario INT,
    leida BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (id_usuario) REFERENCES Tb_usuario(id_usuario)
);

CREATE TABLE Tb_log_actividades (
    id_log SERIAL PRIMARY KEY,
    actividad VARCHAR(255) NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    id_usuario INT,
    FOREIGN KEY (id_usuario) REFERENCES Tb_usuario(id_usuario)
);

-- ============================================================
-- ACTIVIDADES (creadas por el profesor)
-- ============================================================
CREATE TABLE Tb_actividad (
    id_actividad SERIAL PRIMARY KEY,
    titulo VARCHAR(200) NOT NULL,
    descripcion TEXT,
    fecha_publicacion DATE DEFAULT CURRENT_DATE,
    fecha_entrega DATE,
    ruta_archivo VARCHAR(500),  -- ruta del archivo subido por el docente (PDF, DOCX, etc.)
    id_competencia INT NOT NULL,
    id_curso INT NOT NULL,
    id_profesor INT NOT NULL,
    FOREIGN KEY (id_competencia) REFERENCES Tb_competencia(id_competencia),
    FOREIGN KEY (id_curso) REFERENCES Tb_curso(id_curso),
    FOREIGN KEY (id_profesor) REFERENCES Tb_usuario(id_usuario)
);
-- ============================================================
-- ENTREGAS DE LOS ESTUDIANTES
-- ============================================================
CREATE TABLE Tb_entrega_actividad (
    id_entrega SERIAL PRIMARY KEY,
    fecha_entrega TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ruta_archivo VARCHAR(500) NOT NULL,  -- archivo entregado por el estudiante
    calificacion calificacion ,
    observaciones TEXT,
    id_actividad INT NOT NULL,
    id_profesor INT,
    id_estudiante INT NOT NULL,
    FOREIGN KEY (id_actividad) REFERENCES Tb_actividad(id_actividad),
    FOREIGN KEY (id_estudiante) REFERENCES Tb_usuario(id_usuario),
    FOREIGN KEY (id_profesor) REFERENCES Tb_usuario(id_usuario),
    UNIQUE (id_actividad, id_estudiante) -- una sola entrega por estudiante por actividad
);

CREATE INDEX idx_usuario_rol ON Tb_usuario(id_rol);
CREATE INDEX idx_curso_profesor ON Tb_curso(id_profesor_lider);
CREATE INDEX idx_competencia_profesor ON Tb_competencia(id_profesor);
CREATE INDEX idx_entrega_estudiante ON Tb_entrega_actividad(id_estudiante);
CREATE INDEX idx_entrega_actividad ON Tb_entrega_actividad(id_actividad);

-- ============================================================
-- fuciones validar usuario : SELECT validar_usuario('cedula_de_ciudadania','12345678','mi_contraseña');
-- retorna id_usuario, nombre, id_rol, activo, apellido
-- ============================================================
CREATE OR REPLACE FUNCTION validar_usuario(tipo_doc tipo_documento, no_doc VARCHAR)
RETURNS TABLE(id_usuario INT, nombre VARCHAR, id_rol INT,activo BOOLEAN,apellido VARCHAR,pass VARCHAR) AS $$
BEGIN
    RETURN QUERY
    SELECT u.id_usuario, dp.nombre, u.id_rol,u.activo,dp.apellido, u.password
    FROM Tb_usuario u
    JOIN Tb_datos_personales dp ON u.id_usuario = dp.id_usuario
    WHERE u.tipo_documento = tipo_doc
      AND u.no_documento = no_doc
      LIMIT 1;
END;
$$ LANGUAGE plpgsql;
-- ============================================================
-- funcion datos usuario : SELECT  obtener_datos_usuario(1);
-- retorna email, tipo_documento, documento, id_rol, nombre, apellido, fecha_nacimiento, telefono, direccion, genero
-- ============================================================
CREATE OR REPLACE FUNCTION obtener_datos_usuario(p_id_usuario INT)
RETURNS TABLE (
    email VARCHAR,
    tipo_documento tipo_documento,
    documento VARCHAR,
    id_rol INT,
    nombre VARCHAR,
    apellido VARCHAR,
    fecha_nacimiento DATE,
    telefono VARCHAR,
    direccion VARCHAR,
    genero VARCHAR
)
LANGUAGE plpgsql
AS $$
BEGIN
    RETURN QUERY
    SELECT 
        u.email,
        u.tipo_documento,
        u.no_documento,
        u.id_rol,
        d.nombre,
        d.apellido,
        d.fecha_nacimiento,
        d.telefono,
        d.direccion,
        d.genero
    FROM Tb_usuario u
    INNER JOIN Tb_datos_personales d ON u.id_usuario = d.id_usuario
    WHERE u.id_usuario = p_id_usuario;
END;
$$;
-- ============================================================
-- funcion validar existenci de correo usuario : SELECT verificar_correo_usuario('jsjshs@gmail.com')
-- retorna BOOLEAN true o false
-- ============================================================
CREATE OR REPLACE FUNCTION verificar_correo_usuario(p_email VARCHAR)
RETURNS BOOLEAN AS $$
BEGIN
    RETURN EXISTS (
        SELECT 1
        FROM Tb_usuario
        WHERE email = p_email
    );
END;
$$ LANGUAGE plpgsql;


<<<<<<< HEAD
=======

>>>>>>> b061e2e (agregue funciones básicas para gestión de usuarios)
-- ======================================================================
-- función registrar usuario (administrador): 
-- SELECT admin_registrar_usuario('Brallano@gmail.com','cedula_de_ciudadania','12345678','clave123',3);
-- Inserta un nuevo usuario en la tabla Tb_usuario
-- no retorna datos
-- ======================================================================

CREATE OR REPLACE FUNCTION admin_registrar_usuario (
        p_email VARCHAR, 
        p_tipo_documento tipo_documento,
        p_no_documento VARCHAR,
        p_password VARCHAR,
        p_id_rol INT
)
    RETURNS VOID
AS $$

    BEGIN

        INSERT INTO Tb_usuario(email, tipo_documento, no_documento, password, id_rol) 
        VALUES (p_email, p_tipo_documento, p_no_documento, p_password, p_id_rol);

END;
$$ LANGUAGE plpgsql;



-- ======================================================================
-- FUNCIÓN: usuario_datos_personales
-- USO: SELECT usuario_datos_personales('Brallan','Echeverria','1990-01-01','3001234567','Calle 123','Masculino',1);
-- DESCRIPCIÓN: Registra los datos personales de un usuario en Tb_datos_personales.
-- PARÁMETROS:
--   nombre, apellido, fecha_nacimiento, telefono, direccion, genero, id_usuario
-- RETORNO: No retorna datos (void)
-- ======================================================================


CREATE OR REPLACE FUNCTION usuario_datos_personales(
        p_nombre VARCHAR,
        p_apellido VARCHAR,
        p_fecha_nacimiento DATE, 
        p_telefono VARCHAR,
        p_direccion VARCHAR,
        p_genero VARCHAR,
        p_id_usuario INT
)

    RETURNS VOID 
AS $$
    
    BEGIN

	    INSERT INTO Tb_datos_personales(nombre, apellido, fecha_nacimiento, telefono, direccion, genero, id_usuario)
	    VALUES (p_nombre, p_apellido, p_fecha_nacimiento, p_telefono, p_direccion, p_genero, p_id_usuario);

END;
$$ LANGUAGE plpgsql;



-- ============================================================
-- FUNCION: listar_usuarios_por_idrol
-- USO: SELECT * FROM listar_usuarios_por_idrol(3);  -- 2 = profesor, 3 = estudiante
-- DESCRIPCIÓN: Lista los usuarios según su rol.
-- CAMPOS RETORNADOS:
--   id_usuario, nombre, apellido, email, estado (activo/inactivo),
--   fecha_nacimiento, telefono, direccion, genero, fecha_registro
-- ============================================================



CREATE OR REPLACE FUNCTION listar_usuarios_por_idrol(p_id_rol INT)
RETURNS TABLE(
    id_usuario INT,
    nombre VARCHAR,
    apellido VARCHAR,
    email VARCHAR,
    estado VARCHAR,
    fecha_nacimiento DATE,
    telefono VARCHAR,
    direccion VARCHAR,
    genero VARCHAR,
    fecha_registro TIMESTAMP
)
AS $$
BEGIN
    RETURN QUERY
    SELECT 
        u.id_usuario,
        d.nombre,
        d.apellido,
        u.email,
        CASE 
            WHEN u.activo = TRUE THEN 'activo'
            ELSE 'inactivo'
        END::VARCHAR AS estado,
        d.fecha_nacimiento,
        d.telefono,
        d.direccion,
        d.genero,
        d.fecha_registro
    FROM Tb_usuario u
    INNER JOIN Tb_datos_personales d ON u.id_usuario = d.id_usuario
    WHERE u.id_rol = p_id_rol;
END;
$$ LANGUAGE plpgsql;



-- =======================================================================================
-- FUNCIÓN: actualizar_datos_personales
-- USO: SELECT actualizar_datos_personales(1,'Brallan','Echeverria','1990-01-01','3001234567','Calle 123','Masculino');
-- DESCRIPCIÓN: Actualiza los datos personales del usuario en Tb_datos_personales.
-- PARÁMETROS:
--   p_id_usuario, p_nombre, p_apellido, p_fecha_nacimiento, p_telefono, p_direccion, p_genero
-- RETORNO: No retorna datos (void)
-- =======================================================================================

CREATE OR REPLACE FUNCTION actualizar_datos_personales (
    p_id_usuario INT,
    p_nombre VARCHAR,
    p_apellido VARCHAR,
    p_fecha_nacimiento DATE,
    p_telefono VARCHAR,
    p_direccion VARCHAR,
    p_genero VARCHAR
)
RETURNS VOID AS $$
BEGIN
    UPDATE Tb_datos_personales
    SET 
        nombre = p_nombre,
        apellido = p_apellido,
        fecha_nacimiento = p_fecha_nacimiento,
        telefono = p_telefono,
        direccion = p_direccion,
        genero = p_genero
    WHERE id_usuario = p_id_usuario;
END;
$$ LANGUAGE plpgsql;


-- =======================================================================================
-- FUNCIÓN: desactivar_usuario
-- USO: SELECT desactivar_usuario(1);
-- DESCRIPCIÓN: Marca un usuario como inactivo (no elimina registro).
-- PARÁMETRO:
--   p_id_usuario → ID del usuario a desactivar
-- RETORNO: No retorna datos (void)
-- =======================================================================================

CREATE OR REPLACE FUNCTION desactivar_usuario(p_id_usuario INT)
RETURNS VOID AS $$
BEGIN
    UPDATE Tb_usuario
    SET activo = FALSE
    WHERE id_usuario = p_id_usuario;
END;
$$ LANGUAGE plpgsql;