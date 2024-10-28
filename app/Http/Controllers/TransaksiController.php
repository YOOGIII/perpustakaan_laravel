<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response; 
use Illuminate\Http\RedirectResponse; 
use App\Models\Transaksi;
use App\Models\Buku;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksis = Transaksi::all();

        return view('transaksi.index', ['transaksi' => $transaksis]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('transaksi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_buku' => 'required|exists:buku,id',
            'id_member' => 'required',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date',
            'status' => 'required',
        ]);

        $buku = Buku::find($request->id_buku);

        if ($buku->stok > 0) {
            $buku->stok -= 1;
            $buku->save();

            Transaksi::create([
                'id_buku' => $request->id_buku,
                'id_member' => $request->id_member,
                'tanggal_pinjam' => $request->tanggal_pinjam,
                'tanggal_kembali' => $request->tanggal_kembali,
                'status' => $request->status,
            ]);

            return redirect()->route('transaksi.index')->with('success', 'Transaksi created successfully.');
        } else {
            return redirect()->back()->with('error', 'Buku tidak tersedia.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): Response
    {
        $transaksi = Transaksi::findOrFail($id);
        return response()->view('transaksi.edit', ['transaksi' => $transaksi]);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'id_buku' => 'required|integer|exists:buku,id',
            'id_member' => 'required|integer',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date',
            'status' => 'required',
        ]);

        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update($request->all());

        return redirect()->route('transaksi.index')->with('success', 'Data berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        if ($transaksi->delete()) {
            return redirect(route('transaksi.index'))->with('success', 'Deleted!');
        }

        return redirect(route('transaksi.index'))->with('error', 'Sorry, unable to delete this!');
    }

    public function updateStatus($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $buku = Buku::findOrFail($transaksi->id_buku);

        switch ($transaksi->status) {
            case 'proses':
                $transaksi->status = 'acc';
                $buku->stok -= 1; // Kurangi stok buku
                break;
            case 'acc':
                $transaksi->status = 'late';
                break;
            case 'late':
                // Tambah stok buku kembali jika transaksi dihapus
                $buku->stok += 1;
                $buku->save();
                $transaksi->delete();
                return response()->json(['deleted' => true, 'status' => '']);
            default:
                $transaksi->status = 'proses';
                break;
        }

        $transaksi->save();
        $buku->save();

        return response()->json(['status' => $transaksi->status]);
    }
}