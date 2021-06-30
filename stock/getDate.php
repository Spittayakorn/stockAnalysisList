<?php
    header('Content-type: application/json; charset=UTF-8');
    //ตั้งค่าพื้นที่เวลา
	date_default_timezone_set("Asia/Bangkok");

	$today = getdate();
	//รับวัน-เดือน-ปี
	$day = $today["mday"];
	$month = $today["mon"];
	$year = $today["year"]+543;
	$years = $today["year"];
			
	$hour = $today["hours"];
	$minute = $today["minutes"];
	$second = $today["seconds"];

    $json_record = new stdClass();
	
	$json_record->day = $day;
	$json_record->month= $month;
	$json_record->year= $year;
	$json_record->years= $years;

	$json_record->hour= $hour;
	$json_record->minute= $minute;
	$json_record->second= $second;

	echo json_encode($json_record);
?>
