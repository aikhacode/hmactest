<?php
$data = [
    'title' => 'Test credit baru #test123',
    'credit' => 500,
    'status' => 'paid',
    'id_bill' => '10152',
    'user_email' => 'aikhacomp@gmail.com'
];

$url = "http://localhost:8788/api/v1/paymenizer/bill";


$no = 0;
$temp = [];
for ($i = 1; $i <= 100; $i++) {
    $secret_key = '7Wd#SFV@N9^!DSf3P';
    $json_data = json_encode($data);
    $signature = hash_hmac('sha256', $json_data, $secret_key);
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $json_data,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'X-HMAC-Signature: ' . $signature,
        ),
    ));

    $result = curl_exec($curl);
    $tmp = json_decode($result,true);
    if ($tmp['msg']==='TRUE')
        echo $i . "=> (hash = signature): " . $tmp['msg'] . PHP_EOL;
    curl_close($curl);
   
}




