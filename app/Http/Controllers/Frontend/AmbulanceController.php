<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PasienAmbulance;
use App\Models\RiwayatTransaksAmbulance;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AmbulanceController extends Controller
{
    public function index()
    {
        return view('layouts.frontend.ambulance.index');
    }

    public function create()
    {
        return view('layouts.frontend.ambulance.create');

    }

    public function store(Request $request)
    {
        return $request;
    }

    public function cek(Request $request)
    {
        if (date('Y-m-d H:i:s', strtotime($request->get('tgl'))) > date("Y-m-d H:i:s")) {
            $data = RiwayatTransaksAmbulance::with('pasien_ambulance')->whereDate('tanggal_jemput', '>',date('Y-m-d', strtotime($request->get('tgl'))));
            if (count($data->get()) > 0 ) {
                if (count($data->OrWhere('status_kejadian','==','1')->get()) > 0) {
                    if (count($data->where('status_perjalanan','!=','1')->where('status_perjalanan','!=','2')->get()) > 0) {
                        return response()->json([
                            'data' => true,
                            'message' => 'Dapat Memesan'
                        ],Response::HTTP_OK);
                    }else{
                        return response()->json([
                            'data' => false,
                            'message' => 'Mohon maaf, ambulance tidak tersedia. Silakan untuk menghubungi fasilitas kesehatan lainnya.'
                        ],Response::HTTP_OK);
                    }
                }else{
                    return response()->json([
                        'data' => true,
                        'message' => 'Dapat Memesan'
                    ],Response::HTTP_OK);
                }
            } else {
                $data = RiwayatTransaksAmbulance::with('pasien_ambulance')->whereDate('tanggal_jemput', '=',date('Y-m-d', strtotime($request->get('tgl'))));

                if (count($data->get()) > 0 ) {
                    $day = $data->whereDay('tanggal_jemput', '>',date('d',strtotime($request->get('tgl'))));
                    $time = $data->whereTime('tanggal_jemput', '>',date('h:i:s',strtotime($request->get('tgl'))));
                    if ($day->get()) {
                        return response()->json([
                            'data' => true,
                            'message' => 'Dapat Memesan'
                        ],Response::HTTP_OK);
                    }
                    if ($time->get()) {
                        return response()->json([
                            'data' => true,
                            'message' => 'Dapat Memesan'
                        ],Response::HTTP_OK);
                    }
                    if (count($data->where('status_perjalanan','!=','1')->where('status_perjalanan','!=','2')->get()) > 0) {
                        return response()->json([
                            'data' => true,
                            'message' => 'Dapat Memesan'
                        ],Response::HTTP_OK);
                    }else{
                        return response()->json([
                            'data' => false,
                            'message' => 'Mohon maaf, ambulance tidak tersedia. Silakan untuk menghubungi fasilitas kesehatan lainnya.'
                        ],Response::HTTP_OK);
                    }
                }else{
                    return response()->json([
                        'data' => true,
                        'message' => 'Dapat Memesan'
                    ],Response::HTTP_OK);
                }
            }
        }else{
            return response()->json([
                'data' => false,
                'message' => 'Tolong masukkan tanggal dengan benar.'
            ],Response::HTTP_OK);
        }

    }
}
