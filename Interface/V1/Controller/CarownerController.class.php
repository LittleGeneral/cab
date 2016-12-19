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
                $this->show(301, '未获用户id参数或该id不存在');
            }
            $user_id=I('request.id');

            //实例化cab表
            $cab=M('cab');

            $status2 = $cab->where("users_id = '$user_id'")->getField('status2',true);
            if (in_array(1,$status2)) {
                $this->show(200, 'success:有发布车程未完成');
            }

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
            $data['str_start_time'] = strtotime($start_time);
            $data['start_pos']=$start_pos;
            $data['end_pos']=$end_pos;
            $data['type']=1;
            $data['create_time'] =$create_time = time();

            $start_pos_img = I('request.start_pos_img');
            //如果用户图像数据不为空，则将APP端传递的图像数据流转化成图像文件
            //上传地址为 User/用户ID.gif
            if(!empty($start_pos_img)) $data['start_pos_img'] = $this->myStream2Img($start_pos_img,'User','.jpg',$create_time);
            $data['price'] = I('request.price');

            $obj = $cab->create($data);
            if(!$obj){
                $this->show(300,$cab->getError());
            }else{
//                $cab->where("users_id = '$user_id'")->setField('type',0);
                $result = $cab->data($data)->add();
                if ($result === false){
                    $this->show(302, '添加失败，请稍后再试');
                }else{
                    $this->show(200, 'success',1);
                }
            }
        }else{
            $this->show(303, '请使用post提交');
        }
    }

    // 删除接的单
    public function delCarOrderByCabId()
    {
        if(!I('request.cab_id')){
            $this->show(300,'未获取车主id');
        }
        $cab_id = I('request.cab_id');
        $cab = M('cab');
        $where['cab_id'] = $cab_id;

        $data = $cab->find($cab_id);
        if ($data == null) {
             $this->show(301, '车主id不存在');
        }
        if ($data) {
            $start_pos_img='.'.$data['start_pos_img'];
            unlink($start_pos_img);
            $result=$cab->delete($cab_id);
        }
        if ($result) {
            $this->show(200, 'success',1);
        }else {
           $this->show(302, 'fail',0);
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
             $create_time = time();
             // $data['passby_pos_img'] = I('request.passby_pos_img');
             //如果用户图像数据不为空，则将APP端传递的图像数据流转化成图像文件
            //上传地址为 User/用户ID.gif
            if(!empty($passby_pos_img)) $data['passby_pos_img'] = $this->myStream2Img($passby_pos_img,'User','.jpg',$create_time);
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
                           ->join('LEFT JOIN users u ON o.passager_id = u.id')
                           // ->join('LEFT JOIN property p ON o.passager_id = u.id')
                           ->field('o.order_cab_id,o.cab_id,o.passager_id,o.passager_id,u.img,u.cname,u.bind,o.passager_cellphone,o.carowner_cellphone,o.start_time,o.start_pos,o.end_pos,o.companion,o.car_color,o.car_brand,o.price,o.status,o.state,o.order_state,o.create_time')
                           ->order('create_time desc')
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
            if (!I('request.cab_id')){
                $this->show(300, '未获id参数或该id不存在');
            }
            // if (!I('request.status')){
            //     $this->show(300, '未获状态参数');
            // }
            $pid = I('request.pid');  //passage乘客id 不是用户的id 也是cab表中的id
            $cab_id = I('request.cab_id');  //carowner车主id 不是用户的id 也是cab表中的id
            $status = I('request.status');
            $state = I('request.state');

            //实例化cab表
            $cab = M('cab');

            $where['cab_id'] = $cab_id;
            $where['passager_id'] = $pid;

            $p_companion = $cab->where("cab_id='$pid'")->getField('companion');  //2
            $c_companion = $cab->where("cab_id='$cab_id'")->getField('companion');  //5

            $num = $c_companion-$p_companion;
            $num1 = $c_companion+$p_companion;
             //实例化order表
            $order=M('order_cab');

            if ($status=='1') {
                $order->where($where)->setField('status',1);
                $this->show(200,'success',1);
            }elseif ($status=='2') {
                $this->show(200,'success:车主是否同意搭乘');
            }elseif ($status=='3') {
                $order->where($where)->setField('status',3);
                $order->where($where)->setField('state','00');
                $this->show(200,'success:不同意 拒绝乘客',3);
            }elseif ($status=='4') {
                $order->where($where)->setField('status',4);
                // $cab->where($where)->setField('companion',$num);
                $this->show(200,'success:同意 接收乘客',4);
            }elseif ($status=='5') {
                // $cab->where($where)->setField('companion',($num+$p_companion));
                $order->where($where)->setField('status',5);
                $this->show(200,'success:乘客失约',5);
            }elseif ($status=='6') {
                $order->where($where)->setField('status',6);
                $this->show(200,'success:确认上车',6);
            }elseif ($status=='7') {
                $cab->where("cab_id = '$cab_id'")->setField('status2',2);
                $order->where($where)->setField('status',7);
                $orderInfo = $order->where($where)->select();
                $this->show(200, 'success:到达目的地',$orderInfo);
            // }elseif ($status=='8') {
            //     $this->show(200,'success:车主取消或删除接单');
            }elseif ($status=='9') {
                $order->where($where)->setField('status',9);
                $this->show(200,'success:支付成功');
            }elseif ($state=='01') { //车主删除
                $state2 = $order->where($where)->getField('state');
                switch ($state2) {
                    case '00':
                        $order->where($where)->setField('state','01');
                        $this->show(200,'success1:车主已经删除');
                        break;
                    case '01':
                        $this->show(200,'success1:车主已经删除');
                        break;
                    case '10':
                        $order->where($where)->setField('state','11');
                        $order->where($where)->delete();
                        $this->show(200,'success2:乘客车主都已删除');
                        break;
                    default:
                        $this->show(300,'fail','服务器繁忙，请稍后再试');
                        break;
                }
            } else {
                $this->show(300,'fail','服务器繁忙，请稍后再试');
            }
        }else{
            $this->show(300, '请使用post提交');
        }
    }

    // 车主获取订单列表
    public function getOrderListByCid()
    {
        if (!I('request.cid')){
            $this->show(300, '未获车主id参数或该id不存在');
        }
        $carowner_id=I('request.cid');
        //实例化order表
        $order=M('order_cab');
        $where1['carowner_id'] = $carowner_id;
        $where1['order_state'] = '10'; //未支付
        $dataInfo1[0]['count'] = $counts = $order->where($where1)->count();
        $data1 = $order
                ->where($where1)
                ->field('carowner_id,start_time,start_pos,end_pos,order_state')
                ->order('create_time desc')
                ->limit(1)
                ->select();
        $dataInfo1[0]['carowner_id'] = $data1[0]['carowner_id'];
        $dataInfo1[0]['start_time'] = $data1[0]['start_time'];
        $dataInfo1[0]['start_pos'] = $data1[0]['start_pos'];
        $dataInfo1[0]['end_pos'] = $data1[0]['end_pos'];
        $dataInfo1[0]['order_state'] = $data1[0]['order_state'];

        $where['carowner_id'] = $carowner_id;
        $where['order_state'] = '20'; //支付
        $dataInfo2[0]['count'] = $counts = $order->where($where)->count();
        $data = $order
                ->where($where)
                ->field('carowner_id,start_time,start_pos,end_pos,order_state')
                ->order('create_time desc')
                ->limit(1)
                ->select();
        $dataInfo2[0]['carowner_id'] = $data[0]['carowner_id'];
        $dataInfo2[0]['start_time'] = $data[0]['start_time'];
        $dataInfo2[0]['start_pos'] = $data[0]['start_pos'];
        $dataInfo2[0]['end_pos'] = $data[0]['end_pos'];
        $dataInfo2[0]['order_state'] = $data[0]['order_state'];

        $dataInfo = array_merge($dataInfo1,$dataInfo2);
        if ($dataInfo === false){
               $this->show(301, '没有数据');
            }else{
                $this->show(200, 'success',$dataInfo);
            }
    }

    // 车主获取订单列表详情
    public function getOrderListDetailByCid()
    {
        if (!I('request.cid')){
            $this->show(300, '未获车主id参数或该id不存在');
        }
        if (!I('request.order_state')){
            $this->show(301, '未获订单状态 10未支付 20支付');
        }
        $carowner_id=I('request.cid');
        $order_state=I('request.order_state');
        $pageNum1 = I('request.pageNum',0);
        $pageNum = ($pageNum1 + 1);
        $pageCount = I('request.pageCount',5);
        //实例化order表
        $order=M('order_cab');
        $where['carowner_id'] = $carowner_id;
        $where['order_state'] = $order_state;
        $data = $order
                ->where($where)
                ->page($pageNum,$pageCount)
                ->select();
        if ($data === false){
               $this->show(301, '没有数据');
            }else{
                $this->show(200, 'success',$data);
            }
    }

    //删除已完成订单
    public function delOrderByOrderCabId(){
        if (!I('request.order_cab_id')) {
            $this->show(300,'未获取订单id');
        }
        if(!I('request.state')){
            $this->show(301,'未获取状态值');
        }
        $order_cab_id = I('request.order_cab_id');
        $state = I('request.state');

        $order = M('order_cab');
        $where['order_cab_id'] = $order_cab_id;
        $where['order_state'] = '20';

        $order_id = $order->where($where)->getField('order_cab_id');
        if(empty($order_id)){
            $this->show(302,'该订单id不存在');
        }

        if ($state=='01') { //车主删除
            $state2 = $order->where($where)->getField('state');
                switch ($state2) {
                    case '00':
                        $order->where($where)->setField('state','01');
                        $this->show(200,'success1:车主已经删除');
                        break;
                    case '01':
                        $this->show(200,'success2:车主已经删除');
                        break;
                    case '10':
                        $order->where($where)->setField('state','11');
                        $order->where($where)->delete();
                        $this->show(200,'success3:乘客车主都已删除');
                        break;
                    default:
                        $this->show(304,'fail','服务器繁忙，请稍后再试');
                        break;
                    }
        }else{
            $this->show(303,'fail','状态参数有误');
        }
    }










































}