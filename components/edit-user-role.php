<?php 

require_once './inc/functions.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

    $userID = InputProcessor::process_string($_POST['userID'] ?? '');
    $admin = InputProcessor::process_string($_POST['admin'] ?? '');
    $staff = InputProcessor::process_string($_POST['staff'] ?? '');
    

    $valid =  $userID['valid'] && $admin['valid'] && $price['valid'] && $staff['valid'];

    if($valid) {
      
      $args = ['userID' => $userID['value'] , 
              'staff' => $staff['value'] , 
              'admin' => $admin['value']
              ];

      $id = $controllers->roles()->getAll($args);

      if(!empty($id) && $id > 0) {
        redirect('role', ['id' => $id]);
      }
      else {
        $message = "Error adding role."; //Change
      }
    }
    else {
       $message =  "Please fix the following errors: ";
   }

} 

?>