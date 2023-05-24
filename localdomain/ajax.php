<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");

$action = isset($_GET['action']) ? trim($_GET['action']) : '';
$result = ['result' => '', 'info' => ''];


switch ($action) {
    case 'ping':
        $host = isset($_GET['host']) ? trim($_GET['host']) : '';
        $second = isset($_GET['second']) ? (int)trim($_GET['second']) : 3;
        $a = shell_exec('ping -n ' . $second . ' ' . $host, $output, $return);
        $result = ['result' => $return, 'info' => $output];
        break;
    case 'firewall':
        $display_name = isset($_GET['display_name']) ? trim($_GET['display_name']) : '';
        $remote_address = isset($_GET['remote_address']) ? trim($_GET['remote_address']) : '';
        $direction = isset($_GET['direction']) ? trim($_GET['direction']) : '';
        $protocol = isset($_GET['protocol']) ? trim($_GET['protocol']) : '';
        $port = isset($_GET['port']) ? trim($_GET['port']) : '';
        $type = isset($_GET['type']) ? trim($_GET['type']) : '';
        $cmd = 'netsh advfirewall firewall add rule name="'.$display_name.'" dir='.$direction.' action='.$type.' remoteip='.$remote_address.' protocol='.$protocol.' localport='.$port.'';
        exec($cmd, $output, $return);
        $result = ['result' => $return, 'info' => $output];
        break;
    
    default:
        # code...
        break;
}
print(json_encode($result));
?>
