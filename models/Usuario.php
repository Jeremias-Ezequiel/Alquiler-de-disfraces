<?php

class Usuario
{
    private $idUsuario;
    private $nombre;
    private $apellido;
    private $nombreUsuario;
    private $contra;
    private $direccion;
    private $tel;
    private $rol;

    const ROL_ADMIN = 1;
    const ROL_CLIENTE = 2;

    public function __construct($data = [])
    {

        if (!empty($data)) {
            echo "Hola";
            $this->hydrate($data);
        }
    }

    // Para que la función Hydrate sea eficiente debemos asignar dinámicamente los valores a través de los setter
    private function hydrate($data)
    {
        foreach ($data as $key => $value) {

            $method = "set" . ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    public function getRol()
    {
        return $this->rol;
    }

    public function setRol($rol)
    {
        $this->rol = $rol;
        return $this;
    }

    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario): self
    {
        $this->idUsuario = trim($idUsuario);
        return $this;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre): self
    {
        $this->nombre = trim(ucfirst(strtolower($nombre)));

        return $this;
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function setApellido($apellido): self
    {
        $this->apellido = trim(ucfirst(strtolower($apellido)));

        return $this;
    }


    public function getNombreUsuario()
    {
        return $this->nombreUsuario;
    }

    public function setNombreUsuario($nombreUsuario): self
    {
        $this->nombreUsuario = trim(strtolower($nombreUsuario));

        return $this;
    }

    public function getContra()
    {
        return $this->contra;
    }

    public function setContra($contra): self
    {
        $this->contra = trim($contra);

        return $this;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function setDireccion($direccion): self
    {
        $this->direccion = trim($direccion);

        return $this;
    }

    public function getTel()
    {
        return $this->tel;
    }

    public function setTel($tel): self
    {
        $this->tel = trim($tel);

        return $this;
    }

    public function validar()
    {
        $errores = [];

        # Nombre
        if (empty($this->nombre)) {
            $errores['nombre'] = "El nombre se obligatorio.";
        } elseif (strlen($this->nombre) > 30) {
            $errores['nombre'] = "El nombre no puede superar los 30 caracteres.";
        } elseif (!preg_match("\^[a-zA-ZáéíóúÁÉÍÓÚñÑ\S]+$\u", $this->nombre)) {
            $errores['nombre'] = "El nombre solo puede contener letras.";
        }

        # Apellido
        if (empty($this->apellido)) {
            $errores['apellido'] = "El apellido es obligatorio.";
        } elseif (strlen($this->apellido) > 30) {
            $errores['apellido'] = "El apellido no puede superar los 30 carcateres.";
        } elseif (!preg_match("\^[a-zA-ZáéíóúÁÉÍÓÚñÑ\S]+$\u", $this->apellido)) {
            $errores['apellido'] = "El apellido solo puede contener letras.";
        }

        # Nombre de usuario 
        if (empty($this->nombreUsuario)) {
            $errores['nombreUsuario'] = "El usuario es obligatorio.";
        } elseif (strlen($this->nombreUsuario > 30)) {
            $errores['nombreUsuario'] = "El usuario no puede superar los 30 caracteres.";
        } elseif (!preg_match("\^[a-zA-Z0-9_]+$/", $this->nombreUsuario)) {
            $errores['nombreUsuario'] = "El usuario solo admite letras, números y guion bajo.";
        }

        # Password
        # CONSIDERAR CAMBIAR LA LONGITUD DE LA CONTRASEÑA A 255 PARA PODER ENCRIPTARLA Y HACERLA MÁS SEGURA
        if (empty($this->contra)) {
            $errores['contra'] = "La contraseña es obligatoria.";
        } elseif (strlen($this->contra) > 20) {
            $errores['contra'] = "la contraseña no puede superar los 20 caracteres.";
        }

        # Dirección 
        # NO hacemos la dirección una información obligatoria, entonces validamos solamente si el usuario lo entrega
        if (!empty($this->direccion)) {
            if (strlen($this->direccion) > 40) {
                $errores['direccion'] = "La dirección es muy larga (máx 40).";
            } elseif (!preg_match("/^[a-zA-Z0-9âêîôûÂÊÎÔÛñÑ\s.,#-]+$/u", $this->direccion)) {
                $errores['direccion'] = "La dirección contieen caracteres inválidos.";
            }
        }

        # Teléfono
        # NO hacemos el teléfono una información obligatoria 
        if (!empty($this->tel)) {
            if (strlen($this->tel) > 20) {
                $errores['tel'] = "El teléfono es muy largo";
            } elseif (!preg_match("/^[0-9]+$/", $this->tel)) {
                $errores['tel'] = "El teléfono solo debe contener números (sin espacios ni guiones).";
            }
        }

        return $errores;
    }

    public function esAdmin()
    {
        return $this->rol === self::ROL_ADMIN;
    }

    public function esCliente()
    {
        return $this->rol === self::ROL_CLIENTE;
    }
}
