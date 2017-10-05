<?php

namespace app\admin\controller;

use think\Controller;
use think\Db;

class Category extends Controller
{
    private $obj;

    /**
     * 初始化：创建Category模型
     */
    public function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
        $this->obj = model('Category');
    }

    /**
     * 分类首页
     * @return mixed
     */
    public function index()
    {
        $parent_id = input('param.parent_id', 0, 'intval');         // 获取GET的变量parent_id的值，默认是0
        $categories = $this->obj->getFirstCategorys($parent_id);    // 根据父ID的值获取分类
        return $this->fetch('', ['categories' => $categories]);     // 渲染视图
    }

    /**
     * 添加分类页面
     * @return mixed
     */
    public function add()
    {
        $categories = $this->obj->getNormalFirstCategory();     // 获取当前父级分类
        return $this->fetch('', ['categories' => $categories]); // 渲染视图
    }

    /**
     * 表单提交保存操作
     * 1、自动验证 2、添加或者更新操作
     */
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

    public function listorder($id, $listorder)
    {
        $res = $this->obj->save(['listorder' => $listorder], ['id' => $id]);
        if ($res) {
            $this->result($_SERVER['HTTP_REFERER'], 1, 'success');
        } else {
            $this->result($_SERVER['HTTP_REFERER'], 0, 'error');
        }
    }

    public function status()
    {
        // 测试接收到的数据
//        print_r(input('param.'));
        // 1. 校验
        $data = input('param.');
        // To Do

        // 2. 逻辑
        $ret = $this->obj->save(['status' => $data['status']], ['id' => $data['id']]);
        // 3. 渲染
        if ($ret) {
            $this->success('状态更新成功！');
        } else {
            $this->error('状态更新失败！');
        }
    }
}
