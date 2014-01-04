<?php

date_default_timezone_set('asia/jakarta');

include 'simple_html_dom.php';
require_once('twitteroauth.php');
$now = date('G:i');
$html = file_get_html('http://www.jadwalsholat.org/adzan/ajax/ajax.daily1.php?id=307');
$file = "http://data.bmkg.go.id/cuaca_indo_1.xml";
$xml = simplexml_load_file($file);
$es = $html->find('tbody tr td');
$i = 0;
foreach ($es as $e) {
    $telo[$i] = $e->plaintext;
    $i++;
}

$consumerKey = 'lJvnGM8YrVXT2sRo5wJpw';
$consumerSecret = 'mZQLVhhWUlkYpYDUe33xinMCkrdIDUFAtWWEePXd3E';
$oAuthToken = '63434803-4tsxbVOuUl0mYJ7kyAQFYKWW5J32wGW4LtHIFlo0o';
$oAuthSecret = 'y3RJB4Y0fxDJOhQCRqLBd4bW0SKTl1HWVnV4PAOmZL06M';


$tweet = new TwitterOAuth($consumerKey, $consumerSecret, $oAuthToken, $oAuthSecret);

$status = rand(0, 100);
if ($now == date('G:i', strtotime($telo[4]))) {
    $tweet->post('statuses/update', array('status' => 'Subuh, bar iku njaluk imbuh'));
} elseif ($now == date('G:i', strtotime($telo[6]))) {
    $tweet->post('statuses/update', array('status' => 'Dhuhur, rolasan sik dus.. wedus ra tau adus!'));
} elseif ($now == date('G:i', strtotime($$telo[8]))) {
    $tweet->post('statuses/update', array('status' => 'Ashar sik , bar kuwi hajar kowe!!'));
} elseif ($now == date('G:i', strtotime($telo[10]))) {
    $tweet->post('statuses/update', array('status' => 'Maghrib , udah sore jo do nglembur yo'));
} elseif ($now == date('G:i', strtotime($telo[12]))) {
    $tweet->post('statuses/update', array('status' => 'Wes isya bro , leren sik '));
} else {
    foreach ($xml->children()->Isi->Row as $child) {
        if ($child->Kota == 'Yogyakarta') {
            $tweet->post('statuses/update', array('status' => 'Berita cuaca ' . $child->Kota . ' ' . $child->Cuaca . ' Suhu ' . $child->SuhuMin . '-' . $child->SuhuMax));
        }
    }
}
?>