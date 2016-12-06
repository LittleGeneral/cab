<?php
/**
 * 订单接口API
 */
namespace V1\Controller;

use Common\Controller\ApiController;
header('Content-Type: application/x-javascript; charset=UTF-8');
class OrderController extends ApiController{
    public function index(){
        $this->myApiPrint('无效接口');
    }

    // 获取订单详情
    public function getOrderDetailByid()
    {
        if (!I('request.id')){
            $this->show(300, '未获id参数或该id不存在');
        }
        $id=I('request.id');
        //实例化order表
        $order=M('order_cab');
        $where['id'] = $id;
        // $where['order_state'] = '20';
        $data = $order->where($where)->select();
        if ($data === false){
               $this->show(301, '没有数据');
            }else{
                $this->show(200, 'success',$data);
            }
    }

    // 乘客乘车与车主状态码
    public function takeCarStatus()
    {
        if (IS_POST) {
            if (!I('request.pid')){
                $this->show(300, '未获乘客id参数或该id不存在');
            }
            if (!I('request.status')){
                $this->show(300, '未获状态参数');
            }
            if (!I('request.id')){
                $this->show(300, '未获id参数');
            }

            $pid=I('request.pid');  //乘客id 用户的id
            $status = I('request.status');
            $cid=I('request.id');  //cab表的id

            $cab = M('cab');
            $p_data = $cab->where("id='$pid'")->find();
            $users_id = $cab->where("id='$pid'")->getField('users_id');
            $p_cellphone = M('users')->where("id='$users_id'")->getField('tel');
            $data['passager_id'] = $p_data['id'];
            $data['start_time'] = $p_data['start_time'];
            $data['start_pos'] = $p_data['start_pos'];
            $data['companion'] = $p_data['companion'];
            $data['end_pos'] = $p_data['end_pos'];
            $data['price'] = $p_data['price'];
            $data['create_time'] = time();
            $data['order_state'] = 10;
            $data['passager_cellphone'] = $p_cellphone;

            // 车主信息
            $c_data = $cab->where("id='$cid'")->find();
            $users_id = $cab->where("id='$cid'")->getField('users_id');
            $c_cellphone = M('users')->where("id='$users_id'")->getField('tel');
            $data['cab_id'] = $c_data['id'];
            $data['carowner_id'] = $c_data['users_id'];
            $data['carowner_cellphone'] = $c_cellphone;

            // 从认证信息中获取车颜色和品牌
            $certification = M('certification');
            $certifications = $certification->where("users_id='$users_id'")->find();
            $car_color = $certifications['car_color'];
            $car_brand = $certifications['car_brand'];
            $data['car_color'] = $car_color;
            $data['car_brand'] = $car_brand;
            // $data['status'] = 1;

            //实例化passby表
            $order=M('order_cab');

            $obj = $order->create($data);
            if(!$obj){
                $this->show(300,$order->getError());
            }
            $cabs_id = $order->where("cab_id='$cid'")->find();
            if (empty($cabs_id)) {
                $result = $order->data($data)->add();
                if ($result === false){
                   $this->show(300, '添加失败，请稍后再试');
                }else{
                    $orderInfo = $order->where("cab_id = '$cid'")->select();
                    $this->show(200, 'success',$orderInfo);
                }
            }else{
                switch ($status) {
                        case 1:
                            $order->where("cab_id = '$cid'")->setField('status',1);
                            $orderInfo = $order->where("cab_id = '$cid'")->select();
                            $this->show(200,'success',$orderInfo);
                            break;
                        case 2:
                            $order->where("cab_id = '$cid'")->setField('status',2);
                            $this->show(200,'success:等待车主确认',2);
                            break;
                        case 3:
                            // $order->where("cab_id = '$cid'")->setField('status',3);
                            $orderInfo = $order->where("cab_id = '$cid'")->delete();
                            $this->show(200,'success:被拒绝',$orderInfo);
                            break;
                        case 4:
                            $order->where("cab_id = '$cid'")->setField('status',4);
                            $this->show(200,'success:预约成功');
                            break;
                        case 5:
                            $order->where("cab_id = '$cid'")->setField('status',5);
                            $this->show(200,'success:失约',5);
                            break;
                        case 6:
                            $order->where("cab_id = '$cid'")->setField('status',6);
                            $this->show(200,'success:乘客已上车');
                            break;
                        case 7:
                            $order->where("cab_id = '$cid'")->setField('status',7);
                            $orderInfo = $order->where("cab_id = '$cid'")->select();
                            if (!$orderInfo) {
                                $this->show(300,'fail');
                            }else{
                                $this->show(200,'success:到达目的地',$orderInfo);
                            }
                            break;
                        case 8:
                            $order->where("cab_id = '$cid'")->setField('status',8);
                            $this->show(200,'success:取消预约或删除',8);
                            break;
                        default:
                            $this->show(300,'fail','服务器繁忙，请稍后再试');
                            break;
                }
            }
         }else{
            $this->show(300, '请使用post提交');
        }

    }

    // 乘客乘车与车主状态码
    public function takeCarStatus1()
    {
        if (IS_POST) {
            if (!I('request.pid')){
                $this->show(300, '未获乘客id参数或该id不存在');
            }
            if (!I('request.status')){
                $this->show(300, '未获状态参数');
            }
            if (!I('request.id')){
                $this->show(300, '未获id参数');
            }

            $pid=I('request.pid');
            $status = I('request.status');
            $id=I('request.id');
//          $pid = 7;
            // $status = 0;
            $cab = M('cab')->where("id='$id'")->select();
            // $cab = M('cab')->where("id='$pid'")->select();
            switch ($status) {
                case 1:
                    $this->show(200,'success',$cab);
                    break;
                case 2:
                    // $result = $order->where("id = '$id'")->data($data)->save();
                    $this->show(200,'success:等待车主确认',2);
                    break;
                case 3:
                    $this->show(200,'success:被拒绝');
                    break;
                case 4:
                    $this->show(200,'success:预约成功');
                    break;
                case 5:
                    $this->show(200,'success:失约',5);
                    break;
                case 6:
                    $this->show(200,'success:乘客已上车');
                    break;
                case 7:
                    $order = M('order_cab')
                             ->where("passager_id='$pid'")
                             ->order('create_time desc')
                             ->limit(1)
                             ->select();
                    if (!$order) {
                        $this->show(300,'fail');
                    }else{
                        $this->show(200,'success:到达目的地',$order);
                    }
                    break;
                case 8:
                    $this->show(200,'success:取消预约或删除',8);
                    break;
                default:
                    $this->show(300,'fail','服务器繁忙，请稍后再试');
                    break;
            }
         }else{
            $this->show(300, '请使用post提交');
        }

    }



    // 车主接单状态
    public function carOrderStatus()
    {
        if (IS_POST) {
            if (!I('request.pid')){
                $this->show(300, '未获乘客id参数或该id不存在');
            }
            if (!I('request.id')){
                $this->show(300, '未获id参数或该id不存在');
            }
            if (!I('request.status')){
                $this->show(300, '未获状态参数');
            }
            $pid = I('request.pid');  //passage乘客id 不是用户的id 也是cab表中的id
            $cid = I('request.id');  //carowner车主id 不是用户的id 也是cab表中的id
            $status = I('request.status');

            //实例化cab表
            $cab = M('cab');
            $p_companion = $cab->where("id='$pid'")->getField('companion');  //2
            $c_companion = $cab->where("id='$cid'")->getField('companion');  //5

            $num = $c_companion-$p_companion;
            $num1 = $c_companion+$p_companion;
             //实例化order表
            $order=M('order_cab');
            switch ($status) {
                case 1:
                    $order->where("cab_id = '$cid'")->setField('status',1);
                    $this->show(200,'success',1);
                    break;
                case 2:
                    // $order->where("cab_id = '$cid'")->setField('status',2);
                    // $cab->where("id = '$cid'")->setField('companion',$num);
                    $this->show(200,'success:车主是否同意搭乘');
                    break;
                case 3:
                    $order->where("cab_id = '$cid'")->setField('status',3);
                    $this->show(200,'success:不同意 拒绝乘客或删除',3);
                    break;
                case 4:
                    $order->where("cab_id = '$cid'")->setField('status',4);
                    $cab->where("id = '$cid'")->setField('companion',$num);
                    $this->show(200,'success:同意 接收乘客',4);
                    break;
                case 5:
                    $cab->where("id = '$cid'")->setField('companion',($num+$p_companion));
                    $order->where("cab_id = '$cid'")->setField('status',5);
                    $this->show(200,'success:乘客失约',5);
                    break;
                case 6:
                    $order->where("cab_id = '$cid'")->setField('status',6);
                    $this->show(200,'success:确认上车',6);
                    break;
                case 7:
                    $order->where("cab_id = '$cid'")->setField('status',7);
                    $orderInfo = $order->where("cab_id = '$cid'")->select();
                    $this->show(200, 'success:到达目的地',$orderInfo);
                    break;
                case 8:
                    // $cab->where("id='$pid'")->delete();
                    $this->show(200,'success:车主取消或删除接单');
                    // $this->show(200,'success:预约被取消');
                    break;
                default:
                    $this->show(300,'fail','服务器繁忙，请稍后再试');
                    break;
            }
        }else{
            $this->show(300, '请使用post提交');
        }
    }


    // 车主接单状态
    public function carOrderStatus1()
    {
        if (IS_POST) {
            if (!I('request.pid')){
                $this->show(300, '未获乘客id参数或该id不存在');
            }
            if (!I('request.id')){
                $this->show(300, '未获id参数或该id不存在');
            }
            if (!I('request.status')){
                $this->show(300, '未获状态参数');
            }
            $pid = I('request.pid');  //passage乘客id 不是用户的id
            $id = I('request.id');  //id 不是用户的id
            $status = I('request.status');
            // $pid = 1;  //passage乘客id
            // $cid = 7;  //carowner车主id
            // $status = 8;
            // $user_id = 84;
            $cab = M('cab');
            $p_info = $cab->where("id='$pid'")->select();
            $p_companion = $cab->where("id='$pid'")->getField('companion');
            $c_companion = $cab->where("id='$id'")->getField('companion');
            $num = $c_companion-$p_companion;
            $num1 = $c_companion+$p_companion;
            switch ($status) {
                case 1:
                    $this->show(200,'success');
                    break;
                case 2:
                    $this->show(200,'success:车主是否同意搭乘',$p_info);
                    break;
                case 3:
                    $this->show(200,'success:拒绝乘客或删除',3);
                    break;
                case 4:
                    $this->show(200,'success:接收乘客',4);
                    break;
                case 5:
                    $this->show(200,'success:乘客失约',5);
                    break;
                case 6:
                    $this->show(200,'success:确认上车',6);
                    break;
                case 7:

                    // 乘客信息
                    $p_data = $cab->where("id='$pid'")->find();
                    $users_id = $cab->where("id='$pid'")->getField('users_id');
                    $p_cellphone = M('users')->where("id='$users_id'")->getField('tel');
                    $data['passager_id'] = $p_data['id'];
                    $data['start_time'] = $p_data['start_time'];
                    $data['start_pos'] = $p_data['start_pos'];
                    $data['companion'] = $p_data['companion'];
                    $data['end_pos'] = $p_data['end_pos'];
                    $data['price'] = $p_data['price'];
                    $data['create_time'] = time();
                    $data['order_state'] = 10;
                    $data['passager_cellphone'] = $p_cellphone;

                    // 车主信息
                    $c_data = $cab->where("id='$id'")->find();
                    $users_id = $cab->where("id='$id'")->getField('users_id');
                    $c_cellphone = M('users')->where("id='$users_id'")->getField('tel');
                    $data['carowner_id'] = $c_data['id'];
                    $data['carowner_cellphone'] = $c_cellphone;

                    // 从认证信息中获取车颜色和品牌
                    $certification = M('certification');
                    $certifications = $certification->where("users_id='$users_id'")->find();
                    $car_color = $certifications['car_color'];
                    $car_brand = $certifications['car_brand'];
                    $data['car_color'] = $car_color;
                    $data['car_brand'] = $car_brand;
                    $data['status'] = 7;

                    //实例化passby表
                    $order=M('order_cab');
                    $obj = $order->create($data);
                    if(!$obj){
                        $this->show(300,$order->getError());
                    }
                    if ($obj) {
                        $result = $order->data($data)->add();
                        if ($result === false){
                           $this->show(300, '添加失败，请稍后再试');
                        }else{
                            $this->show(200, 'success:到达目的地',$data);
                        }
                    }
                    break;
                case 8:
                    $cab->where("id='$pid'")->delete();
                    $this->show(200,'success:车主删除接单');
                    // $this->show(200,'success:预约被取消');
                    break;
                default:
                    $this->show(300,'fail','服务器繁忙，请稍后再试');
                    break;
            }
        }else{
            $this->show(300, '请使用post提交');
        }
    }




}