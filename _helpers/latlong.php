<?php
class LatLong
{
  public function getLatLong($address)
  {
    $url = "https://geocode.maps.co/search?q=$address";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response);
  }
}
