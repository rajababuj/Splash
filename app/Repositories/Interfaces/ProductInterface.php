<?php
namespace App\Repositories\Interfaces;

Interface ProductInterface{
    
    public function allmyproduct();
    public function home();
    public function index();
    
    public function store($data);

}