<?php

/**
 * 百度地图接口封装类
 */
class Map
{
    /*
     * 根据地址获取百度地图的经纬度信息
     * */
    public static function getLngLat($address)
    {
        $data = [
            'address' => $address,
            'ak' => config('map.ak'),
            'output' => 'json',
        ];

        $url = config('map.baidu_map_url') . config('map.geocoder') . '?' . http_build_query($data);

        echo http_build_query($data);
        $result = doCurl($url);
        print_r($result);
    }

    /*
     * 根据经纬度信息获取百度地图的静态图片
     * */
    public static function staticImage($center)
    {
        if (!$center) {
            return '';
        }

        $data = [
            'ak' => config('map.ak'),
            'width' => config('map.width'),
            'height' => config('map.height'),
            'center' => $center,
            'markers' => $center,
            'zoom' => 18,
        ];
        $url = config('map.baidu_map_url') . config('map.staticimage') . '?' . http_build_query($data);
        $result = doCurl($url);
        echo "<img src='" . $url . "'>";
        return $result;
    }
}