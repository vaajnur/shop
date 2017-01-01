<?

namespace Controllers\Client;

use Core\Controller;
use Models\Client\Model_Login;

class Controller_Login extends Controller{
    /**
     *
     */
    public function action_index(){
        $data = "";
        // авторизация
        if(isset($_POST['name'])){
//            unset($_POST['send']);
            $model = new Model_Login();
            foreach($_POST as $name => $post){
                if($post == ""){
                    $data['mess'] = "Пустое поле $name";
                    $data['mess_type'] = "warning";
                    $this->view->generate("login/login-mess", $data);
                    return;
                }
            }
            $res = $model->getUser($_POST);
            if($res) {
                $_SESSION['user'] = $res;
                $data['mess'] = "Успешная авторизация!";
                $data['mess_type'] = "success";
                $data['reload'] = true;
            }else{
                $data['mess'] = "Ошибка входа!";
                $data['mess_type'] = "danger";
            }
        }
        $this->view->generate("login/login-mess", $data);
    }

    /**
     *
     */
    public function action_logout(){
        $_SESSION['user'] = null;
        return;
    }

    /**
     *
     */
    public function action_register(){
        $data = "";
        if(isset($_POST['send'])){
            unset($_POST['send']);
            foreach($_POST as $name => $post){
                if($post == ""){
                    $data['mess'] = "Пустое поле $name";
                    $data['mess_type'] = "warning";
                    $this->view->generate("login/register", $data);
                }
            }
            $_POST['password'] = md5($_POST['password']);
                $model = new Model_Login();
                $res = $model->registerUser($_POST);
                if ($res == true) {
                    $data['mess'] = "Зарегистрирован!";
                    $data['mess_type'] = "success";
                } else {
                    $data['mess'] = "Ошибка регистрации!";
                    $data['mess_type'] = "danger";
                }

        }
        $this->view->generate("login/register", $data);
    }
}