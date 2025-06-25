<?php
session_start();
include 'includes/header.php';

include 'Database/db.php';

// Assuming user is logged in
$userId = $_SESSION['user']['id'] ?? null;
$membershipStatus = 'N/A';
$membershipPlan = 'None';
$enrolledPrograms = 0;
$messageCount = 0;

if ($userId) {
    // Membership
    $stmt = $conn->prepare("SELECT status, plan_name FROM memberships WHERE user_id = ? ORDER BY id DESC LIMIT 1");
    $stmt->execute([$userId]);
    $membership = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($membership) {
        $membershipStatus = ucfirst($membership['status']);
        $membershipPlan = $membership['plan_name'];
    }

    // Enrolled Programs
    $stmt = $conn->prepare("SELECT COUNT(*) FROM program_enrollments WHERE user_id = ?");
    $stmt->execute([$userId]);
    $enrolledPrograms = $stmt->fetchColumn();

    // Contact messages (assuming you store user_id in contact table)
    $stmt = $conn->prepare("SELECT COUNT(*) FROM messages WHERE user_id = ?");
    $stmt->execute([$userId]);
    $messageCount = $stmt->fetchColumn();
}


if ($userId) {
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$userId]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt2 = $conn->prepare("SELECT * FROM memberships WHERE user_id = ?");
    $stmt2->execute([$userId]);
    $membership = $stmt2->fetch(PDO::FETCH_ASSOC);
}


if (isset($_POST['update_profile']) && $userId) {
    // Update users table
    $stmt = $conn->prepare("UPDATE users SET name = ?, email = ?, phone = ? WHERE id = ?");
    $stmt->execute([
        $_POST['name'],
        $_POST['email'],
        $_POST['phone'],
        $userId
    ]);

    // Check if membership exists
    $stmt = $conn->prepare("SELECT id FROM memberships WHERE user_id = ?");
    $stmt->execute([$userId]);

    if ($stmt->rowCount() > 0) {
        // Update membership table
        $stmt = $conn->prepare("UPDATE memberships SET dob = ?, gender = ? WHERE user_id = ?");
        $stmt->execute([
            $_POST['dob'],
            $_POST['gender'],
            $userId
        ]);
    }

    // Refresh with success message
    echo "<script>window.location.href = '?success=1';</script>";
    exit;
}



// Fetch user memberships (including plan name, amount, etc.)
$stmt = $conn->prepare("SELECT * FROM memberships WHERE user_id = ?");
$stmt->execute([$userId]);
$memberships = $stmt->fetchAll(PDO::FETCH_ASSOC);


// Handle payment (simulation)
// Handle payment (simulation)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['make_payment'])) {
    $membershipId = intval($_POST['membership_id']);

    // Fetch plan name to determine price
    $stmt = $conn->prepare("SELECT plan_name FROM memberships WHERE id = ? AND user_id = ?");
    $stmt->execute([$membershipId, $userId]);
    $membership = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($membership) {
        $planName = strtolower($membership['plan_name']);
        $paidAmount = 0;

        if ($planName === 'basic') $paidAmount = 2500;
        elseif ($planName === 'standard') $paidAmount = 4500;
        elseif ($planName === 'premium') $paidAmount = 7000;

        // Update membership with status and paid amount
        $stmt = $conn->prepare("UPDATE memberships SET status = 'active', paid_amount = ? WHERE id = ? AND user_id = ?");
        $stmt->execute([$paidAmount, $membershipId, $userId]);

        echo "<script>
            alert('Payment successful. Membership activated.');
            document.getElementById('membershipModal').style.display = 'none';
            document.getElementById('paymentModal').style.display = 'none';
            window.location.href = window.location.href;
        </script>";
        exit();
    }
}

?>

<link rel="stylesheet" href="userstyles.css">

<div class="dashboard-container">
    <!-- Sidebar -->
    <nav class="sidebar">
        <ul>
            <li onclick="showSection('overview')">🏠 Overview</li>
            <li onclick="showSection('profile')">👤 My Profile</li>
            <li onclick="showSection('membership')">💳 Membership</li>
            <li onclick="showSection('programs')">📋 My Programs</li>
        </ul>
    </nav>

    <!-- Main Content -->
    <main class="dashboard-content">
        <!-- Section: Overview -->
        <section id="overview" class="dashboard-section active">
            <h2>🏠 Dashboard Overview</h2>

            <div class="card-container">
                <div class="dashboard-card">
                    <h3>Membership Status</h3>
                    <p><?= $membershipStatus ?></p>
                </div>

                <div class="dashboard-card">
                    <h3>Membership Plan</h3>
                    <p><?= htmlspecialchars($membershipPlan) ?></p>
                </div>

                <div class="dashboard-card">
                    <h3>Programs Enrolled</h3>
                    <p><?= $enrolledPrograms ?></p>
                </div>

                <div class="dashboard-card">
                    <h3>Contact Messages</h3>
                    <p><?= $messageCount ?></p>
                </div>
            </div>
        </section>

        <!-- Section: Profile -->
        <section id="profile" class="dashboard-section">
            <h2>👤 My Profile</h2>
            <?php if (isset($_GET['success'])): ?>
                <div style="color: green; margin-bottom: 10px;">Profile updated successfully!</div>
            <?php endif; ?>

            <form method="POST" style="max-width: 700px;">
                <div style="display: flex; gap: 20px;">
                    <div style="flex: 2;">
                        <label>Full Name</label>
                        <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required>
                    </div>
                    <div style="flex: 2;">
                        <label>Email</label>
                        <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
                    </div>
                </div>

                <div style="display: flex; gap: 20px; margin-top: 15px;">
                    <div style="flex: 1;">
                        <label>Phone</label>
                        <input type="text" name="phone" value="<?= htmlspecialchars($user['phone']) ?>" required>
                    </div>
                    <div style="flex: 1;">
                        <label>User Type</label>
                        <input type="text" value="<?= htmlspecialchars($user['user_type']) ?>" readonly>
                    </div>
                </div>

                <div style="display: flex; gap: 20px; margin-top: 15px;">
                    <div style="flex: 1;">
                        <label>Status</label>
                        <input type="text" value="<?= htmlspecialchars($user['status']) ?>" readonly>
                    </div>
                    <div style="flex: 1;">
                        <label>Membership Plan</label>
                        <input type="text" value="<?= htmlspecialchars($membership['plan_name'] ?? 'Not Selected') ?>"
                            readonly>
                    </div>
                </div>

                <div style="display: flex; gap: 20px; margin-top: 15px;">
                    <div style="flex: 1;">
                        <label>Date of Birth</label>
                        <input type="date" name="dob" value="<?= htmlspecialchars($membership['dob'] ?? '') ?>">
                    </div>
                    <div style="flex: 1;">
                        <label>Gender</label>
                        <select name="gender">
                            <option value="">-- Select --</option>
                            <option value="Male" <?= ($membership['gender'] ?? '') === 'Male' ? 'selected' : '' ?>>Male
                            </option>
                            <option value="Female" <?= ($membership['gender'] ?? '') === 'Female' ? 'selected' : '' ?>>
                                Female</option>
                            <option value="Other" <?= ($membership['gender'] ?? '') === 'Other' ? 'selected' : '' ?>>Other
                            </option>
                        </select>
                    </div>
                </div>

                <button type="submit" name="update_profile" class="btn" style="margin-top: 20px;">Update
                    Profile</button>
            </form>
        </section>

        <!-- Section: Membership -->
        <section id="membership" class="dashboard-section">
            <h2>💳 Membership</h2>

            <div class="membership-cards-container" style="display: flex; gap: 20px; flex-wrap: wrap;">
                <?php foreach ($memberships as $m):
                    $bg = '#ccc';
                    if (strtolower($m['plan_name']) == 'basic')
                        $bg = 'darkblue';
                    elseif (strtolower($m['plan_name']) == 'standard')
                        $bg = 'black';
                    elseif (strtolower($m['plan_name']) == 'premium')
                        $bg = 'gold';
                    ?>
                    <div class="membership-card" style="background-color: <?= $bg ?>;
    margin-top: 40px;
    background-color:rgb(0, 0, 0);
    color:rgb(255, 255, 255);
    padding: 20px;
    border-radius: 10px;
    flex: 1;
    max-width: 300px;
    text-align: center;
">
                        <h3><?= ucfirst($m['plan_name']) ?> Plan</h3>
                        <p>Status: <?= ucfirst($m['status']) ?></p>
                        <button onclick="viewMembershipDetails(<?= htmlspecialchars(json_encode($m)) ?>)" class="btn"
                            style="margin-top: 10px;">View</button>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Membership View Modal -->
        <div id="membershipModal" class="modal" style="display:none;">
            <div class="modal-content">
                <span class="close-btn1" onclick="closeModal('membershipModal')">&times;</span>
                <h2>Membership Details</h2>
                <div id="membershipDetailBody"></div>
                <button class="btn" onclick="openPaymentModal()">Pay Now</button>
            </div>
        </div>

        <!-- Payment Modal -->
        <div id="paymentModal" class="modal" style="display:none;">
            <div class="modal-content">
                <span class="close-btn1" onclick="closeModal('paymentModal')">&times;</span>
                <h2>Choose Payment Method</h2>
                <button onclick="showCardPaymentFields()" class="btn">Card Payment</button>

                <div id="cardPaymentForm" style="display:none; margin-top: 15px;">
                    <form method="POST">
                        <label>Card Number</label>
                        <input type="text" name="card_number" required><br>
                        <label>Card Holder Name</label>
                        <input type="text" name="card_holder" required><br>
                        <label>Expiry Date</label>
                        <input type="text" name="expiry" placeholder="MM/YY" required><br>
                        <label>CVV</label>
                        <input type="text" name="cvv" required><br>
                        <input type="hidden" name="membership_id" id="payMembershipId">
                        <button type="submit" name="make_payment" class="btn">Settle Payment</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Section: Programs -->
        <section id="programs" class="dashboard-section">
            <h2>📋 My Programs</h2>

            <div class="program-card-container">
                <?php
                if ($userId) {
                    $stmt = $conn->prepare("
                SELECT 
                    p.title, p.category, p.image, e.goals  
                FROM program_enrollments e
                JOIN programs p ON e.program_id = p.id
                WHERE e.user_id = ?
            ");
                    $stmt->execute([$userId]);
                    $programs = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if ($programs):
                        foreach ($programs as $program): ?>
                            <div class="program-card">
                                <img src="Admin/uploads/<?= htmlspecialchars($program['image']) ?>" alt="Program Image"
                                    class="program-img">
                                <div class="program-details">
                                    <h3><?= htmlspecialchars($program['title']) ?></h3>
                                    <p><strong>Category:</strong> <?= htmlspecialchars($program['category']) ?></p>
                                    <p><strong>My Goal:</strong> <?= htmlspecialchars($program['goals']) ?></p>
                                </div>
                            </div>
                        <?php endforeach;
                    else:
                        echo "<p style='color:gray;'>You haven’t joined any programs yet.</p>";
                    endif;
                } else {
                    echo "<p>Please log in to view your programs.</p>";
                }
                ?>
            </div>
        </section>

    </main>
</div>

<script src="userscript.js"></script>
<script>
    function viewMembershipDetails(membership) {
        const user = <?= json_encode($user) ?>;

        const detailsHTML = `
    <p><strong>Name:</strong> ${user.name}</p>
    <p><strong>Email:</strong> ${user.email}</p>
    <p><strong>Phone:</strong> ${user.phone}</p>
    <p><strong>Plan:</strong> ${membership.plan_name}</p>
    <p><strong>Status:</strong> ${membership.status}</p>
    <p><strong>DOB:</strong> ${membership.dob || 'Not provided'}</p>
    <p><strong>Gender:</strong> ${membership.gender || 'Not provided'}</p>
    <p><strong>Payment:</strong> LKR ${membership.plan_name === 'Premium' ? '7500' : membership.plan_name === 'Standard' ? '4500' : '2500'} / mo</p>
  `;
        document.getElementById('membershipDetailBody').innerHTML = detailsHTML;
        document.getElementById('payMembershipId').value = membership.id;
        document.getElementById('membershipModal').style.display = 'block';
    }

    function openPaymentModal() {
        document.getElementById('membershipModal').style.display = 'none';
        document.getElementById('paymentModal').style.display = 'block';
    }

    function showCardPaymentFields() {
        document.getElementById('cardPaymentForm').style.display = 'block';
    }

    function closeModal(id) {
        document.getElementById(id).style.display = 'none';
        if (id === 'membershipModal') {
            document.getElementById('cardPaymentForm').style.display = 'none';
        }
    }
</script>
<?php include 'includes/footer.php'; ?>