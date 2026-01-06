<?php

interface EntityInterface
{
    function getId();
    function setId($id);
    function hydrate(array $data);
    function toArray();
}
