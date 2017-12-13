<?php 

class Employee extends Model{
    public function login(){
        $password = sha1($_POST['password']);
        $arr = array(':username'=>$_POST['user'],':password'=>$password);

        $query = "SELECT * FROM employee WHERE username=:username AND password=:password";
        $result = $this->query_execute($query,$arr);
        $results = $result[0];
        $_SESSION['adminid'] = $results['id'];
        $_SESSION['admin'] = $results['name'];
        header("Location:http://ims.com/admin/");
    }
}

?>