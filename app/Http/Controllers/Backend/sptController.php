<?php

namespace App\Http\Controllers\backend;

use PDF;
use Help;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class sptController extends Controller
{
    public function index()
    {
        return view('backend.'.$this->kode.'.index');
    }

    public function data(Request $request)
    {
        if ($request->ajax()){
            $data= $this->model::with('bidang')->whereHas('bidang', function($query){
                $query->where('bidangs.opd_id','=', Auth::user()->bidang->opd_id);  
            })->orderBy('updated_at','desc');
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', '<div style="text-align: center;">
               <a class="edit ubah" data-toggle="tooltip" data-placement="top" title="Edit" '.$this->kode.'-id="{{ $id }}" href="#edit-{{ $id }}">
                   <i class="fa fa-eye text-warning"></i>
               </a>&nbsp; &nbsp;
             
           </div>')
           ->addColumn('tanggal_pengajuan',function($row){

            return Help::time_ago($row->created_at);
        })
        ->addColumn('no_spt',function($row){

            return $row->no_spt ?? '-';
        })
        ->addColumn('status_spt',function($row){

            return config('master.status_spt.'.$row->status_spt);
        })
           ->toJson();
        }
        else {
            exit("Not an AJAX request -_-");
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.'.$this->kode.'.tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->ajax()) {
            $validator=Validator::make($request->all(), [
                'nama'              => 'required|'.config('master.regex.json'),
                'alias'             => 'required|'.config('master.regex.json'),
                ]);
            if ($validator->fails()) {
                $respon=['status'=>false, 'pesan'=>$validator->messages()];
            }
            else {
                $this->model::create($request->all());
                $respon=['status'=>true, 'pesan'=>'Data berhasil disimpan'];
            }
            return $respon;
        }
        else {
            exit('Ops, an Ajax request');
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
    function viewspt($id){
        $customPaper = array(0,0,595.276,935.433);
        $data = $this->model::find($id);
        $pegawai = \App\Model\SptPegawai::join('pegawais','pegawais.id','spt_pegawais.pegawai_id')
            ->join('jabatans','jabatans.id','spt_pegawais.jabatan_id')
            ->join('bidangs','bidangs.id','spt_pegawais.bidang_id')
            ->join('opds','opds.id','bidangs.opd_id')
            ->whereSptId($id)
            ->select('pegawais.nama as nama_pegawai','jabatans.nama as jabatan','pegawais.pangkat','pegawais.golongan','pegawais.nip','opds.nama as opd','bidangs.nama as nama_bidang')
            ->get();
        $ttd = $this->model::with('pegawai')->first();
        $kop  = \App\Model\Opd::whereHas('bidang.spt', function($query) use ($id){
            $query->where('spts.id', $id);  
        })->first();
        
        $pdf = PDF::loadView('backend.topdf.spt',compact('data','pegawai','ttd','kop'))->setPaper($customPaper,'potrait');
        return $pdf->stream($data->id.'.pdf');

    }

    function viewsppd($id,$pegawai){
        $customPaper = array(0,0,595.276,935.433);
        $data = $this->model::find($id);
        $pegawai = \App\Model\SptPegawai::join('spts','spts.id','spt_pegawais.spt_id')->join('pegawais','pegawais.id','spt_pegawais.pegawai_id')
        ->join('jabatans','jabatans.id','pegawais.jabatan_id')
        ->join('bidangs','bidangs.id','pegawais.bidang_id')
        ->join('opds','opds.id','bidangs.opd_id')
        ->whereSptId($id)->where('pegawais.id',$pegawai)
        ->select('spts.angkutan','spts.tempat_berangkat','spts.tempat_tujuan','spts.tanggal_berangkat','spts.tanggal_kembali','bidangs.nama as nama_bidang','pegawais.nama as nama_pegawai','jabatans.nama as jabatan','jabatans.tingkat','pegawais.pangkat','pegawais.golongan','pegawais.nip','opds.nama as opd')
        ->first();
        $ttd = $this->model::with('pegawai')->first();
        $kop  = \App\Model\Opd::whereHas('bidang', function($query){
            $query->where('bidangs.opd_id','=', Auth::user()->bidang->opd_id);  
        })->first();
        $pdf = PDF::loadView('backend.topdf.sppd',compact('data','pegawai','ttd','kop'))->setPaper($customPaper,'potrait');
        return $pdf->stream($data->id.'.pdf');
    }
    public function edit($id)
    {   $data = $this->model::find($id);
        if($data->status_spt=='0'){
        $this->model::whereId($id)->update(['status_spt'=>'1']);
        }
        $data=[
            'data'    => $data,
            'pegawai' => \App\Model\SptPegawai::join('pegawais','pegawais.id','spt_pegawais.pegawai_id')
                        ->join('jabatans','jabatans.id','pegawais.jabatan_id')
                        ->join('bidangs','bidangs.id','pegawais.bidang_id')
                        ->join('opds','opds.id','bidangs.opd_id')
                        ->whereSptId($id)
                        ->select('bidangs.nama as nama_bidang','pegawais.id as id_pegawai','pegawais.nama as nama_pegawai','jabatans.nama as jabatan','pegawais.pangkat','pegawais.golongan','pegawais.nip','opds.nama as opd')
                        ->get(),
        ];
        return view('backend.'.$this->kode.'.ubah', $data);
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
        if ($request->ajax()) {
            $validator=Validator::make($request->all(), [
                'status_spt'              => 'required',
            ]);
            if ($validator->fails()) {
                $response=['status'=>FALSE, 'pesan'=>$validator->messages()];
            }
            else {
                $this->model::find($id)->update($request->all());
                $response=['status'=>true, 'pesan'=>'Data berhasil diubah'];
            }
            return $response ?? ['status'=>TRUE, 'pesan'=>['msg'=>'Data berhasil diubah']];
        }
        else {
            exit('Ops, an Ajax request');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function hapus($id)
    {
        $data=$this->model::find($id);
        return view('backend.'.$this->kode.'.hapus', ['data'=>$data]);
    }

    public function destroy($id)
    {
        $data=$this->model::find($id);
        if ($data->delete()) {
            $response=['status'=>TRUE, 'pesan'=>['msg'=>'Data berhasil dihapus']];
        }
        else {
            $response=['status'=>FALSE, 'pesan'=>['msg'=>'Data gagal dihapus']];
        }
        return response()->json($response);
    }
}
