<?php

declare(strict_types=1);

function readData()
{
    $keijban_file = __DIR__ . '/../cache/keijiban.txt';

    $fp = fopen($keijban_file, 'rb');

    if ($fp){
        if (flock($fp, LOCK_SH)){
            while (!feof($fp)) {
                $buffer = fgets($fp);
                print($buffer);
            }

            flock($fp, LOCK_UN);
        }else{
            print('ファイルロックに失敗しました');
        }
    }

    fclose($fp);
}

function writeData()
{
    $personal_name = $_POST['personal_name'];
    $contents = $_POST['contents'];
    $contents = nl2br($contents);
    $date = date("Y/m/d H:i:s", time()) . "\n";
    $IP = $_SERVER["REMOTE_ADDR"] ;

    $data = "<hr>";
    $data = $data."<p>IPアドレス：".$IP."</p>";
    $data = $data."<p>日時：".$date."</p>";
    $data = $data."<p>投稿者：".$personal_name."</p>";
    $data = $data."<p>内容：".$contents."</p>";

    $keijban_file = __DIR__ . '/../cache/keijiban.txt';

    $fp = fopen($keijban_file, 'ab');

    if ($fp){
        if (flock($fp, LOCK_EX)){
            if (fwrite($fp,  $data) === FALSE){
                print('ファイル書き込みに失敗しました');
            }

            flock($fp, LOCK_UN);
        }else{
            print('ファイルロックに失敗しました');
        }
    }

    fclose($fp);
}
