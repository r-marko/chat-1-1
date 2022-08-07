    <form name="register" method="POST" action="chat.php" onsubmit="return registerValidation(this)">
      <!-- Email input -->
      <div class="form-outline mb-4">
      <label class="form-label" for="registerName">Username:</label>
      <input type="text" id="registerName" name="registerName" class="form-control" size="30" maxlength="20" minlength="5" pattern="[A-Za-z].{5,}" placeholder="Only alphabet characters, at least 5" required>
      </div>

      <!-- Password input -->
      <div class="form-outline mb-4">
      <label class="form-label" for="registerPassword">Password:</label>
      <input type="password" id="registerPassword" name="registerPassword" class="form-control" size="30" maxlength="20" minlength="5" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,}" required>
      <small>*Must have at least one digit, one uppercase, and one lowercase letter, at least 5 characters.</small>
      </div>

      <div class="form-outline mb-4">
      <label class="form-label" for="repeatPassword">Repeat password:</label>
      <input type="password" id="repeatPassword" name="repeatPassword" class="form-control"  size="30" maxlength="20" minlength="5" required>
      </div>

     
      <button type="submit" class="btn btn-primary btn-block mb-4">Register</button>
      <!--
      <div class="text-center">
        <p>Already have an account?<span id="register-ajax">Sign in</span></p>
      </div>
      -->
    </form>