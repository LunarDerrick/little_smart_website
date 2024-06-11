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
                <a class="nav-link" href="roster.php">ADMIN</a>
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

        <button type="button" class="btn btn-primary mobile" onclick="document.location='roster.php'">Name List</button>
        <button type="button" class="btn btn-primary mobile" onclick="document.location='analysis.php'">Exam Analysis</button>
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

        <!-- delete modal -->
        <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Delete Entry</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete?</p>
                        <strong>There is no way to revert the action!</strong>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark mx-2" data-bs-postid="" id="modalDeleteBtn">
                            Delete
                        </button>
                        <button type="button" class="btn btn-info" data-bs-dismiss="modal" id="modalKeepBtn">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <br><br>

    <footer>
        <small><i>
            © 2024 Little Smart Day Care Centre
        </i></small>
    </footer>
    <br>

    <!-- JavaScript files-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- items for notification toast -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>

    <script>
        // sort table in ascending or descending order
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

        // delete modal handling
        var deleteModal = document.getElementById('deleteModal')
        var modalKeepBtn = document.getElementById('modalKeepBtn')
        var modalDeleteBtn = document.getElementById('modalDeleteBtn')
        var notyf = new Notyf()

        deleteModal.addEventListener('shown.bs.modal', (event) => {
            modalKeepBtn.focus()
            var button = event.relatedTarget
            //debug
            console.log("Modal triggered by button:", button);
            var studentID = button.getAttribute('data-bs-id')
            //debug
            console.log("Student ID to delete:", studentID);
            modalDeleteBtn.setAttribute('data-bs-id', studentID)
        })

        // delete button
        modalDeleteBtn.onclick = () => {
            // get deleted post id
            var studentID = modalDeleteBtn.getAttribute('data-bs-id')
            // prepare xhttp request
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && parseInt(this.status / 4) == 4) {
                    //default notyf 2000ms
                    notyf.error("We encountered an error when deleting the entry.")
                } else if (this.readyState == 4 && this.status == 200) {
                    //hide modal
                    deleteModal.classList.add("d-none")
                    //default notyf 2000ms
                    notyf.success("Entry is deleted.")
                    const redirect = async() => {
                        //wait 2500ms
                        await new Promise(res => setTimeout(res, 2500))
                        // Refresh the page without GET variable
                        window.location = window.location.href.split(/[?#]/)[0];
                    }
                    redirect()
                }
            };
            // send post request
            xhttp.open("POST", "api_deleteroster.php", true);
            xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhttp.send("id="+studentID);
        }
    </script>
</body>

</html>