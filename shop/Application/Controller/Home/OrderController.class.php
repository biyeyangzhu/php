<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/13
 * Time: 10:19
 */
class OrderController extends  Controller
{
    /**
     * 显示功能
     */
        public function index(){
            $orderModel = new OrderModel();
            $result = $orderModel->getAll();
            $this->assign('result', $result);
            $this->display('index');
        }

    /**
     * 删除
     */
    public function delete()
    {
        //根据ID删除数据
        $id = $_GET['id'];
//        var_dump($id);die;
        $orderModel = new OrderModel();
        $orderModel->delete($id);
        //删除成功 跳转
        $this->redirect('index.php?p=Home&c=Order&a=index');
    }


    /**
     * 增加功能
     */
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $data = $_POST;
            $orderModel = new OrderModel();
            $result = $orderModel->insert($data);
            if ($result === false) {
                $this->redirect("index.php?p=Home&c=Order&a=add", "添加失败" . $orderModel->getError(), 3);
            }
            //添加成功跳转页面
            $this->redirect("index.php?p=Home&c=Order&a=index");
        } else {
            $memberModel=new MemberModel();
            $user =$memberModel->getAll();
            $this->assign('user',$user);
            $this->display('add');
        }
    }


    /**
     * 修改功能
     */
    public function edit()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            //接收数据
            $data = $_POST;
            $orderModel = new OrderModel();
            $result = $orderModel->update($data);
            if ($result === false) {
                $this->redirect("index.php?p=Home&c=Order&a=edit", "添加失败" . $orderModel->getError(), 3);
            }
            //添加成功跳转首页
            $this->redirect("index.php?p=Home&c=Order&a=index");
        } else {
            $id = $_GET['id'];
            //回显一条数据
            $orderModel = new OrderModel();
            $row=$orderModel->getOne($id);
            $this->assign('row',$row);
            //回显分类数据
            $memberModel=new MemberModel();
            $rows =$memberModel->getAll();
            $this->assign('rows',$rows);
            $this->display('edit');
        }
    }
}