
<?php


function imageUpload($image, $source = 'user')
{
    if ($image['error'] == 4) {
        $imgName = "user.jpg"; //for user defeault img
        $message = "No picture has been selected, you can edit later ";
        if ($source == 'animal') { //for animal defeault img
            $imgName = "defeault_animal.jpg";
        }
    } else {
        $checkingImg = getimagesize($image['tmp_name']);
        $message = $checkingImg ? "Success" : "Failed";
    }

    if ($message == "Success") {

        $extens = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
        $imgName = uniqid("") . "." . $extens;
        $destination = "../img/{$imgName}";
        if ($source == 'animal') {
            $destination = "../img/{$imgName}";
        }
        move_uploaded_file($image["tmp_name"], $destination);
    }
    return [$imgName, $message];
}
