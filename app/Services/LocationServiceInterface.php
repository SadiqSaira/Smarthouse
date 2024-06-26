<?php

namespace App\Services;

interface LocationServiceInterface
{
    public function getAll();
    public function getLocationById($id);
    public function add($incomingFields) ;
    public function delete($id);
}