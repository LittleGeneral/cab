<?php
 /*
    *   约车、接单控制器
    */
namespace Admin\Controller;
use Think\Controller;
class CabController extends CommonController {
    //认证列表
    public function index(){
        $cab = M('cab');
        $cabs = $cab->select();
        $this->assign('cabs',$cabs);
        $this->display();
	}



















    /**
     * 删除操作
     */
    public function del(){
        $id=I('get.id');
        $cab=M('cab');
        //查询要删除的信息
        $data=$cab->find($id);
        if ($data) {
            $start_pos_img='.'.$data['start_pos_img'];
            unlink($start_pos_img);
            $result=$cab->delete($id);
        }
        if ($result) {
            $this->redirect('Cab/index');
        }else {
            $this->error('删除失败!');
        }
    }

   	 /**
     * ajax异步删除
     */
     public function doDel(){
        $id=I('get.id');
        $certification=M('certification');
        //查询要删除的信息
        $data=$certification->find($id);
        if ($data) {
            $driver_licence_img='.'.$data['driver_licence_img'];
            $vehicle_license_img='.'.$data['vehicle_license_img'];
            unlink($driver_licence_img);
            unlink($vehicle_license_img);
            $result=$certification->delete($id);
        }
        if ($result) {
            $this->ajaxReturn(1);
        }else {
            $this->ajaxReturn(0);
        }
    }
}