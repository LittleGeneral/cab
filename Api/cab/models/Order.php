<?php

namespace Cab;

/**
 * @SWG\Definition(required={"name", "photoUrls"}, @SWG\Xml(name="Order"))
 */
class Order
{

    /**
     * @SWG\Property(format="int64",example="订单id")
     * @var int
     */
    public $id;

    /**
     * @SWG\Property(example="cab表id")
     * @var int
     */
    public $cab_id;

    /**
     * @SWG\Property(example="乘客id(也是用户id)")
     * @var int
     */
    public $passager_id;

    /**
     * @SWG\Property(example="车主id(也是用户id)")
     * @var int
     */
    public $carowner_id;

    /**
     * @SWG\Property(example="乘客电话")
     * @var String
     */
    public $passager_cellphone;

    /**
     * @SWG\Property(example="车主电话")
     * @var String
     */
    public $carowner_cellphone;

    /**
     * @SWG\Property(example="起始时间")
     * @var String
     */
    public $start_time;

    /**
     * @SWG\Property(example="起始地点")
     * @var String
     */
    public $start_pos;

    /**
     * @SWG\Property(example="到达地点")
     * @var String
     */
    public $end_pos;

    /**
     * @SWG\Property(example="座位/人数")
     * @var String
     */
    public $companion;

    /**
     * @SWG\Property(example="车颜色")
     * @var String
     */
    public $car_color;

    /**
     * @SWG\Property(example="车品牌")
     * @var String
     */
    public $car_brand;

    /**
     * @SWG\Property(example="订单生成时间")
     * @var String
     */
    public $create_time;

    /**
     * @SWG\Property(example="支付方式名称代码")
     * @var String
     */
    public $payment_code;

    /**
     * @SWG\Property(example="支付(付款)方式 1微信 2支付宝")
     * @var String
     */
    public $payment_type;

    /**
     * @SWG\Property(example="订单完成时间")
     * @var String
     */
    public $finished_time;

    /**
     * @SWG\Property(example="乘车费用")
     * @var String
     */
    public $price;

    /**
     * @SWG\Property(example="状态")
     * @var String
     */
    public $status;
    /**
     * @SWG\Property(example="订单状态：0(已取消)10(默认):未付款;20:已付款;")
     * @var String
     */
    public $order_state;
}
