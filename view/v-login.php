    <form name="login" method="POST" action="chat.php" onsubmit="return loginValidation(this)">
      <!-- Email input -->
      <div class="form-outline mb-4">
      <label class="form-label" for="loginName">Username:</label>
      <input type="text" id="loginName" name="loginName" class="form-control" size="30" maxlength="20" minlength="5" required>
      <small>
        <?php 
          if ((isset($_SESSION['log-message']) && !empty($_SESSION['log-message']))){
            if($_SESSION['log-message'] == false){
              echo "Uncorrect Login";
            }
          }
        ?>
      </small>
      </div>

      <!-- Password input -->
      <div class="form-outline mb-4">
      <label class="form-label" for="loginPassword">Password:</label>
      <input type="password" id="loginPassword" name="loginPassword" class="form-control" size="30" maxlength="20" minlength="5" required>
      <small>
        <?php 
          if ((isset($_SESSION['log-message']) && !empty($_SESSION['log-message']))){
            if($_SESSION['log-message'] == false){
              echo "Uncorrect Password";
            }
          }
        ?>
      </small>
      </div>

     
      <button type="submit" class="btn btn-primary btn-block mb-4">Sign in</button>
      <!--
      <div class="text-center">
        <p>Not a member? <span id="register-ajax">Register</span></p>
      </div>
      -->
    </form>
 