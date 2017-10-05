<?php

namespace app\common\model;

use think\Model;

class Category extends Model
{
    protected $autoWriteTimestamp = true;

    public function add($data)
    {
        $data['status'] = 1;
        return $this->save($data);
    }

    /**
     * 获取父级分类
     * @return false|\PDOStatement|string|\think\Collection
     */
    public function getNormalFirstCategory()
    {
        $data = [
            'status' => 1,
            'parent_id' => 0,
        ];
        $order = ['id' => 'desc'];
        return $this->where($data)
            ->order($order)
            ->select();
    }


    public function getFirstCategorys($parent_id = 0)
    {
        $data = [
            'status' => ['neq', '-1'],
            'parent_id' => $parent_id,
        ];
        $order = ['listorder' => 'desc', 'id' => 'desc'];
        $result = $this->where($data)
            ->order($order)
            ->paginate();

        return $result;
    }
}