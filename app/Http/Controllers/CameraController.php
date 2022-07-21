<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Camera;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CameraController extends Controller
{
  public function index() {
    $camera = Camera::where('count', '!=', 'N/A');

    return Inertia::render('Welcome', [
      'data' => $camera->orderBy('count', 'DESC')->paginate(25)
    ]);
  }

  public function search($query)
  {
    return Inertia::render('Welcome', [
      'data' => $this->searchCameras($query),
    ]); 
  }

  public function cameras($query='') 
  {
    return $this->searchCameras($query);
  }

  private function searchCameras($query)
  {

    return Camera::where(function ($q) {
      $q->where('count', '!=', 'N/A');

    })->where(function ($q) use ($query) {
      $q->where('country', 'like', '%' . $query . '%')
        ->orWhere('code', 'like', '%' . $query . '%')
        ->orWhere('city', 'like', '%' . $query . '%')
        ->orWhere('source', 'like', '%' . $query . '%')
        ->orWhere('ip', 'like', '%' . $query . '%');
    })->orderBy('count', 'DESC')->paginate(25);
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

  public function snapshot(Request $request) {
    return base64_encode($this->makeRequest($request));
  }

}
