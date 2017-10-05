<?php
namespace app\index\controller;

use phpmailer\Email;
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

    public function email()
    {
        $send = \phpmailer\Email::send('wbo86@126.com','这就是一封测试邮件的标题',"test by wangbo");
        if (!$send)
            echo "发送失败！";
            die();
        echo "发送成功";
    }
}
