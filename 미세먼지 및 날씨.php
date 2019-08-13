<?php
include_once 'simple_html_dom.php';
function file_get_contents_curl($url) {
    $chrl = curl_init();
    curl_setopt($chrl, CURLOPT_URL, $url);
    curl_setopt($chrl, CURLOPT_HEADER, 0);
    curl_setopt($chrl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($chrl, CURLOPT_SSL_VERIFYPEER, false); // https 일때 이 한줄 추가 필요
    //Set curl to return the data instead of printing it to the browser.
    $data = curl_exec($chrl);
    curl_close($chrl);
    return $data;
}

$url = "https://search.naver.com/search.naver?sm=tab_hty.top&where=nexearch&query=천안+미세먼지&oquery=전국미세먼지&tqi=US54Ilp0J1ZssjB8yelssssssVV-343002";

$str = file_get_contents_curl($url);
$enc = mb_detect_encoding($str, array('EUC-KR', 'UTF-8', 'shift_jis', 'CN-GB'));
if ($enc != 'UTF-8') {
    $str = iconv($enc, 'UTF-8', $str);
}

//print_r($str);

$html = new simple_html_dom(); // Create a DOM object
$html->load($str); // Load HTML from a string


$item = $html->find('div[class=weather_box]',0)->plaintext;
echo $item.'<br />';

echo $item =  '미세먼지 농도(㎍/㎥): ';
$item = $html->find('div[class=detail_info lv1]',0)->find('em',0)->plaintext;
echo $item.'<br />';


echo $item =  '평균 미세먼지 농도(㎍/㎥): ';
$item = $html->find('div[class=detail_info lv1]',0)->find('em',1)->plaintext;
echo $item.'<br />';

$item = $html->find('div[class=all_state]',0)->find('li',0)->plaintext;
echo $item.'<br />';

$item = $html->find('div[class=all_state]',0)->find('li',1)->plaintext;
echo $item.'<br />';

$item = $html->find('div[class=all_state]',0)->find('li',2)->plaintext;
echo $item.'<br />';

$item = $html->find('div[class=all_state]',0)->find('li',3)->plaintext;
echo $item.'<br />';

$item = $html->find('div[class=all_state]',0)->find('li',4)->plaintext;
echo $item.'<br />';

$item = $html->find('div[class=all_state]',0)->find('li',5)->plaintext;
echo $item.'<br />';

?>
