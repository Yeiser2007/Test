@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-lg-12">
      <div class="card w-100 border-0 p-0 bg-white shadow-xss rounded-xxl">
        <div class="card-body h250 p-0 rounded-xxl overflow-hidden m-3">
          <div class="container-fluid">
            <div class="row col-12">
              <h1>Respuestas para la pregunta <br> <b>{{ $pregunta->description }}</b></h1>
            </div>
            <respuestas :pregunta_id="{{ $pregunta->id }}"/>
          </div>
        </div>
      </div>
  </div>
</div>      
@endsection
