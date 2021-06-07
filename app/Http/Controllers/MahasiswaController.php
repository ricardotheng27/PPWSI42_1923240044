<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Mahasiswa;

class MahasiswaController extends Controller
{
   public function insert()
   {
      $result = DB::insert('insert into mahasiswas (npm, nama_mahasiswa, tempat_lahir, tanggal_lahir, alamat, created_at) values (?, ?, ?, ?, ?, ?)', ['1923240044', 'Ricardo Theng', 'Palembang', '2001-01-01', 'Jl Sutan Syahrir', now()]);
      dump($result);
   }
   
   public function update()
   {
        $result = DB::update('update mahasiswas set nama_mahasiswa = "Nando", updated_at = now() where npm = ?', ['1922110010']);
        dump($result);
   }

   public function delete()
   {
         $result = DB::delete('delete from mahasiswas where npm = ?', ['1922110010']);
         dump($result);
   }

   public function select()
   {
         $kampus = "Universitas Multi Data Palembang";
         $result = DB::select('select * from mahasiswas');
         // dump($result);
         return view('mahasiswa.index', ['allmahasiswa' => $result, 'kampus' => $kampus]);
   }

   public function insertQb()
   {
         $result = DB::table('mahasiswas')->insert(
            [
                  'npm' => '1923240001',
                  'nama_mahasiswa' => 'Hasan',
                  'tempat_lahir' => "Palembang",
                  'tanggal_lahir' => '2001-11-01',
                  'alamat' => 'Jl Mayor Ruslan',
                  'created_at' => now(),
            ]
         );
         dump($result);
   }

   public function updateQb()
   {
            $result = DB::table('mahasiswas')
            ->where('npm', '1923250001')
            ->update(
               [
                     'nama_mahasiswa' => 'Lili',
                     'updated_at' => now()
               ]
            );
         dump($result);
   }

   public function deleteQb()
   {
            $result = DB::table('mahasiswas')
               ->where('npm', '=', '1923250001')
               ->delete();
            dump($result);
   }

   public function selectQb()
   {
         $kampus = "Universitas Multi Data Palembang";
         $result = DB::table('mahasiswas')->get();
         // dump($result);
         return view('mahasiswa.index', ['allmahasiswa' => $result, 'kampus' => $kampus]);
   }

   public function insertElq()
   {
         $mahasiswa = new Mahasiswa; // instansiasi class Mahasiswa
         $mahasiswa ->npm = '1923240001'; // isi property
         $mahasiswa ->nama_mahasiswa = 'Lala';
         $mahasiswa ->tempat_lahir = 'Jakarta';
         $mahasiswa ->tanggal_lahir = '2002-02-02';
         $mahasiswa ->alamat = 'Jl Dempo';
         $mahasiswa ->save(); // menyimpan data ke tabel mahasiswas
         dump($mahasiswa); // melihat isi $mahasiswa
   }

   public function updateElq()
   {
         $mahasiswa = Mahasiswa::where('npm', '1923240001')->first(); // cari data tabel mahasiswas berdasarkan npm
         $mahasiswa->nama_mahasiswa = 'Reza';
         $mahasiswa->save(); // menyimpan data ke tabel mahasiswas
         dump($mahasiswa); // melihat isi $mahasiswa
   }

   public function deleteElq()
   {
         $mahasiswa = Mahasiswa::where('npm', '1923240001')->first(); // cari data tabel mahasiswas berdasarkan npm
         $mahasiswa->delete(); // hapus data npm 1923240001
         dump($mahasiswa); // melihat isi $mahasiswa
   }

   public function selectElq()
   {
         $kampus = "Universitas Multi Data Palembang";
         $mahasiswa = Mahasiswa::all();
         // dump($allmahasiswa);
         return view('mahasiswa.index', ['allmahasiswa' => $mahasiswa, 'kampus' => $kampus]);
   }
}