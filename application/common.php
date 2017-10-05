<?php
// 应用公共文件
function status($staus)
{
    if ($staus == 1) {
        $str = "<span class='label label-success radius'>正常</span>";
    } elseif ($staus == 0) {
        $str = "<span class='label label-danger radius'>待审</span>";
    } else {
        $str = "<span class='label label-danger radius'>删除</span>";
    }
    return $str;
}

// 访问api接口
function doCurl($url, $type = 0, $data = [])
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    if ($type == 1) {
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    }
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}