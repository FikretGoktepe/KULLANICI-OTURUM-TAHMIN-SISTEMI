<?php
require_once("CalculateAverageHours.php");
require("CalculateByDayOfTheWeek.php");


//Bugünün Tarihi
$today = new DateTime("now", new DateTimeZone("UTC"));
//Kullanıcı Profil Listesi
$UserProfile = [];

// CURL istedği oluşturularak API üzerinden veri alınıyor.
$ch = curl_init('https://case-test-api.humanas.io');

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPGET, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Accept: application/json'
]);

$response = curl_exec($ch);

//İstek sırasında bir hata oluşması durumunda hata mesajı yollanıyor.
if (curl_errno($ch)) {
    echo 'CURL Hatası: ' . curl_error($ch);
    curl_close($ch);
    exit;
}

//Curl kapatılıyor.
curl_close($ch);

$data = json_decode($response, true);

//Kullanıcıların giriş yaptıkları zamanlar arasındaki ortalama zaman farkı hesaplanıyor.
foreach ($data['data']['rows'] as $row) {
    $UserProfile[] = new User($row['id'], $row['name'], CalculateAverageHours($row['logins']), CalculateByDayOfTheWeek($row['logins']));
}

echo json_encode($UserProfile);
exit;

//User nesnesi tanımlanıyor.
class User
{
    public $id;
    public $name;
    public $averageHour1;
    public $averageHour2;

    public function __construct($_id, $_name, $_averageHour1, $_averageHour2)
    {
        $this->id = $_id;
        $this->name = $_name;
        $this->averageHour1 = $_averageHour1;
        $this->averageHour2 = $_averageHour2;
    }
}
