<?php

namespace Cab;

/**
 * @SWG\Definition(required={"name", "photoUrls"}, @SWG\Xml(name="Carowner"))
 */
class Carowner
{

    /**
     * @SWG\Property(format="int64",example="乘客电话")
     * @var int
     */
    public $tel;

    /**
     * @SWG\Property(example="乘客头像")
     * @var String
     */
    public $img;

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
     * @SWG\Property(example="乘客真实姓名")
     * @var String
     */
    public $real_name;

    /**
     * @SWG\Property(format="int64",example="这条数据id")
     * @var int
     */
    public $id;

    /**
     * @SWG\Property(format="int64",example="用户id")
     * @var int
     */
    public $users_id;

    /**
     * @SWG\Property(example="起始时间")
     * @var String
     */
    public $start_time;

     /**
     * @SWG\Property(format="int64",example="座位数")
     * @var int
     */
    public $companion;

    /**
     * @SWG\Property(example="起始位置")
     * @var String
     */
    public $start_pos;

    /**
     * @SWG\Property(example="起始图片")
     * @var String
     */
    public $start_pos_img;

    /**
     * @SWG\Property(example="到达位置")
     * @var String
     */
    public $end_pos;

    /**
     * @SWG\Property(format="int64",example="价格")
     * @var int
     */
    public $price;

    /**
     * @SWG\Property(example="类型 默认0 1车主1 乘客2")
     * @var enum
     */
    public $type;

    /**
     * @SWG\Property(example="状态 默认1")
     * @var enum
     */
    public $status;

    /**
     * @SWG\Property(example="创建时间")
     * @var String
     */
    public $create_time;
}
