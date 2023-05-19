<?php
session_start();
if ($_SESSION['auth'] !== true) {
    header('Location:index.php');
}
require 'db.php';
require 'table.php';
$table = new Table;
$db = new db;
$notes = $db->getNotes($_SESSION['chat_id']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>
    <div class="container d-flex flex-column">

        <nav class="navbar navbar-expand-lg navbar-light bg-light ">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#" style="text-decoration:line-through">My notes </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" style="text-decoration:line-through">Create a note</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" style="text-decoration:line-through">Set a reminder</a>
                    </li>
                    <li class='nav-item'>
                        <form method="POST" id="logout">
                            <button type="submit" class="btn btn-danger">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="workspace d-flex justify-content-around mt-3">

            <div>
                <form method="POST" id="note">
                    <div class="input-group">
                        <span class="input-group-text">Make a new note</span>
                        <textarea class="form-control" aria-label="With textarea" form="note" name="text"></textarea>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>

            <div>
                <form method="POST" id="reminder">
                    <div class="input-group mb-3 d-flex">
                        <div>
                            <select name="note_id" class="form-select" aria-label="Default select example">

                                <?php
                                $table->showNotesId($notes);
                                ?>

                            </select>
                            <input type="date" name="date" class="btn mt-2">
                            <input type="time" name="time" class="btn mt-2">
                            <button type="submit" class="btn btn-primary mt-2">Make a reminder</button>
                        </div>
                        <div></div>
                    </div>

                </form>
            </div>
        </div>

        <div class='list mt-3'>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Note</th>
                        <th scope="col">Reminder</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $table->showNotes($notes);
                    ?>

                </tbody>
            </table>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#logout').click(function() {
                $.ajax({
                    type: 'POST',
                    url: '/logout.php',
                    success: function() {
                        window.location.href = '/index.php';
                    }
                })
            });
            $('#note').submit(function(event) {
                event.preventDefault();
                let formData = $(this).serialize();
                $.ajax({
                    type: 'POST',
                    url: '/makeNote.php',
                    data: formData,

                    success: function() {
                        window.location.href = '/profile.php';
                    }
                })
            });
            $('#reminder').submit(function(event) {
                event.preventDefault();
                let formData = $(this).serialize();
                $.ajax({
                    type: 'POST',
                    url: '/makeReminder.php',
                    data: formData,

                    success: function() {
                        window.location.href = '/profile.php';
                    }
                })
            });
        })
    </script>
</body>

</html>