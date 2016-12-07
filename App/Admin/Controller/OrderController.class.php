<?php
 /*
    *   订单控制器
    */
namespace Admin\Controller;
use Think\Controller;
class OrderController extends CommonController {

    // 订单列表
    public function index(){
        $order = M('order_cab');
        // $where['order_state']='20';
        $orders = $order->where($where)->select();
        $this->assign('orders',$orders);
        $this->display();
    }

    /**
     * 删除操作
     */
    public function del(){
        $id=I('get.id');
        $order=M('order_cab');
        //删除该条数据
        $result=$order->delete($id);
        if($result){
            $this->redirect('Order/index');
        }else{
            $this->redirect('Order/index');
        }
    }
}