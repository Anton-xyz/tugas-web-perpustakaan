<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $cari = $request->query('cari');

        $buku = Buku::when($cari, function ($query, $cari) {
            return $query->where('judul', 'like', "%{$cari}%")
                         ->orWhere('pengarang', 'like', "%{$cari}%");
        })->get();

        return view('buku.index', compact('buku'));
    }

    public function create()
    {
        return view('buku.create');
    }

    public function store(Request $request)
    {
        Buku::create($request->all());
        return redirect('/buku');
    }

    public function edit($id)
    {
        $buku = Buku::find($id);
        return view('buku.edit', compact('buku'));
    }

    public function update(Request $request, $id)
    {
        $buku = Buku::find($id);
        $buku->update($request->all());
        return redirect('/buku');
    }

    public function destroy($id)
    {
        Buku::destroy($id);
        return redirect('/buku');
    }
}