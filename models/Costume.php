<?php

class Costume implements EntityInterface
{
    private $id;
    private $description;
    private $size;
    private $status_id;

    public function __construct($data = [])
    {
        if (!empty($data)) {
            $this->hydrate($data);
        }
    }

    function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $method = "set" . ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    function getId()
    {
        return $this->id;
    }

    function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    function toArray()
    {
        return [
            "description" => $this->description,
            "size" => $this->size,
            "status" => $this->status_id
        ];
    }

    function getDescription()
    {
        return $this->description;
    }

    function setDescription($description)
    {
        $this->description = trim($description);
        return $this;
    }

    function getSize()
    {
        return $this->size;
    }

    function setSize($size)
    {
        $this->size = $size;
        return $this;
    }
}
