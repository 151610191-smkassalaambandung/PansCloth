@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="{{ url('/home') }}">Dashboard</a></li>
				<li><a href="{{ url('/admin/kategori') }}">kategori</a></li>
				<li class="active">Ubah Profil kategori</li>
			</ul>
<div class="panel" style="background-color: rgba(255,255,255,0.5);">
				<div class="panel-heading">
					<h2 class="panel-title">Ubah Profil kategori</h2>
				</div>
				<div class="panel-body">
					{!! Form::model($kategori, ['url' => route('kategori.update', $kategori->id),
					'method' => 'put', 'files'=>'true', 'class'=>'form-horizontal']) !!}
					@include('kategori._form')
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection