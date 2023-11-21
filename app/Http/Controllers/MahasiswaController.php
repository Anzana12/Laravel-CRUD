<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Mahasiswa;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ch = curl_init();
  
        curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1:5984/laravel-crud/tabel_dosen');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-type: application/json',
            'Accept: */*'
        ));
         
        curl_setopt($ch, CURLOPT_USERPWD, 'admin:admin');
         
        $response = curl_exec($ch);
         
        curl_close($ch);

        $dosen = json_decode($response);
        return view('mahasiswa.index',compact('dosen'))
                ->with('i',(request()->input('page',1) -1)*5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mahasiswa.create');
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
            'namaMahasiswa'=>'required',
            'nimMahasiswa' => 'required',
            'angkatanMahasiswa'=>'required',
            'judulskripsiMahasiswa' => 'required',
            'pembimbing1'=>'required',
            'pembimbing2' => 'required',
            //'gambarMahasiswa' => 'required|image|mimes:jpg,png,jpeg'
        ]);

        $ch = curl_init();
 
        curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1:5984/_uuids');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-type: application/json',
            'Accept: */*'
        ));
         
        curl_setopt($ch, CURLOPT_USERPWD, 'admin:admin');
         
        $response = curl_exec($ch);
        $_response = json_decode($response, true);
         
        $UUID = $_response['uuids'][0];
        
        curl_close($ch);

        // === Get UUID Done

        $ch = curl_init();
 
        $mahasiswa = $request->all();
        
        $payload = json_encode($mahasiswa);
        
        curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1:5984/laravel-crud/'.$UUID);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT'); /* or PUT */
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-type: application/json',
            'Accept: */*'
        ));
         
        curl_setopt($ch, CURLOPT_USERPWD, 'admin:admin');
         
        $response = curl_exec($ch);
        
        curl_close($ch);
 
        return redirect()->route('mahasiswa.index')
                         ->with('success','Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ch = curl_init();
 
        $documentID = $id;
         
        curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1:5984/laravel-crud/'.$documentID.'?include_docs=true');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-type: application/json',
            'Accept: */*'
        ));
         
        curl_setopt($ch, CURLOPT_USERPWD, 'admin:admin');
         
        $response = curl_exec($ch);
         
        curl_close($ch);

        $mahasiswa = json_decode($response);

        return view('mahasiswa.detail', compact('mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ch = curl_init();
 
        $documentID = $id;
         
        curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1:5984/laravel-crud/'.$documentID.'?include_docs=true');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-type: application/json',
            'Accept: */*'
        ));
         
        curl_setopt($ch, CURLOPT_USERPWD, 'admin:admin');
         
        $response = curl_exec($ch);
         
        curl_close($ch);

        $mahasiswa = json_decode($response);

        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ch = curl_init();
 
        $mahasiswa = $request->all();
         
        $payload = json_encode($mahasiswa);
         
        curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1:5984/laravel-crud/'.$id);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT'); /* or PUT */
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-type: application/json',
            'Accept: */*'
        ));
         
        curl_setopt($ch, CURLOPT_USERPWD, 'admin:admin');
         
        $response = curl_exec($ch);
        
        curl_close($ch);

        return redirect()->route('mahasiswa.index')
                         ->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $ch = curl_init();
         
        $database = 'laravel-crud';
        $documentID = $id;
        $revision = $request->_rev;
         
        curl_setopt($ch, CURLOPT_URL, sprintf('http://127.0.0.1:5984/%s/%s?rev=%s', $database, $documentID, $revision));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-type: application/json',
            'Accept: */*'
        ));
         
        curl_setopt($ch, CURLOPT_USERPWD, 'admin:admin');
         
        $response = curl_exec($ch);
         
        curl_close($ch);
        return redirect()->route('mahasiswa.index')
                         ->with('success', 'Data Alumni berhasil dihapus');
    }
}
