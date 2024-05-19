FRONT END:

Color Scheme and Typography: The site uses a palette of custom CSS variables for colors 
(--isabelline, --white, --selective-yellow, --kappel, --gray-web, etc.) and a specific font
family (--ff-league_spartan), suggesting a cohesive visual theme and brand identity.
-------------------------------------------------------------------------------------------------------------------
Responsive Design: The use of media queries (e.g., @media (min-width: 575px))
indicates that the site is designed to be responsive, adjusting its layout and content
to fit different screen sizes, enhancing usability across devices.
-------------------------------------------------------------------------------------------------------------------
Interactive Elements: Various elements such as buttons (.btn), navigation bar (.navbar),
and back-to-top button (.back-top-btn) are styled to respond to user interactions like hover and focus,
improving the interactive experience of the site.
-------------------------------------------------------------------------------------------------------------------
Layout and Structure: The site employs a grid system for layout (grid-list),
padding and margin utilities (.container, .section), and positioning utilities
(.shape, .navbar, .footer-bottom), which help in structuring content in a visually appealing and organized manner.
-------------------------------------------------------------------------------------------------------------------
Accessibility Features: The use of :focus-visible and careful management
of outline offsets and colors indicates an attention to accessibility,
ensuring that keyboard navigation is visually clear and usable.
-------------------------------------------------------------------------------------------------------------------
Custom Components: The site defines styles for custom components
such as course cards (.course-card), badges (.badge, .abs-badge),
and action buttons (.header-action-btn), which likely serve specific
purposes in the site's UI, such as displaying course information, achievements, or calls to action.
-------------------------------------------------------------------------------------------------------------------
Visual Effects: CSS properties for transitions (e.g., --transition-1),
transformations (e.g., scaling of .img-cover on hover), and box shadows (e.g., .nav-close-btn)
are used to create smooth visual effects that enhance the user experience by providing feedback and a sense of depth.
-------------------------------------------------------------------------------------------------------------------
Utility Classes: The site uses utility classes for common tasks like hiding elements
(.display: none), styling scrollbars (::-webkit-scrollbar), and managing text overflow in titles
(.card-title with -webkit-line-clamp), which suggests a modular approach to CSS styling.
-------------------------------------------------------------------------------------------------------------------

DATABASE:

User Entity
The User entity consists of objects with the following attributes:
- UID: A unique identifier for the user.
- UName: The username of the user.
- Email: The email address of the user.
-------------------------------------------------------------------------------------------------------------------
Course Entity
- The Course entity consists of objects with the following attributes:
- CID: A unique identifier for the course.
- UID: An identifier linking the course to a user (nullable).
- Title: The title of the course.
- Duration: The duration of the course.
- Type: The type or level of the course (e.g., Beginner, Advanced).
- Location: The location where the course is offered.
- Category: The category of the course.
- Content: A description of what the course covers.
- Date: The date when the course is available.

The database is manipulated through PHP functions defined in database/feature_db.php, which include operations for retrieving, updating, and deleting user and course data.
-------------------------------------------------------------------------------------------------------------------

Get Data
Get Users: Use the admin_get_users() function to retrieve and display all users.
This function iterates through the user data and outputs HTML for each user, including options to edit or delete the user.
Get Courses: Use the admin_get_courses() function to retrieve and display all courses.
Similar to admin_get_users(), it iterates through the course data and outputs HTML for each course.
-------------------------------------------------------------------------------------------------------------------
Add Data
Add User: To add a new user, use the add_user($user) function.
You need to pass a user object that matches the structure expected by the database (i.e., includes UID, UName, Email, etc.).
Add Course: To add a new course, use the add_course($course) function.
You need to pass a course object that matches the structure expected by the database (i.e., includes CID, Title, Duration, Type, etc.).
-------------------------------------------------------------------------------------------------------------------
Delete Data
Delete User: To delete a user, use the delete_user($id) function,
where $id is the unique identifier (UID) of the user you want to delete.
Delete Course: To delete a course, use the delete_course($id) function,
where $id is the unique identifier (CID) of the course you want to delete.
-------------------------------------------------------------------------------------------------------------------
Update Data
Update User: To update an existing user's information, use the update_user($user) function.
The $user parameter should be an object with the updated user data, including the UID to identify which user to update.
Update Course: To update an existing course's information, use the update_course($course) function.
The $course parameter should be an object with the updated course data, including the CID to identify which course to update.
These functions interact with the data stored in database/db.json, performing the necessary CRUD operations. Make sure to structure your $user and $course objects correctly according to the database schema outlined in your Readme.txt file and ensure that the get_connection() function is properly implemented to fetch and manipulate the JSON data in db.json.