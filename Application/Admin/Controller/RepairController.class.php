<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/10
 * Time: 14:26
 */

namespace Admin\Controller;


use Think\Page;

class RepairController extends AdminController
{
    /*
     *物业报修首页
     */
    public function index()
    {
        $model =M('Repair');//实例化对象
        $count  = $model->count();// 查询满足要求的总记录数
        $Page   = new Page($count,10);//传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
        $list = $model->limit($Page->firstRow.','.$Page->listRows)->select();

        $this->assign('list', $list);
        $this->assign('page',$show);// 赋值分页输出
        $this->display();

    }

    /*
     *新增报修内容
     */
    public function add()
    {
        if(IS_POST){
            $Channel = D('Repair');
            $data = $Channel->create();
            if($data){

                $Channel->sn=uniqid(date("Y-m-d"));
                $id = $Channel->add();
                if($id){
                    $this->success('新增成功', U('index'));
                    //记录行为
                    action_log('update_channel', 'channel', $id, UID);
                } else {
                    $this->error('新增失败');
                }
            } else {
                $this->error($Channel->getError());
            }
        } else {
            $this->assign('info',null);
            $this->display('edit');
        }
    }

    /*
     *查看详情
     */
    public function edit($id = 0)
    {
        if(IS_POST){
            $Channel = D('Repair');
            $data = $Channel->create();
            if($data){
                if($Channel->save()){
                    //记录行为
                    action_log('update_channel', 'channel', $data['id'], UID);
                    $this->success('编辑成功', U('index'));
                } else {
                    $this->error('编辑失败');
                }

            } else {
                $this->error($Channel->getError());
            }
        } else {
            $info = array();
            /* 获取数据 */
            $info = M('Repair')->find($id);

            if(false === $info){
                $this->error('获取配置信息错误');
            }
            $this->assign('info', $info);
            $this->display();
        }
    }

    /*
     *删除内容（逻辑删除）
     */
    public function del()
    {

    }
}