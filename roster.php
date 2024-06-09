<!DOCTYPE html>
<html lang="en">

<?php
require_once("init_db.php");
include_once "helper_list_roster.php";
?>

<head>
    <title>Roster - Little Smart Day Care Centre</title>

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

        <button type="button" class="btn btn-primary mobile" onclick="document.location='roster.html'">Name List</button>
        <button type="button" class="btn btn-primary mobile" onclick="document.location='feedback.html'">Feedback Inbox</button>
        <button type="button" class="btn btn-primary mobile" onclick="document.location='list_post.html'">Edit Post</button>
        <button type="button" class="btn btn-primary mobile" onclick="document.location='index.html'">Logout</button>
        <h1>Tuition Roster</h1>
        <br>

        <div id="roster">
            <table id="rosterTable">
                <tr>
                    <th>Actions</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Phone Number</th>
                    <th>School</th>
                    <th>Standard</th>
                    <th>Mandarin</th>
                    <th>English</th>
                    <th>Malay</th>
                    <th>Mathematics</th>
                    <th>Science</th>
                </tr>
                <?php
                    [$list] = listRoster($conn);
                    buildRoster($list);
                ?>
            </table>
        </div>
        <br>
        <button type="button" class="btn btn-primary crud" onclick="document.location='add_roster.php'">ADD</button>
    </section>

    <br><br>

    <footer>
        <small><i>
            © 2024 Little Smart Day Care Centre
        </i></small>
    </footer>
    <br>

    <script>
        // Function to sort the table by a specific column
        function sortTable(columnIndex) {
            var table, rows, switching, i, x, y, shouldSwitch, dir, switchCount = 0;
            table = document.querySelector("#roster table");
            switching = true;
            dir = "asc";
            
            while (switching) {
                switching = false;
                rows = table.rows;
                
                for (i = 1; i < (rows.length - 1); i++) {
                    shouldSwitch = false;
                    x = rows[i].getElementsByTagName("td")[columnIndex];
                    y = rows[i + 1].getElementsByTagName("td")[columnIndex];
                    
                    if (dir == "asc") {
                        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                            shouldSwitch = true;
                            break;
                        }
                    } else if (dir == "desc") {
                        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                            shouldSwitch = true;
                            break;
                        }
                    }
                }
                
                if (shouldSwitch) {
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                    switchCount++;
                } else {
                    if (switchCount == 0 && dir == "asc") {
                        dir = "desc";
                        switching = true;
                    }
                }
            }
        }
        
        // Event listeners for column headers to trigger sorting
        document.addEventListener('DOMContentLoaded', function() {
            var headers = document.querySelectorAll("#roster th");
            headers.forEach(function(header, index) {
                header.addEventListener('click', function() {
                    sortTable(index);
                });
            });
        });
    </script>
</body>

</html>