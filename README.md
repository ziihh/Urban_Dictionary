# Assignment 2 - Urban Dictionary

## Code structure
Folder structure looks like this:
- Urban_Dictionary
    - Controller
        - Controller.php
    - Model
        - DBModel.php
        - Entry.php
        - Topic.php
        - User.php
    - SQL
        - urban_dictionary.sql
    - View
        - CSS
            - index.css
        - includes
            - footer.php
            - header.php
        - AddEntry.php
        - CreateTopic.php
        - EditProfile.php
        - Home.php
        - Login.php
        - RegisterUser.php
        - Summary.php
        - UserList.php
        - View.php
    - index.php
    - README.md

I have used MVC (Model, View and Controller) pattern for this assignment. Controller.php is responsible for handling all user input and error handling. DBModel is responsible for handling SQL queries. View handels the visualization of the data in different pages.

## How to run the web application?
### Windows
- Install XAMPP
- Navigate to htdocs folder under ```C:\xampp\htdocs```
- Open git bash in htdocs folder
- Clone the repository in htdocs.
- Navigate to ```http://localhost/phpmyadmin```
    - Click "new" on the left side panel.
    - Write "urban_dictionary" as the database name.
    - Click "Create".
- Open browser & navigate to ```http://localhost/Urban_Dictionary/index.php```

## How to use the web application?
- Once at specified url ```http://localhost/Urban_Dictionary/index.php```
- Click "Login" button.
- On the Login page click "Register" button.
- Fill in the form.
- Once all field are filled click "Register" button.
- You will be redirected to Home page.
- Now Login with your registered credentials and use the web-app as any other normal web-app.


## What you can do in web-app? (Taken from assignment description)
In this assignment, you are expected to develop an urban dictionary, which allows its users to provide informal (often funny and/or critical) definitions, called entries, for user-added topics, that might be people, places, objects, situations, sayings, expressions etc.

A visitor accessing the main page of the website should see the list of topics and the latest set of entries for a randomly selected topic, should be able to click on any topic and read the entries, and make a boolean search against topics and entries. The visitor should be able to choose whether he wants topics to be listed according to their chronological order or popularity (e.g., topics with highest number of entries in the last week). The visitor’s choice should also be respected for her/his subsequent visits. The visitor should be able to login, if she/he is a registered user, and a registration form should be provided for the visitors wishing to register.

A user in the system can be either an admin or author. If the logged user is an author, she/he should be able to create new topics, add entries to existing topics (up to 1000 characters), and delete entries and topics created by him, and update his registration data (including the password). If the user logs in as an admin, in addition to what an author can do, he should be able to delete users, delete any topic or entry, and see a summary (i.e., a list presenting the number of entries under each topic).

## Explaination
- Indexes to tables are added as needed.
- System keep track of user preferences for topic ordering using cookies.
- System protect all password using default built-in php hashing algorithm called bcrypt algorithm.
- All user input fields are sanitized.
- All empty field are validated before passed on.
- Code is well indented and commented.
- Code readability is ok.
- Looks of the pages are at minimal.