<?php

include_once __DIR__ . "/../interfaces/EntityInterface.php";

class Usuario implements EntityInterface
{
    private $id;
    private $name;
    private $lastname;
    private $username;
    private $password;
    private $address;
    private $phone;
    private $role;

    const ADMIN_ROLE = 1;
    const CUSTOME_ROLE = 2;

    public function __construct($data = [])
    {

        if (!empty($data)) {
            $this->hydrate($data);
        }
    }

    // Para que la función Hydrate sea eficiente debemos asignar dinámicamente los valores a través de los setter
    public function hydrate($data)
    {
        foreach ($data as $key => $value) {

            $method = "set" . ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role)
    {
        $this->role = $role;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): self
    {
        $this->id = trim($id);
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name): self
    {
        $this->name = trim(ucfirst(strtolower($name)));

        return $this;
    }

    public function getlastname()
    {
        return $this->lastname;
    }

    public function setlastname($lastname): self
    {
        $this->lastname = trim(ucfirst(strtolower($lastname)));

        return $this;
    }


    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username): self
    {
        $this->username = trim(strtolower($username));

        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password): self
    {
        $this->password = trim($password);

        return $this;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address): self
    {
        $this->address = trim($address);

        return $this;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone): self
    {
        $this->phone = trim($phone);

        return $this;
    }

    public function validar()
    {
        $errors = [];

        # Name
        if (empty($this->name)) {
            $errors['name'] = "El nombre se obligatorio.";
        } elseif (strlen($this->name) > 30) {
            $errors['name'] = "El nombre no puede superar los 30 caracteres.";
        } elseif (!preg_match("\^[a-zA-ZáéíóúÁÉÍÓÚñÑ\S]+$\u", $this->name)) {
            $errors['name'] = "El nombre solo puede contener letras.";
        }

        # Apellido
        if (empty($this->lastname)) {
            $errors['lastname'] = "El apellido es obligatorio.";
        } elseif (strlen($this->lastname) > 30) {
            $errors['lastname'] = "El apellido no puede superar los 30 carcateres.";
        } elseif (!preg_match("\^[a-zA-ZáéíóúÁÉÍÓÚñÑ\S]+$\u", $this->lastname)) {
            $errors['lastname'] = "El apellido solo puede contener letras.";
        }

        # Nombre de usuario 
        if (empty($this->username)) {
            $errors['username'] = "El usuario es obligatorio.";
        } elseif (strlen($this->username > 30)) {
            $errors['username'] = "El usuario no puede superar los 30 caracteres.";
        } elseif (!preg_match("\^[a-zA-Z0-9_]+$/", $this->username)) {
            $errors['username'] = "El usuario solo admite letras, números y guion bajo.";
        }

        # Password
        # CONSIDERAR CAMBIAR LA LONGITUD DE LA CONTRASEÑA A 255 PARA PODER ENCRIPTARLA Y HACERLA MÁS SEGURA
        if (empty($this->password)) {
            $errors['password'] = "La contraseña es obligatoria.";
        } elseif (strlen($this->password) > 20) {
            $errors['password'] = "la contraseña no puede superar los 20 caracteres.";
        }

        # Dirección 
        # NO hacemos la dirección una información obligatoria, entonces validamos solamente si el usuario lo entrega
        if (!empty($this->address)) {
            if (strlen($this->address) > 40) {
                $errors['address'] = "La dirección es muy larga (máx 40).";
            } elseif (!preg_match("/^[a-zA-Z0-9âêîôûÂÊÎÔÛñÑ\s.,#-]+$/u", $this->address)) {
                $errors['address'] = "La dirección contieen caracteres inválidos.";
            }
        }

        # Teléfono
        # NO hacemos el teléfono una información obligatoria 
        if (!empty($this->phone)) {
            if (strlen($this->phone) > 20) {
                $errors['phone'] = "El teléfono es muy largo";
            } elseif (!preg_match("/^[0-9]+$/", $this->phone)) {
                $errors['phone'] = "El teléfono solo debe contener números (sin espacios ni guiones).";
            }
        }

        return $errors;
    }

    public function isAdmin()
    {
        return $this->role === self::ADMIN_ROLE;
    }

    public function isCustome()
    {
        return $this->role === self::CUSTOME_ROLE;
    }

    public function toArray()
    {
        return [
            "name" => $this->name,
            "lastname" => $this->lastname,
            "username" => $this->username,
            "password" => $this->password,
            "address" => $this->address,
            "phone" => $this->phone,
            "role" => $this->role
        ];
    }
}
