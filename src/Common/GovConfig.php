<?php
/**
 * @author: renyuchong
 * Date: 2019-12-16
 * @version 1.0
 */
namespace Gov\Common;

class GovConfig
{
    //122账号登录
    const AUTO_LOGIN = '122API/autologin';

    //驾校登录
    const DRIVING_LOGIN = '122API/drvlogin';

    //学员登录
    const STUDENT_LOGIN = '122API/stulogin';

    //同步考试计划-通过excel
    const SYNC_EXAM_PLAN_EXCEL = '122API/drvyyxz';

    //同步考试计划-信息简化版
    const SYNC_EXAM_PLAN_SIMPLE = '122API/drvyycx';

    //同步考试计划-查表的数据
    const SYNC_EXAM_PLAN_TABLE = '122API/get_school_interview_exam';

    //查询考试成绩-通过excel
    const SYNC_DRIVING_EXAM_SCORE_EXCEL = '122API/drvcjcxdown';

    //查询考试成绩-信息简化版
    const SYNC_DRIVING_EXAM_SCORE_SIMPLE = '122API/drvcjcx';

    //获取alitoken
    const GET_ALITOKEN = '122API/alitoken';

    //获取验证码图片的类型
    const GET_CAPTCHA_TYPE = '122API/get_captcha_type';

    //计算验证码
    const CAPTCHA_COUNT_IMG = '122API/get_captcha_img';

    //GIF验证码
    const CAPTCHA_GIF_IMG = '122API/get_captcha_gif_img';

    //122的身份登录地址
    const URL_122 = [
        '北京市' => 'https://bj.122.gov.cn',
        '江西省' => 'https://jx.122.gov.cn',
        '重庆市' => 'https://cq.122.gov.cn',
        '四川省' => 'https://sc.122.gov.cn',
        '广东省' => 'https://gd.122.gov.cn',
        '山东省' => 'https://sd.122.gov.cn',
        '河北省' => 'https://hb.122.gov.cn',
        '湖南省' => 'https://hn.122.gov.cn',
        '陕西省' => 'https://sn.122.gov.cn',
        '福建省' => 'https://fj.122.gov.cn',
        '安徽省' => 'https://ah.122.gov.cn',
        '河南省' => 'https://ha.122.gov.cn',
        '贵州省' => 'https://gz.122.gov.cn',
        '江苏省' => 'https://js.122.gov.cn',
        '山西省' => 'https://sx.122.gov.cn',
        '云南省' => 'https://yn.122.gov.cn',
        '甘肃省' => 'https://gs.122.gov.cn',
        '海南省' => 'https://hi.122.gov.cn'
    ];

    //获取验证码图片类型的固定值，目前是固定的。以后122换了，需要修改
    const CHECK_TYPE = 'xThbIYTTWUEbRysf';
}