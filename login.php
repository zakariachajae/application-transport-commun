<?php 
  
  require_once 'lib/db.php';
  
  
  $email = $password = '';
  $email_err = $password_err = '';
  $message_error = false;
  
  if($_SERVER['REQUEST_METHOD'] === 'POST'){
  
    
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    
    if(empty($email)){
      $email_err = 'Merci de saisir votre email';
    }

    
    if(empty($password)){
      $password_err = 'Merci de saisir votre mot de passe';
    }

    if(empty($email_err) && empty($password_err)){
      
      $sql = 'SELECT id, name, email, password, rank FROM users WHERE email = :email AND password = :password';
      if($stmt = $pdo->prepare($sql)){
        
        // $stmt->bindParam(':email', $email, :password,$password , PDO::PARAM_STR);
        $stmt->execute(['email' => $email, 'password' => $password]);
        $login = $stmt->fetch();
        //var_dump($login['name']);
        if($login != false){
          session_start();
          $_SESSION['email'] = $email;
          $_SESSION['name'] = $login['name'];
          $_SESSION['user_id'] = $login['id'];
          $_SESSION['rank'] = $login['rank'];

          header('location: index.php');
        } else {
          $message_error ='<div class="alert alert-danger" role="alert"> Login Error Please Check Your Email Or Password! </div>';
        }
      }
      
      unset($stmt);
    }

    
    unset($pdo);
  }
  ?>
<?php include "header.php"; ?> 
<header class="major">
<h1> login to account </h1>
<section>
<center><?php if($message_error){ echo $message_error; } ?> </center>
		<form method="post">
			<div class="fields">
			<div class="field">
			<label for="email">email</label>
											
				<input type="text" name="email" id="email" />
				<?php if (!empty($email_err)){ ?>
							<div class="box">
								<?php echo $email_err ;?>
							</div>

						<?php }?>
			</div>
            <div class="field">
			<label for="password">password</label>
				<input type="password" name="password" id="password" />
				<?php if (!empty($password_err)){ ?>
							<div class="box">
								<?php echo $password_err ;?>
							</div>

						<?php }?>
			</div>
			</div>
			<button style="text-align:center;"> log in </button>
        </form>
	
</section>
<?php include "footer.php"; ?>