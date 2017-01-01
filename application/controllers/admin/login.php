<?

namespace Controllers\Admin;

use Core\Controller;
use Models\Admin\Model_Login;

class Controller_Login extends Controller{

    /**
     *
     */
    public function action_index(){
        $model = new Model_Login();
        $data['login_page'] = true;
        if(isset($_POST['send'])) {
            unset($_POST['send']);
            // пустые поля
            if(!empty($_POST['name']) && !empty($_POST['password'])){
                $user = $model->login($_POST);
            }else{
                $data['mess1'] = "Пустые поля!";
                $this->view->generate("login", $data);
                return;
            }
            // ошибка регистрации
            if ($user == true){
                $_SESSION['admin'] = $user;
                $this->view->redirect("/admin/");
                $data['login_page'] = null;
            }else{
                $data['mess1'] = "Неверные данные!";
                $this->view->generate("login", $data);
                return;
            }
        }
        $this->view->generate("login", $data);
    }

    /**
     *
     */
    public function action_logout(){
        $_SESSION['admin'] = null;
        $this->view->redirect("/");
    }
}