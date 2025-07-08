<?php
function FindNextHour($timestamps)
{

    $nowHour = new DateTime("now", new DateTimeZone("UTC"));
    $nowTimeHour = $nowHour->format("H:i:s");

    $baseDate = "1970-01-01";

    $nowTime = new DateTime("$baseDate $nowTimeHour");

    $next = null;

    //En yakın sonraki saati bulmak için karşılaştırma yapılıyor
    foreach ($timestamps as $timestamp) {
        $dtFull = new DateTime($timestamp);
        $timeStr = $dtFull->format("H:i:s");
        $dt = new DateTime("$baseDate $timeStr");

        if ($dt > $nowTime) {
            if ($next === null || $dt < $next) {
                $next = $dt;
            }
        }
    }
    
    return $next->format("H:i:s");;
}
