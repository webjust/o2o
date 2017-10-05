<?php
namespace app\index\controller;

use think\Controller;

class Index extends Controller
{
    public function index()
    {
        return $this->fetch();
    }

    public function test()
    {
        header("Content-Type:text/html; charset=utf-8");
        //\Map::getLngLat("广州");
        \Map::staticImage("广州天河体育中心");
    }
}
