<?php
include 'includes/header.php';
include 'Database/db.php';

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

// Handle message submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user'])) {
  $user_id = $_SESSION['user']['id'];
  $name = htmlspecialchars(trim($_POST['name']));
  $email = htmlspecialchars(trim($_POST['email']));
  $subject = htmlspecialchars(trim($_POST['subject']));
  $message = htmlspecialchars(trim($_POST['message']));

  if (!empty($message)) {
    $stmt = $conn->prepare("INSERT INTO messages (user_id, name, email, subject, message) VALUES (?, ?, ?, ?, ?)");
    if ($stmt->execute([$user_id, $name, $email, $subject, $message])) {
      echo "<script>alert('Your message has been sent successfully!');</script>";
    } else {
      echo "<script>alert('Failed to send message. Please try again later.');</script>";
    }
  } else {
    echo "<script>alert('Message field is required.');</script>";
  }
}
?>

<section class="section__container contact__section">
  <div class="contact__grid">

    <!-- Google Map -->
    <div class="contact__map" data-aos="fade-right">
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3955.6742643155154!2d80.35374117412362!3d7.486157211795959!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae33a82f4dcf079%3A0x2f0f6d25ff84b662!2sKurunegala!5e0!3m2!1sen!2slk!4v1718610000000"
        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>

    <!-- Contact Form -->
    <div class="contact__form" data-aos="fade-left">
      <h2 data-aos="fade-up">Contact Us</h2>
      <p data-aos="fade-up">Feel free to reach out with any questions or feedback.</p>

      <?php if (isset($_SESSION['user'])): ?>
        <form action="#" method="POST">
          <input type="text" name="name" placeholder="Your Name" required />
          <input type="email" name="email" placeholder="Your Email" required />
          <input type="text" name="subject" placeholder="Subject" />
          <textarea name="message" rows="5" placeholder="Your Message" required></textarea>
          <button type="submit" class="btn">Send Message</button>
        </form>
      <?php else: ?>
        <p style="margin-top: 1rem; color: #c6091f;">You must <a href="login.php"
            style="color: #fff; text-decoration: underline;">login</a> to send a message.</p>
      <?php endif; ?>
    </div>

  </div>
</section>

<section class="section__container contact__info__section" >
  <div class="contact__info__grid">

    <div class="contact__info__card" data-aos="flip-left">
      <span><i class="ri-phone-fill"></i></span>
      <div>
        <h4>Phone</h4>
        <p>+94 71 234 5678</p>
      </div>
    </div>

    <div class="contact__info__card" data-aos="flip-left">
      <span><i class="ri-mail-fill"></i></span>
      <div>
        <h4>Email</h4>
        <p>info@fitzone.lk</p>
      </div>
    </div>

    <div class="contact__info__card" data-aos="flip-right">
      <span><i class="ri-global-line"></i></span>
      <div>
        <h4>Website</h4>
        <p>www.fitzone.lk</p>
      </div>
    </div>

    <div class="contact__info__card" data-aos="flip-right">
      <span><i class="ri-map-pin-2-fill"></i></span>
      <div>
        <h4>Address</h4>
        <p>Kurunegala, Sri Lanka</p>
      </div>
    </div>

  </div>
</section>


<?php include 'includes/footer.php'; ?>