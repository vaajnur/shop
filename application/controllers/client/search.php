<?php 

namespace Controllers\Client;

use Core\Controller;
use Models\Client\Model_Search;

class Controller_Search extends Controller{
    /**
     * @param array $args
     */
	public function action_index(array $args = null)
	{
		if(isset($_POST['send'])){
			$arg = $_POST['text'];
			$search = new Model_Search();
			$text = $search->search($arg);
            $newtext = array();
			if(is_array($text)){				
				foreach ($text as $key => $value) {
					$newtext[] = str_ireplace($arg, "<b>$arg</b>", $value["description"] );
				}
			}
			
			$search_result['text'] = $newtext;
			$search_result['count'] = count($search->search($arg));
			$search_result['breadcrumb'] = "Результаты поиска";
			$this->view->generate("search", $search_result);
		}else{
			$this->view->redirect("/");
		}
	}
}

 ?>