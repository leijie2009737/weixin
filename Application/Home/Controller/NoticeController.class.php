<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/11
 * Time: 15:51
 */

namespace Home\Controller;


use Think\Page;

class NoticeController extends HomeController
{
    /*
     *小区通知列表
     */
    public function index(){
        $model = M('Document');
        $count  = $model->count();// 查询满足要求的总记录数
        $Page   = new Page($count,2);//传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
        $list = $model->where('category_id=40')->limit($Page->firstRow.','.$Page->listRows)->select();
//        var_dump($list);exit;
        $this->assign('list', $list);
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }


    /*
     *小区通知详情
     */
    public function detail($id){
        $model=M('document');
        $doc=$model->where(['id'=>$id])->select();
//        $list=$model->where($id)->select();
//        $list=$model->alias('doc')->join('onethink_document_article detail  ON doc.id = detail.id')->field('detail.id,detail.content')->where(['doc.id'=>$id])->select();
        $article=M('document_article');
        $list=$article->where(['id'=>$id])->select();
//        var_dump($list);exit;
        $this->assign('doc', $doc);
        $this->assign('list', $list);
        $this->display();
    }
}