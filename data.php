<?php
include('config.php');
include('db.php');

function get_hosts() {
  $raw = mysql_query("SELECT `hostid`,`host`,`name`,`available` FROM `hosts` WHERE `status`=0 ");
  while ($host = mysql_fetch_array($raw)) {
    $loc_sql = "SELECT `location_lat`,`location_lon` FROM `host_inventory` WHERE `hostid`='".$host['hostid']."'";
    $loc_raw = mysql_query($loc_sql);
    $loc = mysql_fetch_array($loc_raw);
    if (is_numeric($loc['location_lat']) AND is_numeric($loc['location_lon'])) {
      $hosts[$host['hostid']]['location'] = $loc['location_lat'].",".$loc['location_lon'];
    } else {
      unset($host);
      continue;
    }
    if (($host['available']==2) OR ($host['available']==0)) { 
      $hosts[$host['hostid']]['status_human'] = "PROBLEM"; };
      $hosts[$host['hostid']]['marker_color'] = '';
    if ($host['available']==1) { 
      $hosts[$host['hostid']]['status_human'] = 'OK'; 
      $hosts[$host['hostid']]['marker_color'] = '_green';
    };
    $hosts[$host['hostid']]['available'] = $host['available'];
    $hosts[$host['hostid']]['name'] = $host['name'];
    $hosts[$host['hostid']]['host'] = $host['host'];
    $hosts[$host['hostid']]['id'] = $host['hostid'];
    $hosts[$host['hostid']]['zagmap_host'] = "x".$host['hostid']."x";
    unset($host);
  }
return $hosts;
}

?>
