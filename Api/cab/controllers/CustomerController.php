<?php

namespace Cab;

final class CustomerController
{
     /**
     * @SWG\Post(
     *     path="/V1/Customer/appointCar",
     *     summary="乘客约车",
     *     tags={"customer"},
     *     description="约车添加或设置",
     *     operationId="appointCar",
     *     consumes={"application/xml", "application/json"},
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         name="id",
     *         in="query",
     *         description="用户乘客id",
     *         required=true,
     *         type="integer",
     *         @SWG\Items(type="string"),
     *         collectionFormat="multi"
     *     ),
     *     @SWG\Parameter(
     *         name="start_time",
     *         in="query",
     *         description="起始时间",
     *         required=true,
     *         type="string",
     *         @SWG\Items(type="string"),
     *         collectionFormat="multi"
     *     ),
     *     @SWG\Parameter(
     *         name="start_pos",
     *         in="query",
     *         description="起始位置",
     *         required=true,
     *         type="string",
     *         @SWG\Items(type="string"),
     *         collectionFormat="multi"
     *     ),
     *     @SWG\Parameter(
     *         name="end_pos",
     *         in="query",
     *         description="到达位置",
     *         required=true,
     *         type="string",
     *         @SWG\Items(type="string"),
     *         collectionFormat="multi"
     *     ),
     *     @SWG\Parameter(
     *         name="companion",
     *         in="query",
     *         description="同行人数",
     *         required=false,
     *         type="string",
     *         @SWG\Items(type="string"),
     *         collectionFormat="multi"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="操作成功",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/Customer")
     *         ),
     *     ),
     *     @SWG\Response(
     *         response="200",
     *         description="操作成功",
     *     ),
     *     @SWG\Response(
     *         response="300",
     *         description="无匹配数据/请使用post提交",
     *     ),
     *     @SWG\Response(
     *         response="400",
     *         description="无效标签值",
     *     )
     * )
     */
    public function appointCar()
    {
    }

     /**
     * @SWG\Post(
     *     path="/V1/Customer/takeCarStatus",
     *     summary="乘客乘车状态码",
     *     tags={"customer"},
     *     description="通过修改状态与车主进行交互操作 我测试用的 pid=1&id=67&status=1",
     *     operationId="takeCarStatus",
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
     *         name="id",
     *         in="query",
     *         description="点击列表中对应车主的id",
     *         required=true,
     *         type="integer",
     *         @SWG\Items(type="string"),
     *         collectionFormat="multi"
     *     ),
     *     @SWG\Parameter(
     *         name="status",
     *         in="query",
     *         description="状态码 乘车状态：车主/乘客 1发布/取消预约 2待确认/待车主确认 3拒绝乘客/被拒绝 4等待乘客上车/预约成功 5已失约/失约 6上车 7完成 8取消或删除",
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
     *             @SWG\Items(ref="#/definitions/Customer")
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
    public function takeCarStatus()
    {
    }

    /**
     * @SWG\Get(
     *     path="/V1/Customer/getCarownerListByPid",
     *     summary="预约后 获取车主列表(未处理)",
     *     tags={"customer"},
     *     description="通过用户id获取乘客预约后列表(车主列表)(未处理)",
     *     operationId="getCarownerListByPid",
     *     consumes={"application/xml", "application/json"},
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         name="pid",
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
     *             @SWG\Items(ref="#/definitions/Customer")
     *         ),
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="操作成功",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/Customer")
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
     *         description="未获乘客id参数",
     *     ),
     *     @SWG\Response(
     *         response="400",
     *         description="无效标签值",
     *     )
     * )
     */
    public function getCarownerListByPid()
    {
    }

    /**
     * @SWG\Post(
     *     path="/V1/Customer/finishOrder",
     *     summary="乘客订单提交（待处理）",
     *     tags={"customer"},
     *     description="通过提交支付类型和订单状态来完成订单（当乘客订单状态进入7时，获取订单信息，同时将支付类型和订单状态码提交 参数在下边）",
     *     operationId="finishOrder",
     *     consumes={"application/xml", "application/json"},
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         name="pid",
     *         in="query",
     *         description="订单id",
     *         required=true,
     *         type="integer",
     *         @SWG\Items(type="string"),
     *         collectionFormat="multi"
     *     ),
     *     @SWG\Parameter(
     *         name="payment_type",
     *         in="query",
     *         description="支付类型 支付(付款)方式 1微信 2支付宝",
     *         required=true,
     *         type="integer",
     *         @SWG\Items(type="string"),
     *         collectionFormat="multi"
     *     ),
     *     @SWG\Parameter(
     *         name="order_state",
     *         in="query",
     *         description="订单状态 订单状态：0(已取消)10(默认):未付款;20:已付款",
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
     *             @SWG\Items(ref="#/definitions/Customer")
     *         ),
     *     ),
     *     @SWG\Response(
     *         response="200",
     *         description="操作成功",
     *     ),
     *     @SWG\Response(
     *         response="300",
     *         description="请使用post提交",
     *     ),
     *     @SWG\Response(
     *         response="301",
     *         description="未获id参数",
     *     ),
     *     @SWG\Response(
     *         response="302",
     *         description="未获取支付类型",
     *     ),
     *     @SWG\Response(
     *         response="303",
     *         description="未获取订单状态",
     *     ),
     *     @SWG\Response(
     *         response="304",
     *         description="操作失败",
     *     ),
     *     @SWG\Response(
     *         response="400",
     *         description="无效标签值",
     *     )
     * )
     */
    public function finishOrder()
    {
    }

    /**
     * @SWG\Get(
     *     path="/V1/Customer/getRouteBypid",
     *     summary="获取行程列表(提交订单后)",
     *     tags={"customer"},
     *     description="通过用户id获取行程列表",
     *     operationId="getRouteBypid",
     *     consumes={"application/xml", "application/json"},
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         name="pid",
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
     *             @SWG\Items(ref="#/definitions/Customer")
     *         ),
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="操作成功",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/Customer")
     *         ),
     *     ),
     *     @SWG\Response(
     *         response="200",
     *         description="操作成功",
     *     ),
     *     @SWG\Response(
     *         response="300",
     *         description="未获乘客id参数或该id不存在",
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
    public function getRouteBypid()
    {
    }
























































































}