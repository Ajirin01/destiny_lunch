<?php 
    use App\User as User;

    function get_user_by_id($id){
        $User = new User;
        $user = $User::find($id);
        return $user;
    }
?>