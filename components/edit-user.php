<?php 

require_once './inc/functions.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

    $fname = InputProcessor::process_string($_POST['fname'] ?? '');
    $sname = InputProcessor::process_string($_POST['sname'] ?? '');
    $email = InputProcessor::process_email($_POST['email'] ?? '');
    $password = InputProcessor::process_password(($_POST['password'] ?? ''),( $_POST['password-v'] ?? ''));

    $valid =  $fname['valid'] && $sname['valid'] && $password['valid'] && $email['valid'];

    if($valid) {

      $args = ['firstname' => $fname['value'] , 
              'lastname' => $sname['value'] , 
              'password' => $password['value'] ,
              'email' =>  $email['value'] ];

      $result = $controllers->members()->update($args);

     
      if(!empty($id) && $id > 0) {
        redirect('role', ['id' => $id]);
      }
      else {
        $message = "Error editing user."; //Change
      }
    }
    else {
       $message =  "Please fix the following errors: ";
   }

} 


?>

  <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
    <section class="vh-100">
      <div class="container py-5 h-75">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card shadow-2-strong" style="border-radius: 1rem;">
              <div class="card-body p-5 text-center">
                <div class="form-outline mb-4">
                  <input type="text" id="fname" name="fname" class="form-control form-control-lg" placeholder="Firstname" required value="<?= ?>"/>
                  <span class="text-danger"><?= $fname['error'] ?? '' ?></span>
                </div>
                <div class="form-outline mb-4">
                  <input type="text" id="sname" name="sname" class="form-control form-control-lg" placeholder="Surname" required value="<?=  ?>"/>
                  <span class="text-danger"><?= $sname['error'] ?? '' ?></span>
                </div>
                <div class="form-outline mb-4">
                  <input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Email" required value="<?=  ?>"/>
                  <span class="text-danger"><?= $email['error'] ?? '' ?></span>
                </div>
                <?= isset($_GET['errmsg']) ? $message = $_GET['errmsg'] : '' ?>
                <?= $message ? alert($message, 'danger') : '' ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </form>
