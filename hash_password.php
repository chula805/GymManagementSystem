<?php
$password = 'admin123'; // your desired admin password
echo password_hash($password, PASSWORD_DEFAULT);
?>

<?php
$password = 'staff123'; // your desired staff password
echo password_hash($password, PASSWORD_DEFAULT);
?>
