<?
session_start();

require 'db.php';
$db = new db;

if ($_POST['text']) {
    $db->createNote($_POST['text']);
}
