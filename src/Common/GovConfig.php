<?php
/**
 * @author: renyuchong
 * Date: 2019-12-16
 * @version 1.0
 */
namespace Jiadd\Gov\Common;

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

    //同步考试成绩-查表的数据
    const SYNC_DRIVING_EXAM_SCORE_TABLE = '122API/get_school_performance';

    //获取alitoken
    const GET_ALITOKEN = '122API/alitoken';

    //获取验证码图片的类型
    const GET_CAPTCHA_TYPE = '122API/get_captcha_type';

    //计算验证码
    const CAPTCHA_COUNT_IMG = '122API/get_captcha_img';

    //GIF验证码
    const CAPTCHA_GIF_IMG = '122API/get_captcha_gif_img';

    //学员查询考试成绩
    const STUDENT_EXAM_SCORE = '122API/stucjcx';

    //学员网办进度
    const STUDENT_NETWORK_SPEED = '122API/student/query_network_progress';

    //学员网办进度详情
    const STUDENT_NETWORK_SPEED_DETAIL = '122API/student/query_network_progress';

    //预录入-注册申请表
    const PRE_REGISTER_PDF = '122API/slnewregpdf';

    //预录入-检查身份证
    const PRE_CHECK_ID_CARD = '122API/slsfzmhm';

    //预录入-检查身份证
    const PRE_CHECK_ID_CARD_FLOW = '122API/slsfzmhm/flow';

    //预录入-保存受理信息
    const SAVE_PRE_ENTRY_INFO = '122API/slsavexx';

    //预录入-行政区号
    const PRE_AREA_CODE = '122API/ydxzqh';

    //预录入-驾驶证申请表
    const PRE_DRIVER_LICENSE_PDF = '122API/sldrvpdf';

    //预录入-获取注册申请表pdf
    const PRE_REGISTER_PDF_OLD = '122API/slregpdf';

    //预录入-上传受理照片
    const PRE_UPLOAD_ACCEPT_IMAGE = '122API/slsaveimage';

    //预录入-上传照片前获取加密密钥
    const PRE_GET_UPLOAD_IMAGE_ENCRYPT_KEY = '122API/getencrypt';

    //预录入-上传照片前setdecrypt
    const PRE_SET_UPLOAD_IMAGE_DECRYPT_KEY = '122API/setdecrypt';

    //预录入-获取驾照照片流水号
    const PRE_GET_DRIVER_IMAGE_SERIAL_NUMBER = '122API/sldrvphotoflow';

    //预录入-上传驾照照片
    const PRE_UPLOAD_DRIVER_IMAGE = '122API/slsavedrvphoto';

    //预录入-上传身份证电子照片
    const PRE_UPLOAD_ID_CARD_IMAGE = '122API/slsaveidentityphoto';

    //预录入-提交预录入受理
    const PRE_SUBMIT_ENTRY_ACCEPT = '122API/slcommit';

    //预录入-驾校受理查询接口
    const PRE_DRIVER_INQUIRE_ACCEPT_INFO = '122API/slcx';

    //预录入-生成个人用户注册seed接口
    const PRE_CREATE_INDIVIDUAL_REGISTER_SEED = '122API/slgeneregseed';

    //获取验证码图片类型的固定值，目前是固定的。以后122换了，需要修改
    const CHECK_TYPE = 'xThbIYTTWUEbRysf';

    //驾校考试场地查询
    const SCHOOL_EXAM_SITE = '122API/drvksdd';
}