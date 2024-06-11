<?php
require_once("init_db.php");

// prepare array to return data
$data = array();

// fetch passing rate data from database
$myquery = "SELECT COUNT(*) AS total, 
            COUNT(CASE WHEN mandarin >= 60 THEN 1 END) AS Mandarin, 
            COUNT(CASE WHEN english >= 60 THEN 1 END) AS English, 
            COUNT(CASE WHEN malay >= 60 THEN 1 END) AS Malay, 
            COUNT(CASE WHEN math >= 60 THEN 1 END) AS Math, 
            COUNT(CASE WHEN science >= 60 THEN 1 END) AS Science
            FROM students";
try {
    $query = $conn->prepare($myquery);
    // $query->bind_param('s', $student_id);
    $query->execute();
} catch (Exception $e) {
    echo $e->getMessage();
    die;
}
$result = $query->get_result();
while($row = $result->fetch_assoc()){
    $data["pass_data"][] = $row;
}

// fetch science grade distribution data from database
$myquery = "SELECT 
            SUM(CASE WHEN science >= 80 THEN 1 ELSE 0 END) AS 'A',
            SUM(CASE WHEN science >= 60 AND science < 80 THEN 1 ELSE 0 END) AS 'B',
            SUM(CASE WHEN science >= 40 AND science < 60 THEN 1 ELSE 0 END) AS 'C',
            SUM(CASE WHEN science >= 20 AND science < 40 THEN 1 ELSE 0 END) AS 'D',
            SUM(CASE WHEN science < 20 THEN 1 ELSE 0 END) AS 'E'
            FROM students";
try {
    $query = $conn->prepare($myquery);
    // $query->bind_param('s', $student_id);
    $query->execute();
} catch (Exception $e) {
    echo $e->getMessage();
    die;
}
$result = $query->get_result();
while($row = $result->fetch_assoc()){
    $data["gradescience_data"][] = $row;
}

// fetch average score data from database
$myquery = "SELECT
            AVG(mandarin) AS Mandarin,
            AVG(english) AS English,
            AVG(malay) AS Malay,
            AVG(math) AS Math,
            AVG(science) AS Science
            FROM students";
try {
    $query = $conn->prepare($myquery);
    // $query->bind_param('s', $student_id);
    $query->execute();
} catch (Exception $e) {
    echo $e->getMessage();
    die;
}
$result = $query->get_result();
while($row = $result->fetch_assoc()){
    $data["avgscore_data"][] = $row;
}

// // fetch post data by rating from database
// $myquery = "SELECT posts.postid, title, caption, image, AVG(ratings.rating) AS avg_rating
//             FROM posts
//             LEFT JOIN ratings ON posts.postid=ratings.postid
//             WHERE posts.userid= ?
//             GROUP BY posts.postid
//             ORDER BY avg_rating DESC
//             LIMIT 5";

// // fetch post data by view count from database
// $myquery = "SELECT posts.postid, title, caption, image, viewcount
//             FROM posts
//             WHERE posts.userid= ?
//             ORDER BY viewcount DESC
//             LIMIT 5";

// // fetch post data by week from database
// $myquery = "SELECT COUNT(*) AS total,
// from_unixtime(posts.createdtime/1000, '%Y-%m-%d') AS postdate
// FROM posts
// WHERE userid = ?
// AND posts.createdtime/1000 > UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL 7 day))
// GROUP BY postdate
// ORDER BY postdate";

// // fetch rating data from database
// $myquery = "SELECT ratings.rating, COUNT(ratings.rating) AS total
//             FROM ratings
//             LEFT JOIN posts ON posts.postid=ratings.postid
//             WHERE posts.userid= ?
//             GROUP BY rating
//             ORDER BY rating";\

// // fetch comment data from database
// $myquery = "SELECT COUNT(*) AS total_count,
//             from_unixtime(commenttime/1000, '%Y-%m-%d') AS commentdate
//             FROM comments
//             LEFT JOIN posts ON posts.postid=comments.postid
//             WHERE posts.userid= ? 
//             AND commenttime/1000 > UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL 7 day))
//             AND comments.userid != ?
//             GROUP BY commentdate
//             ORDER BY commentdate";

JSONresponse(200, $data)

?>