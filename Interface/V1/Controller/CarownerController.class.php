<?php
/**
 * 用户接口API
 */
namespace V1\Controller;

use Common\Controller\ApiController;
header('Content-Type: application/x-javascript; charset=UTF-8');

class CarownerController extends ApiController{
    public function index(){
        $this->show(300,'无效接口');
    }

    // 接单添加或设置
    public function appointCar()
    {
        if (IS_POST) {
            if (!I('request.id')){
                $this->show(300, '未获用户id参数或该id不存在');
            }
             // $id=84;
             $id=I('request.id');
             $shuttle = M('shuttle');
             $info = $shuttle->where("users_id='$id'")->field('home_addr,company_addr,on_work_time,off_work_time')->find();

             $start_time1=I('request.start_time');
             $start_time2=$info['on_work_time'];
             $start_time = (!empty($start_time1)) ? $start_time1 : $start_time2;

             $start_pos1=I('request.start_pos','');
             $start_pos2=$info['home_addr'];
             $start_pos = (!empty($start_pos1)) ? $start_pos1 : $start_pos2;

             $end_pos1=I('request.end_pos','');
             $end_pos2=$info['company_addr'];
             $end_pos = (!empty($end_pos1)) ? $end_pos1 : $end_pos2;

             $data['users_id']=$id;
             $data['companion'] =$companion= I('request.companion');
             $data['start_time']=$start_time;
             $data['start_pos']=$start_pos;
             $data['end_pos']=$end_pos;


             $data['start_pos_img'] = I('request.start_pos_img');
             // $data['passby_pos'] = I('request.passby_pos');
             $data['price'] = I('request.price');

            //实例化cab表
            $cab=M('cab');
            $obj = $cab->create($data);
            if(!$obj){
                $this->show(300,$cab->getError());
            }
            $users_id = $cab->where("users_id='$id'")->find();
            if (empty($users_id)) {
                $result = $cab->data($data)->add();
                if ($result === false){
                   $this->show(300, '添加失败，请稍后再试');
                }else{
                    $this->show(200, 'success', $result);
                }
            }else{
                $result = $cab->where("users_id = '$id'")->data($data)->save();
                if ($result === false){
                   $this->show(300, '修改失败，请重新操作');
                }else{
                    $this->show(200, 'success', $result);
                }
            }
        }else{
            $this->show(300, '请使用post提交');
        }
    }

    // 车主认证
    public function certification()
    {

    }

// 上班接单（显示和修改）
    public function onWorkAppointCar()
    {
        // $id=84;
        if (!I('get.id')) {
            $this->show(300, '未获用户id参数或该id不存在');
        }
        $id=I('get.id');
        $shuttle = M('shuttle');
        $info = $shuttle
                ->where("users_id='$id'")
                ->field('home_addr,company_addr,on_work_time,companion,start_pos_img,passby_pos,price')
                ->select();

        if ($info){
            $this->show(200, 'success', $info);
        }else if($info == null){
            $this->show(202, '暂无数据');
        }else{
            $this->show(300, '系统繁忙，请稍后再试');
        }
    }

    // 设置上班接单参数
    public function setOnworkOrderParam()
    {
        if (IS_POST) {
            if (!I('request.id')) {
                $this->show(300, '未获取行程id参数或该id不存在');
            }
             // $id=84;
             $data['id'] = $id = I('request.id');
             $data['companion'] = I('request.companion');
             $data['start_pos_img'] = I('request.start_pos_img');
             $data['passby_pos'] = I('request.passby_pos');
             $data['price'] = I('request.price');

            //实例化shuttle表
            $shuttle=M('shuttle');
            $obj = $shuttle->create($data);
            if(!$obj){
                $this->show(300,$shuttle->getError());
            }else{
                $result = $shuttle->where("users_id = '$id'")->data($data)->save();
                if ($result === false){
                   $this->show(300, '修改失败，请重新操作');
                }else{
                    $this->show(200, 'success', $result);
                }
            }
        }else{
            $this->show(300, '请使用post提交');
        }
    }

     // 随时接单添加或设置
    public function getOrderAnytime()
    {
        if (IS_POST) {
            if (!I('request.id')) {
            }
             // $id=84;
             $id=I('request.id');
             $data['users_id']=$id;
             $data['start_time']=$start_time=I('request.start_time','');
             $data['companion'] =$companion= I('request.companion');
             $data['start_pos']=$start_pos=I('request.start_pos','');
             $data['end_pos']=$end_pos=I('request.end_pos','');
             $data['start_pos_img'] = I('request.start_pos_img');
             $data['passby_pos'] = I('request.passby_pos');
             $data['price'] = I('request.price');
             $data['type']=$type=1;

            //实例化cab表
            $cab=M('cab');
            $obj = $cab->create($data);
            if(!$obj){
                $this->show(300,$cab->getError());
            }
            $users_id = $cab->where("users_id='$id'")->find();
            if (empty($users_id)) {
                $result = $cab->data($data)->add();
                if ($result === false){
                   $this->show(300, '添加失败，请稍后再试');
                }else{
                    $this->show(200, 'success', $result);
                }
            }else{
                $result = $cab->where("users_id = '$id'")->data($data)->save();
                if ($result == null) {
                    $this->show(300, '没有修改数据');
                }
                if ($result === false){
                   $this->show(300, '修改失败，请重新操作');
                }else{
                    $this->show(200, 'success', $result);
                }
            }
        }else{
            $this->show(300, '请使用post提交');
        }
    }

    // 途径地设置
    public function passbyPos()
    {

    }
















}