<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnimalController extends Controller
{
    public $animals = [
        ["nama"=> "kucing",
        "warna"=> "putih"],
        ["nama"=> "ikan",
        "warna"=> "merah"]
    ];
    function index () {
        echo 'Ini adalah daftar animals <br>';
        array_push($this->animals, ["nama" => "gg", "warna" => "yy"]);
        $no = 1;
        foreach ($this->animals as $animal) {
            echo $no++. '. nama : '.$animal['nama']. ', warna : '.$animal['warna'].'<br>';

        }
    }
    function create (Request $request) {
        $arr = 
        $nama = $request->nama;
        $warna = $request->warna;
        echo 'Anda berhasil menambahkan data animals';
        echo "nama : $nama";
        echo "warna : $warna";
        array_push($this->animals, ["nama" => $nama, "warna" => $warna]);
    }
    function update (Request $request, $id) {
        $nama = $request->nama;
        $warna = $request->warna;
        echo "Anda berhasil merubah data animals dari id $id";
        echo '<br>';
        echo "Nama terbaru adalah $nama";
        echo '<br>';
        echo "Dengan warna $warna";
    }
    function destroy ($id) {
        echo "Anda berhasil menghapus data animals dari id $id";
    }
}
