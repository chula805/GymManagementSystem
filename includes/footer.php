<!-- Floating BMI Calculator Icon -->
<div id="bmi-icon" class="bmi-icon">
  <i class="ri-calculator-line"></i>
</div>

<!-- BMI Calculator Popup -->
<div id="bmi-popup" class="bmi-popup">
  <div class="bmi-content">
    <span class="close-bmi" id="closeBmi">&times;</span>
    <h2>BMI Calculator</h2>
    <form id="bmiForm">
      <label for="height">Height (cm):</label>
      <input type="number" id="height" required>

      <label for="weight">Weight (kg):</label>
      <input type="number" id="weight" required>

      <button type="submit" class="btn">Calculate</button>
    </form>
    <div id="bmiResult"></div>
  </div>
</div>



<footer class="section__container footer__container">
    <div class="footer__col">
      <div class="footer__logo"><img src="assets/logo.png" alt="logo" /></div>
      <p>
        Take the first step towards a healthier, stronger you with our
        unbeatable pricing plans. Let's sweat, achieve, and conquer together!
      </p>
      <div class="footer__socials">
        <a href="#"><i class="ri-facebook-fill"></i></a>
        <a href="#"><i class="ri-instagram-line"></i></a>
        <a href="#"><i class="ri-twitter-fill"></i></a>
      </div>
    </div>
    <div class="footer__col">
      <h4>Company</h4>
      <a href="#">Business</a>
      <a href="#">Franchise</a>
      <a href="#">Partnership</a>
      <a href="#">Network</a>
    </div>
    <div class="footer__col">
      <h4>About Us</h4>
      <a href="#">Blogs</a>
      <a href="#">Security</a>
      <a href="#">Careers</a>
    </div>
    <div class="footer__col">
      <h4>Contact</h4>
      <a href="#">Contact Us</a>
      <a href="#">Privacy Policy</a>
      <a href="#">Terms & Conditions</a>
      <a href="#">BMI Calculator</a>
    </div>
  </footer>
  <div class="footer__bar">Copyright © 2025. All rights reserved.</div>

  <!-- AOS Library JS -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init({
    duration: 1000, // Animation duration
    once: true      // Whether animation should happen only once
  });
</script>
<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>


</body>
<script src="script.js"></script>

</html>