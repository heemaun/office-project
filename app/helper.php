<?php

// function getRandomText($lenght)
// {
//     $chars = "qwerty uiop asdfg hjklz xcvbn mQWER TYUIO PASDF GHJKL ZXCVB NM123 45678 90";
//     $str = "";
//     for($x=0;$x<$lenght;$x++){
//         $str = $str . $chars[rand(0,strlen($chars)-1)];
//     }
//     $strs = explode(" ",$str);
//     $l = 0;
//     $count = 0;
//     $strlenSum = 0;
//     foreach($strs as $s){
//         if(strlen($s)>30){
//             $s = "";
//         }
//         $count++;
//         $strlenSum += strlen($s);
//         if(strlen($s)>$l){
//             $l = strlen($s);
//         }
//     }
//     $avg = $strlenSum/$count;
//     $data = ['max' => $l,'avg' => $avg];
//     return $data;
// }
function getRandomText($lenght)
{
    $chars = "qwerty uiop asdfg hjklz xcvbn mQWER TYUIO PASDF GHJKL ZXCVB NM123 45678 90";
    $str = "";
    for($x=0;$x<$lenght;$x++){
        $str = $str . $chars[rand(0,strlen($chars)-1)];
    }
    return $str;
}
