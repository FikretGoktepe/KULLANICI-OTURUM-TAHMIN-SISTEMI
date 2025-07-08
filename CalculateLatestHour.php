<?php
function FindLatestHour($_timestamps): DateTime
{
    $latestHour = null;

    foreach ($_timestamps as $ts) {
        //İşlem yapabilmek için variable oluşturuluyor
        $dateTime = new DateTime($ts, new DateTimeZone('UTC'));
        //Sadece saat verisi gerektiği için o şekilde formatlanıyor
        $time = $dateTime->format('H:i:s');

        $dateTimeHour = DateTime::createFromFormat('H:i:s', $time);

        //Basit bir if kontrolü ile büyük olan sürekli ana variable nesnesine atanarak en geç saat bulunuyor.
        if ($latestHour === null || $dateTimeHour > $latestHour) {
            $latestHour = $dateTimeHour;
        }
    }
    return $latestHour;
}
