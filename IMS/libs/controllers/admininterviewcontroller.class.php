<?php 
//Admin controller
class AdminInterviewController extends Interview{

	
	//display interview page with all interviews added 
	public function interviewpage(){
		$interviews = $this->get_all_interviews();
		require './office/templates/interviews.tpl.php';
	}
	
	
	//function to redirect to addinterview page
	public function addinterviewpage() {

		require './office/templates/addinterviewpage.tpl.php';
	}

	//add or update interview in DB
	public function addinterview() {

		if($_POST['jobid'] != NULL) {
			$this->edit_interview();
		}
		else {
			$this->add_interview();
		}
		//$this->interviewpage();
		header("location:http://ims.com/admin/interview");
	}

	//function to prepopuluate the values for the selected interview id
	public function editinterview() {
		$interview = $this->get_interview();
		require './office/templates/addinterviewpage.tpl.php';		
	}

	public function deleteinterview() {
		$this->delete_interview();
		//$this->interviewpage();
	}
}


?>