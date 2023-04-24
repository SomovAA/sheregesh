<?php

namespace App\Controller;
abstract class AbstractController
{
    protected function displayJson(array $data = [])
    {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }
}