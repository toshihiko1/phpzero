<?php
function gengo($year) {
    if(1868 <= $year && $year <= 1911) {
        $year = '明治';
    }
    if(1912 <= $year && $year <= 1925) {
        $year = '大正';
    }
    if(1926 <= $year && $year <=1988) {
        $year = '昭和';
    }
    if(1989 <= $year) {
        $year = '平成';
    }
    return $year;
}

function sanitize($before) {
    foreach($before as $key => $value) {
        $after[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }
    return $after;

}


?>