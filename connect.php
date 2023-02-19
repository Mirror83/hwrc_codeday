<?php
$mysqli = new mysqli();
$mysqli->connect("localhost", "root", "cementceiling", "hwcr");

if ($mysqli->connect_errno) {
    die("Could not connect to database");
}

function officerDetails($result_array, $reason_number)
{
    if ($reason_number === "1") {
        $reason = "asking for bribes";
    } else if ($reason_number === "2") {
        $reason = "extortion";
    } else if ($reason_number === "3") {
        $reason = "professional misconduct";
    } else {
        return "END " . "Invalid reason.";
    }
    return
        ("
Name: {$result_array['officer_first_name']} {$result_array['officer_second_name']}
Officer id: {$result_array['officer_number']}
Area of deployment: {$result_array['area_of_deployment']}
Officer rank: {$result_array['officer_rank']}\n
The officer with the above details will be reported to KWS and KFS for $reason.
");
}

?>