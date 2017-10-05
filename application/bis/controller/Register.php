<?php
namespace app\bis\controller;

use think\Controller;

class Register extends Controller
{
    public function index()
    {
        return $this->fetch();
    }
}