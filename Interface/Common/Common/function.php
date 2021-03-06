<?php

/**
 * 浮点数舍去指定位数小数点部分。全舍不入
 * @param $n float浮点值
 * @param $len 截取长度字数
 * @return string 截取后的值
 */
    function sub_float($n,$len)
    {
        stripos($n, '.') && $n= (float)substr($n,0,stripos($n, '.')+$len+1);
        return $n;
    }

/**
 * 系统缓存缓存管理
 * @param mixed $name 缓存名称
 * @param mixed $value 缓存值
 * @param mixed $options 缓存参数
 * @return mixed
 */
function cache($name, $value = '', $options = null) {
    static $cache = '';
    if (empty($cache)) {
        $cache = \Think\Cache::getInstance();
    }
    // 获取缓存
    if ('' === $value) {
        if (false !== strpos($name, '.')) {
            $vars = explode('.', $name);
            $data = $cache->get($vars[0]);
            return is_array($data) ? $data[$vars[1]] : $data;
        } else {
            return $cache->get($name);
        }
    } elseif (is_null($value)) {//删除缓存
        return $cache->remove($name);
    } else {//缓存数据
        if (is_array($options)) {
            $expire = isset($options['expire']) ? $options['expire'] : NULL;
        } else {
            $expire = is_numeric($options) ? $options : NULL;
        }
        return $cache->set($name, $value, $expire);
    }
}

/**
 * 生成随机字符串
 * @param int       $length  要生成的随机字符串长度
 * @param string    $type    随机码类型：0，数字+大小写字母；1，数字；2，小写字母；3，大写字母；4，特殊字符；-1，数字+大小写字母+特殊字符
 * @return string
 */
function randCode($length = 5, $type = 0) {
    $arr = array(1 => "0123456789", 2 => "abcdefghijklmnopqrstuvwxyz", 3 => "ABCDEFGHIJKLMNOPQRSTUVWXYZ", 4 => "~@#$%^&*(){}[]|");
    if ($type == 0) {
        array_pop($arr);
        $string = implode("", $arr);
    } elseif ($type == "-1") {
        $string = implode("", $arr);
    } else {
        $string = $arr[$type];
    }
    $count = strlen($string) - 1;
    $code = '';
    for ($i = 0; $i < $length; $i++) {
        $code .= $string[mt_rand(0, $count)];
    }
    return $code;
}

/*
 * 产生随机字符
 * $length  int 生成字符传的长度
 * $numeric  int  , = 0 随机数是大小写字符+数字 , = 1 则为纯数字
*/
function randCodeM($length, $numeric = 0)
{
    $seed = base_convert(md5(print_r($_SERVER, 1) . microtime()), 16, $numeric ? 10 : 35);
    $seed = $numeric ? (str_replace('0', '', $seed) . '012340567890') : ($seed . 'zZ' . strtoupper($seed));
    $hash = '';
    $max = strlen($seed) - 1;
    for ($i = 0; $i < $length; $i++) {
        $hash .= $seed[mt_rand(0, $max)];
    }
    return $hash;
}

/**
 * 简单对称加密算法之加密
 * @param String $string 需要加密的字串
 * @param String $skey 加密EKY
 * @return String
 */
function myEncode($string = '')
{
    if(empty($string)) return '';
    $strArr = str_split(base64_encode($string));
    $strCount = count($strArr);
    foreach (str_split(C('PASS_KEY')) as $key => $value)
        $key < $strCount && $strArr[$key] .= $value;
    return str_replace(array('+','/'), array('-','_'), join('', $strArr));
}

/**
 * 简单对称加密算法之解密
 * @param String $string 需要解密的字串
 * @param String $skey 解密KEY
 * @return String
 */
function myDecode($string = '')
{
    if(empty($string)) return '';
    $strArr = str_split(str_replace(array('-','_'),array('+','/'),  $string), 2);
    $strCount = count($strArr);
    foreach (str_split(C('PASS_KEY')) as $key => $value)
        $key <= $strCount && $strArr[$key][1] === $value && $strArr[$key] = $strArr[$key][0];
    return base64_decode(join('', $strArr));
}

/**
 * 用户数据 DES加密
 * @param String $str 需要加密的字串
 * @param String $skey 加密EKY
 * @return String
 */
function myDes_encode($str, $key)
{
    $va = \Think\Crypt\Driver\Des::encrypt($str, $key.C('PASS_KEY'));
    $va = base64_encode($va);
    return str_replace(array('+','/'), array('-','_'), $va);
}

/**
 * 用户数据 DES解密
 * @param String $str 需要解密的字串
 * @param String $skey 解密KEY
 * @return String
 */
function myDes_decode($str, $key)
{
    $str = str_replace(array('-','_'), array('+','/'), $str);
    $str = base64_decode($str);
    $va = \Think\Crypt\Driver\Des::decrypt($str, $key.C('PASS_KEY'));
    return trim($va);
}


/**
 * 邮件发送
 * @param    String                   $to         发件人邮箱
 * @param    String                   $name       发件人姓名
 * @param    string                   $subject    邮件主题
 * @param    string                   $body       邮件内容
 * @param    [type]                   $attachment 附件
 * @return   bool                               发送是否成功
 */
function think_send_mail($to, $name, $subject = '', $body = '', $attachment = null) {

    $config = C('THINK_EMAIL');

    Vendor('PHPMailer.PHPMailerAutoload'); //从PHPMailer目录导class.phpmailer.php类文件

    $mail = new PHPMailer(); //PHPMailer对象

    $mail->CharSet = 'UTF-8'; //设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置，否则乱码

    $mail->IsSMTP(); // 设定使用SMTP服务

    $mail->SMTPDebug = 0; // 关闭SMTP调试功能
// 1 = errors and messages
// 2 = messages only

    $mail->SMTPAuth = true; // 启用 SMTP 验证功能

    $mail->SMTPSecure = 'ssl'; // 使用安全协议

    $mail->Host = $config['SMTP_HOST']; // SMTP 服务器

    $mail->Port = $config['SMTP_PORT']; // SMTP服务器的端口号

    $mail->Username = $config['SMTP_USER']; // SMTP服务器用户名

    $mail->Password = $config['SMTP_PASS']; // SMTP服务器密码

    $mail->SetFrom($config['FROM_EMAIL'], $config['FROM_NAME']);

    $replyEmail = $config['REPLY_EMAIL'] ? $config['REPLY_EMAIL'] : $config['FROM_EMAIL'];

    $replyName = $config['REPLY_NAME'] ? $config['REPLY_NAME'] : $config['FROM_NAME'];

    $mail->AddReplyTo($replyEmail, $replyName);

    $mail->Subject = $subject;

    $mail->AltBody = "为了查看该邮件，请切换到支持 HTML 的邮件客户端";

    $mail->MsgHTML($body);

    $mail->AddAddress($to, $name);

    if (is_array($attachment)) { // 添加附件
        foreach ($attachment as $file) {

            is_file($file) && $mail->AddAttachment($file);
        }
    }

    return $mail->Send() ? true : $mail->ErrorInfo;
}

/**
 * 函数封装分类直接用
 * @param $count 要分页的总记录数
 * @param int $pagesize 每页查询条数
 * @return \Think\Page
 */
function getpage($count,$pagesize = 10) {
    $p = new \Think\Page($count,$pagesize);
    $p->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
    $p->setConfig('prev', '上一页');
    $p->setConfig('next', '下一页');
    $p->setConfig('last', '末页');
    $p->setConfig('first', '首页');
    $p->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
    $p->lastSuffix = false; //最后一页不显示为总数
    return $p;
}
