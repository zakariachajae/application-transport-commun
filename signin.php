<?php
  
  require_once 'lib/db.php';
  
  $name = $email = $password = $confirm_password = '';
  $name_err = $email_err = $password_err = $confirm_password_err = '';

 
  if($_SERVER['REQUEST_METHOD'] === 'POST'){
    
    $name =  trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['2password']);

    
	
    if(empty($email)){
      $email_err = 'Merci de sasir votre email ';
    } else {
     
      $sql = 'SELECT name FROM users WHERE email = :email';

      if($stmt = $pdo->prepare($sql)){
      
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);

        
        if($stmt->execute()){
          
          if($stmt->rowCount() === 1){
            $email_err = 'Email exist déjà';
          }
        } else {
          die('Erreur !');
        }
      }
   
      unset($stmt);
    }
     
    if(empty($name)){
      $name_err = 'Merci de saisir le nom';
    }

    
    if(empty($password)){
      $password_err = 'Merci de saisir le mot de passe';
    } elseif(strlen($password) < 6){
      $password_err = 'Le mot de passe doit être supérieur à 6 caractères ';
    }

    
    if(empty($confirm_password)){
      $confirm_password_err = 'Merci de confirmer votre mot de passe';
    } else {
      if($password !== $confirm_password){
        $confirm_password_err = 'Les mots de passe ne correspondent pas';
      }
    } 

 

    if(empty($name_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)){
     
      // 
      $sql = 'INSERT INTO users (name, email, password) VALUES (:name, :email, :password)';

      if($stmt = $pdo->prepare($sql)){
        
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);

         
        if($stmt->execute()){
          
          header('location: login.php');
        } else {
          die('Erreur !');
        }
      }
      unset($stmt);
    }

    unset($pdo);
  }
?>
<?php include "header.php"; ?> 
<header class="major">
<h1> sign in </h1>
<section>
		<form method="POST">
			<div class="fields">							
            	<div class="field">
					<label for="name">name</label>
						<input type="text" name="name"  placeholder="name" />
						<?php if (!empty($name_err)){ ?>
							<div class="box">
								<?php echo $name_err ;?>
							</div>

						<?php }?>
				</div>
				<div class="field">
					<label for="email">email</label>
						<input type="text" name="email"  placeholder="enter email"/>
						<?php if (!empty($email_err)){ ?>
							<div class="box">
								<?php echo $email_err ;?>
							</div>

						<?php }?>
				</div>
            	<div class="field">
					<label for="password">password</label>
					<input type="password" name="password"  placeholder="enter password" />
					<?php if (!empty($password_err)){ ?>
							<div class="box">
								<?php echo $password_err ;?>
							</div>

						<?php }?>
				</div>
                <div class="field">
				<label for="2password">Confirmer password</label>
					<input type="password" name="2password"  placeholder="confirm password" />
					<?php if (!empty($confirm_password_err)){ ?>
							<div class="box">
								<?php echo $confirm_password_err ;?>
							</div>

						<?php }?>
						<br>
				</div>
				<div style="text-align:center; ">
        <input type="submit" value="Créer" class=" button" >
		</div>						
                                    

											
			</div>
										
			</div>
		
      </div>
                                        
			</form>
</section>
<?php include "footer.php"; ?>