<?php include "includes/topinclude.php"; ?>
<div class="inhoud">
    <?php
    if (isset($_SESSION['username']))
    {
        require 'connection_database.php';

        $stringGetID = "SELECT * FROM Student WHERE gebruikerID = '{$_SESSION['id']}'";

        $result = mysqli_query($DBConnect, $stringGetID);
        $fetch = mysqli_fetch_assoc($result);
        $count = mysqli_num_rows($result);
        $studentnumber = $fetch['StudentNummer'];

        $string_cv = "SELECT * FROM cv WHERE StudentNummer = '$studentnumber'";
        $result2 = mysqli_query($DBConnect, $string_cv);
        $count2 = mysqli_num_rows($result2);
        if ($count2 == 1)
        {
            echo "hoi";
        } else
        {
            echo "Je hebt nog geen CV, Upload hem nu.";
            echo "<form enctype='multipart/form-data' action='#' method='post'><input type='file' name='upload' value='CV'> <input type='submit' name='submit' value='upload cv' ></form> ";
            if (isset($_POST['submit']))
            {
                if (empty($_FILES['upload']))
                {
                    echo "Je hebt geen bestand gekozen.";
                } else
                {
                    $query = "INSERT INTO cv (CV_ID,Link,StudentNummer) VALUES(NULL,'{$_SESSION['username']}','$studentnumber')";
                    mysqli_query($DBConnect, $query);
                    $target_path = "includes/CV/";

                    $target_path = $target_path . $_SESSION['username'] . substr(basename($_FILES['upload']['name']), strrpos(basename($_FILES['upload']['name']), "."), 5);

                    if (move_uploaded_file($_FILES['upload']['tmp_name'], $target_path))
                    {
                        
                    } else
                    {
                        echo "There was an error uploading the file, please try again!";
                    }
                }
            }
        }
    } else
    {
        echo "Je moet ingelogt zijn om een CV te kunnen uploaden en zien.";
    }
    ?>
</div>
<?php include "includes/botinclude.php"; ?>
            
