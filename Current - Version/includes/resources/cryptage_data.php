<?php

function EncodeMultiDatas(array $data)
{
    $tabData = array();
    for ($i = 0; $i < sizeof($data); $i++) {
        $tabData[$i] =  base64_encode($data[$i]);
    }
    return $tabData;
}

function EncodeData($data)
{
    $encodeData = base64_encode($data);
    return $encodeData;
}

function CryptagePassword($pass)
{
    $password = password_hash($pass, PASSWORD_BCRYPT);
    return $password;
}

function CryptageEmail($email)
{
    $hashed_email = crypt($email, '$5$');

    if (hash_equals($hashed_email, crypt($hashed_email, '$5$'))) {
        return -1;
    } else {
        return $hashed_email;
    }
}

function KeyUniqueUser($user)
{
    $numberRandom = rand(5, 15);
    $keyUSer = hash('ripemd128', $user . $numberRandom);
    return $keyUSer;
}
?>