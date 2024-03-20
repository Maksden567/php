<?php 
require('../core/Db.php') ;
$db = new Db('localhost','root','admin','users');
$db = $db->connect();



$data = file_get_contents("php://input");
$result = json_decode($data, true);
if($result["action"] == "saveUser"){
    Main::saveUser($result["valueFirstName"],$result["valueLastName"],$result["valueRole"],$result["valueStatus"]);
}
if($result["action"]=="deleteUser"){
    Main::deleteUser($result["deleteId"],false);
}
if($result["action"]=="getUsers"){
    Main::getUsers();
}
if($result["action"]=="deleteUsers"){
    Main::deleteUsers($result['users']);
}
if($result["action"]=="setActive"){
    Main::setActive($result['users']);
}
if($result["action"]=="setNotActive"){
    Main::setNotActive($result['users']);
}
if($result["action"]=="updateUser"){
    Main::updateUser($result['updateData'],$result['id']);
}

class Main {


    static function saveUser($name,$lastName,$role,$status) {
        try {
            if(!$name||!$lastName || !$role){
                
                $error = array(
                    'status' => 'false',
                    'error' => array(
                        'code' => '100',
                        'message' => 'Fill in the required fields'
                    )
                );
                
                $error_json = json_encode($error);
                echo $error_json;
                return $error_json;
            }
            global $db;
            $stmp = $db->prepare('INSERT INTO `users` (name,surname,role,status) VALUES (?,?,?,?)');
            $stmp->bind_param('sssi', $name,$lastName,$role,$status);
            $user = $stmp->execute();
            $answer = Main::answer(true,'User add succesfully');
            $json = json_encode($answer);
            echo $json;
            return $json;
            
        } catch (Exception $e) {
            echo $e;
        }
        
    }

    static function deleteUser($id,$isUsers){
        try {
            if(!$id){
                $error = array(
                    'status' => 'false',
                    'error' => array(
                        'code' => '400',
                        'message' => 'Chose user'
                    )
                );
                $json = json_encode($error);
                echo $json;
                return $json;
            }
            global $db;
            $stmp = $db->prepare('DELETE FROM `users` WHERE id=?');
            $stmp->bind_param('i', $id);
            $res = $stmp->execute();
            $answer = Main::answerWithId(true,'User delete succesfully', $id);
            $json = json_encode($answer);
            if($isUsers){
                return $json;
            }
            else{
                echo $json;
            }
           
        } catch (Exception $e) {
           echo($e);
        }
       
    }

    static function getUsers(){
        try {
            global $db;
            $stmp = $db->prepare('SELECT * FROM `users`');
            $result = $stmp->execute();
            $result = $stmp->get_result();
            
            if($result->num_rows>0){
                $answer = Main::answerWithUsers(true,"Users gotten sucesfully",$result->fetch_all());
                echo json_encode($answer);
            }
            else{
                $answer= Main::answer(true,"Dont have users");
                echo json_encode($answer);
            }
            
        } catch (Exception $e) {
            echo($e);
        }
        
    }
    static function deleteUsers($users){
        global $db;
        $mass = [];
       foreach ($users as $key => $user) {
            Main::deleteUser($user,true);
            $mass[] = $user;
            
       }
       $answer = Main::answerWithId(true,"Delete users is success", $mass);
       $json = json_encode( $answer);
       echo $json;
        return $json;
    }
    static function setActive($users){
        try {
            global $db;
            $massActive = [];
            foreach ($users as $key => $user) {
                 $stmp = $db->prepare('UPDATE `users` SET status=true WHERE id=?');
                 $stmp->bind_param('i', $user);
                 $result = $stmp->execute();
                 $result = $stmp->get_result();
                 $massActive[] = $user;
            }
            $answer = Main::answerWithId(true,"Status is changed",$massActive);
            $json = json_encode( $answer);
            echo $json;
        } catch (Exception $e) {
            echo($e);
        }
        
    }
    static function setNotActive($users){
        try {
            global $db;
            $massActive = [];
            foreach ($users as $key => $user) {
                 $stmp = $db->prepare('UPDATE `users` SET status=false WHERE id=?');
                 $stmp->bind_param('i', $user);
                 $result = $stmp->execute();
                 $result = $stmp->get_result();
                
                 $massActive[] = $user;
            }
            $answer = Main::answerWithId(true,"Status is changed",$massActive);
            $json = json_encode( $answer);
            echo $json;
        } catch (Exception $e) {
            echo($e);
        }
    }

    static function updateUser($updateData,$id){
        global $db;
        try {
            $firstName=$updateData['firstName'];
            if(!$firstName||!$updateData['lastName']){
                $error = array(
                    'status' => 'false',
                    'error' => array(
                        'code' => '400',
                        'message' => 'Fill required fields'
                    )
                );
                $json = json_encode($error);
                echo $json;
                return false;
            }
            $stmp = $db->prepare('UPDATE `users` SET name = ?, surname = ?, role = ?,status=? WHERE id=?');
            $stmp->bind_param('sssii', $firstName,$updateData['lastName'],$updateData['role'],$updateData['status'],$id);
            $result = $stmp->execute();
            
            $answer = Main::answerWithId('true','User update succesfully', $id);
            $json = json_encode($answer);
            echo $json;

        } catch (Exception $e) {
            echo $e;
        }

    }

    static function answer($status,$message){
         $answer = array(
            'status' => $status,
            'error' => 'null',
            'message'=> $message,
        );

        return $answer;
    }
    static function answerWithId($status,$message,$id){
        $answer = array(
           'status' => $status,
           'error' => 'null',
           'message'=> $message,
           "id"=> $id
       );

       return $answer;
   }

   static function answerWithUsers($status,$message,$users){
    $answer = array(
       'status' => $status,
       'error' => 'null',
       'message'=> $message,
       "users"=> $users
   );

   return $answer;
}

}


?>