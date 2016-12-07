<?php

namespace Cab;

final class OrderController
{

    /**
     * @SWG\Get(
     *     path="/V1/Order/getOrderDetailByid",
     *     summary="获取订单详情(公共)",
     *     tags={"order"},
     *     description="通过id获取订单详情信息（乘客和车主都可以使用）",
     *     operationId="getOrderDetailByid",
     *     consumes={"application/xml", "application/json"},
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         name="id",
     *         in="query",
     *         description="订单id",
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
     *             @SWG\Items(ref="#/definitions/Order")
     *         ),
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="操作成功",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/Order")
     *         ),
     *     ),
     *     @SWG\Response(
     *         response="200",
     *         description="操作成功",
     *     ),
     *     @SWG\Response(
     *         response="300",
     *         description="未获id参数或该id不存在",
     *     ),
     *     @SWG\Response(
     *         response="301",
     *         description="没有数据",
     *     ),
     *     @SWG\Response(
     *         response="400",
     *         description="无效标签值",
     *     )
     * )
     */
    public function getOrderDetailByid()
    {
    }

}
