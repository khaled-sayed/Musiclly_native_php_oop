<?php
if (isset($_POST['submit'])) {

    $mySong = $_FILES['song'];

    $songName = $mySong['name'];
    $songType = $mySong['type'];
    $songSize = $mySong['size'];
    $songName = $mySong['name'];
    $songTmp = $mySong['tmp_name'];
    $songError = $mySong['error'];


    $fileCount = count($songName);

    $errors = array();



    for ($i=0; $i < $fileCount; $i++) {

    $allowExtintion = array('mp3', 'ogg', 'flac');

    $allowFiles = in_array($songTmp[$i], $allowExtintion);

    $song_ex = explode('.', $songName[$i]);

    $song_exFi = strtolower(end($song_ex));

        if ($songError[$i] == 4) {
            
            $errors[] = "Soory Is empty";
        }
        if (in_array($song_exFi, $allowExtintion)) {
            
            echo "Very GOOD";
        } else {
            $errors[] = "So Bad";
        }

    if (!empty($errors)) {
        foreach ($errors as $err) {
            
            echo "<div>".$err."</div>";

        } 
    } else {

            move_uploaded_file($songTmp[$i], 'C:\xampp\htdocs\Musiclly\admin\uploads\\'.$songName[$i]);

            echo $songName[$i];
        }

}
}
?>
<form action="<?php echo $_SERVER['PHP_SELF']  ?>" method="POST" enctype="multipart/form-data">
    <input type="file" name="song[]" multiple>
    <input type="submit" name="submit">


</form>