<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="css/formpostcourse_style.css" />
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
        <form class="card-form" action="add_course.php" method="POST">
          <div class="input">
            <input type="text" name="Title" class="input-field"  />
            <label class="input-label">Title</label>
          </div>
          <div class="input">
            <input type="text" name="Duration" class="input-field"  />
            <label class="input-label">Duration</label>
          </div>
          <div class="input">
            <input type="text" name="Type" class="input-field"  />
            <label class="input-label">Type</label>
          </div>
          <div class="input">
            <input type="text" name="Location" class="input-field"  />
            <label class="input-label">Location</label>
          </div>
          <div class="input">
            <textarea
              name="Content"
              class="input-field"
              rows="5"
              
              style="resize: none; overflow: hidden"
            ></textarea>
            <label class="input-label">Content</label>
          </div>
          <div class="action">
            <button type="submit" class="action-button">Get started</button>
          </div>
          
        </form>
      </div>
    </div>
  </body>
</html>
