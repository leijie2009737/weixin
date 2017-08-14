<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/10
 * Time: 15:13
 */

namespace Home\Model;

use Think\Model;

class RepairModel extends Model
{
    protected $_validate = array(
        array('name', 'require', '姓名不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
        array('tel', 'require', '电话不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
        array('title', 'require', '标题不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
        array('address', 'require', '地址不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
        array('question', 'require', '内容不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
    );

    protected $_auto = array(
        array('user_id', 1, self::MODEL_INSERT),
        array('create_time', NOW_TIME, self::MODEL_INSERT),
//        array('sn', NOW_TIME, self::MODEL_INSERT),
        array('status', '1', self::MODEL_BOTH),

    );
}