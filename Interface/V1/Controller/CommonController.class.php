<?php
/**
 * 公开接口API
 * 分类，登录，版本，更新等
 * 不需要验证用户身份token
 */
namespace V1\Controller;

use Common\Controller\ApiController;
header('Content-Type: application/x-javascript; charset=UTF-8');

class CommonController extends ApiController{
    public function index(){
       $this->show(300,'无效接口');
    }

    // 行程添加或设置
    public function setRoute()
    {
        if (IS_POST) {
            if (!I('request.id')) {
                $this->show(300, '未获用户id参数或该id不存在');
            }
             // $id=84;
             $id=I('request.id');
             $users = M('users');
             $home_addr1=I('request.home_addr','');
             $home_addr2=$users->where("id='$id'")->field('address')->find();

             if (empty($home_addr1)) {
                 $home_addr = $home_addr2;
             }else{
                 $home_addr = $home_addr1;
             }

             $data['users_id']=$id;
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
            $users_id = $shuttle->where("users_id='$id'")->find();
            if (empty($users_id)) {
                $result = $shuttle->data($data)->add();
                if ($result === false){
                   $this->show(300, '添加失败，请稍后再试');
                }else{
                    $this->show(200, 'success', $result);
                }
            }else{
                $result = $shuttle->where("users_id = '$id'")->data($data)->save();
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