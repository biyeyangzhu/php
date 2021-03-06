<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/16
 * Time: 0:34
 */
class ruleController extends PlatformController
{
    /**
     * 显示页面
     */
    public function index()
    {
        $ruleModel = new ruleModel();
        $result = $ruleModel->getAll();
        $this->assign('rows', $result);
        $this->display('index');
    }

    /**
     * 增加功能
     */
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $data = $_POST;
            $panlsModel = new ruleModel();
            $result = $panlsModel->insert($data);
            if ($result === false) {
                $this->redirect("index.php?p=Admin&c=rule&a=add", "添加失败" . $panlsModel->getError(), 3);
            }
            //添加成功跳转页面
            $this->redirect("index.php?p=Admin&c=rule&a=index");
        } else {
            $this->display('add');
        }
    }

    /**
     * 删除
     */
    public function delete()
    {
        //根据ID删除数据
        $id = $_GET['id'];
//        var_dump($id);die;
        $ruleModel = new ruleModel();
        $ruleModel->delete($id);
        //删除成功 跳转
        $this->redirect('index.php?p=Admin&c=rule&a=index');
    }

    /**
     * 修改功能
     */
    public function edit()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            //接收数据
            $data = $_POST;
            $ruleModel = new ruleModel();
            $result = $ruleModel->update($data);
            if ($result === false) {
                $this->redirect("index.php?p=Admin&c=rule&a=edit", "修改失败" . $ruleModel->getError(), 3);
            }
            //添加成功跳转首页
            $this->redirect("index.php?p=Admin&c=rule&a=index");
        } else {
            $id = $_GET['id'];
            $ruleModel = new ruleModel();
            $rows = $ruleModel->edit($id);
            //分配页面显示数据
//            var_dump($rows);die;
            $this->assign('row', $rows);
            $this->display('edit');
        }
    }
}