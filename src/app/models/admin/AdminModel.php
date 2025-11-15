<?php
require_once __DIR__ . "/../../../core/Database.php";

class AdminModel {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Métodos específicos para el modelo de administrador pueden ser añadidos aquí


    public function adminRegistrarUsuario($email, $tipo_documento, $no_documento, $password, $id_rol) {
    $sql = "SELECT admin_registrar_usuario(:email, :tipo_documento, :no_documento, :password, :id_rol) AS id_usuario";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':tipo_documento', $tipo_documento);
    $stmt->bindParam(':no_documento', $no_documento);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':id_rol', $id_rol, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['id_usuario'] ?? null;
}



public function listarUsuariosPorIdRol($id_rol){

    $sql = "SELECT * FROM listar_usuarios_por_idrol(:id_rol)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':id_rol', $id_rol, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC); 
}



public function desactivarUsuario($id_usuario){
    $sql = "CALL desactivar_usuario(:id_usuario)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $stmt->execute();
}



public function actualizarUsuario($id_usuario, $email, $password, $id_rol){

    $sql = "CALL actualizar_usuario(:id_usuario, :email, :password, :id_rol)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password); 
    $stmt->bindParam(':id_rol', $id_rol, PDO::PARAM_INT);
    $stmt->execute();
}



public function activarUsuario($id_usuario){

    $sql = "CALL activar_usuario(:id_usuario)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $stmt->execute();
}




public function crearCurso($ficha, $nombre_curso, $id_profesor_lider,$fecha_inicio, $fecha_fin)
{
    $sql = "CALL crear_curso(:ficha, :nombre_curso, :id_profesor_lider, :fecha_inicio, :fecha_fin)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':ficha', $ficha);
    $stmt->bindParam(':nombre_curso', $nombre_curso);
    $stmt->bindParam(':id_profesor_lider', $id_profesor_lider, PDO::PARAM_INT);
    $stmt->bindParam(':fecha_inicio', $fecha_inicio);
    $stmt->bindParam(':fecha_fin', $fecha_fin);
    $stmt->execute();
}




public function editarCurso($id_curso, $ficha, $nombre_curso, $id_profesor_lider, $ficha_activa,$fecha_inicio, $fecha_fin)
{
    $sql = "CALL editar_curso(:id_curso, :ficha, :nombre_curso, :id_profesor_lider, :ficha_activa, :fecha_inicio, :fecha_fin)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':id_curso', $id_curso, PDO::PARAM_INT);
    $stmt->bindParam(':ficha', $ficha);
    $stmt->bindParam(':nombre_curso', $nombre_curso);
    $stmt->bindParam(':id_profesor_lider', $id_profesor_lider, PDO::PARAM_INT);
    $stmt->bindParam(':ficha_activa', $ficha_activa, PDO::PARAM_BOOL);
    $stmt->bindParam(':fecha_inicio', $fecha_inicio);
    $stmt->bindParam(':fecha_fin', $fecha_fin);
    $stmt->execute();
}






public function asignarEstudianteACurso($id_usuario, $id_curso){

    $sql = "CALL asignar_estudiante_a_curso(:id_usuario, :id_curso)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $stmt->bindParam(':id_curso', $id_curso, PDO::PARAM_INT);
    $stmt->execute();
}



public function removerEstudianteDeCurso($id_usuario, $id_curso){

    $sql = "CALL remover_estudiante_de_curso(:id_usuario, :id_curso)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $stmt->bindParam(':id_curso', $id_curso, PDO::PARAM_INT);
    $stmt->execute();
}





public function asignarProfesorACurso($id_usuario, $id_curso)
{
    $sql = "CALL asignar_profesor_a_curso(:id_usuario, :id_curso)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $stmt->bindParam(':id_curso', $id_curso, PDO::PARAM_INT);
    $stmt->execute();
}





public function removerProfesorDeCurso($id_usuario, $id_curso)
{
    $sql = "CALL remover_profesor_de_curso(:id_usuario, :id_curso)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $stmt->bindParam(':id_curso', $id_curso, PDO::PARAM_INT);
    $stmt->execute();
}





public function reporteNotasEstudiante($id_usuario)
{
    $sql = "SELECT * FROM reporte_notas_estudiante(:id_usuario)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC); 
}






public function reporteNotasPorCurso($id_curso)
{
    $sql = "SELECT * FROM reporte_notas_por_curso(:id_curso)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':id_curso', $id_curso, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC); // Devuelve todas las notas como arreglo asociativo
}





public function enviarNotificacionGeneral($tipo, $titulo, $mensaje, $id_rol = null)
{
    $sql = "SELECT enviar_notificacion_general(:tipo, :titulo, :mensaje, :id_rol)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':tipo', $tipo);
    $stmt->bindParam(':titulo', $titulo);
    $stmt->bindParam(':mensaje', $mensaje);
    $stmt->bindParam(':id_rol', $id_rol, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchColumn(); // Devuelve el mensaje de confirmación
}







public function enviarNotificacionAUsuario($id_usuario, $tipo, $titulo, $mensaje)
{
    $sql = "SELECT enviar_notificacion_a_usuario(:id_usuario, :tipo, :titulo, :mensaje)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $stmt->bindParam(':tipo', $tipo);
    $stmt->bindParam(':titulo', $titulo);
    $stmt->bindParam(':mensaje', $mensaje);
    $stmt->execute();
    return $stmt->fetchColumn(); // Devuelve el mensaje de confirmación
}





public function obtenerBoletinEstudiante($id_usuario)
{
    $sql = "SELECT * FROM obtener_boletin_estudiante(:id_usuario)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC); // Devuelve todas las filas del boletín como arreglo asociativo
}
public function crear_datos_personales($id_usuario, $nombre, $apellido, $fecha_nacimiento, $telefono, $direccion, $genero) 
{
    $sql = "CALL crear_datos_personales(:id_usuario, :nombre, :apellido, :fecha_nacimiento, :telefono, :direccion, :genero)";
    $stmt = $this->conn->prepare($sql);

    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':apellido', $apellido);
    $stmt->bindParam(':fecha_nacimiento', $fecha_nacimiento);
    $stmt->bindParam(':telefono', $telefono);
    $stmt->bindParam(':direccion', $direccion);
    $stmt->bindParam(':genero', $genero);

    $stmt->execute();
}

public function obtener_total_activo() {
    $sql = "SELECT * FROM obtener_totales_activos()";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public function obtener_total_cursos() {
    $sql = "SELECT * FROM obtener_total_cursos()";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
public function obtener_instructores_disponibles() {
    $sql = "SELECT * FROM get_instructores()";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
public function obtener_datos_curso($ficha) {
    $sql = "SELECT * FROM get_curso_por_ficha(:ficha)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':ficha', $ficha, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
public function desactivarCursoYLog($ficha, $mensaje) {
    $sql = "CALL desactivar_curso_y_log(:ficha, :mensaje)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':ficha', $ficha, PDO::PARAM_STR);
    $stmt->bindParam(':mensaje', $mensaje, PDO::PARAM_STR);
    $stmt->execute();
    
}

}
?>