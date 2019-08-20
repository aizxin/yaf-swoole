<?php
/** 
 * @Author: whero 
 * @Date: 2018-05-26 17:42:17 
 * @Desc: 默认控制器 
 */

class IndexController extends Controller {

	/** 
	 * @Author: whero 
	 * @Date: 2018-05-26 17:45:05 
	 * @Desc: 默认动作 
	 */	
	public function indexAction() {
	    var_dump(\swf\model\UserModel::query()->get()->toArray());
        /* 自己输出响应 */
//        return $this->response->write($this->render("index"));
	}

}
