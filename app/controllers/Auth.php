<?php
/**
 * FileName: AuthController.php
 * ==============================================
 * Copy right 2016-2017
 * ----------------------------------------------
 * This is not a free software, without any authorization is not allowed to use and spread.
 * ==============================================
 * @author: kong | <iwhero@yeah.com>
 * @date  : 2019-08-23 23:24
 */

class AuthController extends Controller
{
    /*
     * 登录
     */
    public function loginAction()
    {
        var_dump('indexloginAction');
//        return $this->response->write('index121234');
    }

    /*
     * 获取 用户信息
     */
    public function userAction()
    {
//        return $this->response->write(
//            json_encode([
//                'code' => 200,
//                'msg'  => 'success',
//                'data' => [
//                    'nickname'   => 'admin',
//                    'headimgurl' => 'http://poci6sbqi.bkt.clouddn.com/avatar.jpg',
//                    'roles'      => 'admin',
//                ],
//            ])
//        );
    }
}