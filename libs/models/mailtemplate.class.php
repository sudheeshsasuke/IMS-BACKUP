<?php


class MailTemplate extends database {
    
        
    //insert mailtemplate into mailtemplate table
     public function add_mailtemplate() {
        $query = "INSERT INTO mail_template (code,subject,`text`,description)"
                . " VALUES(:code,:subject,:text,:description)";
        $values = array(
                ':code' => addslashes($_POST['code']),
                ':subject' => addslashes($_POST['subject']),
                ':text' => addslashes($_POST['mailtext']),
                ':description' => addslashes($_POST['description']));
        $this->query_execute($query, $values);               
    }

    public function edit_mailtemplate() {
        $query = "UPDATE mail_template set"  
            . " `code` = :code,subject = :subject,`text` = :text,description = :description"
            . " WHERE id = :id";
            $values = array(
                ':code' => addslashes($_POST['code']),
                ':subject' => addslashes($_POST['subject']),
                ':text' => addslashes($_POST['mailtext']),
                ':description' => addslashes($_POST['description']),
                ':id' => addslashes($_POST['templateid']));
        $this->query_execute($query, $values);               
    }

    public function delete_mailtemplate() {
        $query = "DELETE FROM mail_template WHERE `id` = :id";
        $soft_delete = 1;
        $values = array(
                ':id' => $_POST['templateid']);
        $this->query_execute($query, $values);               
    }
    public function get_template($templatecode) {
        $query = "SELECT * FROM mail_template "
                . "WHERE code= :code";
        $values = array(
                ':code' => $templatecode);
        $tmplt = $this->query_execute($query, $values);   
        return $tmplt[0];
    }

    public function get_template_byid($templateid) {
        $query = "SELECT * FROM mail_template "
                . "WHERE id= :id";
        $values = array(
                ':id' => $templateid);
        $tmplt = $this->query_execute($query, $values);   
        return $tmplt[0];
    }

    //fetch all mail templates
    public function get_all_mailtemplates() {
        $query = "SELECT * FROM `mail_template`";
        $interviews = $this->query_execute($query,NULL);
        return $interviews;
    }  
    
}