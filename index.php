<?php
  $zabmap_version = 0.1;
  include('data.php');
?>
<html>
  <head>
  <link rel="shortcut icon" href="favicon.ico" />
  <meta http-equiv="refresh" content="50"> 
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
  <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
  <title>ZabMap <?php echo $zabmap_version ?></title>
  <script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
  <script type="text/javascript">

  //static code from index.pnp
  function initialize() {
    var myOptions = {
      zoom: 3, 
      center: new google.maps.LatLng(20,0),
      mapTypeId: google.maps.MapTypeId.HYBRID
    };
    window.map = new google.maps.Map(document.getElementById("map_canvas"),myOptions);

    //defining marker images
    var red_blank = new google.maps.MarkerImage(
      'http://www.google.com/mapfiles/marker.png', 
      new google.maps.Size(20,34), 
      new google.maps.Point(10,34));

    var blue_blank = new google.maps.MarkerImage(
      'http://www.google.com/mapfiles/marker_white.png',
      new google.maps.Size(20,34),
      new google.maps.Point(10,34));

    var green_blank = new google.maps.MarkerImage(
      'http://www.google.com/mapfiles/marker_green.png',
      new google.maps.Size(20,34),
      new google.maps.Point(10,34));

    var yellow_blank = new google.maps.MarkerImage(
      'http://www.google.com/mapfiles/marker_yellow.png',
      new google.maps.Size(20,34),
      new google.maps.Point(10,34));

    var grey_blank = new google.maps.MarkerImage(
      'http://www.google.com/mapfiles/marker_grey.png',
      new google.maps.Size(20,34),
      new google.maps.Point(10,34));

<?php
  $hosts = get_hosts();
  foreach ($hosts as $h) {
    echo 'window.'.$h['zagmap_host'].'_pos = new google.maps.LatLng('.$h['location'].');'."\n\n";
    echo 'window.'.$h['zagmap_host'].'_mark = new google.maps.Marker({
            position: '.$h['zagmap_host'].'_pos,
            icon: \'http://www.google.com/mapfiles/marker'.$h['marker_color'].'.png\',
            map: map,
            zIndex: 2,
            title: "'.$h['zagmap_host'].'"});'."\n\n";
  }
?>

    }
  </script>
  <body style="margin:0px; padding:0px;" onload="initialize()">
  <div id="map_canvas" style="width:100%; height:80%;"></div>

<pre>
<?php print_r($hosts) ;?>
</pre>

  </body>
</html>
