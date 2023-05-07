<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksiAmbulance;
use App\Models\RiwayatTransaksAmbulance;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class AmbulanceController extends Controller
{
    public function index()
    {
        return view('backend.ambulance.index');
    }

    public function riwayat()
    {
        $data = RiwayatTransaksAmbulance::with('pasien_ambulance','ambulance')->where('status_pembayaran','lunas')->get();
        return view('backend.ambulance.riwayat-ambulance',compact('data'));
    }

    public function riwayatDetail($id)
    {
        $data = DetailTransaksiAmbulance::select(
            'detail_transaksi_ambulance.*',
            'transaksi_ambulance.kode_pesanan',
            'transaksi_ambulance.nominal',
            'transaksi_ambulance.biaya_lain',
            'transaksi_ambulance.tanggal_jemput',
            'transaksi_ambulance.total_biaya',
            'pasien_ambulance.nama_wali',
            'pasien_ambulance.tanggal'
            )
            ->join(
                'transaksi_ambulance','transaksi_ambulance.id','detail_transaksi_ambulance.id_transaksi'
            )
            ->join(
                'pasien_ambulance', 'pasien_ambulance.id','transaksi_ambulance.id_pasien'
            )
            ->where('detail_transaksi_ambulance.id_transaksi',$id)->first();
        return view('backend.ambulance.cetak',compact('data'));

    }

    public function saldo()
    {
        return view('backend.ambulance.data-saldo');
    }

    public function pemasukan()
    {
        return view('backend.ambulance.data-pemasukan');
    }

    public function transaksi()
    {
        return view('backend.ambulance.riwayat-transaksi');
    }

    public function list()
    {
        $data = RiwayatTransaksAmbulance::with('pasien_ambulance','ambulance','lokasi')->where('status_pembayaran','pending')->orWhere('status_kejadian',Null)->where('status_pembayaran','pending')->get();
        return view('backend.ambulance.list-ambulance',compact('data'));

    }

    public function detail($id)
    {
        $data = RiwayatTransaksAmbulance::
        select(
                'transaksi_ambulance.*',
                'pasien_ambulance.id as pasien_id',
                'pasien_ambulance.nama_wali','pasien_ambulance.tanggal',
                'pasien_ambulance.foto_kejadian',
                'pasien_ambulance.keadaan','pasien_ambulance.no_hp',
                'lokasi_kejadian.id as lokasi_kejadian_id',
                'lokasi_kejadian.long',
                'lokasi_kejadian.lang',
                'lokasi_kejadian.id_provinsi',
                'lokasi_kejadian.id_kota',
                'lokasi_kejadian.id_kecamatan',
                'lokasi_kejadian.id_desa',
                'lokasi_kejadian.alamat',
                'lokasi_kejadian.id_pasien_ambu')
            ->join('pasien_ambulance','pasien_ambulance.id', 'transaksi_ambulance.id_pasien')
            ->join('lokasi_kejadian','lokasi_kejadian.id_pasien_ambu','pasien_ambulance.id')
            ->find($id);
        return view('backend.ambulance.detail',compact('data'));
    }
    public function updatePesanan(Request $request, $id)
    {
        $request->validate([
            'jam_kerja' => 'required',
        ]);
        RiwayatTransaksAmbulance::find($id)->update([
            'nominal' => $this->formatNumber($request->get('biaya')),
            'biaya_lain' => $this->formatNumber($request->get('biaya_lain')),
            'total_biaya' => $this->formatNumber($request->get('total_biaya')),
            'status_perjalanan' => $request->get('status_perjalanan'),
            'tanggal_jemput' => $request->get('jam_kerja')
        ]);

        return redirect()->route('list-ambulance')->withStatus('Berhasil mengupdate status pesanan');


    }



    public function updatePerjalanan($id)
    {
        RiwayatTransaksAmbulance::find($id)->update([
            'status_perjalanan' => '2',
        ]);
        return redirect()->route('list-ambulance')->withStatus('Berhasil mengupdate status perjalanan');
    }
    public function updatePerjalananDua($id)
    {
        RiwayatTransaksAmbulance::find($id)->update([
            'status_perjalanan' => '3',
        ]);
        return redirect()->route('list-ambulance')->withStatus('Berhasil mengupdate status perjalanan');
    }
    public function postAmbulance(Request $request, $id)
    {
        $request->validate([
            'nominal_bayar' => 'required',
            'total' => 'required',
        ]);
        try {
            RiwayatTransaksAmbulance::find($id)->update([
                'status_pembayaran' => 'lunas',
                'status_perjalanan' => '4'
            ]);
            $detail = new DetailTransaksiAmbulance;
            $detail->id_transaksi  = $id;
            $detail->id_user  = auth()->user()->id;
            $detail->biaya_total = $this->formatNumber($request->get('total_biaya'));
            $detail->jumlah_biaya = $this->formatNumber($request->get('nominal_bayar'));
            $detail->total_kembalian = $this->formatNumber($request->get('total'));
            $detail->status  = 'lunas';
            $detail->save();
            return redirect()->route('list-ambulance')->withStatus('Transaksi berhasil');
        } catch (Exception $e) {
            return $e;
        } catch (QueryException $e){
            return $e;
        }
    }
    public function updateStatus(Request $request)
    {
        RiwayatTransaksAmbulance::where('kode_pesanan',$request->get('id_transaksi'))->update([
            'status_kejadian' => $request->get('status_kejadian'),
            'status_kendaraan' => $request->get('status'),
        ]);

        return redirect()->route('list-ambulance')->withStatus('Berhasil mengganti status kejadian');
    }

    public function formatNumber($param)
    {
        return (int)str_replace('.', '', $param);
    }
}
