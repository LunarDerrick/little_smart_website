<?php
require_once("init_db.php");
require_once("helper/sanitisation.php");

# no id provided
if (!isset($_GET["id"]) || empty($_GET["id"])){
    http_response_code(404);
    // include('404.php'); // provide your own HTML for the error page
    die();
}

$student_id = intval($_GET["id"]) ?? die; // try to get integer value, or else die

# only run if is post
if ($_SERVER['REQUEST_METHOD'] !== 'POST'){
    http_response_code(404);
    // include('404.php'); // provide your own HTML for the error page
    die; # prevent if browser dont respect redirect
}

# verify info
foreach (["name", "age", "telno", "school", "standard", "mandarin", "english", "malay", "math", "science"] as $check) {
    if (empty($_POST[$check])){
        # go back to previous page
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        die; # prevent if browser dont respect redirect
    }
}

// match post variables with content type
$fields = [
    "name" => "string",
    "age" => "int",
    "telno" => "string",
    "school" => "string",
    "standard" => "int",
    "mandarin" => "int",
    "english" => "int",
    "malay" => "int",
    "math" => "int",
    "science" => "int"
];

// sanitise inputs
$postvar = sanitize($_POST, $fields);
// # only allow these tags to be used
// $content = strip_tags($postvar["content"], '<table><thead><tbody><th><tr><td><br>');

//prepare update query
$query = $conn -> prepare("UPDATE students
SET student_name=?, age=?, telno=?, school=?, standard=?, mandarin=?, english=?, malay=?, math=?, science=?
WHERE student_id=?");

$query -> bind_param("sissiiiiiii", 
$postvar["name"], $postvar["age"], $postvar["telno"], $postvar["school"], $postvar["standard"], $postvar["mandarin"], $postvar["english"], $postvar["malay"], $postvar["math"], $postvar["science"], $student_id,);

if ($query -> execute()){
    // form header for redirect
    header("Location: roster.php?done=1");
} else {
    http_response_code(500);
}
?>