<?php

function buildScore($list) {
    if ($list == null) {
        // @todo
        // when the database is empty
    }

    foreach ($list as $entry) {
        $output = "";
        $output .= <<< ROW
            <tr>
                <td>$entry->name</td>
                <td>$entry->subject</td>
                <td>$entry->score</td>
            </tr>
        ROW;

        echo $output;
    }
}

// fetch top scorer data
function listScore($conn) {
    // prepare select query
    $stmt = $conn->prepare("SELECT
            'Mandarin' AS subject,
            (SELECT student_name FROM students WHERE mandarin = (SELECT MAX(mandarin) FROM students) LIMIT 1) AS name,
            (SELECT MAX(mandarin) FROM students) AS score
        UNION SELECT
            'English' AS subject,
            (SELECT student_name FROM students WHERE english = (SELECT MAX(english) FROM students) LIMIT 1) AS name,
            (SELECT MAX(english) FROM students) AS score
        UNION SELECT
            'Malay' AS subject,
            (SELECT student_name FROM students WHERE malay = (SELECT MAX(malay) FROM students) LIMIT 1) AS name,
            (SELECT MAX(malay) FROM students) AS score
        UNION SELECT
            'Math' AS subject,
            (SELECT student_name FROM students WHERE math = (SELECT MAX(math) FROM students) LIMIT 1) AS name,
            (SELECT MAX(math) FROM students) AS score
        UNION SELECT
            'Science' AS subject,
            (SELECT student_name FROM students WHERE science = (SELECT MAX(science) FROM students) LIMIT 1) AS name,
            (SELECT MAX(science) FROM students) AS score");
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows){
        while($row = $result->fetch_object()){
            // use [] format to add to last item in PHP
            $resultarr[] = $row;
            // $count = $row->postCount;
        }
        return array($resultarr);
    } else {
        return array(null);
    }
}