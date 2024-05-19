<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/formpostcourse_style.css" />
  </head>
  <body>
    <div class="container">
      <div class="card">
        <div class="card-image">
          <h2 class="card-heading">
            Get started
            <small>Course for everyone</small>
          </h2>
        </div>
        <form class="card-form" action="add_user.php" method="POST">
          <div class="input">
            <input type="text" name="UName" class="input-field"  />
            <label class="input-label">Name</label>
          </div>
          <div class="input">
            <input type="text" name="Email" class="input-field"  />
            <label class="input-label">Email</label>
          </div>
          <div class="action" action="add_user.php" method="POST">
            <button type="submit" class="action-button">Get started</button>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
