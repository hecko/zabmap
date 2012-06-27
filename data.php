<?php
include('config.php');
include('db.php');

function get_hosts() {
  $raw = mysql_query("SELECT `hostid`,`host`,`name`,`available` FROM `hosts` WHERE `status`=0 ");
  while ($host = mysql_fetch_array($raw)) {
    if (($host['available']==2) OR ($host['available']==0)) { 
      $hosts[$host['hostid']]['status_human'] = "PROBLEM"; };
      $hosts[$host['hostid']]['marker_color'] = '';
    if ($host['available']==1) { 
      $hosts[$host['hostid']]['status_human'] = 'OK'; 
      $hosts[$host['hostid']]['marker_color'] = '_green';
    };
    $hosts[$host['hostid']]['available'] = $host['available'];
    $hosts[$host['hostid']]['id'] = $host['hostid'];
    $hosts[$host['hostid']]['zagmap_host'] = "x".$host['hostid']."x";
    $loc_sql = "SELECT `location_lat`,`location_lon` FROM `host_inventory` WHERE `hostid`='".$host['hostid']."'";
    $loc_raw = mysql_query($loc_sql);
    $loc = mysql_fetch_array($loc_raw);
    $hosts[$host['hostid']]['location'] = $loc['location_lat'].",".$loc['location_lon'];
    unset($host);
  }
return $hosts;
}

?>
