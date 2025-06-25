<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.4.0/fonts/remixicon.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="styles.css" />
  <link rel="icon" type="image/x-icon" href="assets/favicon.png">
  <!-- AOS Library CSS -->
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

  <!-- Swiper CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

  <title>FitZone Fitness</title>
</head>

<body>
  <nav>
    <div class="nav__logo">
      <a href="index.php"><img src="assets/logo.png" alt="logo" /></a>
    </div>

    <ul class="nav__links">
      <li class="link"><a href="index.php"
          class="<?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '' ?>">Home</a></li>
      <li class="link"><a href="about.php"
          class="<?= basename($_SERVER['PHP_SELF']) == 'about.php' ? 'active' : '' ?>">About</a></li>
      <li class="link"><a href="program.php"
          class="<?= basename($_SERVER['PHP_SELF']) == 'program.php' ? 'active' : '' ?>">Program</a></li>
      <li class="link"><a href="membership.php"
          class="<?= basename($_SERVER['PHP_SELF']) == 'membership.php' ? 'active' : '' ?>">Membership</a></li>
      <li class="link"><a href="contact.php"
          class="<?= basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'active' : '' ?>">Contact</a></li>
    </ul>

    <div class="menu__icon">
      <i class="ri-menu-line open-icon"></i>
      <i class="ri-close-line close-icon"></i>
    </div>

    <!-- ✅ Right-side user info -->
    <?php if (isset($_SESSION['user'])): ?>
      <div class="nav__user dropdown">
        <div class="user__trigger">
          <i class="ri-user-3-line"></i>
          <span><?= htmlspecialchars($_SESSION['user']['name']) ?></span>
          <i class="ri-arrow-down-s-line"></i>
        </div>
        <ul class="dropdown__menu">
          <li><a href="profile.php"><i class="ri-user-line"></i> My Dashboard</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </div>
    <?php else: ?>
      <button class="btn"><a href="login.php">Login Now</a></button>
    <?php endif; ?>

  </nav>