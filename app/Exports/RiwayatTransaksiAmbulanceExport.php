<?php

namespace App\Exports;

use App\Models\RiwayatTransaksAmbulance;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RiwayatTransaksiAmbulanceExport implements FromQuery, WithHeadings
{
    // public $dari;
    // public $sampai;

    use Exportable;
    public function __construct(string $dari, string $sampai)
    {
        $this->dari = $dari;
        $this->sampai = $sampai;
    }

    public function headings(): array
    {
        return [
            'Kode Pesanan',
            'Tanggal Jemput',
            'Tanggal Pemesanan',
            'Nama Wali',
            'Total Biaya'
        ];
    }
    public function query()
    {
        return RiwayatTransaksAmbulance::select('kode_pesanan','transaksi_ambulance.tanggal_jemput','pasien_ambulance.tanggal','pasien_ambulance.nama_wali','transaksi_ambulance.total_biaya')->join('pasien_ambulance','pasien_ambulance.id', 'transaksi_ambulance.id_pasien')->whereBetween('transaksi_ambulance.created_at',[$this->dari,$this->sampai]);
    }



}
