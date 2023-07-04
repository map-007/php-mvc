<?php

function get_all_courses()
{
    global $db;
    $query = 'SELECT * FROM courses ORDER BY id';
    $statement = $db->prepare($query);
    $statement->execute();
    $courses = $statement->fetchAll();
    $statement->closeCursor();

    return $courses;
}

function get_single_courses($course_id)
{ 
    if(!$course_id) {
        return "All Courses";
    }
    global $db;
    $query = 'SELECT * FROM courses WHERE id = :course_id';
    $statement = $db->prepare($query);
    $statement->bindValue("course_id", $course_id);
    $statement->execute();
    $course = $statement->fetch();
    $statement->closeCursor();

    $course_name = $course['courseName'];
    return $course_name;
}

function delete_course($course_id) {
    global $db;
    $qurey = 'DELETE FROM courses WHERE id = :course_id';
    $statement = $db->prepare($qurey);
    $statement->bindValue(':course_id', $course_id);
    $statement->execute();
    $statement->closeCursor();
}

function add_course($course_name) {
    global $db;
    $qurey = 'INSERT INTO courses (courseName) VALUES (:course_name)';
    $statement = $db->prepare($qurey);
    $statement->bindValue(':course_name', $course_name);
    $statement->execute();
    $statement->closeCursor();
}