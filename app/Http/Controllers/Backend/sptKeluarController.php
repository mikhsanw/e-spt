<?php

namespace App\Http\Controllers\backend;

use App\Model\Bidang;
use App\Model\Pegawai;
use App\Model\Kegiatan;
use App\model\SptPegawai;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
            $data= $this->model::with('bidang');
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', '<div style="text-align: center;">
               <a class="edit ubah" data-toggle="tooltip" data-placement="top" title="Edit" '.$this->kode.'-id="{{ $id }}" href="#edit-{{ $id }}">
                   <i class="fa fa-eye text-warning"></i>
               </a>&nbsp; &nbsp;
             
           </div>')
           ->addColumn('tanggal_pengajuan',function($row){
                return Help::time_ago($row->created_at);
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

                    foreach($request->file_notadinas as $file){
                            $spt->file_notadinas()->Create([
                                'name'                  => 'notadinas',
                                'data'                      =>  [
                                    'disk'      => config('filesystems.default'),
                                    'target'    => Storage::putFile($this->kode.'/notadinas/'.date('Y').'/'.date('m').'/'.date('d'),$file->file('file_notadinas')),
                                ]
                            ]);
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
        $data=[
            'bidang'     => Bidang::pluck('nama','id'),
            'data'    => $this->model::find($id)
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
                'nip'              => 'required|'.config('master.regex.json'),
                'nama'             => 'required|'.config('master.regex.json'),
                'golongan'             => 'required|'.config('master.regex.json'),
                'pangkat'             => 'required|'.config('master.regex.json'),
            ]);
            if ($validator->fails()) {
                $response=['status'=>FALSE, 'pesan'=>$validator->messages()];
            }
            else {
                $this->model::find($id)->update($request->all());
                $respon=['status'=>true, 'pesan'=>'Data berhasil diubah'];
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
