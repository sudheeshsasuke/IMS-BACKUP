<?php

class AdminParticipantController extends Participant{

	

	public function list_participants(){
		$exp = new Experience();
		$acadamic = new Academics();
		$candidates = $this->get_all_participants();
		$experience = $exp->get_experience_details();
		$acadamics = $acadamic->get_acadamic_details();
		require_once './office/templates/candidatelist.tpl.php';
	}

	public function new_registration(){
		if(!isset($_POST['name'])){
			require_once './office/templates/addparticipant.tpl.php';
		}

	}
	public function new_register(){
		$part = new AdminParticipantModel();
		$part->insert_personal_details();
		$part->insert_academic_details();
		$part->insert_experience_details();
		$part->insert_skill_details();
		$part->upload_resume();
		header("Location:http://ims.com/admin/new_reg");
	}
}

?>