<?php

namespace app\index\controller;

use think\Controller;
use think\Request;

class User extends Controller
{
    public function login()
    {
        return $this->fetch('user/login');
    }

    public function register()
    {
        return $this->fetch();
    }
}
