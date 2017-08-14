<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller
{
    public function index()
    {
        $this->display();
    }
    //生成常规验证码
    //http://web.shop.com:8080/index.php/Home/Index/captcha
    //http://web.shop.com:8080/index.php/Home/Index/index
    public function captcha()
    {
        //配置
        $cfg = array(
            'fontSize' => 10,              // 验证码字体大小(px)
            'useCurve' => false,            // 是否画混淆曲线
            'useNoise' => false,            // 是否添加杂点
            'imageH' => 20,               // 验证码图片高度
            'imageW' => 80,               // 验证码图片宽度
            'length' => 4,               // 验证码位数
            'fontttf' => '4.ttf',              // 验证码字体，不设置随机获取
        );
        //实例化验证码类
        $verify = new \Think\Verify($cfg);
        //输出验证码
        $verify->entry();
    }

    //checkLogin
    public function checkLogin()
    {
        //接收数据
        $post = I('post.');
        //验证验证码（不需要传参）
        $verify = new \Think\Verify();
        $result = $verify->check($post['captcha']);
        if ($result) {
            //验证验证码正确，继续处理用户名和密码
            unset($post['captcha']);
            $uid = session('uid');
            $uone_pwd = session('uone_pwd');
            if ($uid == $post['uid'] && $uone_pwd == $post['uone_pwd'])
            {?>
                <script type="text/javascript">
                    window.location.href = "/index.php/Home/User/index";
                    window.alert("登录成功");
                </script>
<!--                echo "登录成功";-->
<!--                $this->success('登录成功', U('User/index'), 3);-->

            <?php
            } else {
                //本地没有，查询数据库
                $model = M('User');
                $data = $model->where($post)->find();
                if ($data) {
                    //存在用户，用户信息持久保存到session中，跳转到前台首页
                    session('uid', $data['uid']);
                    session('uone_pwd', $data['uone_pwd']);
                    ?>
                    <script type="text/javascript">
                        window.location.href = "/index.php/Home/User/index";
                        window.alert("登录成功");
                    </script>
                    <?php
//                    $this->success('登录成功@~@', U('User/index'), 3);
                } else {
                    //用户不存在
                    ?>
                    <script type="text/javascript">
                        window.location.href = "/index.php/Home/Index/index";
                        window.alert("用户名或密码错误");
                    </script>
                    <?php
//                    $this->error('用户名或密码错误！');
                }

            }
        }
        else{
                //验证码不正确
            ?>
            <script type="text/javascript">
                window.location.href = "/index.php/Home/Index/index";
                window.alert("您输入的验证码错误");
            </script>
            <?php
//                $this->error('您输入的验证码错误！');
            }

    }

















}