<?php
session_start();

include 'includes/header.php'; ?>

<?php

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: 0");

// session_start();
include 'Database/db.php';


if (isset($_SESSION['user'])) {
  $type = $_SESSION['user']['user_type'];
  switch ($type) {
    case 'admin':
      header("Location: Admin/index.php");
      exit;
    // case 'staff':
    //   header("Location: Staff/index.php");
    //   exit;
    default:
      header("Location: index.php");
      exit;
  }
}

// Handle Login
if (isset($_POST['login'])) {
  $email = htmlspecialchars(trim($_POST['email']));
  $password = $_POST['password'];
  $user_type = $_POST['user_type'];

  $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND user_type = ?");
  $stmt->execute([$email, $user_type]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($user && password_verify($password, $user['password'])) {
$_SESSION['user'] = $user;
$_SESSION['user_name'] = $user['name'];
$_SESSION['user_id'] = $user['id']; // ✅ Now globally usable

    // Redirect based on user type
    switch ($user_type) {
      case 'admin':
        header("Location: Admin/index.php");
        break;
      // case 'staff':
      //   header("Location: Staff/index.php");
      //   break;
      default:
        header("Location: index.php");
    }
    exit;
  } else {
    echo "<script>alert('Invalid credentials or user type');</script>";
  }
}

// Handle Registration
if (isset($_POST['register'])) {
  $name = htmlspecialchars(trim($_POST['name']));
  $email = htmlspecialchars(trim($_POST['email']));
  $phone = htmlspecialchars(trim($_POST['phone'])); // NEW LINE for phone
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $user_type = 'customer'; // For safety, force it

  $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
  $stmt->execute([$email]);
  if ($stmt->rowCount() > 0) {
    echo "<script>alert('Email already registered');</script>";
  } else {
    $stmt = $conn->prepare("INSERT INTO users (name, email, phone, password, user_type) VALUES (?, ?, ?, ?, ?)");
    if ($stmt->execute([$name, $email, $phone, $password, $user_type])) {
      echo "<script>alert('Registered successfully. You can now log in!');</script>";
    } else {
      echo "<script>alert('Error during registration');</script>";
    }
  }
}
?>



<section class="section__container auth__section">
  <div class="auth__container">
    <div class="auth__tabs">
      <input type="radio" name="tab" id="login" checked>
      <input type="radio" name="tab" id="register">
      <label for="login" class="tab tab__login">Sign In</label>
      <label for="register" class="tab tab__register">Sign Up</label>

      <div class="form__container">
        <!-- Sign In Form -->
        <!-- Sign In Form -->
        <form class="form form__login" method="POST" autocomplete="off">
          <h2>Welcome Back</h2>
          <input type="email" name="email" placeholder="Email" required>
          <input type="password" name="password" placeholder="Password" required>

          <select name="user_type" required>
            <option value="">Select User Type</option>
            <option value="customer">Customer</option>
            <!-- <option value="staff">Staff</option> -->
            <option value="admin">Admin</option>
          </select>

          <button type="submit" class="btn" name="login">Sign In</button>
        </form>


        <!-- Sign Up Form -->
        <form class="form form__register" method="POST">
          <h2>Create Account</h2>
          <input type="text" name="name" placeholder="Full Name" required>
          <input type="email" name="email" placeholder="Email" required>
          <input type="tel" name="phone" placeholder="Phone Number" required pattern="[0-9]{10}">
          <input type="password" name="password" placeholder="Password" required>
          <input type="hidden" name="user_type" value="customer">
          <button type="submit" class="btn" name="register">Sign Up</button>
        </form>

      </div>
    </div>
  </div>
</section>


<?php include 'includes/footer.php'; ?>