<?php
require_once('connection.php');

function get_id()
{
  // Lấy URL hiện tại từ request
  $request_uri = $_SERVER['REQUEST_URI'];

  // Lấy tên file script
  $script_name = $_SERVER['SCRIPT_NAME'];

  // Loại bỏ tên script khỏi URL để lấy phần còn lại của đường dẫn
  $path = str_replace($script_name, '', $request_uri);

  // Tách các phần của đường dẫn bằng dấu '/'
  $path_parts = explode('/', trim($path, '/'));

  // Lấy phần cuối cùng của đường dẫn, thường là ID
  $id = end($path_parts);

  return $id;
}
function get_title()
{
  // Lấy URL hiện tại từ request
  $request_uri = $_SERVER['REQUEST_URI'];

  // Lấy tên file script
  $script_name = $_SERVER['SCRIPT_NAME'];

  // Loại bỏ tên script khỏi URL để lấy phần còn lại của đường dẫn
  $path = str_replace($script_name, '', $request_uri);

  // Tách các phần của đường dẫn bằng dấu '/'
  $path_parts = explode('?', trim($path, '?'));

  // Duyệt qua các phần của đường dẫn để tìm giá trị sau "Title="
  $title = '';
  foreach ($path_parts as $part) {
    if (strpos($part, 'Title=') !== false) {
      $title = str_replace('Title=', '', $part);
      break;
    }
  }

  return $title;
}
function get_location()
{
  $request_uri = $_SERVER['REQUEST_URI'];
  $path_parts = explode('?', $request_uri);

  $location = '';
  foreach ($path_parts as $part) {
    if (strpos($part, 'Location=') !== false) {
      $location = str_replace('Location=', '', $part);
      // Giải mã URL
      $location = urldecode($location);
      break;
    }
  }

  return $location;
}


function get_courses()
{
  $data = get_connection();
  $course_data = $data['Course'];
  return $course_data;
}

function showAllCourse()
{
  $course_data = get_courses();
  foreach ($course_data as $course) :
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
      <span class='badge'>Intermediate</span> 
          <h3 class='h3'>
            <a href='#' class='card-title'>{$course['Title']}</a>
          </h3>
          <div class='wrapper'>
            <div class='rating-wrapper'>
              <ion-icon name='star'></ion-icon>
              <ion-icon name='star'></ion-icon>
              <ion-icon name='star'></ion-icon>
              <ion-icon name='star'></ion-icon>
              <ion-icon name='star'></ion-icon>
            </div>
            <p class='rating-text'>(4.9 /7 Rating)</p> 
          </div>
          <data class='price' value='35'>$35.00</data> 
          <ul class='card-meta-list'>
            <li class='card-meta-item'>
              <ion-icon name='library-outline' aria-hidden='true'></ion-icon>
              <span class='span'>13 Lessons</span> 
            </li>
            <li class='card-meta-item'>
              <ion-icon name='people-outline' aria-hidden='true'></ion-icon>
              <span class='span'>18 Students</span> 
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
    echo json_encode($matching_courses, JSON_PRETTY_PRINT);
    return $matching_courses;
  } else {
    echo json_encode(['message' => 'Course not found'], JSON_PRETTY_PRINT);
    return null;
  }
}

function delete_course($id)
{
  require_once('connection.php');
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
function search_course_by_title($title)
{
  $data = get_connection();
  $course_data = $data['Course'];

  $matching_courses = [];

  foreach ($course_data as $course) {
    if (stripos($course['Title'], $title) !== false) {
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
      <span class='badge'>Intermediate</span> 
          <h3 class='h3'>
            <a href='#' class='card-title'>{$course['Title']}</a>
          </h3>
          <div class='wrapper'>
            <div class='rating-wrapper'>
              <ion-icon name='star'></ion-icon>
              <ion-icon name='star'></ion-icon>
              <ion-icon name='star'></ion-icon>
              <ion-icon name='star'></ion-icon>
              <ion-icon name='star'></ion-icon>
            </div>
            <p class='rating-text'>(4.9 /7 Rating)</p> 
          </div>
          <data class='price' value='35'>$35.00</data> 
          <ul class='card-meta-list'>
            <li class='card-meta-item'>
              <ion-icon name='library-outline' aria-hidden='true'></ion-icon>
              <span class='span'>13 Lessons</span> 
            </li>
            <li class='card-meta-item'>
              <ion-icon name='people-outline' aria-hidden='true'></ion-icon>
              <span class='span'>18 Students</span> 
            </li>
          </ul>
        </div>
      </div>
    </li>";
    }
  }

  if (!empty($matching_courses)) {
    echo json_encode($matching_courses, JSON_PRETTY_PRINT);
    return $matching_courses;
  }
}
function filter_course_by_location($location)
{
  $data = get_connection();
  $course_data = $data['Course'];

  $matching_courses = [];

  foreach ($course_data as $course) {
    if (isset($course['Location']) && stripos($course['Location'], $location) !== false) {
      $matching_courses[] = $course;
    }
  }

  if (!empty($matching_courses)) {
    foreach ($matching_courses as $course) {
      echo "
          <li>
              <div class='course-card'>
                  <figure class='card-banner img-holder' style='--width: 370; --height: 220;'>
                      <img src='./assets/images/course-3.jpg' width='370' height='220' loading='lazy' alt='The Complete Camtasia Course for Content Creators' class='img-cover'>
                  </figure>
                  <div class='abs-badge'>
                      <ion-icon name='time-outline' aria-hidden='true'></ion-icon>
                      <span class='span'>3 Weeks</span> 
                  </div>
                  <div class='card-content'>
                      <span class='badge'>Intermediate</span> 
                      <h3 class='h3'>
                          <a href='#' class='card-title'>{$course['Title']}</a>
                      </h3>
                      <div class='wrapper'>
                          <div class='rating-wrapper'>
                              <ion-icon name='star'></ion-icon>
                              <ion-icon name='star'></ion-icon>
                              <ion-icon name='star'></ion-icon>
                              <ion-icon name='star'></ion-icon>
                              <ion-icon name='star'></ion-icon>
                          </div>
                          <p class='rating-text'>(4.9 /7 Rating)</p> 
                      </div>
                      <data class='price' value='35'>$35.00</data> 
                      <ul class='card-meta-list'>
                          <li class='card-meta-item'>
                              <ion-icon name='library-outline' aria-hidden='true'></ion-icon>
                              <span class='span'>13 Lessons</span> 
                          </li>
                          <li class='card-meta-item'>
                              <ion-icon name='people-outline' aria-hidden='true'></ion-icon>
                              <span class='span'>18 Students</span> 
                          </li>
                      </ul>
                  </div>
              </div>
          </li>";
    }

    
    return $matching_courses;
  } else {
    echo json_encode(['message' => 'Không tìm thấy khóa học cho địa điểm chỉ định'], JSON_PRETTY_PRINT);
    return [];
  }
}
