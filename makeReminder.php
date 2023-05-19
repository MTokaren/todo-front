<?

session_start();

require 'db.php';
$db = new db;

if ($_POST['note_id'] && $_POST['date'] && $_POST['time']) {
    $timestring = $_POST['date'] . ' ' . $_POST['time'] . ':00';
    $unixtime = strtotime($timestring);
    $id = $_POST['note_id'];
    $db->createReminder($id, $unixtime);
}

echo (strtotime('19:18:00')) . '</br>';
echo (strtotime('2019-01-01'));
