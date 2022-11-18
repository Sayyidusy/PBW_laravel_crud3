<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collection;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CollectionController extends Controller
{
    public function index() {
        return view('koleksi.daftarKoleksi');
    }

    public function create() {
        return view('koleksi.registrasi');
    }

    public function store(Request $request) {
        Collection::create([
            'nama'  => $request->nama,
            'jenis'  => $request->jenis,
            'jumlah'  => $request->jumlah,
        ]);

        return view('koleksi.daftarKoleksi');
    }

    public function show(Collection $koleksi) {
        $name = $koleksi->name;

        return view('koleksi.infoKoleksi', compact('koleksi'));
    }

    public function getAllCollections() {
            $collections = DB::table('collections')
            ->select(
                'id as id',
                'nama as judul',
                DB::raw('
                    (CASE
                    WHEN jenis="1" THEN "Buku"
                    WHEN jenis="2" THEN "Majalah"
                    WHEN jenis="3" THEN "Cakram Digital"
                    END) AS jenis
                    '),
                'jumlah as jumlah')
            ->orderBy('nama', 'asc')
            ->get();

            return DataTables::of($collections)
            ->addColumn('action', function($collection) {
                $html = '
                <a class="btn btn-info" href="/koleksiView/'.$collection->id.'">Show</a>
                ';
                return $html;
            })
            ->make(true);
    }
}
