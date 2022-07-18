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

  public function xml2json(Request $request)
  {
    $xml = simplexml_load_string($request->input('xml'));
    $json = json_encode($xml);
    return $json;
  }

  public function makeRequest(Request $request)
  {
    return http::withheaders([
      'Authorization' => 'Basic YWRtaW46MTIzNDU2',
    ])
      ->timeout(5)
      ->get('http://' . $request->input('host') . '/' . $request->input('path'));
  }

}
