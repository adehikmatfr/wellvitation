<?php

function costumResponse($message, $data, $code, $status)
{
    $status === 0 ? $fild = "error" : $fild = "data";
    return [
        "message" => $message,
        $fild => $data,
        "status_code" => $code
    ]; 
}

function generateRandomString($length = 80)
{
    $karakkter = '012345678dssd9abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $panjang_karakter = strlen($karakkter);
    $str = '';
    for ($i = 0; $i < $length; $i++) {
        $str .= $karakkter[rand(0, $panjang_karakter - 1)];
    }
    return $str;
}

function sendWa($message, $phone)
{
    $curl = curl_init();
    $token = "aDOFtAIHYknv3BlrYPyiSwIyy26NVWE2uUrnxjZrhukVoL1HZuqQxSU4M7feWHkF";
    $data = [
        'phone' => $phone,
        'message' => $message,
    ];

    curl_setopt($curl, CURLOPT_HTTPHEADER,
        array(
            "Authorization: $token",
        )
    );
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($curl, CURLOPT_URL, "https://teras.wablas.com/api/send-message");
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    $result = curl_exec($curl);
    curl_close($curl);
    
    return $result;
}

function SendSms($message, $phone)
{
    $id = time();
    $curl = curl_init();
    $smsToken = smsToken();
    $js = json_decode($smsToken, true);
    $js = $js["jwt"];
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.sms.to/sms/send",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "{\n    \"message\": \"$message\",\n    \"to\": \"$phone\",\n    \"sender_id\": \"$id\",\n    \"callback_url\": \"https://sms.to/callback/handler\"\n}",
        CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            "Accept: application/json",
            "Authorization: Bearer $js"
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}

function smsToken()
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://auth.sms.to/oauth/token",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "{\n\t\"client_id\" : \"XV5875MAAfxsnHu7\",\n\t\"secret\": \"dsYP0KFO6ln1Dpn419DuRM88Nb8tuPGg\",\n\t\"expires_in\": 60\n}",
        CURLOPT_HTTPHEADER => array(
            "Accept: application/json",
            "Content-Type: application/json"
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}


function generateOrderCode(){
    $karakkter = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $panjang_karakter = strlen($karakkter);
    $str = '';
    for ($i = 0; $i < 4; $i++) {
        $str .= $karakkter[rand(0, $panjang_karakter - 1)];
    }
    return "WELLVI-".$str."-".date('dmY');
}