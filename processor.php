<?php
require 'vendor/autoload.php';

use GuzzleHttp\Client as Client;

$api_base_url = 'http://127.0.0.1:8000/api/todo/';

if (isset($_GET['id'])) {
  $client = new Client();
  $status = 'fail';
  $response = $client->delete($api_base_url . $_GET['id']);

  if ($response->getStatusCode() == '200')
    $status = 'success';
  header("Location: http://api-consume.test?status=" . $status);
  die();
}

if (isset($_POST['method'])) {
  $client = new Client();
  $status = 'fail';
  $title = $_POST['title'];
  $body = $_POST['body'];
  if ($_POST['method'] == 'create') {
    $response = $client->post($api_base_url, [
      'form_params' => [
        'title' => $title,
        'body' => $body,
      ]
    ]);
    if ($response->getStatusCode() == '203')
      $status = 'success';
  }
  if ($_POST['method'] == 'edit') {
    $id = $_POST['todo_id'];
    $response = $client->patch($api_base_url . $id, [
      'form_params' => [
        'title' => $title,
        'body' => $body,
      ]
    ]);
    if ($response->getStatusCode() == '200')
      $status = 'success';
  }

  header("Location: http://api-consume.test?status=" . $status);
  die();
}

$client = new Client();
$response = $client->get($api_base_url);
$result =  json_decode($response->getBody());
