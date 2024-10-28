<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
        protected $table = 'transaksi';

        protected $fillable = [
            'id',
            'id_buku',
            'id_member',
            'tanggal_pinjam',
            'tanggal_kembali',
            'status',
        ];

        public function buku()
        {
            return $this->belongsTo(Buku::class, 'id_buku');
        }

        public function member()
        {
            return $this->belongsTo(Member::class, 'id_member');
        }

        public function updateStatus($id)
        {
            $transaksi = Transaksi::findOrFail($id);
            
            // Logic to toggle the status, assuming there are 3 statuses: 'proses', 'acc', 'late'
            switch ($transaksi->status) {
                case 'proses':
                    $transaksi->status = 'acc';
                    break;
                case 'acc':
                    $transaksi->status = 'late';
                    break;
                case 'late':
                    $transaksi->status = 'proses';
                    break;
                default:
                    $transaksi->status = 'proses';
                    break;
            }
            
            $transaksi->save();

            return response()->json(['status' => $transaksi->status]);
        }

}
