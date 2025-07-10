# KULLANICI OTURUM TAHMIN SISTEMI
Algoritma-1
1. Algoritma kişinin geçmiş tüm giriş bilgilerinin saat ortalamasını alarak hesap yapıyor ve tahmini bir saat veriyor.
2. Eksikleri bu girişlerin hangi tarihler ve ne gibi diğer etkenlerden etkilendiğine bakmaksızın direkt olarak bir hesaba gidiyor.(Örn: Geçmiş tarihli bir giriş tahmini yapabilir.)

Algoritma-2
1. Giriş işlemlerini haftanın günlerine göre gruplayarak her gün için olasılığı kendi içerisinde hesaplıyor.
2. Eğer bir gün içerisinde geçmiş günlerde giriş yaptığı saatler geçmiş ise sonraki gün geçmişte girdiği en son zaman tahmin olarak veriliyor.
3. Bir algoritmik hata bulunmakta sonraki girişi tahmin ederken bugünü değil son girişi baz alması gerekirken bugünü baz aldığı için sonuçlar yanlış çıkıyor.

Frontend
Frontend olarak hızlı bir şekilde yapabilmek için php tercih ettim ve bir tablo oluşturdum gelecek geliştirmelerde filtreleme gibi özellikler eklenmesi gerekiyor.
Ayrıca daha kullanıcı dostu bir tasarım oluşturabilmek adına php yerine farklı bir frameworke geçilmesi gerekiyor.
