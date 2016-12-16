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