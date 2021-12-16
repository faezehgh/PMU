<?php

function DecodeMultiDatas(array $data)
{
  $tabData = array();
  for ($i = 0; $i < sizeof($data); $i++) {
    $tabData[$i] =  base64_decode($data[$i]);
  }
  return $tabData;
}

function DecodeData($data)
{
  $encodeData = base64_decode($data);
  return $encodeData;
}

function VerifyHashPassword($pass, $hash)
{
  if (password_verify($pass, $hash)) {
    return 0;
  } else {
    return 1;
  }
}

function VerifyHashEmail($email, $hash){
  if (hash_equals($email, $hash)) {
    return 0;
  } else {
    return 1;
  }
}
?>