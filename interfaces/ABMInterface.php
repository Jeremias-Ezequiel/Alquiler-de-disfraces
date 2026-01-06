<?php

interface ABMInterface
{
    function create(EntityInterface $entity);

    function get($id);
    function getAll();
    function update($id);
    function delete($id);
}
