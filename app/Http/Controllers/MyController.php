<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyController extends Controller
{
    private $arr = [
    ['id'=> 1, 'nama' => 'nias', 'kelas' => 'xii rpl 1'],
    ['id'=> 2, 'nama' => 'khansa', 'kelas' => 'xii rpl 2'],
    ['id'=> 3, 'nama' => 'bilqis', 'kelas' => 'xii rpl 3'],
];

    public function index () // untuk memberikan daftar data
    {
        $siswa = session('siswa_data', $this->arr);
        return view('siswa.index', ['siswa' =>$siswa]);
    }
    
    public function show ($id)
     {
        // cari data siswa dari session
        $data = session ('siswa.show', $this->arr);
        
        // cari berdasarkan id
        $siswa = collect($data)->firstWhere('id',$id);
        // jika data tidak ada
        if (! $siswa) {
            abort(404);
        }
        
        // dd($siswa); // untuk cek data
        return view ('siswa.show',compact ('siswa'));
    }
    
    public function create()
    {
        return view ('siswa.create');
    }

    public function store(Request $request)
    {
        $siswa = session('siswa_data', $this->arr);
        
    // membuat id increment otomatis
    $newId = collect($siswa)->max('id') +1;

    //tambah data siswa
    $siswa[] = [
        'id' => $newId,
        'kelas' => $request-> kelas,
        'nama' => $request-> nama,
    ];

    //simpan ke array siswa
    session(['siswa_data' => $siswa]);

    // kembali ke halaman siswa
     return redirect('/siswa');
    }

    public function edit($id)
    {
        // mengambil data siswa dari session siswa_data
        $data = session('siswa_data', $this->arr);
        // cari data berdasarkan id
        $siswa = collect($data)->firstWhere('id', $id);

        // jika data tidak ada
        if (!$siswa) {
            abort(404);
        }

        // dd($siswa);
        return view('siswa.edit', compact('siswa'));
    }

    public function update(Request $request, $id)
    {
        // mengambil data siswa dari session siswa_data
        $data = session('siswa_data', $this->arr);
        
        // mencari data berdasarkan id 
       foreach ($data as &$item) {
        if ($item['id'] == $id) {
        // mengubah isi data nama dan kelas
        $item['nama'] = $request->nama;
        $item['kelas'] = $request->kelas;
        break;
       }
     }

    // menyimpan data yg telah di update ke session 
   session(['siswa_data' => $data]);

    return redirect('siswa');
    }

   public function destroy($id)
   {
    $siswa = session('siswa_data', $this->arr);
    $index = array_search($id, array_column($siswa, 'id'));

    session(['siswa_data' => $siswa]);

    return redirect('siswa');
   }
    
}