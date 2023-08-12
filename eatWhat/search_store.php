<?php

include 'database.php';
$conn = connection();

if ($conn->connect_error) {
    die("連接失敗" . $conn->connect_error);
}

$store_name = $_POST['store_name'];
// echo $store_name;

$sql = "SELECT * FROM `stores` WHERE `name` LIKE '%" . sprintf("%s", $store_name) . "%';";

$result = $conn->query($sql);
$row = $result->fetch_all();
// foreach ($row as $key => $value) {
//     echo "*" . $key . "*    ";
//     foreach ($value as $key2 => $value2) {
//         echo $key2 . ":" . $value2 . "   ";
//     }
//     echo "<br>";
// }

if ($result->num_rows > 0) {
    $arr="";
    foreach ($row as $key => $value) {
        foreach ($value as $key2 => $value2) {
            if ($value2 === null) {
                $row[$key][$key2] = "0";
            }
            $arr.=$row[$key][$key2]." ";
        }
    }
    echo $arr;
}
// elseif ($result->num_rows == 1) {
//     // foreach ($row as $key => $value) {
//     //     if ($value == 0) {
//     //         $row[$key] = "is_zero";
//     //     }
//     // }
//     $arr = json_encode($row, JSON_UNESCAPED_UNICODE);
//     echo $arr;
// }
else {
    echo "none";
}

// if ($result->num_rows > 0) {
//     foreach ($row as $key => $value) {
//         if ($value == 0) {
//             $row[$key] = "A,0";
//         }
//     }
//     if ($result->num_rows == 1) {
//         $r = array("name" => $row["name"], "open_time_hour" => $row["open_time_hour"], "open_time_minute" => $row["open_time_minute"], "closed_time_hour" => $row["closed_time_hour"], "closed_time_minute" => $row["closed_time_minute"], "closed_day" => $row["closed_day"]);
//         $arr = json_encode($r, JSON_UNESCAPED_UNICODE);
//         echo $arr;
//     }
//     if ($result->num_rows > 1) {
//         $arr = array();
//         $c_sr = count($row["name"]);
//         for ($i = 0; $i < $c_sr; $i += 1) {
//             $r = array("name" => $row["name"][$i], "open_time_hour" => $row["open_time_hour"][$i], "open_time_minute" => $row["open_time_minute"][$i], "closed_time_hour" => $row["closed_time_hour"][$i], "closed_time_minute" => $row["closed_time_minute"][$i], "closed_day" => $row["closed_day"][$i]);
//             $arr[$row["name"][$i]] = $r;
//         }
//         $arr = json_encode($arr, JSON_UNESCAPED_UNICODE);
//         echo $arr;
//     }
// } else {
//     echo "none";
// }

?>