<?php

namespace app\admin\controller;

use think\Controller;
use think\Db;

class Category extends Controller
{
    private $obj;

    public function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
        $this->obj = model('Category');
    }

    public function index()
    {
        $parent_id = input('param.parent_id', 0, 'intval');
        $categories = $this->obj->getFirstCategorys($parent_id);
        return $this->fetch('', ['categories' => $categories]);
    }

    public function add()
    {
        $categories = $this->obj->getNormalFirstCategory();
        return $this->fetch('', ['categories' => $categories]);
    }

    public function save()
    {
        // 如果不是post提交，报错信息
        if (!request()->isPost()) {
            $this->error('请求失败');
        }

        $data = input('post.');
        $validate = validate('Category');
        if (!$validate->scene('add')->check($data)) {
            $this->error($validate->getError());
        }

        // 如果传递过来的值有 id 表示是执行更新的代码区间
        if (!empty($data['id'])) {
            // 执行更新操作
            $this->update($data);
        }
        // 实例化模型，把$data添加到数据库
        $res = $this->obj->add($data);
        if ($res) {
            $this->success('新增成功');
        } else {
            $this->error('新增失败');
        }
    }

    public function edit($id = 0)
    {
        if (intval(input('param.id')) < 0) {
            $this->error('参数不合法');
        }

        $category = $this->obj->get($id);

        $categories = $this->obj->getNormalFirstCategory();
        return $this->fetch('',
            [
                'categories' => $categories,
                'category' => $category,
            ]
        );
    }

    public function update($data)
    {
        $res = $this->obj->save($data, ['id' => intval($data['id'])]);
        if ($res) {
            $this->success('更新成功');
        } else {
            $this->error('更新失败');
        }
    }
}
