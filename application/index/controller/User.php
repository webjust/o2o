<?php

namespace app\index\controller;

use think\Controller;
use think\Request;

class User extends Controller
{
    public function login()
    {
        return $this->fetch();
    }

    public function register()
    {
        return $this->fetch();
    }
}
