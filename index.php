<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="refresh" content="5" >
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>BMW tracking :)</title>
    <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100%;
      }
    </style>
  </head>
  <body>
<pre>
<?php 
$output = shell_exec('ls -lArt /Users/ja/trips | grep trip | tail -n 1 | awk \'{print $9}\'') ;
$output = preg_replace('/\s+/', '', $output);
echo "<b> Plik: </B>".$output."<br>";
// Dodajemy zamkniecie tagów, aby można było przeparsować
$Vdata = file_get_contents('/Users/ja/trips/'.$output);
$Vdata = $Vdata."</trkseg>
    </trk>
    </gpx>";
$xml=simplexml_load_string($Vdata);
foreach($xml->trk->trkseg->trkpt as $point)
{
    $trkptlat = $point->attributes()->lat;
    $trkptlon = $point->attributes()->lon;

}
echo "<b> Szerokość geograficzna: </b>".$trkptlat."<br>";
echo "<b> Długość geograficzna: </b>".$trkptlon."<br>";
?></pre>
    <div id="map" style="margin: 0 auto; width: 95%; height: 90%; border: 1px solid #000;"></div>
    <script>

function initMap() {
    var myLatLng = {lat: <?php echo $trkptlat; ?>
    , lng: <?php echo $trkptlon; ?>};

  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 13,
    center: myLatLng
  });

  var marker = new google.maps.Marker({
    position: myLatLng,
    map: map,
    title: 'Hello World!'
  });
}

    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHEWb1xL997LSSJF7X2zPBxxHv-DIK0SM&signed_in=true&callback=initMap"></script>
</body>
</html>
