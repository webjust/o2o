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