<?php

function get_assignments_by_course($course_id)
{
    global $db;
    if ($course_id) {
        $query = 'SELECT A.id, A.description, C.courseName FROM assignments A LEFT JOIN courses C ON A.courseID = C.id WHERE A.courseID = :course_id ORDER BY A.id';
    } else {
        $query = 'SELECT A.id, A.description, C.courseName FROM assignments A LEFT JOIN courses C ON A.courseID = C.id ORDER BY C.id';
    }
    $statement = $db->prepare($query);
    if ($course_id) {
        $statement->bindValue(':course_id', $course_id);
    }
    $statement->execute();
    $assignments = $statement->fetchAll();
    $statement->closeCursor();
    return $assignments;
}

function delete_assignment($assignment_id) {
    global $db;
    $qurey = 'DELETE FROM assignments WHERE id = :assignment_id';
    $statement = $db->prepare($qurey);
    $statement->bindValue(':assignment_id', $assignment_id);
    $statement->execute();
    $statement->closeCursor();
}

function add_assignment($course_id, $description) {
    global $db;
    $qurey = 'INSERT INTO assignments (description, courseID) VALUES (:description,:course_id)';
    $statement = $db->prepare($qurey);
    $statement->bindValue(':description', $description);
    $statement->bindValue(':course_id', $course_id);
    $statement->execute();
    $statement->closeCursor();
}