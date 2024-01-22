<?php 
  session_start();
  if(isset($_SESSION['unique_id'])){
    header("location: users.php");
  }
?>

<?php include_once "header.php"; ?>
<body>
  <div class="wrapper">
    <section class="form login">
      <header>Chat WebApp Login <i class="fa fa-solid fa-user-unlock"></i></header>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>

        <div class="field input">
          <label>Email Address</label>
          <input type="text" name="email" placeholder="Enter your email" required>
        </div>

        <div class="field input">
          <label>Password</label>
          <input type="password" name="password" placeholder="Enter your password" required>
          <i class="fas fa-eye"></i>
        </div>

        <div class="field button">
          <input type="submit" name="submit" value="Continue to Chat">
        </div>
        
      </form>
      <div class="link">Don't have an account? <a href="index.php">Signup now</a></div>
    </section>
  </div>
  
  <script src="javascript/functions.js"></script>
  <script src="javascript/login.js"></script>

</body>
</html>
