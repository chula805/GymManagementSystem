<?php
session_start();
include 'includes/header.php';
include 'Database/db.php';

if (isset($_POST['join_membership']) && isset($_SESSION['user'])) {
  $user = $_SESSION['user'];
  $userId = $user['id'];
  $plan = $_POST['plan_name'];
  $dob = $_POST['dob'];
  $gender = $_POST['gender'];
  $signature = $_POST['signature'];
  $agreeTerms = isset($_POST['terms']) ? 1 : 0;
  $today = date('Y-m-d');

  if ($agreeTerms) {
    $stmt = $conn->prepare("INSERT INTO memberships (user_id, plan_name, dob, gender, signature, date, status) VALUES (?, ?, ?, ?, ?, ?, 'pending')");
    $stmt->execute([$userId, $plan, $dob, $gender, $signature, $today]);
    echo "<script>alert('Successfully joined the plan! Membership is pending approval.');</script>";
  } else {
    echo "<script>alert('You must accept the terms and conditions.');</script>";
  }
}

?>


<!-- Banner Section -->
<section class="section__container membership__banner">
  <div class="banner__content">
    <h4 data-aos="fade-right">FIND THE PERFECT PLAN FOR YOU</h4>
    <h1 data-aos="fade-left" class="outline-text">MEMBERSHIP PLANS</h1>
  </div>
</section>

<!-- Membership Plans -->
<section class="section__container membership__plans">
  <h2 class="section__header" data-aos="fade-down">Choose Your Plan</h2>
  <div class="plans__grid" data-aos="fade-up">

    <!-- Basic Plan -->
    <div class="plan__card">
      <h3>Basic</h3>
      <p class="price">LKR 2,500<span>/mo</span></p>
      <ul>
        <li>✅ Access to gym equipment</li>
        <li>❌ Personal trainer</li>
        <li>❌ Group classes</li>
        <li>✅ Locker room access</li>
      </ul>
      <?php if (isset($_SESSION['user_id'])): ?>
        <button class="btn" onclick="openMembershipModal('Basic')">Join Now</button>
      <?php endif; ?>
    </div>

    <!-- Standard Plan -->
    <div class="plan__card featured">
      <h3>Standard</h3>
      <p class="price">LKR 4,500<span>/mo</span></p>
      <ul>
        <li>✅ Access to gym equipment</li>
        <li>✅ Personal trainer (4 sessions/month)</li>
        <li>✅ Group classes</li>
        <li>✅ Locker room access</li>
      </ul>
      <?php if (isset($_SESSION['user_id'])): ?>
        <button class="btn" onclick="openMembershipModal('Standard')">Join Now</button>
      <?php endif; ?>
    </div>

    <!-- Premium Plan -->
    <div class="plan__card">
      <h3>Premium</h3>
      <p class="price">LKR 7,500<span>/mo</span></p>
      <ul>
        <li>✅ Unlimited access</li>
        <li>✅ Daily personal trainer</li>
        <li>✅ All group classes</li>
        <li>✅ Nutrition plan included</li>
      </ul>
      <?php if (isset($_SESSION['user_id'])): ?>
        <button class="btn" onclick="openMembershipModal('Premium')">Join Now</button>
      <?php endif; ?>
    </div>




  </div>
</section>

<!-- Membership Modal -->
<div id="membershipModal" class="modal" style="display:none;">
  <div class="modal-content">
    <span class="close-btn1" onclick="closeMembershipModal()">&times;</span>
    <h2 style="margin-bottom: 10px;">Join <span id="selectedPlan"></span> Plan</h2>
    <p id="planDetails" style="color: #555; font-size: 14px; margin-bottom: 20px;"></p>

    <form method="POST">
      <input type="hidden" name="plan_name" id="planInput">

      <label>Full Name</label>
      <input type="text" name="name" value="<?= $_SESSION['user']['name'] ?? '' ?>" readonly><br>

      <label>Email</label>
      <input type="email" name="email" value="<?= $_SESSION['user']['email'] ?? '' ?>" readonly><br>

      <label>Phone</label>
      <input type="text" name="phone" value="<?= $_SESSION['user']['phone'] ?? '' ?>" readonly><br>

      <label for="dob">Date of Birth</label>
      <input type="date" name="dob" required><br><br>

      <label for="gender">Gender</label>
      <select name="gender" required>
        <option value="">-- Select --</option>
        <option>Male</option>
        <option>Female</option>
        <option>Other</option>
      </select><br><br>


      <label>Signature (type your name as signature)</label>
      <input type="text" name="signature" placeholder="Enter your name" required><br><br>

      <input type="checkbox" name="terms" required> I agree to the terms and conditions<br><br>

      <button type="submit" name="join_membership" class="btn">Confirm Join</button>
    </form>
  </div>
</div>



<!-- Promotions -->
<section class="section__container membership__promotions">
  <h2 class="section__header" data-aos="fade-down">Special Promotions</h2>

  <div class="promotion__grid">
    <?php
    $stmt = $conn->prepare("SELECT * FROM promotions WHERE valid_until >= CURDATE() ORDER BY created_at DESC LIMIT 3");
    $stmt->execute();
    $promotions = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($promotions):
      foreach ($promotions as $promo): ?>
        <div class="promotion__card" data-aos="fade-up">
          <h4><?= htmlspecialchars($promo['title']) ?></h4>
          <p><?= htmlspecialchars($promo['description']) ?></p>
          <?php if (!empty($promo['image'])): ?>
            <img src="Admin/uploads/<?= $promo['image'] ?>" alt="Promotion Image"
              style="width: 100%; max-width: 300px; border-radius: 10px; margin-top: 10px;">
          <?php endif; ?>
          <p style="margin-top: 20px; font-size: 14px; color: #777;">Valid Until: 2025-08-15</p> <a href="#"
            class="btn">Grab Offer</a>
        </div>
      <?php endforeach;
    else: ?>
      <p style="color: #888;">No active promotions right now. Please check back later!</p>
    <?php endif; ?>
  </div>
</section>


<?php include 'includes/footer.php'; ?>