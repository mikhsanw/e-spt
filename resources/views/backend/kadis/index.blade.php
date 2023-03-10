@extends('layouts.backend.index')
@section('title','Dashboard')
@section('header','Dashboard')
@section('content')
<section class="content">
	<h6 class="pull-right">{{date("l, d F Y")}}</h6>
		<div class="box">
			<div class="box-header with-border">
				<h4 class="box-title d-block text-left"><i class="fas fa-envelope"></i> SPT</h4>          
			</div>
			</div>
                <div class="row">
            <div class="col-xl-3">
					<a href="#" class="box">
						<div class="box-body">
							<div class="d-flex justify-content-between align-items-center">
								<div>								
									<div class="text-dark font-weight-700 h2 mb-2 mt-5">24</div>
									<div class="font-size-16">Baru</div>
								</div>
								<div class="bg-primary-light rounded-circle h-80 w-80 text-center l-h-100">
									<span class="text-primary font-size-40 fa fa-envelope"></span>					
								</div>
							</div>
						</div>
					</a>
				</div>
                <div class="col-xl-3">
					<a href="#" class="box">
						<div class="box-body">
							<div class="d-flex justify-content-between align-items-center">
								<div>								
									<div class="text-dark font-weight-700 h2 mb-2 mt-5">24</div>
									<div class="font-size-16">Disetujui</div>
								</div>
								<div class="bg-success-light rounded-circle h-80 w-80 text-center l-h-100">
									<span class="text-success font-size-40 fa fa-check"></span>					
								</div>
							</div>
						</div>
					</a>
				</div>
                <div class="col-xl-3">
					<a href="#" class="box">
						<div class="box-body">
							<div class="d-flex justify-content-between align-items-center">
								<div>								
									<div class="text-dark font-weight-700 h2 mb-2 mt-5">24</div>
									<div class="font-size-16">Proses Revisi</div>
								</div>
								<div class="bg-warning-light rounded-circle h-80 w-80 text-center l-h-100">
									<span class="text-warning font-size-40 fa fa-spinner"></span>					
								</div>
							</div>
						</div>
					</a>
				</div>
				<div class="col-xl-3">
					<a href="#" class="box">
						<div class="box-body">
							<div class="d-flex justify-content-between align-items-center">
								<div>								
									<div class="text-dark font-weight-700 h2 mb-2 mt-5">810</div>
									<div class="font-size-16">Ditolak</div>
								</div>
								<div class="bg-danger-light rounded-circle h-80 w-80 text-center l-h-100">
									<span class="text-danger font-size-40 fa fa-close"></span>									
								</div>
							</div>
						</div>
					</a>
				</div>
	
		</div>
 
</section>
@endsection