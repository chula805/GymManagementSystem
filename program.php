<?php
session_start(); // Start session only once at the top

include 'includes/header.php';
include 'Database/db.php';

// Debug (optional)
echo "<!-- Debug: " . (isset($_SESSION['user_id']) ? 'Logged in as ' . $_SESSION['user_id'] : 'Not logged in') . " -->";

// Handle program join form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['join_program'])) {
  if (!isset($_SESSION['user']['id'])) {
    echo "<script>alert('Please log in to join a program.');</script>";
  } else {
    $userId = $_SESSION['user']['id'];
    $programId = intval($_POST['program_id']);
    $goals = trim($_POST['goals']);

    // Insert enrollment
    $stmt = $conn->prepare("INSERT INTO program_enrollments (user_id, program_id, goals) VALUES (?, ?, ?)");
    $stmt->execute([$userId, $programId, $goals]);

    echo "<script>alert('Successfully enrolled in the program.'); window.location.href = window.location.href;</script>";
    exit();
  }
}

?>

<!-- Banner -->
<section class="section__container program__banner">
  <div class="banner__content">
    <h4 data-aos="fade-up">JOIN WITH OUR PROGRAMS</h4>
    <h1 data-aos="fade-up" class="outline-text">OUR <br>PROGRAMS</h1>
  </div>
</section>

<!-- Filter + Program List -->
<section class="section__container program__page" data-aos="fade-up">
  <aside class="program__filters">
    <h3>Filter Programs</h3>
    <form method="GET">
      <div class="filter__group">
        <label for="programName">Program Name</label>
        <input type="text" id="programName" name="name" placeholder="Search by name..."
          value="<?= isset($_GET['name']) ? htmlspecialchars($_GET['name']) : '' ?>">
      </div>
      <div class="filter__group">
        <label for="category">Category</label>
        <select id="category" name="category">
          <option value="">All</option>
          <option value="Personal Training" <?= (isset($_GET['category']) && $_GET['category'] == 'Personal Training') ? 'selected' : '' ?>>Personal Training</option>
          <option value="Cardio Burn" <?= (isset($_GET['category']) && $_GET['category'] == 'Cardio Burn') ? 'selected' : '' ?>>Cardio Burn</option>
          <option value="Boxing & Combat" <?= (isset($_GET['category']) && $_GET['category'] == 'Boxing & Combat') ? 'selected' : '' ?>>Boxing & Combat</option>
          <option value="Yoga & Flexibility" <?= (isset($_GET['category']) && $_GET['category'] == 'Yoga & Flexibility') ? 'selected' : '' ?>>Yoga & Flexibility</option>
          <option value="Strength" <?= (isset($_GET['category']) && $_GET['category'] == 'Strength') ? 'selected' : '' ?>>Strength</option>
          <option value="Physical Fitness" <?= (isset($_GET['category']) && $_GET['category'] == 'Physical Fitness') ? 'selected' : '' ?>>Physical Fitness</option>
          <option value="Fat Loss" <?= (isset($_GET['category']) && $_GET['category'] == 'Fat Loss') ? 'selected' : '' ?>>Fat Loss</option>
          <option value="Weight Gain" <?= (isset($_GET['category']) && $_GET['category'] == 'Weight Gain') ? 'selected' : '' ?>>Weight Gain</option>
        </select>
      </div>
      <button type="submit" class="btn filter__btn">Apply Filters</button>
      <a href="program.php" class="btn" style="margin-top: 10px; background-color: #ccc; color: #000;">Reset</a>
    </form>
  </aside>

  <main class="program__list">
    <?php
    $sql = "SELECT * FROM programs WHERE 1=1";
    $params = [];

    if (!empty($_GET['name'])) {
      $sql .= " AND title LIKE ?";
      $params[] = "%" . $_GET['name'] . "%";
    }

    if (!empty($_GET['category'])) {
      $sql .= " AND category = ?";
      $params[] = $_GET['category'];
    }

    $sql .= " ORDER BY id ASC";
    $stmt = $conn->prepare($sql);
    $stmt->execute($params);
    $programs = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($programs):
      foreach ($programs as $program):
    ?>
        <div class="program__card">
          <img src="Admin/uploads/<?= htmlspecialchars($program['image']) ?>" alt="<?= htmlspecialchars($program['title']) ?>" />
          <div class="program__info">
            <h4><?= htmlspecialchars($program['title']) ?></h4>
            <p><?= htmlspecialchars($program['description']) ?></p>
            <?php if (isset($_SESSION['user_id'])): ?>
              <button type="button" class="btn" onclick="openJoinModal(<?= $program['id'] ?>, '<?= htmlspecialchars($program['title']) ?>')">Join Program</button>
            <?php else: ?>
              <button type="button" class="btn" onclick="alert('Please log in to join this program.')">Join Program</button>
            <?php endif; ?>
          </div>
        </div>
    <?php
      endforeach;
    else:
      echo "<p style='color:gray;'>No programs match your filters.</p>";
    endif;
    ?>
  </main>
</section>

<!-- Program Join Modal -->
<!-- Program Join Modal -->
<div id="joinProgramModal" class="modal" style="display:none;">
  <div class="modal-content">
    <span class="close-btn1" onclick="closeJoinModal()">&times;</span>
    <h2>Join Program</h2>
    <form method="POST" id="joinProgramForm">
      <input type="hidden" name="program_id" id="programIdInput">
      <p>You're joining: <strong id="programDisplayName"></strong></p>

      <label>Full Name</label><br>
      <input type="text" name="name" value="<?= htmlspecialchars($_SESSION['user']['name'] ?? '') ?>" readonly><br><br>

      <label>Email</label><br>
      <input type="email" name="email" value="<?= htmlspecialchars($_SESSION['user']['email'] ?? '') ?>" readonly><br><br>

      <label>Phone</label><br>
      <input type="text" name="phone" value="<?= htmlspecialchars($_SESSION['user']['phone'] ?? '') ?>" readonly><br><br>

      <label>Your Goals</label><br>
      <textarea name="goals" id="goals" placeholder="E.g., Build muscle, lose weight..." required></textarea><br><br>

      <button type="submit" name="join_program" class="btn">Confirm Join</button>
    </form>
  </div>
</div>

<script>
  function openJoinModal(programId, programTitle) {
    document.getElementById('joinProgramModal').style.display = 'block';
    document.getElementById('programIdInput').value = programId;
    document.getElementById('programDisplayName').textContent = programTitle;
  }

  function closeJoinModal() {
    document.getElementById('joinProgramModal').style.display = 'none';
  }
</script>

<?php include 'includes/footer.php'; ?>
