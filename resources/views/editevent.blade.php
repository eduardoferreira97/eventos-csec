@extends('layouts.padrao')
@include('ckfinder::setup')

@section('style')
@if($field == "apresentation" || $field == "palestrantes" || $field == "add_palestrante")
<link rel="stylesheet" type="text/css" href="{{ asset('css/simeditor/simditor.css') }}" />
@elseif($field == "general")
<link rel="stylesheet" href="{{ asset('css/clockpicker/bootstrap-clockpicker.min.css') }}"/>
@endif
@endsection

@section('titulo-principal')
@if($field == "apresentation")
Editar descrição
@elseif($field == "programacao")
Editar Programação
@elseif($field == "folder")
Editar Folder
@elseif($field == "general")
Editar informações
@elseif($field == "palestrantes")
Editar informações de palestrante
@elseif($field == "oficinas")
Editar informações do Minicurso
@elseif($field == "add_palestrante")
Adicionar palestrante
@elseif($field == "adicionar_palestras")
Adicionar palestra
@elseif($field == "palestras")
Editar informações da palestra
@elseif($field == "add_minicurso")
Adicionar minicurso
@endif
@endsection

@section('conteudo-principal')
@if($field == "apresentation")
<div class="d-flex my-4">
  {!! Form::open(array('route' => ['events.edit', $id],'method'=>'POST')) !!}
  {!! Form::textarea('input', $old->apresentation, ['id' => 'editor1']) !!}

  <div class="mt-4">
    <a href="{{ route('events.show', ['id' => $id]) }}" class="btn btn-primary mr-3">
      Voltar
    </a>
    {!! Form::hidden('info', 'editar_apresentacao') !!}
    {!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}
  </div>
  {!! Form::close() !!}
</div>
@elseif($field == "programacao")
<div class="d-flex my-4">
  {!! Form::open(array('route' => ['events.edit', $id],'method'=>'POST')) !!}
  {!! Form::textarea('input', $old->programacao, ['id' => 'editor1']) !!}
  <div class="mt-4">
    <a href="{{ route('events.show', ['id' => $id]) }}" class="btn btn-primary mr-3">
      Voltar
    </a>
    {!! Form::hidden('info', 'editar_programacao') !!}
    {!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}
  </div>
  {!! Form::close() !!}
</div>
@elseif($field == "folder")
<div class="d-flex my-4">
  {!! Form::open(array('route' => ['events.edit', $id],'method'=>'POST')) !!}
  {!! Form::textarea('input', $old->folder, ['id' => 'editor1']) !!}
  <div class="mt-4">
    <a href="{{ route('events.show', ['id' => $id]) }}" class="btn btn-primary mr-3">
      Voltar
    </a>
    {!! Form::hidden('info', 'editar_folder') !!}
    {!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}
  </div>
  {!! Form::close() !!}
</div>
@elseif($field == "general")
{!! Form::open(array('route' => ['events.edit', $id],'method'=>'POST')) !!}
<div class="d-flex flex-column panel-body">    
  <div class="d-flex flex-column mb-4">
    {!! Form::label('title','Nome do evento:') !!}
    {!! Form::text('title', $old['title'], ['class' => 'form-control']) !!}
  </div>
  <div class="d-flex flex-column mb-4">
    {!! Form::label('link','Link do evento:') !!}
    {!! Form::text('link', $old['link'], ['class' => 'form-control','placeholder' => 'Caso o evento tenha um site']) !!}
  </div>

  <div class="d-flex flex-column mb-4">
    {!! Form::label('local','Local do evento:') !!}
    {!! Form::text('local', $old['local'], ['class' => 'form-control']) !!}
  </div>
  <div class="d-flex flex-column mb-4">
    {!! Form::label('rua','Rua do evento:') !!}
    {!! Form::text('rua', $old['rua'], ['class' => 'form-control']) !!}
  </div>
  <div class="d-flex flex-column mb-4">
    {!! Form::label('cidade','Cidade do evento:') !!}
    {!! Form::text('cidade', $old['cidade'], ['class' => 'form-control']) !!}
  </div>
  <div class="d-flex flex-column mb-4">
    {!! Form::label('valor','Valor do evento:') !!}
    {!! Form::text('valor', $old['valor'], ['class' => 'form-control']) !!}
  </div>
  <div class="d-flex flex-column mb-4">
    {!! Form::label('hora_comple','Horas ofertadas:') !!}
    {!! Form::text('hora_comple', $old['hora_comple'], ['class' => 'form-control']) !!}
  </div>
  <div class="d-flex flex-fill mb-4">
    <div class="d-flex flex-column mr-4">
      {!! Form::label('start_date','Data de início:') !!}
      {!! Form::date('start_date', $old['start_date'], ['class' => 'form-control']) !!}
    </div>
    <div class="d-flex flex-column">
      {!! Form::label('end_date','Data de término:') !!}
      {!! Form::date('end_date', $old['end_date'], ['class' => 'form-control']) !!}
    </div>
  </div>
  <div class="d-flex flex-fill mb-4">
    <div class="d-flex flex-column mr-4">
      {!! Form::label('all_day','Dia todo?') !!}
      {!! Form::checkbox('all_day', $old['all_day'], false) !!}
    </div>
    <div class="d-flex flex-column mr-4 clockpicker">
      {!! Form::label('start_time','Horário inicial:') !!}
      {!! Form::text('start_time', $old['start_time'], ['class' => 'form-control', 'placeholder' => '--:--']) !!}
    </div>

    <div class="d-flex flex-column clockpicker">
      {!! Form::label('end_time','Horário final:') !!}
      {!! Form::text('end_time', $old['end_time'], ['class' => 'form-control', 'placeholder' => '--:--']) !!}
    </div>
  </div>
  <div class="mt-4">
    <a href="{{ route('events.show', ['id' => $id]) }}" class="btn btn-primary mr-3">
      Voltar
    </a>
    {!! Form::hidden('info', 'editar_informacoes') !!}
    {!! Form::submit('Salvar',['class'=>'btn btn-primary']) !!}
  </div>
  {!! Form::close() !!}
</div>
@elseif($field == "palestras")
<div class="d-flex my-4">
  {!! Form::open(array('route' => ['events.edit', $id],'method'=>'POST', 'files' => true)) !!}
  {!! Form::label('titulo','Nome da palestra:') !!}
  {!! Form::text('titulo', $old->titulo, ['class' => 'form-control mb-4']) !!}
</div>
<div class="d-flex flex-column mr-4">
  {!! Form::open(array('route' => ['events.edit', $id],'method'=>'POST')) !!}
  {!! Form::label('horas','Horas Ofertada:') !!}
  {!! Form::text('horas', $old->horas, ['class' => 'form-control mb-4']) !!}
</div>
  <div class="d-flex flex-column">
    {!! Form::label('input','Apresentação:') !!}
    {!! Form::textarea('input', $old->apresentacao, ['id' => 'editor1']) !!} 
  </div> 
  <div class="mt-4">
    <a href="{{ route('events.show', ['id' => $id]) }}" class="btn btn-primary mr-3">
      Voltar
    </a>
    {!! Form::hidden('id', $old->id) !!}
    {!! Form::hidden('info', 'editar_palestra') !!}
    {!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}
  </div>
  {!! Form::close() !!}
</div>
@elseif($field == "oficinas")
<div class="d-flex my-4">
  {!! Form::open(array('route' => ['events.edit', $id],'method'=>'POST')) !!}
  {!! Form::label('titulo','Título:') !!}
  {!! Form::text('titulo', null, ['class' => 'form-control mb-4']) !!}
  {!! Form::label('palestrante1','Palestrante:') !!}
  {!! Form::text('palestrante1', null, ['class' => 'form-control mb-4']) !!}
  {!! Form::label('palestrante2','Palestrante:') !!}
  {!! Form::text('palestrante2', null, ['class' => 'form-control mb-4']) !!}
  {!! Form::label('palestrante3','Palestrante:') !!}
  {!! Form::text('palestrante3', null, ['class' => 'form-control mb-4']) !!}
  {!! Form::label('palestrante4','Palestrante:') !!}
  {!! Form::text('palestrante4', null, ['class' => 'form-control mb-4']) !!}
  <div class="d-flex flex-fill mb-4">
    <div class="d-flex flex-column mb-4">
      {!! Form::label('start_date','Data:') !!}
      {!! Form::date('start_date', null, ['class' => 'form-control']) !!}
    </div>
  </div>
  <div class="d-flex flex-fill mb-4">
    <div class="d-flex flex-column mr-4 clockpicker">
      {!! Form::label('start_time','Horário inicial:') !!}
      {!! Form::text('start_time', null, ['class' => 'form-control', 'placeholder' => '--:--']) !!}
    </div>
    <div class="d-flex flex-column mr-4 clockpicker">
      {!! Form::label('end_time','Horário final:') !!}
      {!! Form::text('end_time', null, ['class' => 'form-control', 'placeholder' => '--:--']) !!}
    </div>
  </div>
  <div class="d-flex flex-column mb-4">
    {!! Form::label('hora_comple','Horas ofertadas:') !!}
    {!! Form::text('hora_comple', null, ['class' => 'form-control']) !!}
  </div>
  <div class="d-flex flex-column mb-4">
    {!! Form::label('local','Local do curso:') !!}
    {!! Form::text('local', $old->local, ['class' => 'form-control']) !!}
    {!! Form::label('valor','Valor do curso:') !!}
    {!! Form::text('valor', $old->valor, ['class' => 'form-control']) !!}
  </div>
  <div class="d-flex flex-column">
    {!! Form::label('input','Descrição do palestrante:') !!}
    {!! Form::textarea('input', $old->apresentation, ['id' => 'editor1']) !!}   
  </div>
  <div class="mt-4">
    <a href="{{ route('events.show', ['id' => $id]) }}" class="btn btn-primary mr-3">
      Voltar
    </a>
    {!! Form::hidden('id', $old->id) !!}
    {!! Form::hidden('info', 'editar_oficinas') !!}
    {!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}
  </div>
  {!! Form::close() !!}
</div>
@elseif($field == "add_palestra")
<div class="d-flex my-4">
  {!! Form::open(array('route' => ['events.edit', $id],'method'=>'POST')) !!}
  {!! Form::label('titulo','Título:') !!}
  {!! Form::text('titulo', null, ['class' => 'form-control mb-4']) !!}
  <!-- {!! Form::label('palestrante','Palestrante:') !!}
    {!! Form::text('palestrante', null, ['class' => 'form-control mb-4']) !!} -->
  <!-- {!! Form::label('local','Local:') !!}
    {!! Form::text('local', null, ['class' => 'form-control mb-4']) !!} -->
  </div>
  <div class="d-flex flex-column">
  {!! Form::open(array('route' => ['events.edit', $id],'method'=>'POST')) !!}
  {!! Form::label('horas','Horas ofertadas:') !!}
  {!! Form::text('horas', null, ['class' => 'form-control mb-4']) !!}
</div>
    <div class="d-flex flex-column">
      {!! Form::label('input','Descrição da palestra:') !!}
      {!! Form::textarea('input', null, ['id' => 'editor1']) !!} 
    </div> 
    <div class="mt-4">
      <a href="{{ route('events.show', ['id' => $id]) }}" class="btn btn-primary mr-3">
        Voltar
      </a>
      {!! Form::hidden('info', 'adicionar_palestra') !!}
      {!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
  </div>
  @elseif($field == "add_minicurso")
  <div class="d-flex my-4">
    {!! Form::open(array('route' => ['events.edit', $id],'method'=>'POST')) !!}
    {!! Form::label('titulo','Título:') !!}
    {!! Form::text('titulo', null, ['class' => 'form-control mb-4']) !!}
    {!! Form::label('palestrante1','Palestrante:') !!}
    {!! Form::text('palestrante1', null, ['class' => 'form-control mb-4']) !!}
    {!! Form::label('palestrante2','Palestrante:') !!}
    {!! Form::text('palestrante2', null, ['class' => 'form-control mb-4']) !!}
    {!! Form::label('palestrante3','Palestrante:') !!}
    {!! Form::text('palestrante3', null, ['class' => 'form-control mb-4']) !!}
    {!! Form::label('palestrante4','Palestrante:') !!}
    {!! Form::text('palestrante4', null, ['class' => 'form-control mb-4']) !!}
    <div class="d-flex flex-fill mb-4">
      <div class="d-flex flex-column mb-4">
        {!! Form::label('start_date','Data:') !!}
        {!! Form::date('start_date', null, ['class' => 'form-control']) !!}
      </div>
    </div>
    <div class="d-flex flex-fill mb-4">
      <div class="d-flex flex-column mr-4 clockpicker">
        {!! Form::label('start_time','Horário inicial:') !!}
        {!! Form::text('start_time', null, ['class' => 'form-control', 'placeholder' => '--:--']) !!}
      </div>
      <div class="d-flex flex-column mr-4 clockpicker">
        {!! Form::label('end_time','Horário final:') !!}
        {!! Form::text('end_time', null, ['class' => 'form-control', 'placeholder' => '--:--']) !!}
      </div>
    </div>
    <div class="d-flex flex-column mb-4">
      {!! Form::label('hora_comple','Horas ofertadas:') !!}
      {!! Form::text('hora_comple', null, ['class' => 'form-control']) !!}
    </div>
    <div class="d-flex flex-column mb-4">
      {!! Form::label('local','Local do curso:') !!}
      {!! Form::text('local', null, ['class' => 'form-control']) !!}
      {!! Form::label('valor','Valor do curso:') !!}
      {!! Form::text('valor', null, ['class' => 'form-control']) !!}
    </div>
    <div class="d-flex flex-column">
      {!! Form::label('input','Descrição do minicurso:') !!}
      {!! Form::textarea('input', null, ['id' => 'editor1']) !!} 
    </div> 
    <div class="mt-4">
      <a href="{{ route('events.show', ['id' => $id]) }}" class="btn btn-primary mr-3">
        Voltar
      </a>
      {!! Form::hidden('info', 'adicionar_minicurso') !!}
      {!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
  </div>
  @endif
  @endsection

  @section('script')
  @if($field == "general")
  <script src="{{ asset('js/clockpicker/bootstrap-clockpicker.min.js') }}"></script>
  <script src="{{ asset('js/lib/moment.min.js') }}"></script>
  <script>
    $('.clockpicker').clockpicker({
      placement: 'bottom',
      default: 'now',
      align: 'left',
      autoclose: true,
    });
  </script>
  <script>
    document.getElementById('all_day').onchange = function() {
      document.getElementById('start_time').disabled = this.checked;
      document.getElementById('end_time').disabled = this.checked;
    };
  </script>
  @endif
  @endsection
