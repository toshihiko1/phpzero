<?php

$mbango = $_POST['mbango'];

$hoshi['M1'] = 'カニ星雲';
$hoshi['M31'] = 'アンドロ';
$hoshi['M42'] = 'オリオン';
$hoshi['M45'] = 'スバル';
$hoshi['M57'] = 'ドナドナ';

foreach($hoshi as $key => $val) {
    print $key. 'は' . $val;
    print '<br/>';
}

print 'あなたが選んだ星は';
print $hoshi[$mbango];

?>