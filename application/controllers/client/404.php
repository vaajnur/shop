<?

namespace Controllers\Client;

use Core\Controller;

class Controller_404 extends Controller{

    public function action_index($file){
        $data['unexist_file'] = $file;
        $this->view->generate("404", $data);
    }
}
