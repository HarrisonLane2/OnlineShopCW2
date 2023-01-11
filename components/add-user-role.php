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

      $id = $controllers->roles()->create($args);

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

<form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" enctype="multipart/form-data">
    <section class="vh-100">
      <div class="container py-5 h-75">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card shadow-2-strong" style="border-radius: 1rem;">
              <div class="card-body p-5 text-center">
    
                <h3 class="mb-2">Add user Roles</h3>
                <div class="form-outline mb-4">
                  <input type="text" id="userID" name="UserID" class="form-control form-control-lg" placeholder="UserID " required value="<?= htmlspecialchars($userID['value'] ?? '') ?>"/>
                  <span class="text-danger"><?= $userID['error'] ?? '' ?></span>
                </div>
                
                <div class="form-outline mb-4">
                  <input type="text" id="admin" name="admin" class="form-control form-control-lg" placeholder="Please enter a 1 for yes and a 0 for no" required value="<?= htmlspecialchars($admin['value'] ?? '') ?>"/>
                  <span class="text-danger"><?= $admin['error'] ?? '' ?></span>
                </div>
    
    
                <div class="form-outline mb-4">
                  <input type="number" id="staff" name="staff" class="form-control form-control-lg" placeholder="Please enter a 1 for yes and a 0 for no" required value="<?= htmlspecialchars($staff['value'] ?? '') ?>"/>
                  <span class="text-danger"><?= $staff['error'] ?? '' ?></span>
                </div>
    
                <button class="btn btn-primary btn-lg w-100 mb-4" type="submit">Add Product</button>
               
                <?= isset($_GET['errmsg']) ? $message = $_GET['errmsg'] : '' ?>
                <?= $message ? alert($message, 'danger') : '' ?>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </form>