<?php

$file = fopen("list_code_r2.csv","r");
echo "<pre>";
global $wpdb;
$count = 0;
while (($record = fgetcsv($file)) !== FALSE) {
    echo ++$count;
    echo "<br>";
    print_r('ON'.$record[0]);
    echo "<br>";
//    $wpdb->insert(
//        'ruaxanh_event_code',
//        array(
//            'CODE' => 'ON'.$record[0],
//            'IS_SENT' => "N",
//        ));
//    return $wpdb->insert_id;
//    die();
}
fclose($file);
?>