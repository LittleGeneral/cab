<?php
 /*
    *   车主认证控制器
    */
namespace Admin\Controller;
use Think\Controller;
class CertificationController extends CommonController {
    //认证列表
    public function index(){
        $certification = M('certification');
        $certifications = $certification->select();
        $this->assign('certifications',$certifications);
        $this->display();
	}

    //未认证列表
    public function notCertified(){
        $certification = M('certification');
        $certifications = $certification->where('status=0')->select();
        $this->assign('certifications',$certifications);
        $this->display();
    }

    //已认证列表
    public function certified(){
        $certification = M('certification');
        $certifications = $certification->where("status='2'")->select();
        $this->assign('certifications',$certifications);
        $this->display();
    }

     //待认证列表
    public function certifing(){
        $certification = M('certification');
        $certifications = $certification->where("status='1'")->select();
        $this->assign('certifications',$certifications);
        $this->display();
    }

    /**
     * 删除操作
     */
    public function del(){
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
            $this->redirect('Certification/index');
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

     //通过认证
    public function modify($id)
    {
         $certification=M('certification');
         // $status=$certification->where("id = '$id'")->getField('status');
         $obj = $certification->where("id = '$id'")->setField('status',2);
            if(!$obj){
                $this->error($certification->getError());
            }else{
                if ($obj) {
                    $this->redirect('Certification/index');
                }else{
                    $this->error('修改失败!');
                }
            }
    }


}