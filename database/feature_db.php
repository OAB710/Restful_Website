<?php
require_once ('connection.php');

// <div class='wrapper'>
//             <div class='rating-wrapper'>
//               <ion-icon name='star'></ion-icon>
//               <ion-icon name='star'></ion-icon>
//               <ion-icon name='star'></ion-icon>
//               <ion-icon name='star'></ion-icon>
//               <ion-icon name='star'></ion-icon>
//             </div>
//             <p class='rating-text'>(4.9 /7 Rating)</p> 
//           </div>

function get_courses()
{
  $data = get_connection();
  $course_data = $data['Course'];
  return $course_data;
}

function showAllCourse()
{
  $course_data = get_courses();
  foreach ($course_data as $course):
    echo "
    <li>
    <div class='course-card'>
    <figure class='card-banner img-holder' style='--width: 370; --height: 220;'>
      <img src='./assets/images/course-3.jpg' width='370' height='220' loading='lazy'
        alt='The Complete Camtasia Course for Content Creators' class='img-cover'>
    </figure>
    <div class='abs-badge'>
      <ion-icon name='time-outline' aria-hidden='true'></ion-icon>
      <span class='span'>3 Weeks</span> 
    </div>
    <div class='card-content'>
      <span class='badge'>{$course['Type']}</span> 
          <h3 class='h3'>
            <a href='course_detail.php?CID={$course['CID']}' class='card-title'>{$course['Title']}</a>
          </h3>
          
          <data class='price' value=''>{$course['Duration']}</data> 
          <ul class='card-meta-list'>
            <li class='card-meta-item'>
              <ion-icon name='location-outline' aria-hidden='true'></ion-icon>
              <span class='span'>{$course['Location']}</span> 
            </li>
          </ul>
        </div>
      </div>
    </li>";
  endforeach;
}

function add_course($course)
{
  $data = get_connection();
  $course_data = $data['Course'];
  $course_data[] = $course;
  $data['Course'] = $course_data;
  $data = json_encode($data, JSON_PRETTY_PRINT);
  file_put_contents('database/db.json', $data);
}

function get_course($id)
{
  $data = get_connection();
  $course_data = $data['Course'];

  $matching_courses = [];

  foreach ($course_data as $course) {
    if ($course['CID'] == $id) {
      $matching_courses[] = $course;
    }
  }

  if (!empty($matching_courses)) {
    foreach ($matching_courses as $course):
      echo "
      <h3 class='card-title' style='color: var(--eerie-black-1);'>{$course['Title']}</h3>
      <hr class='divider'>
      <style>
          hr.divider {
              margin-top: 20px;
              margin-bottom: 20px;
              clear: both;
              border: 0;
              height: 1px;
              background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, .75), rgba(0, 0, 0, 0));
          }
      </style>
      <p class='card-text'>{$course['Content']}</p>
      <hr class='divider'>
      <ul>
          <style>
              li {
                  display: inline-block;
                  margin-right: 10px;
              }
          </style>
          <li>
              <ul>
                  <li><ion-icon name='location-outline' aria-hidden='true'></ion-icon></li>
                  <li><span class='badge'>{$course['Type']}</span></li>
              </ul>
          </li>
          <li>
              <ul>
                  <li><ion-icon name='time-outline' aria-hidden='true'></ion-icon></li>
                  <li><span class='span'>{$course['Duration']}</span></li> 
              </ul>
          </li>
          <li>
              <ul>
                  <li><ion-icon name='location-outline' aria-hidden='true'></ion-icon></li>
                  <li><span class='span'>{$course['Location']}</span> </li>
              </ul>
          </li>
      </ul>";
    endforeach;
    // return $matching_courses;
  } else {
    echo json_encode(['message' => 'Course not found'], JSON_PRETTY_PRINT);
    return null;
  }
}

function delete_course($id)
{
  require_once ('connection.php');
  $data = get_connection();
  $course_data = $data['Course'];

  // Create a new array to hold courses that are not deleted
  $updated_course_data = [];

  foreach ($course_data as $course) {
    if ($course['CID'] != $id) {
      $updated_course_data[] = $course;
    }
  }

  // Assign the updated course data back to the main data array
  $data['Course'] = $updated_course_data;

  // Encode the data back to JSON and save it to the file
  $data = json_encode($data, JSON_PRETTY_PRINT);
  file_put_contents('database/db.json', $data);
}

function update_course($course)
{
  // Convert the stdClass object to an array
  $course_array = json_decode(json_encode($course), true);

  $data = get_connection();
  $course_data = $data['Course'];

  foreach ($course_data as $key => $c) {
    if ($c['CID'] == $course_array['CID']) {
      $course_data[$key] = $course_array;
      break; // No need to continue looping once the course is found and updated
    }
  }

  $data['Course'] = $course_data;
  $json_data = json_encode($data, JSON_PRETTY_PRINT);
  file_put_contents('database/db.json', $json_data);
}

?>