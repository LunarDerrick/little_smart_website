<!DOCTYPE html>
<html lang="en">

<head>
    <title>New Entry - Little Smart Day Care Centre</title>

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
        
        <a href="roster.html">Go Back</a>

        <section>
            <div class="container">
                <div class="container section-title ">
                    <h1>New Entry</h1>
                </div>
                
                <form method="POST" enctype="multipart/form-data">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 form-label">
                                <label for="name"><b>Name</b></label>
                                <input type="text" id="name" name="name" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-label">
                                <label for="age"><b>Age</b></label>
                                <input type="age" id="age" name="age" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-label">
                                <label for="telno"><b>Phone Number</b></label>
                                <input type="telno" id="telno" name="telno" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-label">
                                <label for="school"><b>School</b></label>
                                <input type="school" id="school" name="school" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-label">
                                <label for="standard"><b>Standard</b></label>
                                <select type="standard" id="standard" name="standard" class="form-select" required>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-label">
                                <label for="mandarin"><b>Mandarin</b></label>
                                <input type="mandarin" id="mandarin" name="mandarin" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-label">
                                <label for="english"><b>English</b></label>
                                <input type="english" id="english" name="english" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-label">
                                <label for="malay"><b>Malay</b></label>
                                <input type="malay" id="malay" name="malay" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-label">
                                <label for="math"><b>Mathematics</b></label>
                                <input type="math" id="math" name="math" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-label">
                                <label for="science"><b>Science</b></label>
                                <input type="science" id="science" name="science" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7">
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <input type="submit" value="Add Entry" class="btn btn-primary">
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