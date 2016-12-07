<?php

namespace Cab;

/**
 * @SWG\Definition(required={"name", "photoUrls"}, @SWG\Xml(name="Common"))
 */
class Common
{

    /**
     * @SWG\Property(format="int64")
     * @var int
     */
    public $id;

    /**
     * @SWG\Property(example="用户id")
     * @var int
     */
    public $users_id;

    /**
     * @SWG\Property(example="家庭地址")
     * @var String
     */
    public $home_addr;

    /**
     * @SWG\Property(example="公司地址")
     * @var String
     */
    public $company_addr;

    /**
     * @SWG\Property(example="上班时间")
     * @var String
     */
    public $on_work_time;

    /**
     * @SWG\Property(example="下班时间")
     * @var String
     */
    public $off_work_time;
}
