<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Penduduk;

use App;
use WordTemplate;
use Carbon\Carbon;

class SupportController extends Controller
{
    public function __construct(Penduduk $penduduk){
        $this->penduduk = $penduduk;
    }

    public function persetujuan($id, $fungsi, $kondisi)
    {
        $table = App::make('App\Models\\'.ucwords($fungsi))->find($id);
        $table->persetujuan = $kondisi == 'setuju' ? 1 : 2;
        $table->save();

        return redirect()->back();
    }

    public function file($id, $fungsi)
    {
        $penduduk   = $this->penduduk->find($id);

        // return $penduduk->hari_kematian;

        $array = array(
            '[KECAMATAN]'       => $penduduk->kecamatan,
            '[KELURAHAN]'       => $penduduk->kelurahan,
            '[DUSUN]'           => $penduduk->nama_dusun,
            '[NO_KK]'           => $penduduk->nomor_kartu_keluarga,
            '[NAMA_KK]'         => $penduduk->nama_kepala_keluarga,
            '[ALAMAT]'          => $penduduk->nama_alamat,
            '[RT]'              => $penduduk->rt,
            '[RW]'              => $penduduk->rw,
            '[NIK]'             => $penduduk->nik,
            '[NAMA]'            => $penduduk->nama,
            '[NIK_KK]'          => $penduduk->nik_kepala_keluarga,
            '[ALAMAT_TUJUAN]'   => $penduduk->alamat_tujuan,
            '[TANGGAL_LAHIR]'   => $penduduk->tanggal_lahir,
            '[AGAMA]'           => $penduduk->agama,
            '[HARI_MATI]'       => $penduduk->hari_kematian,
            '[JENIS_KELAMIN]'   => $penduduk->jenis_kelamin,
            '[TANGGAL_KEMATIAN]'=> $penduduk->tanggal_kematian,
            '[TEMPAT_KEMATIAN]' => $penduduk->tempat_kematian,
            '[ALASAN_KEMATIAN]' => $penduduk->alasan_kematian,
            '[TANGGAL_SEKARANG]'=> Carbon::now()->format('d-m-Y')
        );

        if($fungsi == 'mutasi'){
            return $this->fileMutasi($id, $array);
        }elseif($fungsi == 'kematian'){
            return $this->fileKematian($id, $array, $penduduk);
        }else{
            return $this->fileKelahiran($id);
        }
    }

    public function fileMutasi($id, $array)
    {
        $file       = public_path('storages/dokumen/surat_perpindahan.rtf');
        $nama_file  = 'surat-perpindahan.doc';
        
        return WordTemplate::export($file, $array, $nama_file);
    }

    public function fileKematian($id, $array, $penduduk){
        $file       = public_path('storages/dokumen/surat_kematian.rtf');
        $nama_file  = 'surat-kematian.doc';
        
        return WordTemplate::export($file, $array, $nama_file);
    }

    public function fileKelahiran($id){
        
    }

}