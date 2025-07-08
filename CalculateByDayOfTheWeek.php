<?php
require_once("CalculateAverageHours.php");
require("FindNextLoginHour.php");
require("CalculateLatestHour.php");

function CalculateByDayOfTheWeek($timestamps)
{
    $estimatedTime = null;
    $weekNumber = 1;
    $result = [];
    //Bugünün gün numarası alınır.
    $todaysWeakNumber = date('N');
    $now = new DateTime('now', new DateTimeZone('UTC'));
    $today = DateTime::createFromFormat('H:i:s', $now->format('H:i:s'));

    $mondays = [];
    $tuesdays = [];
    $wednesdays = [];
    $thursdays = [];
    $fridays = [];
    $saturdays = [];
    $sundays = [];

    //Haftanın günlerine göre tarihler filtreleniyor.
    foreach ($timestamps as $timestamp) {
        $date = new DateTime($timestamp, new DateTimeZone('UTC'));
        $weekNumber = (int) $date->format('N');
        switch ($weekNumber) {
            case 1:
                $mondays[] = $timestamp;
                break;
            case 2:
                $tuesdays[] = $timestamp;
                break;
            case 3:
                $wednesdays[] = $timestamp;
                break;
            case 4:
                $thursdays[] = $timestamp;
                break;
            case 5:
                $fridays[] = $timestamp;
                break;
            case 6:
                $saturdays[] = $timestamp;
                break;
            case 7:
                $sundays[] = $timestamp;
                break;
        }
    }


    $weekNumber = $todaysWeakNumber;
    //İşlem devam ediyorsa döngü devam edebilmesi için variable ataması yapılıyor.
    $proccesInProgres = true;
    $counter = 0;
    //Eğer sonraki güne geçilmişse hesaplamada bunu dahil edebilmek için variable ataması yapılıyor.
    $jumpedNextDay = false;

    //Gün içerisinde geçmiş kayıtlı bir girişi bulunmuyorsa sonraki güne geçilerek hesaplanıyor. (case içerisindeki if bulunmasının amacı)
    //Gün içerisinde geçmiş kayıtlı bir giriş olmasına rağmen geçmiş giriş saatleri geçilmiş ise sonraki güne geçilerek hesaplanıyor. (case içerisindeki elseif bulunmasının amacı)
    while ($proccesInProgres) {
        //Bir hatadan dolayı döngü sonsuz bir şekilde devam edememesi için önlem alınıyor.
        if ($counter > 60) {
            $proccesInProgres = false;
        }
        switch ($weekNumber) {
            case 1:
                if (empty($mondays)) {
                    $weekNumber += 1;
                    $counter += 1;
                } elseif ($jumpedNextDay) {
                    $estimatedTime = FindEarliestHour($mondays);
                    $proccesInProgres = false;
                } elseif ($today > FindLatestHour($mondays)) {
                    $weekNumber += 1;
                    $counter += 1;
                } else {
                    $estimatedTime = FindNextHour($mondays);
                    $proccesInProgres = false;
                }
                break;
            case 2:
                if (empty($tuesdays)) {
                    $weekNumber += 1;
                    $counter += 1;
                } elseif ($jumpedNextDay) {
                    $estimatedTime = FindEarliestHour($tuesdays);
                    $proccesInProgres = false;
                } elseif ($today > FindLatestHour($tuesdays)) {
                    $weekNumber += 1;
                    $counter += 1;
                } else {
                    $estimatedTime = FindNextHour($tuesdays);
                    $proccesInProgres = false;
                }
                break;
            case 3:
                if (empty($wednesdays)) {
                    $weekNumber += 1;
                    $counter += 1;
                } elseif ($jumpedNextDay) {
                    $estimatedTime = FindEarliestHour($wednesdays);
                    $proccesInProgres = false;
                } elseif ($today > FindLatestHour($wednesdays)) {
                    $weekNumber += 1;
                    $counter += 1;
                } else {
                    $estimatedTime = FindNextHour($wednesdays);
                    $proccesInProgres = false;
                }
                break;
            case 4:
                if (empty($thursdays)) {
                    $weekNumber += 1;
                    $counter += 1;
                } elseif ($jumpedNextDay) {
                    $estimatedTime = FindEarliestHour($thursdays);
                    $proccesInProgres = false;
                } elseif ($today > FindLatestHour($thursdays)) {
                    $weekNumber += 1;
                    $counter += 1;
                } else {
                    $estimatedTime = FindNextHour($thursdays);
                    $proccesInProgres = false;
                }
                break;
            case 5:
                if (empty($fridays)) {
                    $weekNumber += 1;
                    $counter += 1;
                } elseif ($jumpedNextDay) {
                    $estimatedTime = FindEarliestHour($fridays);
                    $proccesInProgres = false;
                } elseif ($today > FindLatestHour($fridays)) {
                    $weekNumber += 1;
                    $counter += 1;
                } else {
                    $estimatedTime = FindNextHour($fridays);
                    $proccesInProgres = false;
                }
                break;
            case 6:
                if (empty($saturdays)) {
                    $weekNumber += 1;
                    $counter += 1;
                } elseif ($jumpedNextDay) {
                    $estimatedTime = FindEarliestHour($saturdays);
                    $proccesInProgres = false;
                } elseif ($today > FindLatestHour($saturdays)) {
                    $weekNumber += 1;
                    $counter += 1;
                } else {
                    $estimatedTime = FindNextHour($saturdays);
                    $proccesInProgres = false;
                }
                break;
            case 7:
                if (empty($sundays)) {
                    $weekNumber = 1;
                    $counter += 1;
                } elseif ($jumpedNextDay) {
                    $estimatedTime = FindEarliestHour($sundays);
                    $proccesInProgres = false;
                } elseif ($today > FindLatestHour($sundays)) {
                    $weekNumber = 1;
                    $counter += 1;
                } else {
                    $estimatedTime = FindNextHour($sundays);
                    $proccesInProgres = false;
                }
                break;
            default:
                $proccesInProgres = false;
                break;
        }
    }
    $result[] = $weekNumber;
    $result[] = $estimatedTime;
    return $result;
}
