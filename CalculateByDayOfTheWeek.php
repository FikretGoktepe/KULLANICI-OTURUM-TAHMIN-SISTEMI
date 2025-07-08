<?php
require_once("CalculateAverageHours.php");
require("CalculateLatestHour.php");

function CalculateByDayOfTheWeek($timestamps)
{
    $status = false;
    //Bugünün gün numarası alınır.
    $todaysWeekNumber = date('N');
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

    //İşlem devam ediyorsa döngü devam edebilmesi için variable ataması yapılıyor.
    $proccesInProgres = true;
    $counter = 0;

    //Gün içerisinde geçmiş kayıtlı bir girişi bulunmuyorsa sonraki güne geçilerek hesaplanıyor. (case içerisindeki if bulunmasının amacı)
    //Gün içerisinde geçmiş kayıtlı bir giriş olmasına rağmen geçmiş giriş saatleri geçilmiş ise sonraki güne geçilerek hesaplanıyor. (case içerisindeki elseif bulunmasının amacı)
    while ($proccesInProgres) {
        //Bir hatadan dolayı döngü sonsuz bir şekilde devam edememesi için önlem alınıyor.
        if ($counter > 13) {
            $proccesInProgres = false;
            $status = false;
        }
        switch ($todaysWeekNumber) {
            case 1:
                if (empty($mondays)) {
                    $weekNumber += 1;
                    $counter += 1;
                } elseif ($today > FindLatestHour($mondays)) {
                    $weekNumber += 1;
                    $counter += 1;
                } else {
                    
                }
                break;
            case 2:
                if (empty($tuesdays)) {
                    $weekNumber += 1;
                    $counter += 1;
                } elseif ($today > FindLatestHour($tuesdays)) {
                    $weekNumber += 1;
                    $counter += 1;
                } else {
                }
                break;
            case 3:
                if (empty($wednesdays)) {
                    $weekNumber += 1;
                    $counter += 1;
                } elseif ($today > FindLatestHour($wednesdays)) {
                    $weekNumber += 1;
                    $counter += 1;
                } else {
                }
                break;
            case 4:
                if (empty($thursdays)) {
                    $weekNumber += 1;
                    $counter += 1;
                } elseif ($today > FindLatestHour($thursdays)) {
                    $weekNumber += 1;
                    $counter += 1;
                } else {
                }
                break;
            case 5:
                if (empty($fridays)) {
                    $weekNumber += 1;
                    $counter += 1;
                } elseif ($today > FindLatestHour($fridays)) {
                    $weekNumber += 1;
                    $counter += 1;
                } else {
                }
                break;
            case 6:
                if (empty($saturdays)) {
                    $weekNumber += 1;
                    $counter += 1;
                } elseif ($today > FindLatestHour($saturdays)) {
                    $weekNumber += 1;
                    $counter += 1;
                } else {
                }
                break;
            case 7:
                if (empty($sundays)) {
                    $weekNumber = 1;
                    $counter += 1;
                } elseif ($today > FindLatestHour($sundays)) {
                    $weekNumber += 1;
                    $counter += 1;
                } else {
                }
                break;
            default:
                $proccesInProgres = false;
                $status = false;
                break;
        }
    }
}
