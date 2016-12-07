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

}