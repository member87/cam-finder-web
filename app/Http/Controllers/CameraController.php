<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Camera;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CameraController extends Controller
{
  public function index() {
    return Inertia::render('Welcome', [
      'data' => Camera::where('count', '!=', 'N/A')->paginate(25),
    ]);
  }

  public function show($id)
  {
    return Inertia::render('View', [
      'data' => Camera::where('id', $id)->first(),
    ]); 
  }

  public function users($ip)
  {
    $response = Http::withHeaders([
      'Authorization' => 'Basic YWRtaW46MTIzNDU2',
    ])->get('http://' . $ip . '/Media/UserGroup/getUser?response_format=json');
    return $response;
  }

  public function cameras($ip)
  {
    $response = Http::withHeaders([
      'Authorization' => 'Basic YWRtaW46MTIzNDU2',
    ])->get('http://' . $ip . '/Media/Device/getDevice?response_format=json');
    return $response;
  }

  public function storage($ip)
  {
    $response = http::withheaders([
      'Authorization' => 'Basic YWRtaW46MTIzNDU2',
    ])->get('http://' . $ip . '/Media/Storage/getDrive');

    $xml = simplexml_load_string($response);
    $json = json_encode($xml);

    return $json;
  }

  public function connectedUsers($ip)
  {
    $response = http::withheaders([
      'Authorization' => 'Basic YWRtaW46MTIzNDU2',
    ])->get('http://' . $ip . '/Media/UserGroup/getOnlineUserList');

    $xml = simplexml_load_string($response);
    $json = json_encode($xml);

    return $json;
  }

}
