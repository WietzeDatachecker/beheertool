<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" type="text/css" href="css/login.css">
 <head>
   <title>Inloggen DataCheker beheer</title>
 </head>
 <body>
  <div class="container">
    <div class="content">
      <div class="row">
        <div class="login-form">
         <h1>Inloggen</h1>
         <?php echo validation_errors(); ?>
         <?php echo form_open('verifylogin'); ?>
           

          <fieldset>
              <div class="clearfix">
                <input type="text" placeholder="Gebruikersnaam" id="username" name="username">
              </div>
              <div class="clearfix">
                <input type="password" placeholder="Wachtwoord" d="passowrd" name="password">
              </div>
              <button class="btn btn-primary" type="submit">Inloggen</button>
          </fieldset>
  
         </form>
        </div>
      </div>
    </div>
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
 </body>
</html>
