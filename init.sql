-- ============================================================
-- ENUMERACIONES
-- ============================================================
CREATE TYPE tipo_documento AS ENUM ('cedula_de_ciudadania', 'tarjeta_identidad', 'cedula_extranjeria');
CREATE TYPE estado_asistencia AS ENUM ('presente', 'excusa', 'ausente');
CREATE TYPE tipo_rol AS ENUM ('administrador', 'profesor', 'estudiante');
CREATE TYPE estado_est AS ENUM ('activo', 'inactivo', 'suspendido', 'graduado', 'retirado','aplazado');
CREATE TYPE calificacion AS ENUM ('aprobado', 'reprobado');

-- ============================================================
-- TABLAS BASE
-- ============================================================
CREATE TABLE Tb_rol (
    id_rol SERIAL PRIMARY KEY,
    nombre_rol tipo_rol UNIQUE NOT NULL
);



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
-- CURSOS Y RELACIONES
-- ============================================================
CREATE TABLE Tb_curso (
    id_curso SERIAL PRIMARY KEY,
    ficha VARCHAR(50) NOT NULL UNIQUE,
    nombre_curso VARCHAR(100) NOT NULL, --ej:adso,sst
    id_profesor_lider INT NOT NULL,
    ficha_activa BOOLEAN DEFAULT TRUE,
    fecha_inicio DATE DEFAULT CURRENT_DATE,
    fecha_fin DATE DEFAULT CURRENT_DATE + INTERVAL '1 year',
    FOREIGN KEY (id_profesor_lider) REFERENCES Tb_usuario(id_usuario)
);
--=============================================================
-- trigger para registrar en el log el registro de un nuevo curso   
CREATE OR REPLACE FUNCTION log_registro_curso()
RETURNS TRIGGER AS $$
BEGIN
    INSERT INTO Tb_log_actividades (actividad, id_usuario)
    VALUES (
        'Registro de curso (' || NEW.ficha || ' - ' || NEW.nombre_curso || ')',
        NEW.id_profesor_lider
    );
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;
-------------------------------------------------------------
CREATE TRIGGER trg_log_registro_curso
AFTER INSERT ON Tb_curso
FOR EACH ROW
EXECUTE FUNCTION log_registro_curso();

CREATE TABLE Tb_estudiante_curso (
    id_estudiante_curso SERIAL PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_curso INT NOT NULL,
    UNIQUE (id_usuario, id_curso),
    FOREIGN KEY (id_usuario) REFERENCES Tb_usuario(id_usuario),
    FOREIGN KEY (id_curso) REFERENCES Tb_curso(id_curso)
);

-------------------------------------------------------------
-- trigger para registrar en el log la inscripcion de un estudiante a un curso
CREATE OR REPLACE FUNCTION log_inscripcion_estudiante_curso()
RETURNS TRIGGER AS $$
DECLARE
    nombre_del_curso VARCHAR(100);
BEGIN
    -- Especifica la tabla.campo para evitar ambigüedad
    SELECT Tb_curso.nombre_curso INTO nombre_del_curso FROM Tb_curso WHERE Tb_curso.id_curso = NEW.id_curso;

    -- Utiliza la variable local 'nombre_del_curso'
    INSERT INTO Tb_log_actividades (actividad, id_usuario)
    VALUES (
        'Inscripción a curso (' || nombre_del_curso || ' - id curso: ' || NEW.id_curso || ')',
        NEW.id_usuario
    );
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;
CREATE TRIGGER trg_log_inscripcion_estudiante_curso
AFTER INSERT ON Tb_estudiante_curso
FOR EACH ROW
EXECUTE FUNCTION log_inscripcion_estudiante_curso();

CREATE TABLE Tb_profesor_curso (
    id_profesor_curso SERIAL PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_curso INT NOT NULL,
    UNIQUE (id_usuario, id_curso),
    FOREIGN KEY (id_usuario) REFERENCES Tb_usuario(id_usuario),
    FOREIGN KEY (id_curso) REFERENCES Tb_curso(id_curso)
);
-- ============================================================

CREATE OR REPLACE FUNCTION log_asignacion_profesor_curso()
RETURNS TRIGGER AS $$
DECLARE
    nombre_curso VARCHAR(100);
BEGIN
    -- Obtener el nombre del curso
    SELECT Tb_curso.nombre_curso INTO nombre_curso 
    FROM Tb_curso 
    WHERE Tb_curso.id_curso = NEW.id_curso;

    -- Registrar la asignación en el log de actividades
    INSERT INTO Tb_log_actividades (actividad, id_usuario)
    VALUES (
        'Asignación como profesor al curso (' || nombre_curso || ' - id curso: ' || NEW.id_curso || ')',
        NEW.id_usuario
    );
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;
CREATE TRIGGER trg_log_asignacion_profesor_curso
AFTER INSERT ON Tb_profesor_curso
FOR EACH ROW
EXECUTE FUNCTION log_asignacion_profesor_curso();
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
    id_profesor INT NOT NULL,
    UNIQUE(fecha, id_estudiante_curso),
    FOREIGN KEY (id_estudiante_curso) REFERENCES Tb_estudiante_curso(id_estudiante_curso)
);

-- ============================================================
-- ESTADOS Y EXPEDIENTES DE ESTUDIANTES
-- ============================================================
CREATE TABLE Tb_expediente_usuario (
    id_expediente_usuario SERIAL PRIMARY KEY,
    nombre_documento VARCHAR(100) NOT NULL,
    fecha_subida DATE DEFAULT CURRENT_DATE,
    descripcion TEXT,
    nombre_archivo VARCHAR(200) NOT NULL,
    ruta_documento VARCHAR(500) NOT NULL, -- ruta o referencia al documento
    id_usuario INT NOT NULL, -- el estudiante también es usuario
    FOREIGN KEY (id_usuario) REFERENCES Tb_usuario(id_usuario)
);
-- hay que hacer un tiger para el historial de estados del estudiante
CREATE TABLE Tb_estado_usuario (
    id_estado_usuario SERIAL PRIMARY KEY,
    estado estado_est NOT NULL,
    fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    observaciones TEXT,
    id_usuario INT NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES Tb_usuario(id_usuario)
);
-- ============================================================
-- funcion para el tiger de estado usuario
-- ============================================================
CREATE OR REPLACE FUNCTION fn_registrar_estado_usuario()
RETURNS TRIGGER AS $$
BEGIN
    INSERT INTO Tb_estado_usuario (estado, observaciones, id_usuario)
    VALUES ('activo', 'creado', NEW.id_usuario);
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;
--============================================================
-- trigger para registrar estado usuario al crear un nuevo usuario
--===========================================================
CREATE TRIGGER trg_usuario_estado_inicial
AFTER INSERT ON Tb_usuario
FOR EACH ROW
EXECUTE FUNCTION fn_registrar_estado_usuario();

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
--------------------------------------------------------------

CREATE OR REPLACE FUNCTION log_creacion_competencia()
RETURNS TRIGGER AS $$
DECLARE
    nombre_competencia VARCHAR(200);
BEGIN
    -- Guardar el nombre de la competencia creada
    SELECT Tb_competencia.nombre INTO nombre_competencia
    FROM Tb_competencia
    WHERE Tb_competencia.id_competencia = NEW.id_competencia;

    -- Registrar la actividad en el log
    INSERT INTO Tb_log_actividades (actividad, id_usuario)
    VALUES (
        'Creación de competencia (' || nombre_competencia || ' - código: ' || NEW.codigo || ')',
        NEW.id_profesor
    );
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;
CREATE TRIGGER trg_log_creacion_competencia
AFTER INSERT ON Tb_competencia
FOR EACH ROW
EXECUTE FUNCTION log_creacion_competencia();

CREATE TABLE Tb_competencia_curso (
    id_curso INT NOT NULL,
    id_competencia INT NOT NULL,
    PRIMARY KEY (id_curso, id_competencia),
    FOREIGN KEY (id_curso) REFERENCES Tb_curso(id_curso),
    FOREIGN KEY (id_competencia) REFERENCES Tb_competencia(id_competencia)
);
--------------------------------------------------------------
CREATE OR REPLACE FUNCTION log_competencia_curso()
RETURNS TRIGGER AS $$
DECLARE
    nombre_del_curso VARCHAR(100);
    nombre_de_competencia VARCHAR(200);
    id_profesor INT;
BEGIN
    -- Obtener el nombre del curso y el profesor líder
    SELECT Tb_curso.nombre_curso, Tb_curso.id_profesor_lider
    INTO nombre_del_curso, id_profesor
    FROM Tb_curso
    WHERE Tb_curso.id_curso = NEW.id_curso;

    -- Obtener el nombre de la competencia
    SELECT Tb_competencia.nombre INTO nombre_de_competencia
    FROM Tb_competencia
    WHERE Tb_competencia.id_competencia = NEW.id_competencia;

    -- Registrar la actividad en el log
    INSERT INTO Tb_log_actividades (actividad, id_usuario)
    VALUES (
        'Vinculación de competencia (' || nombre_de_competencia || ') al curso (' || nombre_del_curso || ')',
        id_profesor
    );
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;
--------------------------------------------------------------
CREATE TRIGGER trg_log_competencia_curso
AFTER INSERT ON Tb_competencia_curso
FOR EACH ROW
EXECUTE FUNCTION log_competencia_curso();

CREATE TABLE Tb_evaluacion (
    id_evaluacion SERIAL PRIMARY KEY,
    titulo VARCHAR(200) NOT NULL,
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
    id_usuario INT,
    UNIQUE (id_evaluacion, id_pregunta, id_usuario), -- estudiante
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
-- trigger para registrar en el log el registro de un nuevo usuario

CREATE OR REPLACE FUNCTION log_registro_usuario()
RETURNS TRIGGER AS $$
BEGIN
    INSERT INTO Tb_log_actividades (actividad, id_usuario)
    VALUES (
        'Registro de usuario (' || NEW.email || ')',
        NEW.id_usuario
    );
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;
CREATE TRIGGER trg_log_registro_usuario
AFTER INSERT ON Tb_usuario
FOR EACH ROW
EXECUTE FUNCTION log_registro_usuario();


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
    titulo VARCHAR(200) NOT NULL,
    descripcion TEXT,
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
-- fuciones validar usuario : SELECT validar_usuario('12345678');
-- retorna id_usuario, nombre, id_rol, activo, apellido
-- ============================================================
CREATE OR REPLACE FUNCTION validar_usuario( no_doc VARCHAR)
RETURNS TABLE(id_usuario INT, nombre VARCHAR, id_rol INT,activo BOOLEAN,apellido VARCHAR,pass VARCHAR) AS $$
BEGIN
    RETURN QUERY
    SELECT u.id_usuario, dp.nombre, u.id_rol,u.activo,dp.apellido, u.password
    FROM Tb_usuario u
    JOIN Tb_datos_personales dp ON u.id_usuario = dp.id_usuario
    WHERE u.no_documento = no_doc
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
-- procedimiento actualizar datos personales : CALL actualizar_datos_personales(1,'Brallan','Echeverria','1990-01-01','3001234567','Calle 123','Masculino');
-- no retorna datos
-- ============================================================
CREATE OR REPLACE PROCEDURE actualizar_datos_personales(
    p_id_usuario INT,
    p_nombre VARCHAR(100),
    p_apellido VARCHAR(100),
    p_fecha_nacimiento DATE,
    p_telefono VARCHAR(20),
    p_direccion VARCHAR(100),
    p_genero VARCHAR(20)
)
LANGUAGE plpgsql
AS $$
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
$$;
-------------------------------------------------------------
-- ============================================================
-- procedimiento crear datos personales : CALL crear_datos_personales(1,'Brallan','Echeverria','1990-01-01','3001234567','Calle 123','Masculino');
-- no retorna datos

-- ============================================================
 CREATE OR REPLACE PROCEDURE crear_datos_personales(
    p_id_usuario INT,
    p_nombre VARCHAR(100),
    p_apellido VARCHAR(100),
    p_fecha_nacimiento DATE,
    p_telefono VARCHAR(20),
    p_direccion VARCHAR(100),
    p_genero VARCHAR(20)
)
LANGUAGE plpgsql
AS $$
BEGIN
    INSERT INTO Tb_datos_personales (
        nombre,
        apellido,
        fecha_nacimiento,
        telefono,
        direccion,
        genero,
        id_usuario
    ) VALUES (
        p_nombre,
        p_apellido,
        p_fecha_nacimiento,
        p_telefono,
        p_direccion,
        p_genero,
        p_id_usuario
    );
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

-- ============================================================
-- funcion para traer datos de emergencia de un usuario : SELECT obtener_contactos_emergencia(1);
-- retorna id_contacto_emergencia, nombre, apellido, telefono, parentesco, direccion, correo, observaciones, id_usuario
-- ============================================================
CREATE OR REPLACE FUNCTION obtener_contactos_emergencia(p_id_usuario INT)
RETURNS TABLE (
    id_contacto_emergencia INT,
    nombre VARCHAR,
    apellido VARCHAR,
    telefono VARCHAR,
    parentesco VARCHAR,
    direccion VARCHAR,
    correo VARCHAR,
    observaciones TEXT,
    id_usuario INT
)
AS $$
BEGIN
    RETURN QUERY
    SELECT 
        ce.id_contacto_emergencia,
        ce.nombre,
        ce.apellido,
        ce.telefono,
        ce.parentesco,
        ce.direccion,
        ce.correo,
        ce.observaciones,
        ce.id_usuario
    FROM Tb_contacto_emergencia ce
    WHERE ce.id_usuario = p_id_usuario;
END;
$$ LANGUAGE plpgsql;



-- ============================================================
-- función: obtener_notificaciones_usuario
-- descripción: retorna todas las notificaciones de un usuario ordenadas por fecha
-- uso: SELECT * FROM obtener_notificaciones_usuario(5);
-- retorna: id_notificacion, tipo, titulo, fecha_envio, mensaje, leida, id_usuario
-- ============================================================

CREATE OR REPLACE FUNCTION obtener_notificaciones_usuario(p_id_usuario INT)
RETURNS TABLE (
    id_notificacion INT,
    tipo VARCHAR,
    titulo VARCHAR,
    fecha_envio DATE,
    mensaje TEXT,
    leida BOOLEAN,
    id_usuario INT
)
AS $$
BEGIN
    RETURN QUERY
    SELECT 
        n.id_notificacion,
        n.tipo,
        n.titulo,
        n.fecha_envio,
        n.mensaje,
        n.leida,
        n.id_usuario
    FROM Tb_notificaciones n
    WHERE n.id_usuario = p_id_usuario
    ORDER BY n.fecha_envio DESC;
END;
$$ LANGUAGE plpgsql;

-- ============================================================
-- función: obtener_log_actividades_paginado
-- descripción: retorna las actividades registradas en el log de forma paginada
-- uso: SELECT * FROM obtener_log_actividades_paginado(1, 15);
--       --> página 1, 15 registros por página
-- retorna: id_log, actividad, fecha, id_usuario
-- ============================================================

CREATE OR REPLACE FUNCTION obtener_log_actividades()
RETURNS TABLE(
    nombre_completo VARCHAR,
    id_usuario INT,
    actividad VARCHAR,
    fecha TIMESTAMP
)
AS $$
    SELECT
        dp.nombre || ' ' || dp.apellido AS nombre_completo,
        dp.id_usuario,
        log.actividad,
        log.fecha
    FROM Tb_log_actividades log
    JOIN Tb_datos_personales dp ON log.id_usuario = dp.id_usuario
$$ LANGUAGE sql;


-- ======================================================================
-- función registrar usuario (administrador): 
-- SELECT admin_registrar_usuario('Brallano@gmail.com','cedula_de_ciudadania','12345678','clave123',3);
-- Inserta un nuevo usuario en la tabla Tb_usuario
-- no retorna datos
-- ======================================================================

-- =====================================================================================
-- PROCEDIMIENTO: admin_registrar_usuario
-- USO:
--   CALL admin_registrar_usuario(
--       'Brallano@gmail.com',
--       'cedula_de_ciudadania',
--       '12345678',
--       'clave123',
--       3
--   );
--
-- DESCRIPCIÓN:
--   Registra un nuevo usuario en la tabla Tb_usuario con los datos proporcionados.
--   No retorna ningún valor.
-- =====================================================================================


CREATE OR REPLACE FUNCTION admin_registrar_usuario(
    p_email VARCHAR, 
    p_tipo_documento tipo_documento,
    p_no_documento VARCHAR,
    p_password VARCHAR,
    p_id_rol INT
) RETURNS INT
LANGUAGE plpgsql
AS $$
DECLARE
    v_id_usuario INT;
BEGIN
    INSERT INTO Tb_usuario(email, tipo_documento, no_documento, password, id_rol) 
    VALUES (p_email, p_tipo_documento, p_no_documento, p_password, p_id_rol)
    RETURNING id_usuario INTO v_id_usuario;
    RETURN v_id_usuario;
END;
$$;




-- ======================================================================
-- PROCEDIMIENTO: usuario_datos_personales
-- USO: CALL usuario_datos_personales('Brallan','Echeverria','1990-01-01','3001234567','Calle 123','Masculino',1);
-- DESCRIPCIÓN: Registra los datos personales de un usuario en Tb_datos_personales.
-- PARÁMETROS:
--   nombre, apellido, fecha_nacimiento, telefono, direccion, genero, id_usuario
-- RETORNO: No retorna datos (procedimiento, sin RETURN)
-- ======================================================================

CREATE OR REPLACE PROCEDURE usuario_datos_personales(
    p_nombre VARCHAR,
    p_apellido VARCHAR,
    p_fecha_nacimiento DATE,
    p_telefono VARCHAR,
    p_direccion VARCHAR,
    p_genero VARCHAR,
    p_id_usuario INT
)
LANGUAGE plpgsql
AS $$
BEGIN
    INSERT INTO Tb_datos_personales(
        nombre, apellido, fecha_nacimiento, telefono, direccion, genero, id_usuario
    )
    VALUES (
        p_nombre, p_apellido, p_fecha_nacimiento, p_telefono, p_direccion, p_genero, p_id_usuario
    );
END;
$$;




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
-- PROCEDIMIENTO: actualizar_datos_personales
-- USO: CALL actualizar_datos_personales(1,'Brallan','Echeverria','1990-01-01','3001234567','Calle 123','Masculino');
-- DESCRIPCIÓN: Actualiza los datos personales del usuario en Tb_datos_personales.
-- PARÁMETROS:
--   p_id_usuario, p_nombre, p_apellido, p_fecha_nacimiento, p_telefono, p_direccion, p_genero
-- RETORNO: No retorna datos (procedimiento)
-- =======================================================================================

CREATE OR REPLACE PROCEDURE actualizar_datos_personales(
    p_id_usuario INT,
    p_nombre VARCHAR,
    p_apellido VARCHAR,
    p_fecha_nacimiento DATE,
    p_telefono VARCHAR,
    p_direccion VARCHAR,
    p_genero VARCHAR
)
LANGUAGE plpgsql
AS $$
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
$$;



-- =======================================================================================
-- PROCEDIMIENTO: desactivar_usuario
-- USO: CALL desactivar_usuario(1);
-- DESCRIPCIÓN: Marca un usuario como inactivo (no elimina registro).
-- PARÁMETRO:
--   p_id_usuario → ID del usuario a desactivar
-- RETORNO: No retorna datos (procedimiento)
-- =======================================================================================

CREATE OR REPLACE PROCEDURE desactivar_usuario(p_id_usuario INT)
LANGUAGE plpgsql
AS $$
BEGIN
    UPDATE Tb_usuario
    SET activo = FALSE
    WHERE id_usuario = p_id_usuario;
END;
$$;




-- =======================================================================================
-- PROCEDIMIENTO: actualizar_usuario
-- USO:
-- CALL actualizar_usuario(1, 'Empirico@gmail.com', '123456789', 3);
--
-- DESCRIPCIÓN:
-- Actualiza los datos de la tabla Tb_usuario:
-- email, password y rol del usuario según su id.
-- *No modifica documento ni tipo de documento.*
--
-- PARÁMETROS:
--   p_id_usuario INT       -> id del usuario a actualizar
--   p_email VARCHAR        -> nuevo email
--   p_password VARCHAR     -> nueva contraseña
--   p_id_rol INT           -> rol actualizado (2=Profesor, 3=Estudiante)
--
-- RETORNO: No retorna datos (procedimiento)
-- =======================================================================================

CREATE OR REPLACE PROCEDURE actualizar_usuario(
    p_id_usuario INT,
    p_email VARCHAR,
    p_password VARCHAR,
    p_id_rol INT
)
LANGUAGE plpgsql
AS $$
BEGIN
    UPDATE Tb_usuario
    SET 
        email = p_email,
        password = p_password,
        id_rol = p_id_rol
    WHERE id_usuario = p_id_usuario;
END;
$$;



-- =======================================================================================
-- PROCEDIMIENTO: activar_usuario
-- USO: CALL activar_usuario(1);
-- DESCRIPCIÓN: Marca un usuario como activo.
-- PARÁMETRO:
--   p_id_usuario → ID del usuario a activar
-- RETORNO: No retorna datos (procedimiento)
-- =======================================================================================

CREATE OR REPLACE PROCEDURE activar_usuario(p_id_usuario INT)
LANGUAGE plpgsql
AS $$
BEGIN
    UPDATE Tb_usuario
    SET activo = TRUE
    WHERE id_usuario = p_id_usuario;
END;
$$;



-- =======================================================================================
-- PROCEDIMIENTO: crear_curso
-- USO: CALL crear_curso('2933470', 'ADSO', 2, '2025-01-15', '2025-11-15');
-- DESCRIPCIÓN: Inserta un nuevo curso en la tabla Tb_curso.
-- PARÁMETROS:
--   p_ficha → identificador único del curso
--   p_nombre_curso → nombre del curso
--   p_id_profesor_lider → ID del profesor líder del curso
--   p_fecha_inicio → fecha de inicio del curso
--   p_fecha_fin → fecha de finalización del curso
-- RETORNO: No retorna datos (procedimiento)
-- =======================================================================================

CREATE OR REPLACE PROCEDURE crear_curso(
    p_ficha VARCHAR,
    p_nombre_curso VARCHAR,
    p_id_profesor_lider INT,
    p_fecha_inicio DATE,
    p_fecha_fin DATE
)
LANGUAGE plpgsql
AS $$
BEGIN
    INSERT INTO Tb_curso(ficha, nombre_curso, id_profesor_lider, fecha_inicio, fecha_fin)
    VALUES (p_ficha, p_nombre_curso, p_id_profesor_lider, p_fecha_inicio, p_fecha_fin);
END;
$$;


-- =======================================================================================
-- PROCEDIMIENTO: editar_curso
-- USO: CALL editar_curso(1, '2933480', 'ADSO', 2, TRUE, '2025-01-15', '2025-11-15');
-- DESCRIPCIÓN: Actualiza los datos de un curso en la tabla Tb_curso.
-- PARÁMETROS:
--   p_id_curso           → ID del curso a editar
--   p_ficha              → Ficha del curso (única)
--   p_nombre_curso       → Nombre del curso
--   p_id_profesor_lider  → ID del profesor líder asignado al curso
--   p_ficha_activa       → Indica si la ficha del curso está activa (TRUE/FALSE)
--   p_fecha_inicio       → Fecha de inicio del curso
--   p_fecha_fin          → Fecha de finalización del curso
-- RETORNO: No retorna datos
-- =======================================================================================

CREATE OR REPLACE PROCEDURE editar_curso(
    p_id_curso INT,
    p_ficha VARCHAR,
    p_nombre_curso VARCHAR,
    p_id_profesor_lider INT,
    p_ficha_activa BOOLEAN,
    p_fecha_inicio DATE,
    p_fecha_fin DATE
)
LANGUAGE plpgsql
AS $$
BEGIN
    UPDATE Tb_curso
    SET 
        ficha = p_ficha,
        nombre_curso = p_nombre_curso,
        id_profesor_lider = p_id_profesor_lider,
        ficha_activa = p_ficha_activa,
        fecha_inicio = p_fecha_inicio,
        fecha_fin = p_fecha_fin
    WHERE id_curso = p_id_curso;
END;
$$;



-- =======================================================================================
-- PROCEDIMIENTO: asignar_estudiante_a_curso
-- USO: CALL asignar_estudiante_a_curso(1, 1);
-- DESCRIPCIÓN: Asigna un estudiante a un curso insertando la relación en Tb_estudiante_curso.
-- PARÁMETROS:
--   p_id_usuario → ID del estudiante a asignar
--   p_id_curso   → ID del curso al que se quiere asignar al estudiante
-- RETORNO: No retorna datos
-- =======================================================================================

CREATE OR REPLACE PROCEDURE asignar_estudiante_a_curso(
    p_id_usuario INT,
    p_id_curso INT
)
LANGUAGE plpgsql
AS $$
BEGIN
    INSERT INTO Tb_estudiante_curso(id_usuario, id_curso)
    VALUES (p_id_usuario, p_id_curso);
END;
$$;



-- =======================================================================================
-- PROCEDIMIENTO: remover_estudiante_de_curso
-- USO: CALL remover_estudiante_de_curso(1, 1);
-- DESCRIPCIÓN: Remueve la relación de un estudiante con un curso en Tb_estudiante_curso.
-- PARÁMETROS:
--   p_id_usuario → ID del estudiante a remover
--   p_id_curso   → ID del curso del que se quiere remover al estudiante
-- RETORNO: No retorna datos
-- =======================================================================================

CREATE OR REPLACE PROCEDURE remover_estudiante_de_curso(
    p_id_usuario INT,
    p_id_curso INT
)
LANGUAGE plpgsql
AS $$
BEGIN
    DELETE FROM Tb_estudiante_curso
    WHERE id_usuario = p_id_usuario
      AND id_curso = p_id_curso;
END;
$$;




-- =======================================================================================
-- PROCEDIMIENTO: asignar_profesor_a_curso
-- USO: CALL asignar_profesor_a_curso(4, 1);
-- DESCRIPCIÓN: Asigna un profesor a un curso en Tb_profesor_curso.
-- PARÁMETROS:
--   p_id_usuario → ID del profesor
--   p_id_curso   → ID del curso
-- NOTA: Si el profesor ya está asignado al curso, no hace nada (gracias a ON CONFLICT).
-- RETORNO: No retorna datos
-- =======================================================================================

CREATE OR REPLACE PROCEDURE asignar_profesor_a_curso(
    p_id_usuario INT,
    p_id_curso INT
)
LANGUAGE plpgsql
AS $$
BEGIN
    INSERT INTO Tb_profesor_curso(id_usuario, id_curso)
    VALUES (p_id_usuario, p_id_curso)
    ON CONFLICT (id_usuario, id_curso) DO NOTHING;  
END;
$$;




-- =======================================================================================
-- PROCEDIMIENTO: remover_profesor_de_curso
-- USO: CALL remover_profesor_de_curso(4, 1);
-- DESCRIPCIÓN: Elimina la relación entre un profesor y un curso en Tb_profesor_curso.
-- PARÁMETROS:
--   p_id_usuario → ID del profesor a remover
--   p_id_curso   → ID del curso del que se quiere remover al profesor
-- RETORNO: No retorna datos
-- =======================================================================================

CREATE OR REPLACE PROCEDURE remover_profesor_de_curso(
    p_id_usuario INT,
    p_id_curso INT
)
LANGUAGE plpgsql
AS $$
BEGIN
    DELETE FROM Tb_profesor_curso
    WHERE id_usuario = p_id_usuario
      AND id_curso = p_id_curso;
END;
$$;




-- =======================================================================================
-- FUNCIÓN: reporte_notas_estudiante
-- USO: SELECT * FROM reporte_notas_estudiante(1);
-- DESCRIPCIÓN: Muestra todas las calificaciones de un estudiante específico.
-- PARÁMETROS:
--   p_id_usuario → ID del estudiante
-- RETORNO:
--   id_evaluacion, titulo_evalacion, nombre_competencia, nota, id_profeso
-- =======================================================================================

CREATE OR REPLACE FUNCTION reporte_notas_estudiante(
    p_id_usuario INT
)
RETURNS TABLE(
    id_evaluacion INT,
    titulo_evaluacion VARCHAR,
    nombre_competencia VARCHAR,
    nota calificacion,
    id_profesor INT
)
AS $$
BEGIN
    RETURN QUERY
    SELECT 
        c.id_evaluacion,
        c.titulo,
        comp.nombre,
        cal.nota,
        cal.id_profesor
    FROM Tb_calificacion cal
    JOIN Tb_evaluacion c ON cal.id_evaluacion = c.id_evaluacion
    JOIN Tb_competencia comp ON cal.id_competencia = comp.id_competencia
    WHERE cal.id_usuario = p_id_usuario;
END;
$$ LANGUAGE plpgsql;


-- =======================================================================================
-- FUNCIÓN: reporte_notas_por_curso
-- USO: SELECT * FROM reporte_notas_por_curso(1);
-- DESCRIPCIÓN: Muestra las calificaciones de todos los estudiantes de un curso.
-- PARÁMETROS:
--   p_id_curso → ID del curso
-- RETORNO:
--   id_usuario, nombre_estudiante, apellido_estudiante, id_evaluacion, titulo_evaluacion, nota
-- =======================================================================================

CREATE OR REPLACE FUNCTION reporte_notas_por_curso(
    p_id_curso INT
)
RETURNS TABLE(
    id_usuario INT,
    nombre_estudiante VARCHAR,
    apellido_estudiante VARCHAR,
    id_evaluacion INT,
    titulo_evaluacion VARCHAR,
    nota calificacion
)
AS $$
BEGIN
    RETURN QUERY
    SELECT 
        u.id_usuario,
        dp.nombre,
        dp.apellido,
        cal.id_evaluacion,
        e.titulo,
        cal.nota
    FROM Tb_estudiante_curso ec
    JOIN Tb_usuario u ON ec.id_usuario = u.id_usuario
    JOIN Tb_datos_personales dp ON u.id_usuario = dp.id_usuario
    LEFT JOIN Tb_calificacion cal ON cal.id_usuario = u.id_usuario
    LEFT JOIN Tb_evaluacion e ON cal.id_evaluacion = e.id_evaluacion
    WHERE ec.id_curso = p_id_curso;
END;
$$ LANGUAGE plpgsql;-- =======================================================================================
-- FUNCIÓN: reporte_notas_por_curso
-- USO: SELECT * FROM reporte_notas_por_curso(1);
-- DESCRIPCIÓN: Muestra las calificaciones de todos los estudiantes de un curso.
-- PARÁMETROS:
--   p_id_curso → ID del curso
-- RETORNO:
--   id_usuario, nombre_estudiante, apellido_estudiante, id_evaluacion, titulo_evaluacion, nota
-- =======================================================================================

CREATE OR REPLACE FUNCTION reporte_notas_por_curso(
    p_id_curso INT
)
RETURNS TABLE(
    id_usuario INT,
    nombre_estudiante VARCHAR,
    apellido_estudiante VARCHAR,
    id_evaluacion INT,
    titulo_evaluacion VARCHAR,
    nota calificacion
)
AS $$
BEGIN
    RETURN QUERY
    SELECT 
        u.id_usuario,
        dp.nombre,
        dp.apellido,
        cal.id_evaluacion,
        e.titulo,
        cal.nota
    FROM Tb_estudiante_curso ec
    JOIN Tb_usuario u ON ec.id_usuario = u.id_usuario
    JOIN Tb_datos_personales dp ON u.id_usuario = dp.id_usuario
    LEFT JOIN Tb_calificacion cal ON cal.id_usuario = u.id_usuario
    LEFT JOIN Tb_evaluacion e ON cal.id_evaluacion = e.id_evaluacion
    WHERE ec.id_curso = p_id_curso;
END;
$$ LANGUAGE plpgsql;

-- ============================================================
-- Función: obtener_actividades
-- Descripción: Retorna todas las actividades filtradas por
-- competencia, curso y profesor.
-- Ejemplo de uso:
-- SELECT * FROM obtener_actividades(1, 2, 3);
-- ============================================================

CREATE OR REPLACE FUNCTION obtener_actividades(
    p_id_competencia INT,
    p_id_curso INT,
    p_id_profesor INT
)
RETURNS TABLE (
    id_actividad INT,
    titulo VARCHAR,
    descripcion TEXT,
    fecha_publicacion DATE,
    fecha_entrega DATE,
    ruta_archivo VARCHAR,
    id_competencia INT,
    id_curso INT,
    id_profesor INT
)
AS $$
BEGIN
    RETURN QUERY
    SELECT 
        a.id_actividad,
        a.titulo,
        a.descripcion,
        a.fecha_publicacion,
        a.fecha_entrega,
        a.ruta_archivo,
        a.id_competencia,
        a.id_curso,
        a.id_profesor
    FROM Tb_actividad a
    WHERE 
        a.id_competencia = p_id_competencia
        AND a.id_curso = p_id_curso
        AND a.id_profesor = p_id_profesor
    ORDER BY a.fecha_publicacion DESC;
END;
$$ LANGUAGE plpgsql;






-- ============================================================
-- Procedimiento: crear_actividad
-- Descripción: Inserta una nueva actividad en la tabla Tb_actividad.
-- Uso:
-- CALL crear_actividad(
--     'Título de ejemplo',
--     'Descripción de la actividad',
--     '2025-11-10',
--     '/uploads/actividades/act_001.pdf',
--     1,  -- id_competencia
--     2,  -- id_curso
--     3   -- id_profesor
-- );
-- ============================================================

CREATE OR REPLACE PROCEDURE crear_actividad(
    p_titulo VARCHAR,
    p_descripcion TEXT,
    p_fecha_entrega DATE,
    p_ruta_archivo VARCHAR,
    p_id_competencia INT,
    p_id_curso INT,
    p_id_profesor INT
)
LANGUAGE plpgsql
AS $$
BEGIN
    INSERT INTO Tb_actividad (
        titulo,
        descripcion,
        fecha_publicacion,
        fecha_entrega,
        ruta_archivo,
        id_competencia,
        id_curso,
        id_profesor
    ) VALUES (
        p_titulo,
        p_descripcion,
        CURRENT_DATE,
        p_fecha_entrega,
        p_ruta_archivo,
        p_id_competencia,
        p_id_curso,
        p_id_profesor
    );

END;
$$;



-- =======================================================================================
-- FUNCIÓN: enviar_notificacion_general
-- USO:
--   -- Enviar a todos
--   SELECT enviar_notificacion_general('aviso','Reunión','Asamblea mañana 8 AM');
--
--   -- Enviar solo a profesores (id_rol = 2)
--   SELECT enviar_notificacion_general('recordatorio','Reunión Docente','Mañana a las 8', 2);
-- DESCRIPCIÓN:
--   Inserta una notificación para todos los usuarios o un grupo por rol.
-- PARÁMETROS:
--   p_tipo        → tipo de mensaje (aviso, alerta, etc.)
--   p_titulo      → título de la notificación
--   p_mensaje     → contenido del mensaje
--   p_id_rol      → rol destino (NULL = todos los usuarios)
-- RETORNA:
--   Mensaje de confirmación
-- =======================================================================================
CREATE OR REPLACE FUNCTION enviar_notificacion_general(
    p_tipo VARCHAR,
    p_titulo VARCHAR,
    p_mensaje TEXT,
    p_id_rol INT DEFAULT NULL
)
RETURNS TEXT
AS $$
BEGIN
    -- Insertar notificación para todos o para rol específico
    INSERT INTO Tb_notificaciones (tipo, titulo, mensaje, id_usuario)
    SELECT p_tipo, p_titulo, p_mensaje, u.id_usuario
    FROM Tb_usuario u
    WHERE p_id_rol IS NULL OR u.id_rol = p_id_rol;

    RETURN 'Notificaciones enviadas correctamente';
END;
$$ LANGUAGE plpgsql;




-- =======================================================================================
-- FUNCIÓN: enviar_notificacion_a_usuario
-- USO:
--   SELECT enviar_notificacion_a_usuario(
--       3,
--       'alerta',
--       'Entrega Pendiente',
--       'Sube la actividad antes de las 11:59 PM'
--   );
-- DESCRIPCIÓN:
--   Inserta una notificación dirigida a un solo usuario.
-- PARÁMETROS:
--   p_id_usuario  → usuario destino
--   p_tipo        → tipo de mensaje
--   p_titulo      → título de la notificación
--   p_mensaje     → contenido del mensaje
-- RETORNA:
--   Mensaje de confirmación
-- =======================================================================================
CREATE OR REPLACE FUNCTION enviar_notificacion_a_usuario(
    p_id_usuario INT,
    p_tipo VARCHAR,
    p_titulo VARCHAR,
    p_mensaje TEXT
)
RETURNS TEXT
AS $$
BEGIN
    -- Insertar notificación para un usuario específico
    INSERT INTO Tb_notificaciones (tipo, titulo, mensaje, id_usuario)
    VALUES (p_tipo, p_titulo, p_mensaje, p_id_usuario);

    RETURN 'Notificación enviada';
END;
$$ LANGUAGE plpgsql;





-- =======================================================================================
-- FUNCIÓN: marcar_notificacion_leida
-- USO:
--   SELECT marcar_notificacion_leida(1, 1);
-- DESCRIPCIÓN:
--   Cambia el estado de una notificación a leída.
-- PARÁMETROS:
--   p_id_notificacion → ID de la notificación
--   p_id_usuario      → usuario que leyó la notificación
-- RETORNA:
--   Mensaje indicando resultado (éxito o error)
-- =======================================================================================
CREATE OR REPLACE FUNCTION marcar_notificacion_leida(
    p_id_notificacion INT,
    p_id_usuario INT
)
RETURNS TEXT
AS $$
BEGIN
    -- Actualizar notificación como leída solo si pertenece al usuario
    UPDATE Tb_notificaciones
    SET leida = TRUE
    WHERE id_notificacion = p_id_notificacion
      AND id_usuario = p_id_usuario;

    -- Si no afectó ninguna fila, no existe o no pertenece al usuario
    IF NOT FOUND THEN
        RETURN 'No se encontró notificación para este usuario';
    END IF;

    RETURN 'Notificación marcada como leída';
END;
$$ LANGUAGE plpgsql;







-- =======================================================================================
-- FUNCIÓN: obtener_boletin_estudiante
-- USO:
--   SELECT * FROM obtener_boletin_estudiante(3);
-- DESCRIPCIÓN:
--   Retorna el boletín académico de un estudiante, incluyendo competencias y estados.
-- PARÁMETROS:
--   p_id_usuario → ID del estudiante
-- RETORNO:
--   Datos del estudiante, curso, competencia, estado, profesor
-- =======================================================================================

CREATE OR REPLACE FUNCTION obtener_boletin_estudiante(
    p_id_usuario INT
)
RETURNS TABLE(
    id_estudiante INT,
    nombre_estudiante VARCHAR,
    apellido_estudiante VARCHAR,
    nombre_curso VARCHAR,
    competencia VARCHAR,
    estado_competencia calificacion,
    profesor VARCHAR,
    fecha_evaluacion DATE,
    observaciones TEXT
)
AS $$
BEGIN
    RETURN QUERY
    SELECT 
        u.id_usuario AS id_estudiante,
        dp.nombre,
        dp.apellido,
        c.nombre_curso,
        comp.nombre AS competencia,
        rc.estado AS estado_competencia,
        CONCAT(prof.nombre, ' ', prof.apellido)::VARCHAR AS profesor,
        rc.fecha_evaluacion,
        rc.observaciones
    FROM Tb_usuario u
    JOIN Tb_datos_personales dp ON u.id_usuario = dp.id_usuario
    JOIN Tb_estudiante_curso ec ON u.id_usuario = ec.id_usuario
    JOIN Tb_curso c ON ec.id_curso = c.id_curso
    LEFT JOIN Tb_resultado_competencia rc ON rc.id_usuario = u.id_usuario
    LEFT JOIN Tb_competencia comp ON rc.id_competencia = comp.id_competencia
    LEFT JOIN Tb_datos_personales prof ON rc.id_profesor = prof.id_usuario
    WHERE u.id_usuario = p_id_usuario;
END;
$$ LANGUAGE plpgsql;

-- =======================================================================================
-- FUNCIÓN: obtener_asistencias_por_curso_profesor
-- USO:
--   SELECT * FROM obtener_asistencias_por_curso_profesor('2933470', 4);
-- DESCRIPCIÓN:
--   Retorna las asistencias registradas para un curso específico y un profesor.
-- PARÁMETROS:
--   p_ficha        → Ficha del curso
--   p_id_profesor  → ID del profesor
-- RETORNO:
--   Datos de asistencia, estudiante y curso


CREATE OR REPLACE FUNCTION obtener_asistencias_por_curso_profesor(
    p_ficha VARCHAR,
    p_id_profesor INT
)
RETURNS TABLE (
    id_asistencia INT,
    fecha DATE,
    estado estado_asistencia,
    observaciones TEXT,
    id_estudiante_curso INT,
    id_usuario_estudiante INT,
    nombre_estudiante VARCHAR,
    apellido_estudiante VARCHAR,
    id_curso INT,
    nombre_curso VARCHAR,
    ficha VARCHAR,
    id_profesor INT
) AS $$
BEGIN
    RETURN QUERY
    SELECT 
        a.id_asistencia,
        a.fecha,
        a.estado,
        a.observaciones,
        ec.id_estudiante_curso,
        u.id_usuario AS id_usuario_estudiante,
        dp.nombre AS nombre_estudiante,
        dp.apellido AS apellido_estudiante,
        c.id_curso,
        c.nombre_curso,
        c.ficha,
        a.id_profesor
    FROM Tb_asistencia a
    INNER JOIN Tb_estudiante_curso ec ON a.id_estudiante_curso = ec.id_estudiante_curso
    INNER JOIN Tb_usuario u ON ec.id_usuario = u.id_usuario
    INNER JOIN Tb_datos_personales dp ON u.id_usuario = dp.id_usuario
    INNER JOIN Tb_curso c ON ec.id_curso = c.id_curso
    INNER JOIN Tb_profesor_curso pc ON c.id_curso = pc.id_curso
    WHERE c.ficha = p_ficha
      AND pc.id_usuario = p_id_profesor
    ORDER BY a.fecha DESC;
END;
$$ LANGUAGE plpgsql;
--- =======================================================================================
-- PROCEDIMIENTO: sp_crear_asistencia_estudiante
-- USO:
--   CALL sp_crear_asistencia_estudiante(
--       '2025-11-01',
--       'presente',
--       'Asistencia puntual',
--       1,  -- id_estudiante_curso
--       4   -- id_profesor
--   );
-- DESCRIPCIÓN:
--   Inserta un nuevo registro de asistencia para un estudiante en Tb_asistencia.
-- PARÁMETROS:
--   p_fecha               → fecha de la asistencia
--   p_estado              → estado de la asistencia (presente, ausente, tarde)
--   p_observaciones       → observaciones adicionales
--   p_id_estudiante_curso → ID de la relación estudiante-curso
--   p_id_profesor         → ID del profesor que registra la asistencia
-- RETORNO: No retorna datos (procedimiento)
-- =======================================================================================
CREATE OR REPLACE PROCEDURE sp_crear_asistencia_estudiante(
    p_fecha DATE,
    p_estado estado_asistencia, 
    p_observaciones TEXT,
    p_id_estudiante_curso INT,
    p_id_profesor INT
)
LANGUAGE plpgsql
AS $$
BEGIN
    INSERT INTO Tb_asistencia (fecha, estado, observaciones, id_estudiante_curso, id_profesor)
    VALUES (p_fecha, p_estado, p_observaciones, p_id_estudiante_curso, p_id_profesor);

    RAISE NOTICE '✅ Asistencia creada para estudiante % en fecha %', p_id_estudiante_curso, p_fecha;
END;
$$;


-- ============================================================
-- FUNCIÓN: obtener_info_cursos
-- USO:
--     SELECT * FROM obtener_info_cursos();
--
-- DESCRIPCIÓN:
--     Retorna información detallada de todos los cursos,
--     incluyendo el nombre del curso, la ficha, el nombre del profesor líder
--     y la cantidad de estudiantes inscritos en cada curso.
-- PARÁMETROS:
--     Ninguno.
-- CAMPOS RETORNADOS:
--     id_curso            → ID del curso.
--     nombre_curso       → Nombre del curso.
--     ficha              → Ficha del curso.
--     nombre_profesor     → Nombre del profesor líder.
--     cantidad_estudiantes → Cantidad de estudiantes inscritos en el curso.

CREATE OR REPLACE FUNCTION obtener_info_cursos()
RETURNS TABLE (
    id_curso INT,
    nombre_curso VARCHAR,
    ficha VARCHAR,
    nombre_profesor VARCHAR,
    cantidad_estudiantes bigint
)
AS $$
BEGIN
    RETURN QUERY
    SELECT
        c.id_curso,
        c.nombre_curso,
        c.ficha,
        dp.nombre AS nombre_profesor,
        COUNT(ec.id_usuario) AS cantidad_estudiantes
    FROM Tb_curso c
    INNER JOIN Tb_usuario u ON c.id_profesor_lider = u.id_usuario
    INNER JOIN Tb_datos_personales dp ON u.id_usuario = dp.id_usuario
    LEFT JOIN Tb_estudiante_curso ec ON c.id_curso = ec.id_curso
    GROUP BY c.id_curso, c.nombre_curso, c.ficha, dp.nombre;
END;
$$ LANGUAGE plpgsql;









--========================================================================================================
--================Requerimientos estudiante===============================================================



--=====================================Visualización de cursos y materias:================================


-- =======================================================================================
-- FUNCIÓN: obtener_curso_por_estudiante
-- USO: SELECT * FROM obtener_curso_por_estudiante(1);
--
-- DESCRIPCIÓN:
--   Retorna la información del curso al que está asignado un estudiante.
--   Muestra ficha, nombre del curso y nombre completo del profesor líder.
--
-- PARÁMETROS:
--   p_id_usuario → ID del estudiante (id_usuario en Tb_usuario)
--
-- RETORNO:
--   Tabla con los siguientes campos:
--     id_curso, ficha, nombre_curso, profesor_lider
-- =======================================================================================

CREATE OR REPLACE FUNCTION obtener_curso_por_estudiante(
    p_id_usuario INT
)
RETURNS TABLE(
    id_curso INT,
    ficha VARCHAR,
    nombre_curso VARCHAR,
    profesor_lider TEXT
)
AS $$
BEGIN
    RETURN QUERY
    SELECT 
        c.id_curso,
        c.ficha,
        c.nombre_curso,
        CONCAT(dp.nombre, ' ', dp.apellido) AS profesor_lider
    FROM Tb_estudiante_curso ec
    INNER JOIN Tb_curso c ON ec.id_curso = c.id_curso
    INNER JOIN Tb_usuario u ON c.id_profesor_lider = u.id_usuario
    INNER JOIN Tb_datos_personales dp ON dp.id_usuario = u.id_usuario
    WHERE ec.id_usuario = p_id_usuario;
END;
$$ LANGUAGE plpgsql;





-- =======================================================================================
-- FUNCIÓN: obtener_competencias_por_curso
-- USO: SELECT * FROM obtener_competencias_por_curso(1);
--
-- DESCRIPCIÓN:
-- Devuelve todas las competencias asociadas a un curso específico.
-- Incluye información de la competencia, su código, descripción y el profesor que la imparte.
--
-- PARÁMETRO:
--   p_id_curso → ID del curso del cual se quieren ver las competencias
--
-- RETORNO:
--   id_competencia, codigo, nombre_competencia, descripcion, profesor
-- =======================================================================================
 
CREATE OR REPLACE FUNCTION obtener_competencias_por_curso(
    p_id_curso INT
)
RETURNS TABLE(
    id_competencia INT,
    codigo VARCHAR,
    nombre_competencia VARCHAR,
    descripcion TEXT,
    profesor TEXT
)
AS $$
BEGIN
    RETURN QUERY
    SELECT 
        c.id_competencia,
        c.codigo,
        c.nombre,
        c.descripcion,
        CONCAT(dp.nombre, ' ', dp.apellido) AS profesor
    FROM Tb_competencia c
    LEFT JOIN Tb_competencia_curso cc ON c.id_competencia = cc.id_competencia
    LEFT JOIN Tb_usuario u ON c.id_profesor = u.id_usuario
    LEFT JOIN Tb_datos_personales dp ON u.id_usuario = dp.id_usuario
    WHERE cc.id_curso = p_id_curso;
END;
$$ LANGUAGE plpgsql;





--===========================================Subida de actividades y exámenes:=====================






-- =======================================================================================
-- PROCEDIMIENTO: subir_entrega_actividad
-- USO: CALL subir_entrega_actividad(2, 1, 'ntrega aCtividada', 'Trabajo final', '/archivos/entregas/trabajo1.pdf');
-- DESCRIPCIÓN:
--   Permite que un estudiante suba una entrega para una actividad.
-- PARÁMETROS:
--   p_id_actividad → ID de la actividad asignada
--   p_id_estudiante → ID del estudiante que entrega
--   p_titulo → Título de la entrega
--   p_descripcion → Descripción opcional
--   p_ruta_archivo → Ruta del archivo subido
-- =======================================================================================

CREATE OR REPLACE PROCEDURE subir_entrega_actividad(
    p_id_actividad INT,
    p_id_estudiante INT,
    p_titulo VARCHAR,
    p_descripcion TEXT,
    p_ruta_archivo VARCHAR
)
LANGUAGE plpgsql
AS $$
BEGIN
    INSERT INTO Tb_entrega_actividad (
        titulo,
        descripcion,
        ruta_archivo,
        id_actividad,
        id_estudiante
    )
    VALUES (
        p_titulo,
        p_descripcion,
        p_ruta_archivo,
        p_id_actividad,
        p_id_estudiante
    )
    ON CONFLICT (id_actividad, id_estudiante)
    DO UPDATE
        SET descripcion = EXCLUDED.descripcion,
            ruta_archivo = EXCLUDED.ruta_archivo,
            fecha_entrega = CURRENT_TIMESTAMP;

    
    INSERT INTO Tb_log_actividades (actividad, id_usuario)
    VALUES (CONCAT('Subió una entrega para la actividad ', p_id_actividad), p_id_estudiante);
END;
$$;



-- =======================================================================================
-- FUNCIÓN: obtener_actividades_pendientes
-- USO:
-- SELECT * FROM obtener_actividades_pendientes(2);
--
-- DESCRIPCIÓN:
-- Devuelve la lista de actividades pendientes para un estudiante.
-- Muestra actividades del curso asignado al estudiante que aún no ha entregado
-- y cuya fecha de entrega no ha pasado.
--
-- PARÁMETRO:
--   p_id_estudiante → ID del estudiante (id_usuario)
--
-- RETORNO:
--   id_actividad, titulo, descripcion, fecha_entrega, nombre_curso, nombre_profesor
-- =======================================================================================

   CREATE OR REPLACE FUNCTION obtener_actividades_pendientes(p_id_estudiante INT)
RETURNS TABLE (
    id_actividad INT,
    titulo VARCHAR,
    descripcion TEXT,
    fecha_entrega DATE,
    nombre_curso VARCHAR,
    nombre_profesor TEXT
)
AS $$
BEGIN
    RETURN QUERY
    SELECT 
        a.id_actividad,
        a.titulo,
        a.descripcion,
        a.fecha_entrega,
        c.nombre_curso,
        CONCAT(dp.nombre, ' ', dp.apellido) AS nombre_profesor
    FROM Tb_actividad a
    INNER JOIN Tb_curso c ON a.id_curso = c.id_curso
    INNER JOIN Tb_datos_personales dp ON a.id_profesor = dp.id_usuario
    INNER JOIN Tb_estudiante_curso ec ON ec.id_curso = c.id_curso
    WHERE ec.id_usuario = p_id_estudiante
      AND a.fecha_entrega >= CURRENT_DATE
      AND a.id_actividad NOT IN (
          SELECT ea.id_actividad
          FROM Tb_entrega_actividad ea
          WHERE ea.id_estudiante = p_id_estudiante
      )
    ORDER BY a.fecha_entrega ASC;
END;
$$ LANGUAGE plpgsql;







--============================Visualización de calificaciones:=============================================




-- =======================================================================================
-- FUNCIÓN: obtener_calificaciones_por_estudiante
-- USO: SELECT * FROM obtener_calificaciones_por_estudiante(1);
-- DESCRIPCIÓN:
--   Devuelve todas las actividades de un estudiante, junto con las calificaciones
--   (si existen). Incluye las que aún no han sido calificadas.
-- PARÁMETROS:
--   p_id_estudiante → ID del estudiante
-- RETORNO:
--   id_actividad, titulo_actividad, nombre_materia, calificacion, fecha_entrega, estado
-- =======================================================================================

CREATE OR REPLACE FUNCTION obtener_calificaciones_por_estudiante(p_id_estudiante INT)
RETURNS TABLE(
    id_actividad INT,
    titulo_actividad VARCHAR,
    descripcion TEXT,
    nombre_competencia VARCHAR,
    nombre_curso VARCHAR,
    calificacion TEXT,
    fecha_entrega TIMESTAMP,
    estado TEXT
) AS $$
BEGIN
    RETURN QUERY
    SELECT
        a.id_actividad,
        a.titulo AS titulo_actividad,
        a.descripcion,
        c.nombre AS nombre_competencia,
        cu.nombre_curso,
        ea.calificacion::TEXT,
        ea.fecha_entrega,
        CASE
            WHEN ea.id_entrega IS NULL THEN 'Sin entregar'
            WHEN ea.calificacion IS NULL THEN 'Entregado, sin calificar'
            ELSE 'Calificado'
        END AS estado
    FROM Tb_actividad a
    INNER JOIN Tb_competencia c ON a.id_competencia = c.id_competencia
    INNER JOIN Tb_curso cu ON a.id_curso = cu.id_curso
    INNER JOIN Tb_estudiante_curso ec ON ec.id_curso = cu.id_curso
    LEFT JOIN Tb_entrega_actividad ea 
        ON ea.id_actividad = a.id_actividad
       AND ea.id_estudiante = p_id_estudiante
    WHERE ec.id_usuario = p_id_estudiante;
END;
$$ LANGUAGE plpgsql;





-- =======================================================================================
-- FUNCIÓN: obtener_calificaciones_examenes
-- USO: SELECT * FROM obtener_calificaciones_examenes(2);
-- DESCRIPCIÓN:
--   Retorna todas las evaluaciones (exámenes) asociadas al curso del estudiante indicado,
--   junto con su calificación (si la tiene), fecha de evaluación, y un estado descriptivo:
--     • 'Sin presentar' → el estudiante no tiene registro de calificación.
--     • 'Presentado, sin calificar' → existe registro pero la nota es NULL.
--     • 'Calificado' → existe registro con nota.
--
-- PARÁMETROS:
--   p_id_estudiante → ID del usuario (estudiante) que consulta sus calificaciones.
--
-- RETORNO:
--   id_evaluacion       INT
--   titulo_evaluacion   VARCHAR
--   descripcion         TEXT
--   nombre_competencia  VARCHAR
--   nombre_curso        VARCHAR
--   calificacion        TEXT        
--   fecha_evaluacion    DATE
--   estado              VARCHAR
-- =======================================================================================

CREATE OR REPLACE FUNCTION obtener_calificaciones_examenes(p_id_estudiante INT)
RETURNS TABLE (
    id_evaluacion INT,
    titulo_evaluacion VARCHAR,
    descripcion VARCHAR,
    nombre_competencia VARCHAR,
    nombre_curso VARCHAR,
    calificacion TEXT,
    fecha_evaluacion DATE,
    estado VARCHAR
)
LANGUAGE plpgsql
AS $$
BEGIN
    RETURN QUERY
    SELECT
        e.id_evaluacion,
        e.titulo AS titulo_evaluacion,
        e.descripcion,
        comp.nombre AS nombre_competencia,
        cu.nombre_curso,
        cal.nota::TEXT AS calificacion,    
        e.fecha AS fecha_evaluacion,       
        (CASE
            WHEN cal.id_calificacion IS NULL THEN 'Sin presentar'
            WHEN cal.nota IS NULL THEN 'Presentado, sin calificar'
            ELSE 'Calificado'
        END)::VARCHAR AS estado
    FROM Tb_evaluacion e
    INNER JOIN Tb_competencia comp ON e.id_competencia = comp.id_competencia
    INNER JOIN Tb_curso cu ON e.id_curso = cu.id_curso
    INNER JOIN Tb_estudiante_curso ec ON ec.id_curso = cu.id_curso
    LEFT JOIN Tb_calificacion cal 
        ON cal.id_evaluacion = e.id_evaluacion
       AND cal.id_usuario = p_id_estudiante    
    WHERE ec.id_usuario = p_id_estudiante;
END;
$$;

--============================================
--procedimiento para cambiar la clave de un usuario
-- =======================================================================================
-- PROCEDIMIENTO: cambiar_clave_usuario
-- USO: CALL cambiar_clave_usuario('correo@ejemplo.com', 'nueva_clave');
-- DESCRIPCIÓN:
--   Actualiza la contraseña de un usuario basado en su correo electrónico.
-- PARÁMETROS:
--   p_correo       → Correo electrónico del usuario
--   p_nueva_clave  → Nueva contraseña a establecer
-- RETORNO: No retorna datos (procedimiento)
CREATE OR REPLACE PROCEDURE cambiar_clave_usuario(
    p_correo VARCHAR,
    p_nueva_clave VARCHAR
)
LANGUAGE plpgsql
AS $$
BEGIN
    UPDATE Tb_usuario
    SET password = p_nueva_clave
    WHERE email= p_correo;
END;
$$;

-- ============================================================
-- FUNCIÓN: obtener_totales_activos
-- USO:
--     SELECT * FROM obtener_totales_activos();
-- 
-- DESCRIPCIÓN:
--     Retorna las cantidades totales de usuarios activos según su rol
--     (estudiantes y profesores), así como el total de cursos activos
--     registrados en el sistema.
--
-- PARÁMETROS:
--     Ninguno.
-- CAMPOS RETORNADOS:
--     total_estudiantes     → Número total de usuarios con rol '
--     total_profesores      → Número total de usuarios con rol 'profesor' y estado activo.
--     total_cursos_activos  → Número total de cursos con ficha activa.
CREATE OR REPLACE FUNCTION obtener_totales_activos()
RETURNS TABLE (
    total_estudiantes bigint,
    total_profesores bigint,
    total_cursos_activos bigint
)
AS $$
BEGIN
    RETURN QUERY
    SELECT
        COUNT(*) FILTER (WHERE r.nombre_rol = 'estudiante' AND u.activo = TRUE) AS total_estudiantes,
        COUNT(*) FILTER (WHERE r.nombre_rol = 'profesor' AND u.activo = TRUE) AS total_profesores,
        (SELECT COUNT(*) FROM Tb_curso WHERE ficha_activa = TRUE) AS total_cursos_activos
    FROM Tb_usuario u
    INNER JOIN Tb_rol r ON u.id_rol = r.id_rol;
END;
$$ LANGUAGE plpgsql;

-- ============================================================
-- FUNCIÓN: obtener_total_cursos
-- USO: 
--     SELECT * FROM obtener_total_cursos();
-- DESCRIPCIÓN:
--     Retorna información detallada de todos los cursos,
--     incluyendo el nombre del curso, la ficha, el nombre del profesor líder
--     y la cantidad de estudiantes inscritos en cada curso.
-- PARÁMETROS:
--     Ninguno.
-- CAMPOS RETORNADOS:
--     id_curso            → ID del curso.
--     nombre_curso       → Nombre del curso.
--     ficha              → Ficha del curso.
--     nombre_profesor     → Nombre del profesor líder.
--     cantidad_estudiantes → Cantidad de estudiantes inscritos en el curso.

CREATE OR REPLACE FUNCTION obtener_total_cursos()
RETURNS TABLE (
    id_curso INT,
    nombre_curso VARCHAR,
    ficha VARCHAR,
    fecha_inicio DATE,
    fecha_fin DATE,
    nombre_profesor VARCHAR,         -- <--- mantiene VARCHAR
    cantidad_estudiantes bigint,
    ficha_activa BOOLEAN
)
AS $$
BEGIN
    RETURN QUERY
    SELECT
        c.id_curso,
        c.nombre_curso,
        c.ficha,
        c.fecha_inicio,
        c.fecha_fin,
        (dp.nombre || ' ' || dp.apellido)::VARCHAR AS nombre_profesor,   -- <--- aquí el CAST
        COUNT(ec.id_usuario) AS cantidad_estudiantes,
        c.ficha_activa

    FROM Tb_curso c
    INNER JOIN Tb_usuario u ON c.id_profesor_lider = u.id_usuario
    INNER JOIN Tb_datos_personales dp ON u.id_usuario = dp.id_usuario
    LEFT JOIN Tb_estudiante_curso ec ON c.id_curso = ec.id_curso
    GROUP BY c.id_curso, c.nombre_curso, c.ficha, c.fecha_inicio, c.fecha_fin, dp.nombre, dp.apellido, c.ficha_activa;
END;
$$ LANGUAGE plpgsql;
-- =======================================================================================
-- todos los inser al final del script
-- =======================================================================================
INSERT INTO Tb_rol (nombre_rol) VALUES
('administrador'),
('profesor'),
('estudiante');
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

--prueba de datos curso y estudiante_curso

INSERT INTO Tb_curso (ficha, nombre_curso, id_profesor_lider, ficha_activa)
VALUES ('F12345', 'ADSO', 2, TRUE);
-- Si el curso tiene id=1
INSERT INTO Tb_estudiante_curso (id_usuario, id_curso)
VALUES (3, 1);

-- ============================================================
-- FUNCIÓN: get_instructores
CREATE OR REPLACE FUNCTION get_instructores()
RETURNS TABLE (
    id_usuario INT,
    nombre_completo VARCHAR
) AS $$
BEGIN
    RETURN QUERY
    SELECT 
        u.id_usuario,
        (dp.nombre || ' ' || dp.apellido)::VARCHAR AS nombre_completo
    FROM Tb_usuario u
    JOIN Tb_datos_personales dp ON dp.id_usuario = u.id_usuario
    WHERE u.id_rol = 2
      AND u.activo = true;
END;
$$ LANGUAGE plpgsql;
--
-- ============================================================
-- FUNCIÓN: get_curso_por_ficha

CREATE OR REPLACE FUNCTION get_curso_por_ficha(_ficha VARCHAR)
RETURNS TABLE (
    id_curso INT,
    nombre_curso VARCHAR,
    fecha_inicio DATE,
    fecha_fin DATE,
    instructor_lider INT
) AS $$
BEGIN
    RETURN QUERY
    SELECT 
        c.id_curso,
        c.nombre_curso,
        c.fecha_inicio,
        c.fecha_fin,
        C.id_profesor_lider
    FROM Tb_curso c
    WHERE c.ficha = _ficha;
END;
$$ LANGUAGE plpgsql;
-- ============================================================
-- PROCEDIMIENTO: desactivar_curso_y_log
CREATE OR REPLACE PROCEDURE desactivar_curso_y_log (
    in_ficha VARCHAR,
    in_mensaje VARCHAR
)
LANGUAGE plpgsql
AS $$
DECLARE
    v_id_usuario INTEGER;
BEGIN
    -- Actualiza el estado del curso a inactivo
    UPDATE Tb_curso
    SET ficha_activa = FALSE
    WHERE ficha = in_ficha;

    -- Busca el usuario líder del curso
    SELECT id_profesor_lider INTO v_id_usuario
      FROM Tb_curso
      WHERE ficha = in_ficha;

    -- Inserta el log de actividad
    INSERT INTO Tb_log_actividades (actividad, id_usuario)
    VALUES (in_mensaje, v_id_usuario);
END;
$$;