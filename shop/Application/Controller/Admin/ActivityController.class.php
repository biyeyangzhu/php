<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/13
 * Time: 14:15
 */
class ActivityController extends PlatformController
{
    /**
     * 展示活动列表
     */
    public function index(){
            $page = $_GET['page']??1;
            $activitymodel = new ActivityModel();
            $result = $activitymodel->index($page);
            unset($_REQUEST['page']);
            $url = http_build_query($_REQUEST);
            $pageHtml = PageTool::show($result['count'],$result['pagesize'],$result['page'],"index.php?".$url);
            $this->assign('pagehtml',$pageHtml);
            $this->assign($result);
            $this->display('index');
        }

    /**
     * 添加活动
     */
    public function insert(){
        if ($_SERVER['REQUEST_METHOD']=="POST"){
            $data = $_POST;
            $data['start_time']=strtotime($data['start_time']);
            $data['end_time']=strtotime($data['end_time']);
            $data['time']=time();
            $activity = new ActivityModel();
            $activity->insert($data);
            $this->redirect("index.php?p=Admin&c=Activity&a=index","添加成功",3);
        }else{
            $this->display('add');
        }

    }
    /**
     * 修改活动
     */
    public function update(){
        if ($_SERVER['REQUEST_METHOD']=="POST"){
            $data = $_POST;
            $acticity = new ActivityModel();
            $acticity->update($data);
            $this->redirect("index.php?p=Admin&c=Activity&a=index","修改成功",3);
        }else{
            $id = $_GET['id'];
            $acticity = new ActivityModel();
            $result = $acticity->edit($id);
            var_dump($result);
            $this->assign('row',$result);
            $this->display('edit');
        }
    }
    /**
     * 删除功能
     */
    public function delete(){
    $id=$_GET['id'];
    $activity = new ActivityModel();
    $activity->delete($id);
    $this->redirect("index.php?p=Admin&c=Activity&a=index","删除成功",3);
    }
    /**
     * 详情页
     */
    public function content(){
        $id = $_GET['id'];
        $activity = new ActivityModel();
        $result=$activity->content($id);
        $this->assign('content',$result);
        $this->display('content');
    }
}