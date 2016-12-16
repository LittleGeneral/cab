<?php
/**
 * 公开接口API
 * 不需要验证用户身份token
 */
namespace V1\Controller;

use Common\Controller\ApiController;
// use Common\Common\Response;

class IndexController extends ApiController{
    public function index(){
       $this->show(300,'无效接口');
    }
}