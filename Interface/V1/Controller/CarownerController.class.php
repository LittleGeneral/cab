<?php
/**
 * 车主接口API
 */
namespace V1\Controller;

use Common\Controller\ApiController;
header('Content-Type: application/x-javascript; charset=UTF-8');

class CarownerController extends ApiController{
    public function index(){
        $this->show(300,'无效接口');
    }

    // 判断是否认证
    public function isCertification()
    {
            if (!I('request.id')){
                $this->show(300, '未获用户id参数或该id不存在');
            }
             // $id=84;
             $user_id=I('request.id');
             $certification = M('certification');
             $data['users_id']=$user_id;
             //实例化certification表
             $obj = $certification->create($data);
             if(!$obj){
                $this->show(300,$certification->getError());
             }
             $users_id = $certification->where("users_id='$user_id'")->find();
             if (empty($users_id)) {
                $result = $certification->data($data)->add();
                if ($result === false){
                   $this->show(300, '添加失败，请稍后再试');
                }else{
                    $status = $certification->where("users_id='$user_id'")->getField('status');
                     switch ($status) {
                         case '0':
                             $this->show(200,'不能接单，马上认证',0);
                             break;
                         case '1':
                             $this->show(200,'正在审核中',1);
                             break;
                         case '2':
                             $this->show(200,'审核通过',2);
                             break;
                         default:
                             $this->show(300,'系统繁忙，请稍后再试');
                             break;
                     }
                }
             }else{
                 $status = $certification->where("users_id='$user_id'")->getField('status');
                 switch ($status) {
                     case '0':
                         $this->show(200,'不能接单，马上认证',0);
                         break;
                     case '1':
                         $this->show(200,'正在审核中',1);
                         break;
                     case '2':
                         $this->show(200,'审核通过',2);
                         break;
                     default:
                         $this->show(300,'系统繁忙，请稍后再试');
                         break;
                 }
             }
    }

    // 驾照认证
    public function certification()
    {
        if (IS_POST) {
            if (!I('request.id')){
                $this->show(300, '未获用户id参数或该id不存在');
            }
             $user_id=I('request.id');
             $certification = M('certification');
             $agreement = $certification->where("users_id='$user_id'")->field('agreement')->select();
             $data['users_id']=$user_id;
             $data['real_name']=$real_name=I('request.real_name','');
             $data['driver_licence_num']=$driver_licence_num=I('request.driver_licence_num','');
             $data['car_num']=$car_num=I('request.car_num','');
             $data['car_owner']=$car_owner=I('request.car_owner','');
             $data['car_brand']=$car_brand=I('request.car_brand','');
             $data['car_color']=$car_color=I('request.car_color','');
             $data['register_date']=$register_date=I('request.register_date','');
             $data['agreement']=$agreement;
             $data['status']=1;
             $driver_licence_img=I('request.driver_licence_img','');
             $vehicle_license_img=I('request.vehicle_license_img','');

             //如果用户图像数据不为空，则将APP端传递的图像数据流转化成图像文件
            //上传地址为 User/用户ID.gif
            if(!empty($driver_licence_img)) $data['driver_licence_img'] = $this->myStream2Img($driver_licence_img,'User','.jpg',$driver_licence_num);
            if(!empty($vehicle_license_img)) $data['vehicle_license_img'] = $this->myStream2Img($vehicle_license_img,'User','.jpg',$vehicle_license_num);

            //实例化certification表
            $obj = $certification->create($data);
            if(!$obj){
                $this->show(300,$certification->getError());
            }
            $users_id = $certification->where("users_id='$user_id'")->find();
            if (empty($users_id)) {
                $result1 = $certification->data($data)->add();
                if ($result1 === false){
                   $this->show(300, '添加失败，请稍后再试');
                }else{
                    $this->show(200, 'success', $result1);
                }
            }else{
                $result2 = $certification->where("users_id = '$user_id'")->data($data)->save();
                if ($result2 === false){
                   $this->show(300, '修改失败，请重新操作');
                }else{
                    $this->show(200, 'success', 1);
                }
            }
        }else{
            $this->show(300, '请使用post提交');
        }
    }

    // 接单添加或设置
    public function carOrder()
    {
        if (IS_POST) {
            if (!I('request.id')){
                $this->show(300, '未获用户id参数或该id不存在');
            }
            // $id=84;
            $user_id=I('request.id');
            $shuttle = M('shuttle');
            $info = $shuttle->where("users_id='$user_id'")->field('home_addr,company_addr,on_work_time,off_work_time')->find();

            $start_time1=I('request.start_time');
            $start_time2=$info['on_work_time'];
            $start_time = (!empty($start_time1)) ? $start_time1 : $start_time2;

            $start_pos1=I('request.start_pos','');
            $start_pos2=$info['home_addr'];
            $start_pos = (!empty($start_pos1)) ? $start_pos1 : $start_pos2;

            $end_pos1=I('request.end_pos','');
            $end_pos2=$info['company_addr'];
            $end_pos = (!empty($end_pos1)) ? $end_pos1 : $end_pos2;

            $data['users_id']=$user_id;
            $data['companion'] =$companion= I('request.companion');
            $data['start_time']=$start_time;
            $data['str_start_time']=strtotime($start_time);
            $data['start_pos']=$start_pos;
            $data['end_pos']=$end_pos;
            $data['type']=1;
            $data['create_time']=time();

            $start_pos_img = I('request.start_pos_img');
            //如果用户图像数据不为空，则将APP端传递的图像数据流转化成图像文件
            //上传地址为 User/用户ID.gif
            if(!empty($start_pos_img)) $data['start_pos_img'] = $this->myStream2Img($start_pos_img,'User','.jpg',intval($start_time));
            $data['price'] = I('request.price');

            //实例化cab表
            $cab=M('cab');
            $obj = $cab->create($data);
            if(!$obj){
                $this->show(300,$cab->getError());
            }else{
//                $cab->where("users_id = '$user_id'")->setField('type',0);
                $result = $cab->data($data)->add();
                if ($result === false){
                    $this->show(300, '添加失败，请稍后再试');
                }else{
                    $this->show(200, 'success',1);
                }
            }
        }else{
            $this->show(300, '请使用post提交');
        }
    }

    // 添加途径地
    public function addPassbyPos()
    {
        if (IS_POST) {
            if (!I('request.id')){
                $this->show(300, '未获用户id参数或该id不存在');
            }
             // $user_id=84;
             $id=I('request.id');
             $data['users_id'] = $id;
             $data['passby_pos'] = I('request.passby_pos');
             $passby_time = I('request.passby_time');
             $data['passby_time'] = $passby_time;
             $data['str_passby_time'] = strtotime($passby_time);
             $passby_pos_img = I('request.passby_pos_img');
             // $data['passby_pos_img'] = I('request.passby_pos_img');
             //如果用户图像数据不为空，则将APP端传递的图像数据流转化成图像文件
            //上传地址为 User/用户ID.gif
            if(!empty($passby_pos_img)) $data['passby_pos_img'] = $this->myStream2Img($passby_pos_img,'User','.jpg',intval($passby_time));
            //实例化passby表
            $passby=M('passby');
            $obj = $passby->create($data);
            if(!$obj){
                $this->show(300,$passby->getError());
            }
            if ($obj) {
                $result = $passby->data($data)->add();
                if ($result === false){
                   $this->show(300, '添加失败，请稍后再试');
                }else{
                    $this->show(200, 'success',1);
                }
            }
        }else{
            $this->show(300, '请使用post提交');
        }
    }

    // 途径地列表
    public function passbyList()
    {
        if (!I('request.id')){
            $this->show(300, '未获用户id参数或该id不存在');
        }
         // $id=84;
        $id=I('request.id');
        //实例化passby表
        $passby=M('passby');
        $data = $passby->where("users_id='$id'")->select();
        if ($data === false){
               $this->show(300, '没有数据');
            }else{
                $this->show(200, 'success',$data);
            }
    }

    // 删除途径地
    public function delPassbyPos()
    {
        if (!I('request.id')){
            $this->show(300, '未获id参数或该id不存在');
        }
        $id=I('request.id');
        //实例化passby表
        $passby=M('passby');
        $data = $passby->find($id);
        if ($data == null) {
             $this->show(300, 'id不存在');
        }
        if ($data) {
            $passby_pos_img='.'.$data['passby_pos_img'];
            unlink($passby_pos_img);
            $result=$passby->delete($id);
        }
        if ($result) {
            $this->show(200, 'success',1);
        }else {
           $this->show(300, 'fail',0);
        }
    }

     // 获取乘客预约后列表(乘客列表)(未处理)
    public function getCustomerListByCid()
    {
        if (!I('request.cid')){
            $this->show(301, '未获乘客id参数');
        }
        $carowner_id=I('request.cid');
        //实例化order表
        $order=M('order_cab');
        $where['o.carowner_id'] = $carowner_id;
        $where['o.order_state'] = '10';
        $data = $order->alias('o')
                           ->join('LEFT JOIN users u ON o.carowner_id = u.id')
                           ->join('LEFT JOIN property p ON o.carowner_id = u.id')
                           ->field('o.id,o.passager_id,o.carowner_id,u.img,u.cname,u.bind,o.passager_cellphone,o.carowner_cellphone,o.start_time,o.start_pos,o.end_pos,o.companion,o.car_color,o.car_brand,o.price,o.status,o.order_state')
                           ->where($where)
                           ->select();
        if ($data === false){
               $this->show(302, '没有数据');
            }else{
                $this->show(200, 'success',$data);
            }
    }

    // 获取乘客预约后列表(乘客列表)(未处理)
    public function getCustomerListByCid1()
    {

        $passager_id=I('request.pid');
        $users = M('users');
        mysql_set_charset('latin1');
        $real_name = $users->where("id = '$passager_id'")->getField('cname');
        // $real_name1 = strval($real_name);
        dump($real_name);die();

        if (!I('request.cid')){
            $this->show(301, '未获乘客id参数');
        }
        $carowner_id=I('request.cid');
        //实例化order表
        $order=M('order_cab');
        $where['o.carowner_id'] = $carowner_id;
        $where['o.order_state'] = '10';
        $data = $order->alias('o')
                           ->join('LEFT JOIN users u ON o.carowner_id = u.id')
                           // ->join('LEFT JOIN certification c2 ON o.carowner_id = c2.users_id')
                           ->field('o.id,o.passager_id,o.carowner_id,u.img,o.passager_cellphone,o.carowner_cellphone,o.start_time,o.start_pos,o.end_pos,o.companion,o.car_color,o.car_brand,o.price,o.status,o.order_state')
                           ->where($where)
                           ->select();
        if ($data === false){
               $this->show(302, '没有数据');
            }else{
                $this->show(200, 'success',$data);
            }
    }

    // 获取车主发布详情
    public function getCarownerDetailById()
    {
        if (!I('request.id')){
            $this->show(300, '未获车主id参数或该id不存在');
        }
        $id=I('request.id');
        //实例化order表
        $cab=M('cab');
        $where['users_id'] = $id;
        $where['type'] = 1;
        $data = $cab->where($where)->order('create_time desc')->limit(1)->select();
        if ($data === false){
               $this->show(301, '没有数据');
            }else{
                $this->show(200, 'success',$data);
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

    // 获取订单行程
    public function getOrderByCid()
    {
        if (!I('request.cid')){
            $this->show(300, '未获车主id参数或该id不存在');
        }
        $carowner_id=I('request.cid');
        //实例化order表
        $order=M('order_cab');
        $where['carowner_id'] = $carowner_id;
        // $where['order_state'] = '10';
        $data = $order->where($where)->select();
        if ($data === false){
               $this->show(301, '没有数据');
            }else{
                $this->show(200, 'success',$data);
            }
    }

    // // 获取订单行程
    // public function getRouteBycid()
    // {
    //     if (!I('request.cid')){
    //         $this->show(300, '未获车主id参数或该id不存在');
    //     }
    //     $carowner_id=I('request.cid');
    //     //实例化order表
    //     $order=M('order_cab');
    //     $where['carowner_id'] = $carowner_id;
    //     $where['order_state'] = '20';
    //     $data = $order->where($where)->select();
    //     if ($data === false){
    //            $this->show(301, '没有数据');
    //         }else{
    //             $this->show(200, 'success',$data);
    //         }
    // }









































}