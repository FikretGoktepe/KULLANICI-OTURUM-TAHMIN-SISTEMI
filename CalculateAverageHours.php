<?php
function CalculateAverageHours($timestamps): String
{
    $today = new DateTime("now", new DateTimeZone("UTC"));
    
    $totalSeconds = 0;

    $count = count($timestamps);

    //Girişler arasındaki fark saniye bazında hesaplanıyor
    for ($i = 1; $i < $count; $i++) {
        $t1 = new DateTime($timestamps[$i - 1], new DateTimeZone("UTC"));
        $t2 = new DateTime($timestamps[$i], new DateTimeZone("UTC"));

        $diff = $t2->getTimestamp() - $t1->getTimestamp();
        $totalSeconds += $diff;
    }

    $averageSeconds = (int) round($totalSeconds / ($count - 1));

    //DateInterval olarak geriye ortalama süre yollanıyor.
    $start = new DateTime("@0");
    $end = new DateTime("@$averageSeconds");

    $today->add($start->diff($end));

    return $today->format('Y-m-d/H:i:s');
}
