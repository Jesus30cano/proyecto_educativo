<?php
require_once __DIR__ . "/../../core/Database.php";

class AdminModel {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Métodos específicos para el modelo de administrador pueden ser añadidos aquí


    public function adminRegistrarUsuario($email, $tipo_documento, $no_documento, $password, $id_rol){

    $sql = "CALL admin_registrar_usuario(:email, :tipo_documento, :no_documento, :password, :id_rol)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':tipo_documento', $tipo_documento);
    $stmt->bindParam(':no_documento', $no_documento);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':id_rol', $id_rol, PDO::PARAM_INT);
    $stmt->execute();
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




public function crearCurso($ficha, $nombre_curso, $id_profesor_lider)
{
    $sql = "CALL crear_curso(:ficha, :nombre_curso, :id_profesor_lider)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':ficha', $ficha);
    $stmt->bindParam(':nombre_curso', $nombre_curso);
    $stmt->bindParam(':id_profesor_lider', $id_profesor_lider, PDO::PARAM_INT);
    $stmt->execute();
}




public function editarCurso($id_curso, $ficha, $nombre_curso, $id_profesor_lider, $ficha_activa)
{
    $sql = "CALL editar_curso(:id_curso, :ficha, :nombre_curso, :id_profesor_lider, :ficha_activa)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':id_curso', $id_curso, PDO::PARAM_INT);
    $stmt->bindParam(':ficha', $ficha);
    $stmt->bindParam(':nombre_curso', $nombre_curso);
    $stmt->bindParam(':id_profesor_lider', $id_profesor_lider, PDO::PARAM_INT);
    $stmt->bindParam(':ficha_activa', $ficha_activa, PDO::PARAM_BOOL);
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





}
?>