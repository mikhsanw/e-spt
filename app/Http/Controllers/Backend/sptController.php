<?php

namespace App\Http\Controllers\backend;

use PDF;
use Help;
use App\model\Opd;
use App\model\Bidang;
use App\model\SptPegawai;
use App\model\NomorTerakhir;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
            })->orderBy('created_at','desc');
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', '<div style="text-align: center;">
               <a class="edit ubah btn btn-social-icon btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Edit" '.$this->kode.'-id="{{ $id }}" href="#edit-{{ $id }}">
                   <i class="fa fa-eye"></i>
               </a>&nbsp; &nbsp;
             
           </div>')
           ->addColumn('tanggal_pengajuan',function($row){

            return Help::time_ago($row->created_at);
        })
        ->addColumn('no_spt',function($row){

            return $row->no_spt ?? '-';
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
            return '<span class="'.$class.'" style="font-weight: bolder">'.config('master.status_spt.'.$row->status_spt).'</span>';
        })
        ->rawColumns(['status_spt','no_spt', 'tanggal_pengajuan','action'])->toJson();
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

    function pdfspt($id){
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
        
        return PDF::loadView('backend.topdf.spt',compact('data','pegawai','ttd','kop'))->setPaper($customPaper,'potrait');
    }

    function pdfsppd($id,$pegawai){
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
        return PDF::loadView('backend.topdf.sppd',compact('data','pegawai','ttd','kop'))->setPaper($customPaper,'potrait');
    }

    function viewspt($id){
        $pdf = $this->pdfspt($id);
        return $pdf->stream($id.'.pdf');

    }

    function viewsppd($id,$pegawai){
        $pdf = $this->pdfsppd($id,$pegawai);
        return $pdf->stream($id.'.pdf');
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
            'sptpegawai' => new SptPegawai
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
                'catatan_pimpinan'              => 'required',
            ]);
            if ($validator->fails()) {
                $response=['status'=>FALSE, 'pesan'=>$validator->messages()];
            }
            else {

                if($request->status_spt=='2'){
                    $mspt = $this->model::find($id);
                    $kodeOpd = Opd::whereId(Auth::user()->bidang->opd_id)->first();
                    $bidang = Bidang::whereId($mspt->bidang->id)->first();
                    $nomorSPT = NomorTerakhir::whereOpdId($kodeOpd->id)->whereJenis('SPT')->first();
                    $no_spt=$kodeOpd->kode.'/SPT/'.date("Y").'/'.sprintf("%02d", ((int)$nomorSPT->nomor_terakhir+1));

                    //save no_spt
                    $request->request->add(['no_spt'=>$no_spt]);
                    $this->model::find($id)->update($request->all());

                    //save nomor_terakhir
                    NomorTerakhir::find($nomorSPT->id)->update(['nomor_terakhir'=>sprintf("%02d", ((int)$nomorSPT->nomor_terakhir+1))]);

                    //save file spt
                    $pdfspt = $this->pdfspt($id);
                    $pathspt = $this->kode.'/spt/'.date('Y').'/'.date('m').'/'.date('d').'/'.$id.'.pdf';
                    Storage::put($pathspt,$pdfspt->download()->getOriginalContent());
                    $spt=$this->model::find($id);
                    $spt->file_spt()->Create([
                        'name'                  => 'spt',
                        'data'                      =>  [
                            'disk'      => config('filesystems.default'),
                            'target'    => $pathspt,
                        ]
                    ]);

                    $sptpeg = SptPegawai::whereSptId($id)->get();
                    foreach($sptpeg as $sptpegawai){
                        $nomorSPPD = NomorTerakhir::whereOpdId(Auth::user()->bidang->opd_id)->whereBidangId($bidang->id)->whereJenis('SPPD')->first();
                        $no_sppd=$kodeOpd->kode.'/SPPD-'.$bidang->singkatan.'/'.date("Y").'/'.sprintf("%02d", ($nomorSPPD->nomor_terakhir+1));
                        
                        //save no_sppd
                        SptPegawai::find($sptpegawai->id)->update(['no_sppd'=>$no_sppd]);

                        //save nomor_terakhir
                        NomorTerakhir::find($nomorSPPD->id)->update(['nomor_terakhir'=>sprintf("%02d", ($nomorSPPD->nomor_terakhir+1))]);
                        
                        //save file sppd
                        $pdfsppd = $this->pdfsppd($id,$sptpegawai->pegawai_id);
                        $pathsppd = $this->kode.'/sppd/'.date('Y').'/'.date('m').'/'.date('d').'/'.$sptpegawai->id.'.pdf';
                        Storage::put($pathsppd,$pdfsppd->download()->getOriginalContent());
                        $sppd=SptPegawai::find($sptpegawai->id);
                        $sppd->file_sppd()->Create([
                            'name'                  => 'sppd',
                            'data'                      =>  [
                                'disk'      => config('filesystems.default'),
                                'target'    => $pathsppd,
                            ]
                        ]);
                    }

                }else{
                    $spt=$this->model::find($id)->update($request->all());
                }

                $response=['status'=>true, 'pesan'=>'Data berhasil diubah'];
            }
            return $response ?? ['status'=>TRUE, 'pesan'=>['msg'=>'Data berhasil diubah']];
        }
        else {
            exit('Ops, an Ajax request');
        }
    }

    function setnomor($idspt){

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
