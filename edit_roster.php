<!DOCTYPE html>
<html lang="en">

<?php
require_once("init_db.php");
include_once "helper_list_roster.php";

# only run if is set
if ($_SERVER['REQUEST_METHOD'] !== 'GET'){
    http_response_code(404);
    // include('404.php');
    die();
}

# no id provided
if (!isset($_GET["id"]) || empty($_GET["id"])){
    http_response_code(404);
    // include('404.php'); // provide your own HTML for the error page
    die();
}

$student_id = intval($_GET["id"]) ?? die; // try to get integer value, or else die

// get post item
$stmt = $conn->prepare("SELECT student_id, student_name, age, telno, school, standard, mandarin, english, malay, math, science
    FROM students 
    WHERE students.student_id = ?");
$stmt->bind_param("i", $student_id);
if (!$stmt->execute()){
    http_response_code(500);
    die;
}
$result = $stmt->get_result();
if ($row = $result->fetch_object()){
    $entry = $row;
    if (empty($entry->student_id)) {
        // no entry matching id
        http_response_code(404);
        // include('404.php'); // provide your own HTML for the error page
        die();
    }
} else {
    http_response_code(500);
    die;
}
?>

<head>
    <title>Edit Entry - Little Smart Day Care Centre</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--Bootstrap implementation-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!--CSS overwrite-->
        <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <nav class="navbar navbar-expand navbar-light bg-custom">
        <a class="navbar-brand" href="index.html">
            <img src="media/logo.png" class="d-inline-block align-top" alt="day care centre logo">
        </a>

        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <b>
                <a class="nav-link" href="roster.html">ADMIN</a>
                </b>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="about.html">About Us</a>
        </ul>
    </nav>

    <section>
        <p id="PC">You are now viewing as <b>Computer</b>.</p>
        <p id="tablet">You are now viewing as <b>Tablet</b>.</p>
        <p id="mobile">You are now viewing as <b>Mobile Device</b>.</p>
        
        <a href="roster.php">Go Back</a>

        <section>
            <div class="container">
                <div class="container section-title ">
                    <h1>Edit Entry</h1>
                </div>
                
                <form action="api_editroster.php?id=<?php echo $entry->student_id?>" method="POST" enctype="multipart/form-data">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 form-label">
                                <label for="name"><b>Name</b></label>
                                <input type="text" id="name" name="name" class="form-control" value="<?php echo $entry->student_name?>" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-label">
                                <label for="age"><b>Age</b></label>
                                <input type="number" min="1" id="age" name="age" class="form-control" value="<?php echo $entry->age?>" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-label">
                                <label for="telno"><b>Phone Number</b></label>
                                <input type="tel"  id="telno" name="telno" class="form-control" value="<?php echo $entry->telno?>" required
                                pattern="([0-9]{3}-[0-9]{7})|([0-9]{3}-[0-9]{8})" placeholder="Example: 012-3456789">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-label">
                                <label for="school"><b>Primary School</b></label>
                                <input type="text" id="school" name="school" class="form-control" value="<?php echo $entry->school?>" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-label">
                                <label for="standard"><b>Standard</b></label>
                                <select type="standard" id="standard" name="standard" class="form-select" required>
                                    <?php preSelect($entry->standard)?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-label">
                                <h4>Exam Scores</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-label">
                                <label for="mandarin"><b>Mandarin</b></label>
                                <input type="number" min="0" max="100" id="mandarin" name="mandarin" class="form-control" value="<?php echo $entry->mandarin?>" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-label">
                                <label for="english"><b>English</b></label>
                                <input type="number" min="0" max="100" id="english" name="english" class="form-control" value="<?php echo $entry->english?>" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-label">
                                <label for="malay"><b>Malay</b></label>
                                <input type="number" min="0" max="100" id="malay" name="malay" class="form-control" value="<?php echo $entry->malay?>" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-label">
                                <label for="math"><b>Mathematics</b></label>
                                <input type="number" min="0" max="100" id="math" name="math" class="form-control" value="<?php echo $entry->math?>" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-label">
                                <label for="science"><b>Science</b></label>
                                <input type="number" min="0" max="100" id="science" name="science" class="form-control" value="<?php echo $entry->science?>" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7">
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <input type="submit" value="Save" class="btn btn-primary">
                                    </div>
                                </div>
                            </div>  
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <br>

    </section>

    <footer>
        <small><i>
            © 2024 Little Smart Day Care Centre
        </i></small>
    </footer>
    <br>
</body>

</html>