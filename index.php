<?php
include 'includes/header.php';
include 'Database/db.php';

?>

<header class="section__container header__container">
  <div class="header__content">
    <span class="bg__blur"></span>
    <span class="bg__blur header__blur"></span>
    <h4 data-aos="fade-right">THE ULTIMATE FITNESS HUB</h4>
    <h1 data-aos="fade-right"><span>STRONG </span> IS THE NEW SHAPE</h1>
    <p data-aos="fade-right">
      Unlock your strength and start your journey to a fitter, more
      confident you. Join Shape Your Body Today and see the transformation
      begin!
    </p>
    <button data-aos="fade-right" class="btn"><a href="membership.php">Get Started</a></button>
  </div>
  <div class="header__image" >
    <img src="assets/header.png" alt="header" data-aos="fade-left"/>
  </div>
</header>

<section class="section__container class__container">
  <div class="class__image">
    <span class="bg__blur"></span>
    <img src="assets/class-3.jpg" alt="class" class="class__img-1" data-aos="fade-right"/>
    <img src="assets/class-4.jpg" alt="class" class="class__img-2" data-aos="fade-right"/>
  </div>
  <div class="class__content">
    <h2 class="section__header" data-aos="fade-up">
      ABOUT <span>FITZONE FITNESS CENTER</span>
    </h2>
    <p data-aos="fade-up">
      Welcome to Fitzone Fitness Center – Kurunegala’s go-to destination for
      health, strength, and transformation. We offer modern equipment,
      expert trainers, and a motivating environment to help you achieve your
      fitness goals. Join us today and take the first step toward a
      healthier lifestyle!
    </p>
    <button data-aos="fade-up" class="btn"><a href="about.php">Read More</a></button>
  </div>
</section>

<section class="section__container text-slider">
  <div class="slider-track">
    <span>FITZONE FITNESS</span>
    <span>FITZONE FITNESS</span>
    <span>FITZONE FITNESS</span>
  </div>
</section>

<section class="section__container explore__container">
  <div class="explore__header">
    <h2 class="section__header" data-aos="fade-up">EXPLORE OUR PROGRAM</h2>
    <div class="explore__nav">
      <span><i class="ri-arrow-left-line"></i></span>
      <span><i class="ri-arrow-right-line"></i></span>
    </div>
  </div>
  <div class="explore__slider-wrapper">
    <div class="explore__grid">
      <div class="explore__card">
        <span><i class="ri-user-star-fill"></i></span>
        <h4>Personal Training</h4>
        <p>
          One-on-one fitness coaching tailored to your unique goals, body
          type, and progress speed.
        </p>
        <a href="#">Join Now <i class="ri-arrow-right-line"></i></a>
      </div>
      <div class="explore__card">
        <span><i class="ri-bike-line"></i></span>
        <h4>Cardio Burn</h4>
        <p>
          Raise your heart rate and energy levels with cycling, treadmill,
          and endurance cardio routines.
        </p>
        <a href="#">Join Now <i class="ri-arrow-right-line"></i></a>
      </div>
      <div class="explore__card">
        <span><i class="ri-hand-coin-fill"></i></span>
        <h4>Boxing & Combat</h4>
        <p>
          Boost endurance and coordination with high-energy boxing,
          kickboxing, and combat training.
        </p>
        <a href="#">Join Now <i class="ri-arrow-right-line"></i></a>
      </div>
      <div class="explore__card">
        <span><i class="ri-brain-line"></i></span>
        <h4>Yoga & Flexibility</h4>
        <p>
          Enhance your flexibility, posture, and peace of mind with
          expert-led yoga sessions.
        </p>
        <a href="#">Join Now <i class="ri-arrow-right-line"></i></a>
      </div>
      <div class="explore__card">
        <span><i class="ri-boxing-fill"></i></span>
        <h4>Strength</h4>
        <p>
          Embrace the essence of strength as we delve into its various
          dimensions physical, mental, and emotional.
        </p>
        <a href="#">Join Now <i class="ri-arrow-right-line"></i></a>
      </div>
      <div class="explore__card">
        <span><i class="ri-heart-pulse-fill"></i></span>
        <h4>Physical Fitness</h4>
        <p>
          It encompasses a range of activities that improve health,
          strength, flexibility, and overall well-being.
        </p>
        <a href="#">Join Now <i class="ri-arrow-right-line"></i></a>
      </div>
      <div class="explore__card">
        <span><i class="ri-run-line"></i></span>
        <h4>Fat Lose</h4>
        <p>
          Through a combination of workout routines and expert guidance,
          we'll empower you to reach your goals.
        </p>
        <a href="#">Join Now <i class="ri-arrow-right-line"></i></a>
      </div>
      <div class="explore__card">
        <span><i class="ri-shopping-basket-fill"></i></span>
        <h4>Weight Gain</h4>
        <p>
          Designed for individuals, our program offers an effective approach
          to gaining weight in a sustainable manner.
        </p>
        <a href="#">Join Now <i class="ri-arrow-right-line"></i></a>
      </div>
    </div>
  </div>
</section>

<section class="section__container join__container">
  <h2 class="section__header" data-aos="fade-up">WHY JOIN US ?</h2>
  <p class="section__subheader" data-aos="fade-up">
    Join a vibrant community where encouragement and friendship thrive,
    helping you stay inspired and reach your fitness goals together.
  </p>
  <div class="join__image" data-aos="zoom-in">
    <img src="assets/join.jpg" alt="Join" />
    <div class="play-button" id="playButton">
      <i class="ri-play-fill"></i>
    </div>
  </div>
</section>

<div class="video-modal" id="videoModal">
  <div class="video-content">
    <span class="close-btn" id="closeModal">&times;</span>
    <iframe src="https://www.youtube.com/embed/t5Put_6aziE?si=BHLZXPWUpc7pr4lQ" frameborder="0"
      allowfullscreen></iframe>
  </div>
</div>

<section class="section__container class__container">
  <div class="class__content">
    <h2 class="section__header" data-aos="fade-up">
      UNLEASH YOUR POTENTIAL WITH THESE CLASSES
    </h2>
    <p data-aos="fade-up">
      Discover a variety of expert-led fitness classes designed to match
      your goals — whether you're aiming to build strength, boost endurance,
      or simply stay active and healthy
    </p>
    <button data-aos="fade-up" class="btn"><a href="program.php">Book A Class</a></button>
  </div>
  <div class="class__image">
    <span class="bg__blur"></span>
    <img src="assets/class-1.jpg" alt="class" class="class__img-1" data-aos="fade-left"/>
    <img src="assets/class-2.jpg" alt="class" class="class__img-2" data-aos="fade-left"/>
  </div>
</section>

<section class="section__container equipment__container">
  <h2 class="section__header" data-aos="fade-up">OUR GYM EQUIPMENT</h2>

  <div class="swiper equipmentSwiper" data-aos="fade-up">
    <div class="swiper-wrapper">
      <?php
      $stmt = $conn->prepare("SELECT name, image FROM equipments ORDER BY created_at DESC");
      $stmt->execute();
      $equipments = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach ($equipments as $eq): ?>
        <div class="swiper-slide">
          <div class="equipment__card">
            <img src="Admin/uploads/<?= htmlspecialchars($eq['image']) ?>" alt="<?= htmlspecialchars($eq['name']) ?>">
            <h4 style="margin-bottom: 20px;"><?= htmlspecialchars($eq['name']) ?></h4>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>



<section class="section__container key-info">
  <div class="info-box" data-aos="flip-left">
    <i class="ri-time-line"></i>
    <h4>Open Hours</h4>
    <p>Mon – Sun: 5.00am – 10.00pm</p>
  </div>
  <div class="info-box" data-aos="flip-left">
    <i class="ri-map-pin-line"></i>
    <h4>Location</h4>
    <p>Kurunegala City Center, Sri Lanka</p>
  </div>
  <div class="info-box" data-aos="flip-right">
    <i class="ri-phone-line"></i>
    <h4>Contact</h4>
    <p>+94 77 123 4567</p>
  </div>
  <div class="info-box" data-aos="flip-right">
    <i class="ri-mail-line"></i>
    <h4>Email</h4>
    <p>info@fitzone.lk</p>
  </div>
</section>

<?php
include 'includes/footer.php';
?>