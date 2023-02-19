<?php

include "connect.php";

$sessionId = $_POST["sessionId"];
$serviceCode = $_POST["serviceCode"];
$phoneNumber = $_POST["phoneNumber"];
$text = $_POST["text"];
$text_arguments = explode("*", $text);

if ($text === "") {
    echo "CON " . "Enter your county of residence";

} else if (count($text_arguments) === 1) {
    echo "CON " . "
    HWRC\n
    1. Human wildlife conflict
    2. Deforestation
    3. Make claim
    4. FAQs
    5. Report officer
    ";
} else if ($text_arguments[1] === "1" && count($text_arguments) === 2) {
    echo "CON " . "1. Poaching
    2. Marauding elephants
    3. Hyena attack
    4. Lion attack";

} else if (
    ($text_arguments[1] === "1" && $text_arguments[2] === "1") ||
    ($text_arguments[1] === "1" && $text_arguments[2] === "2") ||
    ($text_arguments[1] === "1" && $text_arguments[2] === "3") ||
    ($text_arguments[1] === "1" && $text_arguments[2] === "4")
) {
    echo "END " . "Thank you, report made to KWS. Help is on the way.";
} else if ($text_arguments[1] === "2" && count($text_arguments) === 2) {
    echo "CON " . "1. Illegal logging
    2. Burning Charcoal
    ";
} else if ($text_arguments[1] === "2" && $text_arguments[2] === "1") {
    echo "END " . "Thank you, illegal logging report made to KWS";
} else if ($text_arguments[1] === "2" && $text_arguments[2] === "2") {
    echo "END " . "Thank you, burning charcoal report made to KWS and KFS";
} else if ($text_arguments[1] === "3" && count($text_arguments) === 2) {
    echo "CON " . "Compensation for loss of livestock
    1. 1 - 10
    2. 11 - 20
    3. 21 - 40
    4. Over 50";

} else if (
    ($text_arguments[1] === "3" && $text_arguments[2] === "1") ||
    ($text_arguments[1] === "3" && $text_arguments[2] === "2") ||
    ($text_arguments[1] === "3" && $text_arguments[2] === "3") ||
    ($text_arguments[1] === "3" && $text_arguments[2] === "4")
) {
    echo "END " . "Claim for compensation made to KWS";

} else if ($text_arguments[1] === "4" && count($text_arguments) === 2) {
    echo "CON " . "1. Which number do I call in case of of a wild animal attack?\n
    2. Which number do I call in case of a forest fire?";
} else if ($text_arguments[1] === "4" && $text_arguments[2] === "1") {
    echo "END " . "The KWS hotline is 0800597000";
} else if ($text_arguments[1] === "4" && $text_arguments[2] === "2") {
    echo "END " . "The KFS hotline is 08002212323";
} else if ($text_arguments[1] === "5" && count($text_arguments) === 2) {
    echo "CON " . "Select a reason for filing the report.
    1. Asking for bribes
    2. Extortion to approve claims
    3. Professional misconduct";
} else if (
    ($text_arguments[1] === "5" && $text_arguments[2] === "1" && count($text_arguments) === 3) ||
    ($text_arguments[1] === "5" && $text_arguments[2] === "2" && count($text_arguments) === 3) ||
    ($text_arguments[1] === "5" && $text_arguments[2] === "3" && count($text_arguments) === 3)
) {
    echo "CON " . "Enter the officer's name";
} else if ($text_arguments[1] === "5" && count($text_arguments) === 4) {
    // Since text_arguments is a string containing the first name and last name separated by a space
    $names_array = explode(" ", $text_arguments[3]);
    if ($names_array && count($names_array) === 2) {
        $officer_first_name = $names_array[0];
        $officer_second_name = $names_array[1];
        $table = "kws_officer";
        $result = $mysqli->query("SELECT * FROM $table 
        WHERE officer_first_name = '$officer_first_name' 
        AND officer_second_name = '$officer_second_name'");

        $result_array = $result->fetch_assoc();
        $reason_number = $text_arguments[2];

        if ($result_array) {
            $officer_details = officerDetails($result_array, $reason_number);
            echo "CON " . "Officer found!\n" . "$officer_details
            Press 1 to confirm, press 2 to cancel.";
        } else {
            echo "END " . "Officer not found. Please confirm whether the officer name was entered correctly.";
        }
    } else {
        echo "END " . "Incorrect format. Please enter the first name and second name, separated by a space";
    }

} else if (count($text_arguments) === 5) {
    $choice = $text_arguments[4];
    switch ($choice) {
        case "1":
            echo "END " . "Officer reported";
            break;
        case "2":
            echo "END " . "Cancelled the operation";
            break;
        default:
            echo "END " . "Invalid choice";
    }
} else {
    echo "END " . "Invalid choice";
}
$mysqli->close();


header("content-type: text/plain");
?>