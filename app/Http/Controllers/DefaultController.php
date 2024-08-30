<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    protected array $data;
    public function __construct()
    {
        //NAVIGACIJA
        $this->data['menu']=[
            [
                'name'=>'Home',
                'route'=>'/'
            ],
            [
                'name'=>'Products',
                'route'=>'/items'
            ],
            [
                'name'=>'About',
                'route'=>'/about'
            ]
        ];
    }

}
