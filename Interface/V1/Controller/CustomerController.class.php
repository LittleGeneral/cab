<?php
/**
 * 客户接口API
 */
namespace V1\Controller;

use Common\Controller\ApiController;
header('Content-Type: application/x-javascript; charset=UTF-8');

class CustomerController extends ApiController{
    public function index(){
            $this->show(300,'无效接口');
    }

    // 约车添加或设置
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

            //实例化cab表
            $cab=M('cab');
            $obj = $cab->create($data);
            if(!$obj){
                $this->show(300,$cab->getError());
            }
            $users_id = $cab->where("users_id='$id'")->find();
            if (empty($users_id)){
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



    // 上班约车（显示和修改）
    public function onWorkAppointCar()
    {
        // $id=84;
        if (!I('get.id')) {
            $this->show(300, '未获用户id参数或该id不存在');
        }
        $id=I('get.id');
        $shuttle = M('shuttle');
        $info = $shuttle->where("users_id='$id'")->field('home_addr,company_addr,on_work_time,companion,off_work_time')->select();
        if ($info){
            $this->show(200, 'success', $info);
        }else if($info == null){
            $this->show(202, '暂无数据');
        }else{
            $this->show(300, '系统繁忙，请稍后再试');
        }
    }

    // 设置同行人数
    public function setCompaionNum()
    {
        if (IS_POST) {
            if (!I('request.id')) {
                $this->show(300, '未获取行程id参数或该id不存在');
            }
             // $id=84;
             $data['id'] = $id = I('request.id');
             $data['companion'] = I('request.companion');

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

    public function testShow()
    {
        $str="84";
        $id=intval($str);
        echo $id;
        dump($id);die();

        $shuttle = M('shuttle');
        $info = $shuttle->where("users_id='$id'")->field('home_addr,company_addr,on_work_time,companion')->select();
        // $info = null;
        if ($info){
            $this->show(200, 'success',$info);
        }else if($info == null){
            $this->show(202, '暂无数据');
        }else{
            $this->show(202, '暂无数据');
        }
    }

     //添加行程接口
    public function add()
    {
            // $id=$users_id=I('request.users_id','')=2;
            $id=30;
            $users = M('users');
            $customer_addr=$users->where("id='$id'")->field('address')->find();

            $this->myApiPrint('success',200,$customer_addr);die();
            $users_id = $users['id'];
            $address = $users['address'];

        if (IS_POST) {
            // $data['users_id']=$users_id=I('post.users_id','');
            $data['company_addr']=$company_addr=I('post.company_addr','');
            $data['on_work_time']=$on_work_time=I('post.on_work_time','');
            $data['off_work_time']=$off_work_time=I('post.off_work_time','');

            $data['users_id']=$users_id=
            $data['address']=$address=I('post.address','');

            //实例化goods表
            $goods=M('goods');
            if (!$goods->create($data)) {
               $this->myApiPrint($goods->getError());
            }
            $res = $goods->data($data)->add();
            if ($res === false){
               $this->show(300, '添加失败，请稍后再试');
            }else{
                $this->myApiPrint('success',200,$res);
            }
        }else{
            $this->show(300, '请使用post提交');
        }

     }


    /**
     * 删除行程接口
     * @DateTime 2016-09-18T14:50:31+0800
     */
    public function del(){
        $id=I('post.id');
        if (!$id || $id==null) {
            $this->myApiPrint('未获取行程id参数',300);
        }
        $model=M('goods');
        //查询要删除的信息
        $data=$model->find($id);
        if (!$data) {
            $this->myApiPrint('没有该行程',300);
        }
        if(!empty($data['img'])){
            $img=$data['img'];
        }
        //删除该条数据
        if ($data) {
            $res=$model->delete($id);
            $unsimg="./Public/Admin/Uploads/".$img;
            unlink($unsimg);

            if ($res){
                $this->myApiPrint('删除成功',200);
            }else{
                $this->myApiPrint('删除失败，请稍后再试',300);
            }
        }
    }

   //更新行程信息接口
    public function update()
    {
         if (IS_POST) {
            if (!I('post.id')) {
                $this->show(300, '未获取行程id参数或该id不存在');
            }
             $data['id'] = $id = I('post.id');
             $data['name'] = I('post.name');
             $data['price'] = I('post.price');
             $data['group_price'] = I('post.group_price');
             $data['count'] = I('post.count');

            //实例化goods表
            $goods=M('goods');
            // dump($goods);die();
            $obj = $goods->create($data);
            if(!$obj){
                $this->myApiPrint($goods->getError());
            }else{
                $result = $goods->where("id = '$id'")->data($data)->save();
                if ($result === false){
                   $this->show(300, '修改失败，请重新操作');
                }else{
                    $this->myApiPrint('success',200,$result);
                }
            }
        }else{
            $this->show(300, '请使用post提交');
        }

    }

}