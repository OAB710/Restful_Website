<?php
require_once('database/connection.php');

function get_course_by_id($cid)
{
  $data = get_connection();
  $course_data = $data['Course'];

  foreach ($course_data as $course) {
    if ($course['CID'] == $cid) {
      return $course;
    }
  }
  return null;
}

$cid = $_GET['CID'];
$course = get_course_by_id($cid);

if (!$course) {
  echo "Course not found";
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Course</title>
    <link rel="stylesheet" href="assets/css/formpostcourse_style.css" />
  </head>
  <body>
    <div class="container">
      <div class="card">
        <div class="card-image">
          <h2 class="card-heading">
            Edit Course
            <small>Update your course details</small>
          </h2>
        </div>
        <form class="card-form" action="update_course.php" method="POST">
          <input type="hidden" name="CID" value="<?php echo $course['CID']; ?>">
          <div class="input">
            <input type="text" name="Title" class="input-field" value="<?php echo $course['Title']; ?>" />
            <label class="input-label">Title</label>
          </div>
          <div class="input">
            <input type="text" name="Duration" class="input-field" value="<?php echo $course['Duration']; ?>" />
            <label class="input-label">Duration</label>
          </div>
          <div class="input">
            <input type="text" name="Type" class="input-field" value="<?php echo $course['Type']; ?>" />
            <label class="input-label">Type</label>
          </div>
          <div class="input">
            <input type="text" name="Location" class="input-field" value="<?php echo $course['Location']; ?>" />
            <label class="input-label">Location</label>
          </div>
          <div class="input">
            <input type="text" name="Category" class="input-field" value="<?php echo $course['Category']; ?>" />
            <label class="input-label">Category</label>
          </div>
          <div class="input">
            <textarea name="Content" class="input-field" rows="5" style="resize: none; overflow: hidden"><?php echo $course['Content']; ?></textarea>
            <label class="input-label">Content</label>
          </div>
          <input type="hidden" name="UID" value="<?php echo $course['CID']; ?>">

          <div class="action">
            <button type="submit" class="action-button">Update Course</button>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
