<?php
/**
 * 公共接口API
 * 不需要验证用户身份token
 */
namespace V1\Controller;

use Common\Controller\ApiController;
header('Content-Type: application/x-javascript; charset=UTF-8');

class CommonController extends ApiController{
    public function index(){
       $this->show(300,'无效接口');
    }

    // 获取行程设置
    public function getRoute()
    {
        // $id=84;
        if (!I('get.id')) {
            $this->show(300, '未获用户id参数或该id不存在');
        }
        $id=I('get.id');
        $shuttle = M('shuttle');
        $info = $shuttle->where("users_id='$id'")->field('home_addr,company_addr,on_work_time,off_work_time')->select();
        $users_id = $shuttle->where("users_id='$id'")->getField('users_id');
        if ($users_id != $id) {
            $this->show(201, '用户id不存在');
        }
        if ($info){
            $this->show(200, 'success', $info);
        }else if($info == null){
            $this->show(202, '暂无数据');
        }else{
            $this->show(300, '系统繁忙，请稍后再试');
        }
    }

    // 行程添加或设置
    public function setRoute()
    {
        if (IS_POST) {
            if (!I('request.id')) {
                $this->show(300, '未获用户id参数或该id不存在');
            }
             // $id=84;
             $user_id=I('request.id');
             $users = M('users');
             $home_addr1=I('request.home_addr','');
             $home_addr2=$users->where("id='$user_id'")->field('address')->find();

             if (empty($home_addr1)) {
                 $home_addr = $home_addr2;
             }else{
                 $home_addr = $home_addr1;
             }

             $data['users_id']=$user_id;
             $data['home_addr']=$home_addr;
             $data['company_addr']=$company_addr=I('request.company_addr','');
             $data['on_work_time']=$on_work_time=I('request.on_work_time','');
             $data['off_work_time']=$off_work_time=I('request.off_work_time','');
             // $data['type']=$type=1;

            //实例化shuttle表
            $shuttle=M('shuttle');
            $obj = $shuttle->create($data);
            if(!$obj){
                $this->show(300,$shuttle->getError());
            }
            $users_id = $shuttle->where("users_id='$user_id'")->find();
            if (empty($users_id)) {
                $result = $shuttle->data($data)->add();
                if ($result === false){
                   $this->show(300, '添加失败，请稍后再试');
                }else{
                    $this->show(200, 'success', $result);
                }
            }else{
                $result = $shuttle->where("users_id = '$user_id'")->data($data)->save();
                // if ($result == null) {
                //     $this->show(300, '没有修改数据');
                // }
                if ($result === false){
                   $this->show(300, '修改失败，请重新操作');
                }else{
                    $users->where("id = '$id'")->setField('address',$home_addr);
                    $this->show(200, 'success', $result);
                }
            }
        }else{
            $this->show(300, '请使用post提交');
        }
    }


}