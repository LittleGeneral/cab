<?php
/**
 * 用户接口API
 */
namespace V1\Controller;

use Common\Controller\ApiController;

class UserController extends ApiController{
    public function index(){
        $this->myApiPrint('无效接口');
    }

// 约车添加或设置
    public function appointCar()
    {
        if (IS_POST) {
            if (!I('request.id')){
                $this->show(300, '未获用户id参数或该id不存在');
            }
             // $users_id=84;
             $users_id=I('request.id');  //用户id 乘客id
             $shuttle = M('shuttle');
             $info = $shuttle->where("users_id='$users_id'")->field('home_addr,company_addr,on_work_time,off_work_time')->find();

             $start_time1=I('request.start_time');
             $start_time2=$info['on_work_time'];
             $start_time = (!empty($start_time1)) ? $start_time1 : $start_time2;

             $start_pos1=I('request.start_pos','');
             $start_pos2=$info['home_addr'];
             $start_pos = (!empty($start_pos1)) ? $start_pos1 : $start_pos2;

             $end_pos1=I('request.end_pos','');
             $end_pos2=$info['company_addr'];
             $end_pos = (!empty($end_pos1)) ? $end_pos1 : $end_pos2;

             $data['users_id']=$users_id;
             $data['companion'] =$companion= I('request.companion');
             $data['start_time']=$start_time;
             $str_start_time=strtotime($start_time);
             $data['str_start_time']=$str_start_time;
             $data['start_pos']=$start_pos;
             $data['end_pos']=$end_pos;
             $data['create_time']=time();

            //实例化cab表
            $cab=M('cab');
            $obj = $cab->create($data);
            if(!$obj){
                $this->show(300,$cab->getError());
            }else{
                $result = $cab->data($data)->add();
                if ($result === false){
                   $this->show(300, '添加失败，请稍后再试');
                }else{
                    // $pageNum = I('get.pageNum',1);
                    // $pageCount = I('get.pageCount',2);
                    $timeDiff = 30 * 60;  //30分
                    $smallTime = ($str_start_time-$timeDiff);
                    $bigTime = ($str_start_time+$timeDiff);

                    $map['c.start_pos'] = array(array('like',"%$start_pos%"),array('like',"%$start_pos"),array('like',"$start_pos%"),$start_pos,'or');
                    $map['c.type'] = "1";
                    $map['c.str_start_time'] = array(array('gt',$smallTime),array('lt',$bigTime));

                    $where['p.passby_pos'] =$start_pos;
                    $where['c.type'] =1;

                    // 途径地
                    $cabList1 = $cab->alias('c')
                                ->join('LEFT JOIN passby p ON c.users_id = p.users_id')
                                ->field('c.id,c.users_id,c.start_time,c.passby_pos,c.companion,c.start_pos,c.start_pos_img,c.end_pos,c.price,c.type,c.status,c.create_time')
                                ->where($where)
                                // ->page($pageNum,$pageCount)
                                ->select();
                    $cabList2 = $cab->alias('c')
                                ->join('LEFT JOIN users u ON c.users_id = u.id')
                                ->join('LEFT JOIN certification c2 ON c.users_id = c2.users_id')
                                ->field('u.tel,u.img,c2.car_color,c2.car_brand,c2.real_name,c.id,c.users_id,c.start_time,c.passby_pos,c.companion,c.start_pos,c.start_pos_img,c.end_pos,c.price,c.type,c.status,c.create_time')
                                ->where($map)
                                ->select();
                    $list = array_merge($cabList1,$cabList2);
                    if (!$list) {
                        $this->show(300,'无匹配数据',$list);
                    }else{
                        $this->show(200,'success',$list);
                    }
                }
            }
        }else{
            $this->show(300, '请使用post提交');
        }
    }



// 约车添加或设置
    public function appointCar2()
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
            $str_start_time=strtotime($start_time);
            $data['str_start_time']=$str_start_time;
            $data['start_pos']=$start_pos;
            $data['end_pos']=$end_pos;
            $data['create_time']=time();

            //实例化cab表
            $cab=M('cab');
            $obj = $cab->create($data);
            if(!$obj){
                $this->show(300,$cab->getError());
            }else{
                $result = $cab->data($data)->add();
                if ($result === false){
                    $this->show(300, '添加失败，请稍后再试');
                }else{
//                    $this->show(200, 'success',1);
                    // $pageNum = I('get.pageNum',1);
                    // $pageCount = I('get.pageCount',2);
                    $timeDiff = 30 * 60;  //30分
                    $smallTime = ($str_start_time-$timeDiff);
                    $bigTime = ($str_start_time+$timeDiff);

                    $passby['start_pos'] = array(array('like',"%$start_pos%"),array('like',"%$start_pos"),array('like',"$start_pos%"),$start_pos,'or');
                    // $passby['end_pos'] = array(array('like',"%$start_pos%"),array('like',"%$start_pos"),array('like',"$start_pos%"),$start_pos,'or');
                    $passby['type'] = "1";
                    $passby['str_start_time'] = array(array('gt',$smallTime),array('lt',$bigTime));

                    $where['p.passby_pos'] =$start_pos;
                    // $where['p.passby_pos'] =array(array('like',"%$start_pos%"),array('like',"%$end_pos%"),'or');
                    $where['c.type'] =1;
                    // 途径地
                    $cabList1 = $cab->alias('c')
                        ->join('LEFT JOIN passby p ON c.users_id = p.users_id')
                        ->field('c.id,c.users_id,c.start_time,c.passby_pos,c.companion,c.start_pos,c.start_pos_img,c.end_pos,c.price,c.type,c.status,c.create_time')
                        ->where($where)
                        // ->page($pageNum,$pageCount)
                        ->select();

                    $cabList2 = $cab->where($passby)->select();
                    // dump($cabList1);die();
                    $list = array_merge($cabList1,$cabList2);
                    if (!$list) {
                        $this->show(300,'无匹配数据',$list);
                    }else{
                        $this->show(200,'success',$list);
                    }
                }
            }
        }else{
            $this->show(300, '请使用post提交');
        }
    }


    //用户列表接口
    public function lists(){

        $pageNum = I('get.pageNum',1);
        $pageCount = I('get.pageCount',5);
        $user = M('users');
        $list = $user->alias('u')
        		->join('LEFT JOIN property p ON p.propertyid = u.propertyid')
        		->field('u.id,u.tel,u.cname,u.gender,u.img,u.usertype,u.password,u.address,u.info,u.status,p.name')
                ->page($pageNum,$pageCount)
                ->order('createtime desc')
        		->select();
        if ($list){
            $this->myApiPrint('success',200,$list);
        }else if($list == null){
            $this->myApiPrint('暂无数据',202);
        }else{
            $this->myApiPrint('系统繁忙，请稍后再试',300);
        }
	}

}