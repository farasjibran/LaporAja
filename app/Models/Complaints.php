<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

enum ComplaintCategory: string
{
    case PRODUK_BARANG = 'produk_barang';
    case KUALITAS_LAYANAN = 'kualitas_layanan';
    case MASALAH_TEKNIS = 'masalah_teknis';
    case PENAGIHAN_PEMBAYARAN = 'penagihan_pembayaran';
    case KETERLAMBATAN_PENGIRIMAN = 'keterlambatan_pengiriman';
    case PERILAKU_STAF = 'perilaku_staf';
    case FASILITAS_SARANA = 'fasilitas_sarana';
    case KEAMANAN_PRIVASI = 'keamanan_privasi';
    case INFORMASI_MISLEADING = 'informasi_misleading';
    case LAIN_LAIN = 'lain_lain';
}

class Complaints extends Model
{
    protected $fillable = [
        'title_complaint',
        'goverment_id',
        'incident_date',
        'incident_location',
        'complaint_type',
        'description',
        'status',
        'attachment',
        'unique_code'
    ];

    public function goverment()
    {
        return $this->belongsTo(Goverments::class, 'goverment_id');
    }
}
