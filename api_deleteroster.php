<?php
require_once("init_db.php");

# only run if is post
if ($_SERVER['REQUEST_METHOD'] !== 'POST'){
    # go back to previous page
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    die; # prevent if browser dont respect redirect
}

if (empty($_POST["id"]) || !is_numeric($_POST["id"])){
    # go back to previous page
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    die; # prevent if browser dont respect redirect
}

$studentID = intval($_POST["id"]);

//prepare select query
$stmt = $conn -> prepare("SELECT * FROM students WHERE student_id=?");
$stmt -> bind_param("i", $studentID);

if (!$stmt->execute()){
    http_response_code(500);
    die;
}

$result = $stmt->get_result();
if ($result->num_rows){
    // get first result row
    $row = $result->fetch_assoc();
    // if (intval($row["userid"]) !== intval($userid)){
    //     // userid for post doesnt match
    //     JSONresponse(403, ["status" => "entry not found"]);
    //     die;
    // }
} else {
    // no entry with given studentid
    JSONresponse(401, ["status" => "entry not found"]);
    die;
}

// verification success

//prepare delete query
$stmt = $conn -> prepare("DELETE FROM students WHERE student_id=?");
$stmt -> bind_param("i", $studentID);

if (!$stmt->execute()){
    http_response_code(500);
    die;
}
// // delete image from server too
// $image = $row["image"];
// unlink($image);

// userid for post doesnt match
JSONresponse(200, ["OK" => "Post deleted"]);
die;