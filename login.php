<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>LOG IN</title>
  <style>
    body, h1, p {
      margin: 0;
      padding: 0;
    }

    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-color: #f0f0f0;
      font-family: Arial, sans-serif;
    }

    .con {
      background-color: white;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      width: 300px;
    }

    h1 {
      text-align: center;
      margin-bottom: 20px;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }

    input[type="submit"] {
      background-color: #4CAF50;
      color: white;
      border: none;
      padding: 10px;
      border-radius: 4px;
      cursor: pointer;
      width: 100%;
      font-size: 16px;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }

    p {
      text-align: center;
      font-size: 12px;
    }

    a {
      color: #4CAF50;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }

    /* Style for show password checkbox container */
    .show-pass-container {
      font-size: 14px;
      margin-top: 5px;
      user-select: none;
    }

    #error-message {
      color: red;
      font-size: 10px;
      height: 14px; /* Reserve space to prevent layout shifts */
      margin-top: 0;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>
  <div class="con">
    <h1>LOG IN</h1>
    <form action="" method="post" id="loginForm">
      <input type="text" name="uname" placeholder="Username" required />
      <input type="password" name="pass" placeholder="Password" id="password" required />
      <div class="show-pass-container">
        <input type="checkbox" id="showPassword" />
        <label for="showPassword">Show Password</label>
      </div>
      <p id="error-message"></p>
      <input type="submit" name="loginbtn" value="Submit" />
    </form>
    <br />
    <p style="font-size: 10px;">
      Don't have an account? <a href="register.php">Sign Up</a>
    </p>
  </div>

  <script>
    const showPasswordCheckbox = document.getElementById('showPassword');
    const passwordInput = document.getElementById('password');

    showPasswordCheckbox.addEventListener('change', function() {
      if (this.checked) {
        passwordInput.type = 'text';
      } else {
        passwordInput.type = 'password';
      }
    });
  </script>

  <?php
      include "connection.php";

      if(isset($_POST['loginbtn'])){
          $username = $_POST['uname'];
          $password = $_POST['pass'];

          if($username!=""&&$password!=""){

              $sql = "SELECT * FROM admins WHERE uname = '$username'";
              $result = mysqli_query($connection, $sql);

              if(mysqli_num_rows($result)==1){
                  $user = mysqli_fetch_assoc($result);

                  if($password==$user['password']){
                      echo "<script>alert('Successful log in');</script>";
                      header("location: index.php");
                  }
                  else{
                      echo "<script>document.getElementById('error-message').innerHTML = 'Invalid password';</script>";
                  }
              }
              else{
                  echo "<script>alert('User not found');</script>";
              }
          }
          else{
              echo "<script>document.getElementById('error-message').innerHTML = 'Input fields should not be empty';</script>";
          }
      }
  ?>
</body>
</html>

