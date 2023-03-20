<?php

namespace App\Http\Controllers\backend;

use App\Helpers\Help;
use App\Model\Bidang;
use App\Model\Pegawai;
use App\Model\Kegiatan;
use PDF;
use App\model\SptPegawai;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class sptKeluarController extends Controller
{
    public function index()
    {
        return view('backend.'.$this->kode.'.index');
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $data= $this->model::with('bidang')->whereBidangId(Auth::user()->bidang_id)->orderBy('created_at','desc');;
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($q){
                $button = '<div style="text-align: left;">
                    <a class="lihat btn btn-social-icon btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Lihat" '.$this->kode.'-id="'.$q->id.'" href="#lihat-'.$q->id.'">
                            <i class="fa fa-eye"></i>
                        </a>&nbsp; &nbsp;'.
                    (($q->status_spt==3)?
                    '<a class="edit ubah btn btn-social-icon btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Revisi" '.$this->kode.'-id="'.$q->id.'" href="#edit-'.$q->id.'">
                            <i class="fa fa-edit"></i>
                        </a>&nbsp; &nbsp;':'')
                        
                .'</div>';
                return $button;
        })
           ->addColumn('tanggal_perjalanan',function($row){
                return Help::durasitanggal($row->tanggal_berangkat,$row->tanggal_kembali);
            })
           ->addColumn('tanggal_pengajuan',function($row){
                return Help::time_ago($row->created_at);
            })
            ->addColumn('status_spt',function($row){
                if($row->status_spt=='0'){
                    $class='badge badge-primary-light';
                }elseif($row->status_spt=='1'){
                    $class='badge badge-primary-light';
                }elseif($row->status_spt=='2'){
                    $class='badge badge-secondary-light';
                }elseif($row->status_spt=='3'){
                    $class='badge badge-warning-light';
                }elseif($row->status_spt=='4'){
                    $class='badge badge-danger-light';
                }
                return '<span class="'.$class.'" style="font-weight: bolder;">'.config('master.status_spt.'.$row->status_spt).'</span>';
            })
            ->rawColumns(['status_spt','tanggal_perjalanan', 'tanggal_pengajuan','action'])->toJson();
        }
        else {
            exit("Not an AJAX request -_-");
        }
    }

    function viewspt($id){
        $customPaper = array(0,0,595.276,935.433);
        $data = $this->model::find($id);
        $pegawai =  \App\Model\SptPegawai::join('spts','spts.id','spt_pegawais.spt_id')->join('pegawais','pegawais.id','spt_pegawais.pegawai_id')
        ->join('jabatans','jabatans.id','pegawais.jabatan_id')
        ->join('bidangs','bidangs.id','pegawais.bidang_id')
        ->join('opds','opds.id','bidangs.opd_id')
        ->whereSptId($id)->select('pegawais.nama as nama_pegawai','jabatans.nama as jabatan','pegawais.pangkat','pegawais.golongan','pegawais.nip','opds.nama as opd','bidangs.nama as nama_bidang')
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
        ->select('spt_pegawais.no_sppd','spts.angkutan','spts.tempat_berangkat','spts.tempat_tujuan','spts.tanggal_berangkat','spts.tanggal_kembali','bidangs.nama as nama_bidang','pegawais.nama as nama_pegawai','jabatans.nama as jabatan','jabatans.tingkat','pegawais.pangkat','pegawais.golongan','pegawais.nip','opds.nama as opd')
        ->first();
        $ttd = $this->model::with('pegawai')->first();
        $kop  = \App\Model\Opd::whereHas('bidang', function($query){
            $query->where('bidangs.opd_id','=', Auth::user()->bidang->opd_id);  
        })->first();
        $pdf = PDF::loadView('backend.topdf.sppd',compact('data','pegawai','ttd','kop'))->setPaper($customPaper,'potrait');
        return $pdf->stream($data->id.'.pdf');

    }

    public function lihat($id)
    {   $data = $this->model::find($id);
        $data=[
            'data'    => $data,
            'pegawai' => \App\Model\SptPegawai::join('pegawais','pegawais.id','spt_pegawais.pegawai_id')
                        ->join('jabatans','jabatans.id','pegawais.jabatan_id')
                        ->join('bidangs','bidangs.id','pegawais.bidang_id')
                        ->join('opds','opds.id','bidangs.opd_id')
                        ->whereSptId($id)
                        ->select('bidangs.nama as nama_bidang','pegawais.id as id_pegawai','pegawais.nama as nama_pegawai','jabatans.nama as jabatan','pegawais.pangkat','pegawais.golongan','pegawais.nip','opds.nama as opd')
                        ->get(),
            'sptpegawai' => new SptPegawai
        ];
        return view('backend.'.$this->kode.'.lihat', $data);
    }

    public function getrekening($id)
    {
        $data = Kegiatan::find($id)->kode_rekening;
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data=[
            'kegiatan'   => Kegiatan::whereBidangId(Auth::user()->bidang_id)->pluck('nama','id'),
            'penandatangan'    => Pegawai::whereHas('jabatan', function($query){
                                    $query->where('jabatans.penandatangan',1);  
                                })->get(),
            'pegawai'    => Pegawai::all()
        ];
        return view('backend.'.$this->kode.'.tambah',$data);
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
                'file_notadinas'              => 'required|array|min:1',
                'perihal_notadinas'           => 'required|array|min:1',
                'maksud_perjalanan'              => 'required|'.config('master.regex.text'),
                'tanggal'              => 'required|'.config('master.regex.json'),
                'pegawai_id'              => 'required|array|min:1',
                'angkutan'              => 'required|array|min:1',
                'tempat_berangkat'              => 'required|'.config('master.regex.text'),
                'tempat_tujuan'              => 'required|'.config('master.regex.text'),
                'kegiatan_id'              => 'required|'.config('master.regex.uuid'),
                'penandatangan_id'              => 'required|'.config('master.regex.uuid'),
                ]);
            if ($validator->fails()) {
                $respon=['status'=>false, 'pesan'=>$validator->messages()];
            }
            else {
                $tgl_explode = explode(' - ',$request->tanggal);
                $spt = $this->model::create([
                    'perihal_notadinas' => $request->perihal_notadinas,
                    'maksud_perjalanan' => $request->maksud_perjalanan,
                    'angkutan' => $request->angkutan,
                    'tempat_berangkat' => $request->tempat_berangkat,
                    'tempat_tujuan' => $request->tempat_tujuan,
                    'tanggal_berangkat' => date('Y-m-d', strtotime(str_replace('/', '-', $tgl_explode[0]))),
                    'tanggal_kembali' => date('Y-m-d', strtotime(str_replace('/', '-', $tgl_explode[1]))),
                    'kegiatan_id' => $request->kegiatan_id,
                    'pegawai_id' => $request->penandatangan_id,
                    'bidang_id' => Auth::user()->bidang_id,
                    'status_spt' => '0',
                ]);
                
                if($spt){
                    foreach($request->pegawai_id as $val)
                    {
                        $pgw = Pegawai::find($val);
                        SptPegawai::create([
                            'pegawai_id'=>$val,
                            'spt_id'=>$spt->id,
                            'status_dibaca' => '0',
                            'bidang_id'    => $pgw->bidang_id,
                            'jabatan_id'    => $pgw->jabatan_id
                            ]);
                    }

                    if ($request->hasFile('file_notadinas')) {
                        foreach($request->file_notadinas as $key => $file){
                            $spt->file_notadinas()->Create([
                                'name'                  => 'notadinas',
                                'data'                      =>  [
                                    'disk'      => config('filesystems.default'),
                                    'target'    => Storage::putFile($this->kode.'/notadinas/'.date('Y').'/'.date('m').'/'.date('d'),$request->file('file_notadinas')[$key]),
                                ]
                            ]);
                        }
                    }
                }
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
    public function edit($id)
    {
        foreach(SptPegawai::whereSptId($id)->pluck('pegawai_id') as $val){
            $item[]=$val;
        };
        $data=[
            'kegiatan'   => Kegiatan::whereBidangId(Auth::user()->bidang_id)->pluck('nama','id'),
            'penandatangan'    => Pegawai::whereHas('jabatan', function($query){
                                    $query->where('jabatans.penandatangan',1);  
                                })->get(),
            'pegawai'    => Pegawai::all(),
            'data'  => $this->model::find($id),
            'datapegawai' => $item
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
                'maksud_perjalanan'              => 'required|'.config('master.regex.text'),
                'tanggal'              => 'required|'.config('master.regex.json'),
                'pegawai_id'              => 'required|array|min:1',
                'angkutan'              => 'required|array|min:1',
                'tempat_berangkat'              => 'required|'.config('master.regex.text'),
                'tempat_tujuan'              => 'required|'.config('master.regex.text'),
                'kegiatan_id'              => 'required|'.config('master.regex.uuid'),
                'penandatangan_id'              => 'required|'.config('master.regex.uuid'),
                ]);
            if ($validator->fails()) {
                $respon=['status'=>false, 'pesan'=>$validator->messages()];
            }
            else {
                $tgl_explode = explode(' - ',$request->tanggal);
                $spt = $this->model::find($id);
                    $spt->update([
                        'perihal_notadinas' => $request->perihal_notadinas,
                        'maksud_perjalanan' => $request->maksud_perjalanan,
                        'angkutan' => $request->angkutan,
                        'tempat_berangkat' => $request->tempat_berangkat,
                        'tempat_tujuan' => $request->tempat_tujuan,
                        'tanggal_berangkat' => date('Y-m-d', strtotime(str_replace('/', '-', $tgl_explode[0]))),
                        'tanggal_kembali' => date('Y-m-d', strtotime(str_replace('/', '-', $tgl_explode[1]))),
                        'kegiatan_id' => $request->kegiatan_id,
                        'pegawai_id' => $request->penandatangan_id,
                        'bidang_id' => Auth::user()->bidang_id,
                        'status_spt' => '0',
                    ]);
                
                if($spt){

                    SptPegawai::whereSptId($spt->id)->forceDelete();
                    foreach($request->pegawai_id as $val)
                    {
                        $pgw = Pegawai::find($val);
                        SptPegawai::create([
                            'pegawai_id'=>$val,
                            'spt_id'=>$spt->id,
                            'status_dibaca' => '0',
                            'bidang_id'    => $pgw->bidang_id,
                            'jabatan_id'    => $pgw->jabatan_id
                            ]);
                    }
                    
                    if($request->hapusnodin=='ya'){
                        $spt->file_notadinas()->delete();
                    }
                    if ($request->hasFile('file_notadinas')) {
                        foreach($request->file_notadinas as $key => $file){
                            $spt->file_notadinas()->Create([
                                'name'                  => 'notadinas',
                                'data'                      =>  [
                                    'disk'      => config('filesystems.default'),
                                    'target'    => Storage::putFile($this->kode.'/notadinas/'.date('Y').'/'.date('m').'/'.date('d'),$request->file('file_notadinas')[$key]),
                                ]
                            ]);
                        }
                    }
                }
            }
            return $respon ?? ['status'=>TRUE, 'pesan'=>['msg'=>'Data berhasil diubah']];
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
