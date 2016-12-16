<?php

namespace Cab;

final class CarownerController
{
     /**
     * @SWG\Get(
     *     path="/V1/Carowner/isCertification",
     *     summary="判断是否认证",
     *     tags={"carowner"},
     *     description="通过用户id来判断车主认证状态",
     *     operationId="isCertification",
     *     consumes={"application/xml", "application/json"},
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         name="id",
     *         in="query",
     *         description="用户id",
     *         required=true,
     *         type="integer",
     *         @SWG\Items(type="string"),
     *         collectionFormat="multi"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="操作成功",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/Carowner")
     *         ),
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="操作成功",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/Carowner")
     *         ),
     *     ),
     *     @SWG\Response(
     *         response="200",
     *         description="status状态码：0不能接单，马上认证 1正在审核中 2审核通过",
     *     ),
     *     @SWG\Response(
     *         response="300",
     *         description="系统繁忙，请稍后再试",
     *     ),
     *     @SWG\Response(
     *         response="400",
     *         description="无效标签值",
     *     )
     * )
     */
    public function isCertification()
    {
    }

    /**
     * @SWG\Post(
     *     path="/V1/Carowner/certification",
     *     summary="驾照认证",
     *     tags={"carowner"},
     *     description="填写车主驾照信息进行认证",
     *     operationId="certification",
     *     consumes={"application/xml", "application/json"},
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         name="id",
     *         in="query",
     *         description="用户id",
     *         required=true,
     *         type="integer",
     *         @SWG\Items(type="string"),
     *         collectionFormat="multi"
     *     ),
     *     @SWG\Parameter(
     *         name="real_name",
     *         in="query",
     *         description="真实姓名",
     *         required=true,
     *         type="string",
     *         @SWG\Items(type="string"),
     *         collectionFormat="multi"
     *     ),
     *     @SWG\Parameter(
     *         name="driver_licence_num",
     *         in="query",
     *         description="驾驶证号码",
     *         required=true,
     *         type="string",
     *         @SWG\Items(type="string"),
     *         collectionFormat="multi"
     *     ),
     *     @SWG\Parameter(
     *         name="car_num",
     *         in="query",
     *         description="车牌号",
     *         required=true,
     *         type="string",
     *         @SWG\Items(type="string"),
     *         collectionFormat="multi"
     *     ),
     *     @SWG\Parameter(
     *         name="driver_licence_img",
     *         in="formData",
     *         description="驾驶证图片",
     *         required=true,
     *         type="file"
     *     ),
     *     @SWG\Parameter(
     *         name="car_owner",
     *         in="query",
     *         description="车主",
     *         required=true,
     *         type="string",
     *         @SWG\Items(type="string"),
     *         collectionFormat="multi"
     *     ),
     *     @SWG\Parameter(
     *         name="car_brand",
     *         in="query",
     *         description="车辆品牌",
     *         required=true,
     *         type="string",
     *         @SWG\Items(type="string"),
     *         collectionFormat="multi"
     *     ),
     *     @SWG\Parameter(
     *         name="car_color",
     *         in="query",
     *         description="车颜色",
     *         required=true,
     *         type="string",
     *         @SWG\Items(type="string"),
     *         collectionFormat="multi"
     *     ),
     *     @SWG\Parameter(
     *         name="vehicle_license_img",
     *         in="formData",
     *         description="行驶证图片",
     *         required=true,
     *         type="file"
     *     ),
     *     @SWG\Parameter(
     *         name="register_date",
     *         in="query",
     *         description="行驶证注册日期",
     *         required=true,
     *         type="string",
     *         @SWG\Items(type="string"),
     *         collectionFormat="multi"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="操作成功",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/Carowner")
     *         ),
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="操作成功",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/Carowner")
     *         ),
     *     ),
     *     @SWG\Response(
     *         response="200",
     *         description="操作成功",
     *     ),
     *     @SWG\Response(
     *         response="300",
     *         description="添加或修改失败或请使用post提交，请稍后再试",
     *     ),
     *     @SWG\Response(
     *         response="400",
     *         description="无效标签值",
     *     )
     * )
     */
    public function certification()
    {
    }

    /**
     * @SWG\Post(
     *     path="/V1/Carowner/carOrder",
     *     summary="接单",
     *     tags={"carowner"},
     *     description="填写车主驾照信息进行认证",
     *     operationId="carOrder",
     *     consumes={"application/xml", "application/json"},
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         name="id",
     *         in="query",
     *         description="用户id",
     *         required=true,
     *         type="integer",
     *         @SWG\Items(type="string"),
     *         collectionFormat="multi"
     *     ),
     *     @SWG\Parameter(
     *         name="start_time",
     *         in="query",
     *         description="起始时间",
     *         required=false,
     *         type="string",
     *         @SWG\Items(type="string"),
     *         collectionFormat="multi"
     *     ),
     *     @SWG\Parameter(
     *         name="start_pos",
     *         in="query",
     *         description="起始位置",
     *         required=false,
     *         type="string",
     *         @SWG\Items(type="string"),
     *         collectionFormat="multi"
     *     ),
     *     @SWG\Parameter(
     *         name="end_pos",
     *         in="query",
     *         description="到达位置",
     *         required=false,
     *         type="string",
     *         @SWG\Items(type="string"),
     *         collectionFormat="multi"
     *     ),
     *     @SWG\Parameter(
     *         name="companion",
     *         in="query",
     *         description="座位数",
     *         required=false,
     *         type="string",
     *         @SWG\Items(type="string"),
     *         collectionFormat="multi"
     *     ),
     *     @SWG\Parameter(
     *         name="start_pos_img",
     *         in="formData",
     *         description="上车地点图片",
     *         required=false,
     *         type="file"
     *     ),
     *     @SWG\Parameter(
     *         name="price",
     *         in="query",
     *         description="行程费用",
     *         required=true,
     *         type="string",
     *         @SWG\Items(type="string"),
     *         collectionFormat="multi"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="操作成功",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/Carowner")
     *         ),
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="操作成功",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/Carowner")
     *         ),
     *     ),
     *     @SWG\Response(
     *         response="200",
     *         description="操作成功",
     *     ),
     *     @SWG\Response(
     *         response="300",
     *         description="请求失败或请使用post提交，请稍后再试",
     *     ),
     *     @SWG\Response(
     *         response="400",
     *         description="无效标签值",
     *     )
     * )
     */
    public function carOrder()
    {
    }

    /**
     * @SWG\Post(
     *     path="/V1/Carowner/addPassbyPos",
     *     summary="添加途径地点",
     *     tags={"carowner"},
     *     description="添加途径地点",
     *     operationId="addPassbyPos",
     *     consumes={"application/xml", "application/json"},
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         name="id",
     *         in="query",
     *         description="用户id",
     *         required=true,
     *         type="integer",
     *         @SWG\Items(type="string"),
     *         collectionFormat="multi"
     *     ),
     *     @SWG\Parameter(
     *         name="passby_pos",
     *         in="query",
     *         description="途径地",
     *         required=false,
     *         type="string",
     *         @SWG\Items(type="string"),
     *         collectionFormat="multi"
     *     ),
     *     @SWG\Parameter(
     *         name="passby_time",
     *         in="query",
     *         description="途经时间",
     *         required=false,
     *         type="string",
     *         @SWG\Items(type="string"),
     *         collectionFormat="multi"
     *     ),
     *     @SWG\Parameter(
     *         name="passby_pos_img",
     *         in="formData",
     *         description="途径地照片",
     *         required=false,
     *         type="file"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="操作成功",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/Carowner")
     *         ),
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="操作成功",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/Carowner")
     *         ),
     *     ),
     *     @SWG\Response(
     *         response="200",
     *         description="操作成功",
     *     ),
     *     @SWG\Response(
     *         response="300",
     *         description="请求失败或请使用post提交，请稍后再试",
     *     ),
     *     @SWG\Response(
     *         response="400",
     *         description="无效标签值",
     *     )
     * )
     */
    public function addPassbyPos()
    {
    }

    /**
     * @SWG\Get(
     *     path="/V1/Carowner/passbyList",
     *     summary="获取途径地列表",
     *     tags={"carowner"},
     *     description="通过用户id来获取途径地列表",
     *     operationId="passbyList",
     *     consumes={"application/xml", "application/json"},
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         name="id",
     *         in="query",
     *         description="用户id",
     *         required=true,
     *         type="integer",
     *         @SWG\Items(type="string"),
     *         collectionFormat="multi"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="操作成功",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/Carowner")
     *         ),
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="操作成功",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/Carowner")
     *         ),
     *     ),
     *     @SWG\Response(
     *         response="200",
     *         description="操作成功",
     *     ),
     *     @SWG\Response(
     *         response="300",
     *         description="fail",
     *     ),
     *     @SWG\Response(
     *         response="400",
     *         description="无效标签值",
     *     )
     * )
     */
    public function passbyList()
    {
    }

    /**
     * @SWG\Get(
     *     path="/V1/Carowner/delPassbyPos",
     *     summary="删除途径地",
     *     tags={"carowner"},
     *     description="通过id来删除途径地",
     *     operationId="delPassbyPos",
     *     consumes={"application/xml", "application/json"},
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         name="id",
     *         in="query",
     *         description="用户id",
     *         required=true,
     *         type="integer",
     *         @SWG\Items(type="string"),
     *         collectionFormat="multi"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="操作成功",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/Carowner")
     *         ),
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="操作成功",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/Carowner")
     *         ),
     *     ),
     *     @SWG\Response(
     *         response="200",
     *         description="操作成功",
     *     ),
     *     @SWG\Response(
     *         response="300",
     *         description="fail或id不存在",
     *     ),
     *     @SWG\Response(
     *         response="400",
     *         description="无效标签值",
     *     )
     * )
     */
    public function delPassbyPos()
    {
    }

    /**
     * @SWG\Get(
     *     path="/V1/Carowner/getCarownerDetailById",
     *     summary="获取车主发布详情",
     *     tags={"carowner"},
     *     description="通过车主id获取车主发布的最新详情",
     *     operationId="getCarownerDetailById",
     *     consumes={"application/xml", "application/json"},
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         name="id",
     *         in="query",
     *         description="id",
     *         required=true,
     *         type="integer",
     *         @SWG\Items(type="string"),
     *         collectionFormat="multi"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="操作成功",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/Carowner")
     *         ),
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="操作成功",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/Carowner")
     *         ),
     *     ),
     *     @SWG\Response(
     *         response="200",
     *         description="操作成功",
     *     ),
     *     @SWG\Response(
     *         response="300",
     *         description="未获车主id参数或该id不存在",
     *     ),
     *      @SWG\Response(
     *         response="301",
     *         description="暂无数据",
     *     ),
     *     @SWG\Response(
     *         response="400",
     *         description="无效标签值",
     *     )
     * )
     */
    public function getCarownerDetailById()
    {
    }


    /**
     * @SWG\Post(
     *     path="/V1/Carowner/carOrderStatus",
     *     summary="车主状态码（待处理）",
     *     tags={"carowner"},
     *     description="通过修改状态与乘客进行交互操作 我测试用的 pid=1&id=67&status=1 如果传status不传state",
     *     operationId="carOrderStatus",
     *     consumes={"application/xml", "application/json"},
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         name="pid",
     *         in="query",
     *         description="用户乘客id",
     *         required=true,
     *         type="integer",
     *         @SWG\Items(type="string"),
     *         collectionFormat="multi"
     *     ),
     *     @SWG\Parameter(
     *         name="cab_id",
     *         in="query",
     *         description="点击列表中对应的cab_id",
     *         required=true,
     *         type="integer",
     *         @SWG\Items(type="string"),
     *         collectionFormat="multi"
     *     ),
     *     @SWG\Parameter(
     *         name="status",
     *         in="query",
     *         description="状态码 乘车状态：车主/乘客 1发布/取消预约 2待确认/待车主确认 3拒绝乘客/被拒绝 4等待乘客上车/预约成功 5已失约/失约 6上车 7完成(到达目的地) 8删除 9支付成功",
     *         required=false,
     *         type="integer",
     *         @SWG\Items(type="string"),
     *         collectionFormat="multi"
     *     ),
     *      @SWG\Parameter(
     *         name="state",
     *         in="query",
     *         description="车主乘客删除状态：00都没删 10乘客删 01车主删 11乘客车主都删除",
     *         required=false,
     *         type="integer",
     *         @SWG\Items(type="string"),
     *         collectionFormat="multi"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="操作成功",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/Carowner")
     *         ),
     *     ),
     *     @SWG\Response(
     *         response="200",
     *         description="操作成功",
     *     ),
     *     @SWG\Response(
     *         response="300",
     *         description="fail/请使用post提交",
     *     ),
     *     @SWG\Response(
     *         response="400",
     *         description="无效标签值",
     *     )
     * )
     */
    public function carOrderStatus()
    {
    }

    /**
     * @SWG\Get(
     *     path="/V1/Carowner/getCustomerListByCid",
     *     summary="预约后 获取乘客列表(未处理)",
     *     tags={"carowner"},
     *     description="通过车主id获取乘客预约后列表(乘客列表)(未处理)",
     *     operationId="getCustomerListByCid",
     *     consumes={"application/xml", "application/json"},
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         name="cid",
     *         in="query",
     *         description="车主id",
     *         required=true,
     *         type="integer",
     *         @SWG\Items(type="string"),
     *         collectionFormat="multi"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="操作成功",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/Carowner")
     *         ),
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="操作成功",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/Carowner")
     *         ),
     *     ),
     *     @SWG\Response(
     *         response="200",
     *         description="操作成功",
     *     ),
     *     @SWG\Response(
     *         response="302",
     *         description="暂无数据",
     *     ),
     *     @SWG\Response(
     *         response="301",
     *         description="未获车主id参数",
     *     ),
     *     @SWG\Response(
     *         response="400",
     *         description="无效标签值",
     *     )
     * )
     */
    public function getCustomerListByCid()
    {
    }

    /**
     * @SWG\Get(
     *     path="/V1/Carowner/getOrderListByCid",
     *     summary="获取行程列表(发送订单后)",
     *     tags={"carowner"},
     *     description="通过车主id获取行程列表，页码pageNum，每页默认5条",
     *     operationId="getOrderListByCid",
     *     consumes={"application/xml", "application/json"},
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         name="cid",
     *         in="query",
     *         description="车主id",
     *         required=true,
     *         type="integer",
     *         @SWG\Items(type="string"),
     *         collectionFormat="multi"
     *     ),
     *     @SWG\Parameter(
     *         name="pageNum",
     *         in="query",
     *         description="页码（默认第1页）",
     *         required=false,
     *         type="integer",
     *         @SWG\Items(type="string"),
     *         collectionFormat="multi"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="操作成功",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/Carowner")
     *         ),
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="操作成功",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/Carowner")
     *         ),
     *     ),
     *     @SWG\Response(
     *         response="200",
     *         description="操作成功",
     *     ),
     *     @SWG\Response(
     *         response="300",
     *         description="未获车主id参数或该id不存在",
     *     ),
     *      @SWG\Response(
     *         response="301",
     *         description="暂无数据",
     *     ),
     *     @SWG\Response(
     *         response="400",
     *         description="无效标签值",
     *     )
     * )
     */
    public function getOrderListByCid()
    {
    }

    /**
     * @SWG\Get(
     *     path="/V1/Carowner/delOrderByOrderCabId",
     *     summary="车主删除订单(提交订单后)",
     *     tags={"carowner"},
     *     description="通过订单id修改状态值来判断乘客是否删除",
     *     operationId="delOrderByOrderCabId",
     *     consumes={"application/xml", "application/json"},
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         name="order_cab_id",
     *         in="query",
     *         description="订单id",
     *         required=true,
     *         type="integer",
     *         @SWG\Items(type="string"),
     *         collectionFormat="multi"
     *     ),
     *     @SWG\Parameter(
     *         name="state",
     *         in="query",
     *         description="车主乘客删除状态：00都没删 10乘客删 01车主删 11乘客车主都删除",
     *         required=true,
     *         type="integer",
     *         @SWG\Items(type="string"),
     *         collectionFormat="multi"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="操作成功",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/Carowner")
     *         ),
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="操作成功",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/Carowner")
     *         ),
     *     ),
     *     @SWG\Response(
     *         response="200",
     *         description="操作成功",
     *     ),
     *     @SWG\Response(
     *         response="300",
     *         description="未获取订单id",
     *     ),
     *      @SWG\Response(
     *         response="301",
     *         description="未获取状态值",
     *     ),
     *      @SWG\Response(
     *         response="302",
     *         description="该订单id不存在",
     *     ),
     *     @SWG\Response(
     *         response="303",
     *         description="状态参数有误",
     *     ),
     *     @SWG\Response(
     *         response="304",
     *         description="服务器繁忙，请稍后再试",
     *     ),
     *     @SWG\Response(
     *         response="400",
     *         description="无效标签值",
     *     )
     * )
     */
    public function delOrderByOrderCabId()
    {
    }






















































}
