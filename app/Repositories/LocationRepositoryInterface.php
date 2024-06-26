<?php

namespace App\Repositories;

interface LocationRepositoryInterface
{
    public function getAll();
    public function getLocationById($id);

    public function add($incomingFields);
    public function delete($id);
}