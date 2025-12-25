<?php
if(!defined("HLXGUVENLIK"))
	exit('OLDU');
$itemler=[
    1=>["type"=>1,"item"=>"Farkındalık Kaskı","aciklama"=>"+% 15 daha fazla deneyim."],
    2=>["type"=>1,"item"=>"Aydınlanma Miğferi","aciklama"=>"+% 20 daha fazla deneyim."],
    3=>["type"=>1,"item"=>"Bilgelik Miğferi","aciklama"=>"+% 25 daha fazla deneyim."],
    4=>["type"=>1,"item"=>"Rejenerasyon Kaskı","aciklama"=>"+ 10 sağlık puanı / gün"],
    5=>["type"=>1,"item"=>"Sağlık Kaskı","aciklama"=>"+ 15 sağlık puanı / gün"],
    6=>["type"=>1,"item"=>"Helmet of Healing","aciklama"=>"+ 20 sağlık puanı / gün"],
    7=>["type"=>1,"item"=>"Gladyatörün Kaskı","aciklama"=>"+ 100 Kültür Puanı / gün"],
    8=>["type"=>1,"item"=>"Tribün Başlığı","aciklama"=>"+ 400 Kültür Puanı / gün"],
    9=>["type"=>1,"item"=>"Konsolos Kaskı","aciklama"=>"+ 800 Kültür Puanı / gün"],
    10=>["type"=>1,"item"=>"Süvari Kaskı","aciklama"=>"Sabit modda eğitim süresi% 10 azaltıldı"],
    11=>["type"=>1,"item"=>"Süvari Miğferi","aciklama"=>"Sabit modda eğitim süresi% 15 azaltıldı"],
    12=>["type"=>1,"item"=>"Ağır Süvari Miğferi","aciklama"=>"Sabit modda eğitim süresi% 20 azaltıldı"],
    13=>["type"=>1,"item"=>"Paralı Asker Miğferi","aciklama"=>"Kışlalarda eğitim süresi% 10 azaltıldı"],
    14=>["type"=>1,"item"=>"Savaşçının Miğferi","aciklama"=>"Kışlalarda eğitim süresi% 15 azaltıldı"],
    15=>["type"=>1,"item"=>"Archon'un Miğferi","aciklama"=>"Kışlalarda eğitim süresi% 20 azaltıldı"],
    82=>["type"=>2,"item"=> "Yenilenme Zırhı","aciklama"=> "+ günde 20 sağlık puanı yenilenmesi"],
    83=>["type"=>2,"item"=> "Sağlık Zırhı","aciklama"=> "+ günde 30 sağlık puanı yenilenmesi"],
    84=>["type"=>2,"item"=> "İyileştirme Zırhı","aciklama"=> "+ günde 40 sağlık puanı yenilenmesi"],
    85=>["type"=>2,"item"=> "Hafif ölçekli Zırh","aciklama"=> "Hasar 4 sağlık puanı + 10 SP yenilenmesi azaldı"],
    86=>["type"=>2,"item"=> "Ölçek Zırhı","aciklama"=> "Hasar 6 sağlık puanı + 15 SP yenilenmesi azaldı"],
    87=>["type"=>2,"item"=> "Ağır Ölçekli Zırh","aciklama"=> "Hasar 8 sağlık puanı + 20 SP yenilenmesi azaldı"],
    88=>["type"=>2,"item"=> "Hafif Göğüs plakası","aciklama"=> "Kahraman için + 500 dövüş gücü"],
    89=>["type"=>2,"item"=> "Göğüs plakası","aciklama"=> "Kahraman için + 1000 dövüş gücü"],
    90=>["type"=>2,"item"=> "Ağır Göğüs plakası","aciklama"=> "+ 1500 Kahraman için dövüş gücü"],
    91=>["type"=>2,"item"=> "Hafif Parçalı zırh","aciklama"=> "Hasar 3 azaltıldı; Kahraman için +250 dövüş gücü"],
    92=>["type"=>2,"item"=> "Parçalı zırh","aciklama"=> "Hasar 4 azaltıldı; Kahraman için +500 dövüş gücü"],
    93=>["type"=>2,"item"=> "Heavy Segmented-armor","aciklama"=> "Hasar 5 azaltıldı; Kahraman için +750 dövüş gücü"],
    61=>["type"=>3,"item"=>"Küçük Harita","aciklama"=>"% 30 daha hızlı getiri"],
    62=>["type"=>3,"item"=>"Harita","aciklama"=>"% 40 daha hızlı getiri"],
    63=>["type"=>3,"item"=>"Büyük Harita","aciklama"=>"% 50 daha hızlı dönüş"],
    64=>["type"=>3,"item"=>"Küçük Flama","aciklama"=>"kendi köyleri arasında% 30 daha hızlı asker"],
    65=>["type"=>3,"item"=>"Flama","aciklama"=>"kendi köyleri arasında% 40 daha hızlı asker"],
    66=>["type"=>3,"item"=>"Büyük Flama","aciklama"=>"kendi köyleri arasında% 50 daha hızlı asker"],
    67=>["type"=>3,"item"=>"Küçük Standart","aciklama"=>"İttifak üyeleri arasında% 15 daha hızlı asker"],
    68=>["type"=>3,"item"=>"Standart","aciklama"=>"İttifak üyeleri arasında% 20 daha hızlı asker"],
    69=>["type"=>3,"item"=>"Büyük Standart","aciklama"=>"İttifak üyeleri arasında% 25 daha hızlı asker"],
    73=>["type"=>3,"item"=>"Hırsızın Kesesi","aciklama"=>"+% 10 yağma bonusu"],
    74=>["type"=>3,"item"=>"Hırsızın Çantası","aciklama"=>"+% 15 yağma bonusu"],
    75=>["type"=>3,"item"=>"Hırsızın Torbası","aciklama"=>"+% 20 yağma bonusu"],
    76=>["type"=>3,"item"=>"Küçük kalkan","aciklama"=>"+ 500 kahraman gücü"],
    77=>["type"=>3,"item"=>"Kalkan","aciklama"=>"+ 1000 kahraman gücü"],
    78=>["type"=>3,"item"=>"Büyük kalkan","aciklama"=>"+ 1500 kahraman gücü"],
    79=>["type"=>3,"item"=>"Yerli'nin Küçük Boynuzu","aciklama"=>"Natarlara karşı +% 20 savaş gücü"],
    80=>["type"=>3,"item"=>"Yerli Boynuzu","aciklama"=>"Natarlara karşı +% 25 savaş gücü"],
    81=>["type"=>3,"item"=>"Natar'ın büyük boynuzu","aciklama"=>"Natarlara karşı +% 30 savaş gücü"],
    16=>["type"=>4,"item"=>"Lejyonerin Kısa Kılıcı","aciklama"=>"+ 500'den kahraman gücüne Her Lejyoner için: +3 saldırı ve +3 savunma"],
    17=>["type"=>4,"item"=>"Lejyoner Kılıcı","aciklama"=>"+ 1000'den kahraman gücü Her Lejyoner için: +4 saldırı ve +4 savunma"],
    18=>["type"=>4,"item"=>"Lejyonerin Uzun Kılıcı","aciklama"=>"+ 1500'den kahraman gücüne Her Lejyoner için: +5 saldırı ve +5 savunma"],
    19=>["type"=>4,"item"=>"Praetorian'ın Kısa Kılıcı","aciklama"=>"+ 500'den kahraman gücüne Her Praetorian için: +3 saldırı ve +3 savunma"],
    20=>["type"=>4,"item"=>"Praetorian Kılıcı","aciklama"=>"+ 1000'den kahraman gücüne Her Praetorian için: +4 saldırı ve +4 savunma"],
    21=>["type"=>4,"item"=>"Praetorian'ın Uzun Kılıcı","aciklama"=>"+ 1500'den kahraman gücüne Her Praetorian için: +5 saldırı ve +5 savunma"],
    22=>["type"=>4,"item"=>"Imperian'ın Kısa Kılıcı","aciklama"=>"+ 500'den kahraman gücüne Her İmparatorluk için: +3 saldırı ve +3 savunma"],
    23=>["type"=>4,"item"=>"İmparatorun Kılıcı","aciklama"=>"+ 1000'den kahraman gücüne Her İmparatorluk için: +4 saldırı ve +4 savunma"],
    24=>["type"=>4,"item"=>"İmparatorun Uzun Kılıcı","aciklama"=>"+ 1500'den kahraman gücüne Her İmparatorluk için: +5 saldırı ve +5 savunma"],
    25=>["type"=>4,"item"=>"Imperatoris'in Kısa Kılıcı","aciklama"=>"+ 500'den kahraman gücüne Her Equites Imperatoris için: +9 saldırı ve +9 savunma"],
    26=>["type"=>4,"item"=>"Imperatoris'in Kılıcı","aciklama"=>"+ 1000'den kahraman gücü Her Equites Imperatoris için: +12 saldırı ve +12 savunma"],
    27=>["type"=>4,"item"=>"Imperatoris'in Uzun Kılıcı","aciklama"=>"+ 1500'den kahraman gücüne Her Equites Imperatoris için: +15 saldırı ve +15 savunma"],
    28=>["type"=>4,"item"=>"Sezarilerin Hafif Mızrağı","aciklama"=>"+ 500'den kahraman gücüne Her Equites Caesaris için: +12 saldırı ve +12 savunma"],
    29=>["type"=>4,"item"=>"Sezarilerin Mızrağı","aciklama"=>"+ 1000'den kahraman gücü Her Equites Caesaris için: +16 saldırı ve +16 savunma"],
    30=>["type"=>4,"item"=>"Sezarilerin Ağır Mızrağı","aciklama"=>"+ 1500'den kahraman gücüne Her Equites Caesaris için: +20 saldırı ve +20 savunma"],
    31=>["type"=>4,"item"=>"Falanks Mızrağı","aciklama"=>"+ 500'den kahraman gücüne Her Phalanx için: +3 saldırı ve +3 savunma"],
    32=>["type"=>4,"item"=>"Falanks'ın Kargası","aciklama"=>"+ 1000'den kahraman gücüne Her Phalanx için: +4 saldırı ve +4 savunma"],
    33=>["type"=>4,"item"=>"Falanks Mızrağı","aciklama"=>"+ 1500'den kahraman gücüne Her Phalanx için: +5 saldırı ve +5 savunma"],
    34=>["type"=>4,"item"=>"Kılıç Ustasının Kısa Kılıcı","aciklama"=>"+ 500'den kahraman gücüne Her Kılıçlı İçin: +3 saldırı ve +3 savunma"],
    35=>["type"=>4,"item"=>"Kılıç Ustasının Kılıcı","aciklama"=>"+ 1000'den kahraman gücüne Her Kılıçlı İçin: +4 saldırı ve +4 savunma"],
    36=>["type"=>4,"item"=>"Kılıç Ustasının Uzun Kılıcı","aciklama"=>"+ 1500'den kahraman gücüne Her Kılıçlı İçin: +5 saldırı ve +5 savunma"],
    37=>["type"=>4,"item"=>"Theutates'in Kısa Yayını","aciklama"=>"+ 500'den kahraman gücüne Her Theutates Thunder için: +6 saldırı ve +6 savunma"],
    38=>["type"=>4,"item"=>"Theutates Yayı","aciklama"=>"+ 1000'den kahraman gücü Her Theutates Thunder için: +8 saldırı ve +8 savunma"],
    39=>["type"=>4,"item"=>"Theutates'in Uzun Yayını","aciklama"=>"+ 1500'den kahraman gücüne Her Theutates Thunder için: +10 saldırı ve +10 savunma"],
    40=>["type"=>4,"item"=>"Druidrider Kadrosu","aciklama"=>"+ 500'den kahraman gücüne Her Druidrider için: +6 saldırı ve +6 savunma"],
    41=>["type"=>4,"item"=>"Druidrider'ın büyük kadrosu","aciklama"=>"+ 1000'den kahraman gücüne Her Druidrider için: +8 saldırı ve +8 savunma"],
    42=>["type"=>4,"item"=>"Druidrider'ın dövüş kadrosu","aciklama"=>"+ 1500'den kahraman gücüne Her Druidrider için: +10 saldırı ve +10 savunma"],
    43=>["type"=>4,"item"=>"Haeduan'ın Hafif Mızrağı","aciklama"=>"+ 500'den kahraman gücüne Her Haeduan için: +9 saldırı ve +9 savunma"],
    44=>["type"=>4,"item"=>"Haeduan'ın Mızrağı","aciklama"=>"+ 1000'den kahraman gücü Her Haeduan için: +12 saldırı ve +12 savunma"],
    45=>["type"=>4,"item"=>"Haeduan'ın Ağır Mızrağı","aciklama"=>"+ 1500'den kahraman gücüne Her Haeduan için: +15 saldırı ve +15 savunma"],
    46=>["type"=>4,"item"=>"Clubswinger Kulübü","aciklama"=>"+ 500'den kahraman gücüne Her Maceman için: +3 saldırı ve +3 savunma"],
    47=>["type"=>4,"item"=>"Sopalı Topuz","aciklama"=>"+ 1000'den kahraman gücüne Her Maceman için: +4 saldırı ve +4 savunma"],
    48=>["type"=>4,"item"=>"Clubswinger'ın sabah yıldızı","aciklama"=>"+ 1500'den kahraman gücüne Her Maceman için: +5 saldırı ve +5 savunma"],
    49=>["type"=>4,"item"=>"Mızrakçı Mızrağı","aciklama"=>"+ 500'den kahraman gücüne Her Spearman için: +3 saldırı ve +3 savunma"],
    50=>["type"=>4,"item"=>"Mızrakçının Başak","aciklama"=>"+ 1000'den kahraman gücü Her Mızrakçı için: +4 saldırı ve +4 savunma"],
    51=>["type"=>4,"item"=>"Mızrakçı Mızrağı","aciklama"=>"+ 1500'den kahraman gücüne Her Mızraklı için: +5 saldırı ve +5 savunma"],
    52=>["type"=>4,"item"=>"Baltacı Baltası","aciklama"=>"+ 500'den kahraman gücüne Her Axeman için: +3 saldırı ve +3 savunma"],
    53=>["type"=>4,"item"=>"Axeman'ın Baltası","aciklama"=>"+ 1000'den kahraman gücüne Her Axeman için: +4 saldırı ve +4 savunma"],
    54=>["type"=>4,"item"=>"Axeman'ın Savaş Baltası","aciklama"=>"+ 1500'den kahraman gücüne Her Axeman için: +5 saldırı ve +5 savunma"],
    55=>["type"=>4,"item"=>"Paladin'in Hafif çekici","aciklama"=>"+ 500'den kahraman gücüne Her Paladin için: +6 saldırı ve +6 savunma"],
    56=>["type"=>4,"item"=>"Paladin'in Çekici","aciklama"=>"+ 1000'den kahraman gücüne Her Paladin için: +8 saldırı ve +8 savunma"],
    57=>["type"=>4,"item"=>"Paladin'in ağır çekici","aciklama"=>"+ 1500'den kahraman gücüne Her Paladin için: +10 saldırı ve +10 savunma"],
    58=>["type"=>4,"item"=>"Cermen Şövalyesinin Kısa Kılıcı","aciklama"=>"+ 500'den kahraman gücüne Her Töton Şövalyesi için: +9 saldırı ve +9 savunma"],
    59=>["type"=>4,"item"=>"Cermen Şövalyesinin Kılıcı","aciklama"=>"+ 1000'den kahraman gücü Her Töton Şövalyesi için: +12 saldırı ve +12 savunma"],
    60=>["type"=>4,"item"=>"Cermen Şövalyesinin Uzun Kılıcı","aciklama"=>"+ 1500'den kahraman gücüne Her Töton Şövalyesi için: +15 saldırı ve +15 savunma"],
    94=>["type"=>5,"item"=>"Yenileme Çizmeleri","aciklama"=>"+ 10 sağlık puanı / gün"],
    95=>["type"=>5,"item"=>"Sağlıklılık Çizmeleri","aciklama"=>"+ 15 sağlık puanı / gün"],
    96=>["type"=>5,"item"=>"İyileştirme Çizmeleri","aciklama"=>"+ 20 sağlık puanı / gün"],
    97=>["type"=>5,"item"=>"Paralı Asker Botları","aciklama"=>"+% 25 ordunun hızı"],
    98=>["type"=>5,"item"=>"Savaşçının Botları","aciklama"=>"+% 50 ordunun hızı"],
    99=>["type"=>5,"item"=>"Archon'un Çizmeleri","aciklama"=>"+% 75 ordunun hızı"],
    100=>["type"=>5,"item"=>"Küçük mahmuzlar","aciklama"=>"kahraman hızı +3"],
    101=>["type"=>5,"item"=>"Spurs","aciklama"=>"kahraman hızı +4"],
    102=>["type"=>5,"item"=>"Edepsiz mahmuzlar","aciklama"=>"kahraman hızı +5"],
    103=>["type"=>6,"item"=>"Gelding","aciklama"=>"Kahraman hızı 14"],
    104=>["type"=>6,"item"=>"Thoroughbred","aciklama"=> "Kahraman hızı 17"],
    105=>["type"=>6,"item"=>"Savaş Atı","aciklama"=> "Kahraman hızı 20'dir"],
    112=>["type"=>7,"item"=>"Küçük bandaj","aciklama"=> "İyileştirilebilir, maksimum% 25 İstiflenebilir"],
    113=>["type"=>8,"item"=>"Bandaj","aciklama"=> "İyileştirilebilir, maksimum% 33 İstiflenebilir"],
    114=>["type"=>9,"item"=>"Kafes","aciklama"=> " Hayvan istiflenebilir vahada yakalanabilir"],
    107=>["type"=>10,"item"=>"Kaydırma","aciklama"=> "kahraman 10'a İstiflenebilir deneyim verir"],
    106=>["type"=>11,"item"=>"Merhem","aciklama"=> "Kahramanı anında istiflenebilir% 1 iyileştirir"],
    108=>["type"=>12,"item"=>"Kova","aciklama"=> "Kahramanınızı anında yeniden başlatın"],
    110=>["type"=>13,"item"=>"Bilgelik Kitabı","aciklama"=> "Kahraman becerilerini yeniden dağıtır"],
    109=>["type"=>14,"item"=>"Hukuk Tableti","aciklama"=> "Köyde +% 1 sadakat, maksimum% 125 İstiflenebilir"],
    111=>["type"=>15,"item"=>"Yapıt","aciklama"=> "Anında CP miktarını verir, günlük üretime eşit, ancak 5000'den fazla İstiflenebilir"],
    115=>["type"=>4,"item"=>"köle milis çubuğu","aciklama"=>"kahramanın + 500 savaş yetkinliği; +3 saldırı bonusu + her köle milis için +3 savunma bonusu"],
    116=>["type"=>4,"item"=>"milis köle değnek asası","aciklama"=>"Kahramanın + 1000 savaş etkinliği; +4 saldırı bonusu + her köle milis için +4 savunma bonusu"],
    117=>["type"=>4,"item"=>"köle milis yıldızı","aciklama"=>"+ kahramanın 1500 savaş etkinliği; +5 saldırı bonusu + her köle milis için +5 savunma bonusu"],
    118=>["type"=>4,"item"=>"kül tutucu balta","aciklama"=>"Kahramanın + 500 savaş etkinliği; +3 saldırı bonusu, her Kül Kolcusu için +3 Savunma bonusu"],
    119=>["type"=>4,"item"=>"kül tutucu balta","aciklama"=>"+ 1000 Kahraman Savaşı Verimliliği; +4 Saldırı Bonusu + Her Kül Kolcusu için +4 Savunma Bonusu"],
    120=>["type"=>4,"item"=>"Ash Ranger Savaş Baltası","aciklama"=>"+ 1500 Kahramanın Silah Verimliliği; +5 Saldırı Bonusu + Her Kül Kolcusu için +5 Savunma Bonusu"],
    121=>["type"=>4,"item"=>"Savaşçının Kısa Khopesh","aciklama"=>"+ 500'den kahraman gücüne Her Khopesh Savaşçısı için: +3 saldırı ve +3 savunma"],
    122=>["type"=>4,"item"=>"Savaşçının Khopesh'i","aciklama"=>"+ 1000'den kahraman gücü Her Khopesh Savaşçısı için: +4 saldırı ve +4 savunma"],
    123=>["type"=>4,"item"=>"Savaşçının Uzun Khopesh","aciklama"=>"+ 1500'den kahraman gücüne Her Khopesh Savaşçısı için: +5 saldırı ve +5 savunma"],
    124=>["type"=>4,"item"=>"Anhor Muhafızının Mızrağı","aciklama"=>"+ 500'den kahraman gücüne Her Anhur Muhafızı için: +6 saldırı ve +6 savunma"],
    125=>["type"=>4,"item"=>"Anhor Muhafızının Mızrağı","aciklama"=>"+ 1000'den kahraman gücü Her Anhur Muhafızı için: +8 saldırı ve +8 savunma"],
    126=>["type"=>4,"item"=>"Anhor Muhafızlarının Mızrağı","aciklama"=>"+ 1500'den kahraman gücüne Her Anhur Muhafızı için: +10 saldırı ve +10 savunma"],
    127=>["type"=>4,"item"=>"Resheph Arabasının Kısa Pruvası","aciklama"=>"+ 500'den kahraman gücüne Her Resheph Chariot için: +9 saldırı ve +9 savunma"],
    128=>["type"=>4,"item"=>"Resheph Arabasının Yayı","aciklama"=>"+ 1000'den kahraman gücüne Her Resheph Chariot için: +12 saldırı ve +12 savunma"],
    129=>["type"=>4,"item"=>"Resheph Arabasının Uzun Pruvası","aciklama"=>"+ 1500'den kahraman gücüne Her Resheph Chariot için: +15 saldırı ve +15 savunma"],
    130=>["type"=>4,"item"=>"Paralı Asker Hatchet","aciklama"=>"+ 500'den kahraman gücüne Her Paralı Asker için: +3 saldırı ve +3 savunma"],
    131=>["type"=>4,"item"=>"Paralı Asker Baltası","aciklama"=>"+ 1000'den kahraman gücüne Her Paralı Asker için: +4 saldırı ve +4 savunma"],
    132=>["type"=>4,"item"=>"Paralı Asker Savaş Baltası","aciklama"=>"+ 1500'den kahraman gücüne Her Paralı Asker için: +5 saldırı ve +5 savunma"],
    133=>["type"=>4,"item"=>"Okçunun Kompozit Kısa Yayı","aciklama"=>"+ 500'den kahraman gücüne Her Okçu için: +3 saldırı ve +3 savunma"],
    134=>["type"=>4,"item"=>"Okçunun Kompozit Yayı","aciklama"=>"+ 1000'den kahraman gücüne Her Okçu için: +4 saldırı ve +4 savunma"],
    135=>["type"=>4,"item"=>"Okçunun Kompozit Uzun Yayı","aciklama"=>"+ 1500'den kahraman gücüne Her Okçu için: +5 saldırı ve +5 savunma"],
    136=>["type"=>4,"item"=>"Bozkır Binicisinin Kısa Spatha Kılıcı","aciklama"=>"+ 500'den kahraman gücüne Her Bozkır Sürücüsü için: +6 saldırı ve +6 savunma"],
    137=>["type"=>4,"item"=>"Bozkır Binicisinin Spatha Kılıcı","aciklama"=>"+ 1000'den kahraman gücüne Her Bozkır Sürücüsü için: +8 saldırı ve +8 savunma"],
    138=>["type"=>4,"item"=>"Bozkır Binicisinin Uzun Spatha Kılıcı","aciklama"=>"+ 1500'den kahraman gücüne Her Bozkır Sürücüsü için: +10 saldırı ve +10 savunma"],
    139=>["type"=>4,"item"=>"Nişancının Kompozit Kısa Yayı","aciklama"=>"+ 500'den kahraman gücüne Her Nişancı İçin: +6 saldırı ve +6 savunma"],
    140=>["type"=>4,"item"=>"Nişancının Kompozit Yayı","aciklama"=>"+ 1000'den kahraman gücüne Her Nişancı İçin: +8 saldırı ve +8 savunma"],
    141=>["type"=>4,"item"=>"Nişancının Kompozit Uzun Yayı","aciklama"=>"+ 1500'den kahraman gücüne Her Nişancı İçin: +10 saldırı ve +10 savunma"],
    142=>["type"=>4,"item"=>"Çapulcunun Kısa Spatha Kılıcı","aciklama"=>"+ 500'den kahraman gücüne Her Çapulcu için: +9 saldırı ve +9 savunma"],
    143=>["type"=>4,"item"=>"Çapulcunun Spatha Kılıcı","aciklama"=>"+ 500'den kahraman gücüne Her Çapulcu için: +12 saldırı ve +12 savunma"],
    144=>["type"=>4,"item"=>"Çapulcunun Uzun Spatha Kılıcı","aciklama"=>"+ 500'den kahraman gücüne Her Çapulcu için: +15 saldırı ve +15 savunma"],    
];

if(isset($_POST['acikArtirma'])){
    if(isset($itemler[$_POST['itemid']])){
        try{
            $item=$itemler[$_POST['itemid']];
            for($i=0;$i<$_POST['ekSay'];$i++){
                $database->query("INSERT INTO auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `newsilver`, `time`, `finish`) VALUES ('".$_POST['owner']."', '".(time()+$i)."', '".$item['type']."', '".$_POST['itemid']."', '".$_POST['num']."', 0, 0, '".$_POST['silver']."', 0, '".(time()+($_POST['sure']*60))."', 0)");
            }
            echo 'Açık Artırma İtemler Eklendi.';
        }catch(Exception $e){
            echo 'HATA : '.$e->getMessage();
        }
    }else{
        echo 'İtem bulunamadı!';
    }

}
$kullanicilar=$database->query('SELECT id,username FROM users');
?>
<form action="" method="post">
	<div class="form-group">
		<label>İTEM</label>
		<select class="custom-select mr-sm-2" name="itemid" required>
            <?php
                foreach($itemler as $k=>$v){
                    echo '<option value="'.$k.'">'.$v["item"].'-'.$v["aciklama"].'</option>';
                }
            ?>
		</select>
	</div>
	<div class="form-group">
		<label>Açık Artırma Fiyatı</label>
		<input type="number" step="1" name="silver" class="form-control" placeholder="100" required>
	</div>
	<div class="form-group">
		<label>Adet</label>
		<input type="number" step="1" name="ekSay" class="form-control" placeholder="5" required>
	</div>
	<div class="form-group">
		<label>Miktar</label>
		<input type="number" step="1" name="num" class="form-control" placeholder="5" required>
	</div>
	<div class="form-group">
		<label>Süre Dakika Cinsinden</label>
		<input type="number" step="1" name="sure" class="form-control" placeholder="5" required>
	</div>
	<div class="form-group">
		<label>Kullanıcı</label>
		<select class="custom-select mr-sm-2" name="owner" required>
			<?php
				foreach($kullanicilar as $kullanici){
					echo '<option value="'.$kullanici['id'].'">'.$kullanici['username'].'</option>';
				}
			?>
		</select>
	</div>
	<div class="form-group text-center">
		<input type="submit" class="btn btn-primary" name="acikArtirma" value="Açık Artırma Ekle">
	</div>
</form>