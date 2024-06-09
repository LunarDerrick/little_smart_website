<?php

function buildRoster($list) {
    if ($list == null) {
        // @todo
        // when the database is empty
    }

    foreach ($list as $entry) {
        $output = "";
        $output .= <<< ROW
            <tr>
                <td>
                    <a class="img-btn" href="edit_roster.html">
                        <img src="media/edit_img.png" alt="edit">
                    </a>
                    <a class="img-btn" href="#" data-bs-target="#deleteModal" data-bs-toggle="modal" data-bs-id="$entry->student_id">
                        <img src="media/delete_img.png" alt="delete">
                    </a>
                </td>
                <td>$entry->student_name</td>
                <td>$entry->age</td>
                <td>$entry->telno</td>
                <td>$entry->school</td>
                <td>$entry->standard</td>
                <td>$entry->mandarin</td>
                <td>$entry->english</td>
                <td>$entry->malay</td>
                <td>$entry->math</td>
                <td>$entry->science</td>
            </tr>
        ROW;

        echo $output;
    }
}

function listRoster($conn) {
    // prepare select query
    $stmt = $conn->prepare("SELECT * FROM students");
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows){
        // $count = 0;
        while($row = $result->fetch_object()){
            // use [] format to add to last item in PHP
            $resultarr[] = $row;
            // $count = $row->postCount;
        }
        // return array($resultarr, $count);
        return array($resultarr);
    } else {
        // return array(null, 0);
        return array(null);
    }
}