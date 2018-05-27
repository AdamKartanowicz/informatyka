<!DOCTYPE html>
<html lang="pl">
<head>
    <title>Matfiz codzienny</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        .jumbotron {
            background: #5B4D35;
            color: black;
            background-size: cover;
            text-align: center;
            margin: 0 auto;
        }
        body {
            background: #E1D7C6;
            font-family: "Lucida Console";
        }
        .panel > .panel-heading {
            background-image: none;
            background-color: #A88D61;
            color: black;
            font-weight: bold;
        }
        .panel-body {
            background: #DBB87F;
        }
        .sekcja-text {
            margin-top: 20px;
            font-weight: bold;
            font-size: 24px;
        }
        input[type="text"], textarea {
            background-color : #ede4d5;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="jumbotron">
        <h1>MAT-FIZ</h1>
        <p>Publiczna ankieta na temat zachowania uczniów klasy mat-fiz</p>
    </div>
    <div class="sekcja">
        <p align="center" class="sekcja-text">Komentarze:</p>
    </div>

    <hr>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "2d_topo";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM matfiz";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo '<div class="panel panel-default"><div class="panel-heading"><strong>';
            echo  $row["name"];
            echo '</strong> skomentował  </div><div class="panel-body">';
            echo $row["text"];
            echo '</div></div>';
        }
    } else {
        echo "0 results";
    }
    $conn->close();
    ?>

    <form action="" method="post">
        <div class="form-group">
            <label>Imie:</label>
            <input type="text" class="form-control" placeholder="wpisz swoje imie" name="imie">
            <label>Komentarz:</label>
            <input type="text" class="form-control" placeholder="dodaj komentarz" name="komentarz">
        </div>
        <button type="submit" class="btn btn-succcess" name="send">Dodaj wpis</button>
    </form>


    <?php
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if(isset($_POST["send"])){
        $sql = "INSERT INTO matfiz (name,text)
        VALUES ('".$_POST["imie"]."','".$_POST["komentarz"]."')";

        if ($conn->query($sql) === TRUE) {
            header("Refresh:0");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
    ?>

</div>

</body>
</html>