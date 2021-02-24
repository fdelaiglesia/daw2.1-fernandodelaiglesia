<?php
abstract class Dato
{
}
trait Identificable
{
    protected int $id;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }
}
/* Clase usuario */
class Usuario extends Dato
{
    use Identificable;
    private string $usuario;
    private string $contrasenna;
    private string $codigoCookie;
    private int $tipoUsuario;
    private string $nombreCliente;
    private string  $apellidos;

    public function __construct(int $idCliente, string $identificador, string $contrasenna
        , string $codigoCookie, int $tipoUsuario, string $nombreCliente, string $apellidos)
    {
        $this->setId($idCliente);
        $this->setIdentificador($identificador);
        $this->setContrasenna($contrasenna);
        $this->setCodigoCookie($codigoCookie);
        $this->setCodigoCookie($tipoUsuario);
        $this->setNombreCliente($nombreCliente);
        $this->setApellidos($apellidos);
    }

    /* GET USUARIO*/
    public function getIdentificador(): string{return $this->identificador;}
    public function getContrasenna(): string{return $this->contrasenna;}
    public function getCodigoCookie(): string{return $this->codigoCookie;}
    public function getNombreCliente(): string{return $this->nombreCliente;}
    public function getApellidos(): string{return $this->apellidos;}

    /* SET USUARIO*/
    public function setIdentificador(string $identificador): void{$this->indentificador = $identificador;}
    public function setContrasenna(string $contrasenna): void{$this->contrasenna = $contrasenna;}
    public function setCodigoCookie(string $codigoCookie): void{$this->codigoCookie = $codigoCookie;}
    public function setTipoUsuario(string $tipoUsuario): void{$this->tipoUsuario = $tipoUsuario;}
    public function setNombreCliente(string $nombreCliente): void{$this->nombreCliente = $nombreCliente;}
    public function setApellidos(string $apellidos): void{$this->apellidos = $apellidos;}
}

class Publicacion extends Dato
{
    use Identificable;
    private int $idPublicacion;
    private string $fecha;
    private string $emisorId;
    private ?string $distinatorioId;
    private ?string $destacadaHasta;
    private string $asunto;
    private string  $contenido;

    public function __construct(int $idPublicacion,string $fecha, string $emisorId, string $distinatorioId, string $destacadaHasta, string $asunto, string $contenido)
    {
        $this->setId($idPublicacion);
        $this->setFecha($fecha);
        $this->setEmisorId($emisorId);
        $this->setDistinatorioId($distinatorioId);
        $this->setDestacadaHasta($destacadaHasta);
        $this->setAsunto($asunto);
        $this->setContenido($contenido);
    }
    /* GET PUBLICACION*/

    public function getFecha(): string{return $this->fecha;}
    public function getEmisorId(): string{return $this->emisorId;}
    public function getDistinatorioId(): string{return $this->distinatorioId;}
    public function getDestacadaHasta(): string{return $this->destacadaHasta;}
    public function getAsunto(): string{return $this->asunto;}
    public function getContenido(): string{return $this->contenido;}

    /* SET PUBLICACION*/
    public function setFecha(string $fecha): void{$this->fecha = $fecha;}
    public function setEmisorId(string $emisorId): void{$this->emisorId = $emisorId;}
    public function setDistinatorioId(?string $distinatorioId): void{$this->distinatorioId = $distinatorioId;}
    public function setDestacadaHasta(?string $destacadaHasta): void{$this->destacadaHasta = $destacadaHasta;}
    public function setAsunto(string $asunto): void{$this->asunto = $asunto;}
    public function setContenido(string $contenido): void{$this->contenido = $contenido;}


}