<?php

namespace Cab;

final class CommonController
{

    /**
     * @SWG\Get(
     *     path="/V1/Common/getRoute",
     *     summary="获取行程设置",
     *     tags={"common"},
     *     description="通过用户id获取行程设置",
     *     operationId="getRoute",
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
     *             @SWG\Items(ref="#/definitions/Common")
     *         ),
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="操作成功",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/Common")
     *         ),
     *     ),
     *     @SWG\Response(
     *         response="200",
     *         description="操作成功",
     *     ),
     *     @SWG\Response(
     *         response="202",
     *         description="暂无数据",
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
    public function getRoute()
    {
    }

    /**
     * @SWG\Post(
     *     path="/V1/Common/setRoute",
     *     summary="设置行程",
     *     tags={"common"},
     *     description="通过用户id修改行程",
     *     operationId="setRoute",
     *     consumes={"application/xml", "application/json"},
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         name="id",
     *         in="query",
     *         description="用户id",
     *         required=true,
     *         type="integer"
     *     ),
     *     @SWG\Parameter(
     *         name="home_addr",
     *         in="formData",
     *         description="家庭地址",
     *         required=false,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="company_addr",
     *         in="formData",
     *         description="公司地址",
     *         required=false,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="on_work_time",
     *         in="formData",
     *         description="上班时间",
     *         required=false,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="off_work_time",
     *         in="formData",
     *         description="下班时间",
     *         required=false,
     *         type="string"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="操作成功",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/Common")
     *         ),
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="操作成功",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/Common")
     *         ),
     *     ),
     *     @SWG\Response(
     *         response="200",
     *         description="操作成功",
     *     ),
     *     @SWG\Response(
     *         response="300",
     *         description="添加或修改失败，请稍后再试",
     *     ),
     *     @SWG\Response(
     *         response="400",
     *         description="无效标签值",
     *     )
     * )
     */
    public function setRoute()
    {
    }
}
