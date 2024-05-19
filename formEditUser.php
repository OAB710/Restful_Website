<?php
require_once('database/connection.php');

function get_user_by_id($uid)
{
  $data = get_connection();
  $user_data = $data['User'];

  foreach ($user_data as $user) {
    if ($user['UID'] == $uid) {
      return $user;
    }
  }
  return null;
}

$uid = $_GET['UID'];
$user = get_user_by_id($uid);

if (!$user) {
  echo "User not found";
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="assets/css/formpostcourse_style.css" />
</head>
<body>
<div class="container">
    <div class="card">
        <div class="card-image">
            <h2 class="card-heading">
                Edit User
                <small>Update user details</small>
            </h2>
        </div>
        <form class="card-form" action="update_user.php" method="POST">
            <input type="hidden" name="UID" value="<?php echo $user['UID']; ?>">
            <div class="input">
                <input type="text" name="UName" class="input-field" value="<?php echo $user['UName']; ?>" />
                <label class="input-label">Username</label>
            </div>
            <div class="input">
                <input type="text" name="Email" class="input-field" value="<?php echo $user['Email']; ?>" />
                <label class="input-label">Email</label>
            </div>
            <div class="input">
                <input type="password" name="Password" class="input-field" value="<?php echo $user['Password']; ?>" />
                <label class="input-label">Password</label>
            </div>
            <div class="action">
                <button type="submit" class="action-button">Update User</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
