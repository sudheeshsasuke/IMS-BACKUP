<?php 
//Admin controller
class AdminRoundController extends Rounds{

	
	//display interview page with all interviews added 
	public function roundpage(){
		$rounds = $this->get_all_rounds();
		require './office/templates/rounds.tpl.php';
	}
	
	//
	public function addroundpage() {
		require './office/templates/addroundpage.tpl.php';
	}

	//add or modify rounds
	public function addround() {
		if($_POST['roundid'] != NULL) {
			$this->edit_round();
		}
		else {
			$this->add_round();
		}
		//$this->roundpage();
		header("location:http://ims.com/admin/round");
	}

	//function to prepopuluate the values for the selected round id
	public function editround() {
		$round = $this->get_round();
		require './office/templates/addroundpage.tpl.php';		
	}

	public function deleteround() {
		$this->delete_round();
		//$this->roundpage();
	}
}


?>