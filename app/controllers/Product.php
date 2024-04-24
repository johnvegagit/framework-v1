<?php
declare(strict_types=1);
use models\Product as product_model;

class Product
{
    use Controller;

    public function index()
    {

        $data = ['title' => 'Productos'];
        $this->header($data);
        $user = new product_model;
        $user->getAll();
        $this->footer();

    }
}

