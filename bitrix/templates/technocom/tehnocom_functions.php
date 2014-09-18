<?php
//error_reporting(E_ALL);
//ini_set('display_errors',true);
function get_client_ip() {
    $ipaddress = '';
    if (@$_SERVER['HTTP_CLIENT_IP'])
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(@$_SERVER['HTTP_X_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(@$_SERVER['HTTP_X_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(@$_SERVER['HTTP_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(@$_SERVER['HTTP_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(@$_SERVER['REMOTE_ADDR'])
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

function getCity() {
    $ipclient = get_client_ip();
    $ch = curl_init();
    $headers = array(
        'Accept: application/json',
        'Content-Type: application/json',

    );
    curl_setopt($ch, CURLOPT_URL, "http://api.sypexgeo.net/json/".$ipclient);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $city = curl_exec($ch);

    $city = json_decode($city);
    if(is_array($city)){
        $city = $city[0];
    }
//    print_r($city);
    $city = $city->city->name_ru;
//echo $city;
    return $city;
}
//echo getCity();die();

function c_encode($txt) {
  return strtr($txt, array(
      "\\" => "\\\\",
      "\n" => "\\n",
      "\r" => "\\r",
      "\t" => "\\t",
      '\'' => '\\\'',
      "\"" => "\\\"")
  );
}
function php_c_encode($txt) {
  return strtr($txt, array(
      "\\" => "\\\\",
      "\n" => "\\n",
      "\r" => "\\r",
      "\t" => "\\t",
      '\$' => '\\\$',
      "\"" => "\\\"")
  );
}
function json_encode_obj($arr) {
  $res = array();
  $i = 0;
  foreach ($arr as $k => $v) $res[$i++] = "\"" . c_encode($k) . "\":" . my_json_encode($v);
  return "{" . join(",", $res) . "}";
}
function json_encode_array($arr) {
  $cnt = count($arr);
  $res = array();
  for ($i = 0; $i < $cnt; $i++) $res[$i] = my_json_encode($arr[$i]);
  return "[" . join(",", $res) . "]";
}
function my_json_encode($val) {
  if (is_array($val)) {
    if (!count($val) || isset($val[0])) return json_encode_array($val);
    else return json_encode_obj($val);
  }
  if (is_bool($val)) return $val ? "true" : "false";
  if (is_int($val) || is_float($val)) return strval($val);
  return "\"" . c_encode(strval($val)) . "\"";
}

?>