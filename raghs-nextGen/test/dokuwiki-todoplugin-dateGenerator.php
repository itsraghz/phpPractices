<?php

/*
| :::   | :::      |  06    | Saturday  | [[diary:06.09.14|Diary on 06.09.14 Sat]]   |
| :::   | :::      |  07    | Sunday    | [[diary:07.09.14|Diary on 07.09.14 Sun]]   |
| :::   | :::      |  08    | Monday    | [[diary:08.09.14|Diary on 08.09.14 Mon]]   |
| :::   | :::      |  09    | Tuesday   | [[diary:09.09.14|Diary on 09.09.14 Tue]]   |
| :::   | :::      |  10    | Wednesday | [[diary:10.09.14|Diary on 10.09.14 Wed]]   |
| :::   | :::      |  11    | Thursday  | [[diary:11.09.14|Diary on 11.09.14 Thu]]   |
| :::   | :::      |  12    | Friday    | [[diary:12.09.14|Diary on 12.09.14 Fri]]   |
*/

//Todo Plugin Date Generation

$weekdayArray = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
$weekdayShortArray = array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun');

$monthArray = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
$monthShortArray = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');

$daysForMonthArray = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);

$year = '14';
$yearFull = '2014';
$month = 12; //non 0-based index
$weekdayStart = 0;

$diaryTxt = '';

$diaryTxtForDay = '';

for($i=1; $i <= $daysForMonthArray[$month-1]; $i++)
{
	$diaryTxtForDay =  "<pre>| :::   | :::      | ";

    $diaryTxtForDay =  "<pre>| ";

    if($i==1)
    {
        $diaryTxtForDay = $diaryTxtForDay .  $yearFull . "  | " . $monthShortArray[$month-1] . "      | " . "0".$i;
    }
    else if($i<10)
    {
        $diaryTxtForDay = $diaryTxtForDay .  ":::   | " . ":::      | " . "0".$i;
    }
    else
    {
        $diaryTxtForDay = $diaryTxtForDay .  ":::   | " . ":::      | " . $i;
    }

    $diaryTxtForDay = $diaryTxtForDay .  "   | "  . $weekdayArray[$weekdayStart];

	for($j=1; $j<= 10-strlen($weekdayArray[$weekdayStart]); $j++)
	{
		$diaryTxtForDay = $diaryTxtForDay . " ";
	}

	if(strlen($i) <= 1) {
		$i = "0" . $i;
	}

	if(strlen($month) <= 1 ) {
		$month = "0" . $month;
	}

	$diaryTxt = $i . "." . $month . "." . $year;

	$diaryTxtForDay .= "| [[diary:" . $diaryTxt . "|Diary on " . $diaryTxt . " " . 
		$weekdayShortArray[$weekdayStart] . "]]   |";

	$diaryTxtForDay .= "</pre>";

	echo $diaryTxtForDay;

	$diaryTxtForDay = '';

	if(++$weekdayStart > 6)
	{
		$weekdayStart = $weekdayStart % 7;
		//echo "<br/>\tweekdayStart :: " . $weekdayStart;
	}
}

?>