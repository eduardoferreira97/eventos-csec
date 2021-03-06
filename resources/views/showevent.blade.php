@extends('layouts.padrao')

@section('titulo-principal')
<div class="d-flex">
  <div class="d-flex flex-fill">
    {{ $data['title'] }}
  </div>
  <div class="d-flex align-self-center">
    <a href="{{ route('events.index') }}" class="btn btn-primary">Voltar</a>
  </div>
</div>
@endsection
@section('conteudo-principal')
<div class="d-flex mb-4">
  <div class="d-flex flex-column mr-auto">
    <h4>
      Coordenador:
      <a class="btn btn-link" href="{{ route('user.index', ['id' => $info->id]) }}">
        {{ $info->name }}
      </a>
    </h4>
    <h6>Período:
      {{$data['start_date']}}  às  {{$data['start_time']}}
      até {{$data['end_date']}} às {{$data['end_time']}}
    </h6>
    @if($data['link'] != null)
    <h6>Para mais informações:<a target="_blank" href="{{$data['link']}}">  {{$data['link']}}</a></h6>
    @else
    <!-- não aparece nada -->
    @endif
    @auth('admin-web')
    <div class="d-flex mt-4">
      {!! Form::open(array('route' => ['events.edit', $data['id']],'method'=>'POST')) !!}
      {!! Form::hidden('info', 'general') !!}
      {!! Form::submit('Editar informações', ['class'=>'btn btn-primary']) !!}
      {!! Form::close() !!}
    </div>
    <div class="d-flex align-self">
      <a href="{{ route('lista.qr',$data['id']) }}" class="btn btn-primary" target="_blank">Download QRCode</a>
    </div>
    @endauth
  </div> 
</div>
<div class="d-flex flex-column mb-4">
  <div class="d-flex flex-column mb-3">
    <h2>Informações:</h2>
  </div>
  <div class="d-flex flex-column">
    <ul class="nav nav-tabs ml-0 mb-0">
      <li class=""><a data-toggle="tab" href="#descricao">Descrição</a></li>
      <li class=""><a data-toggle="tab" href="#programacao">Programação</a></li>
      <!-- <li class="active"><a data-toggle="tab" href="#folder">Folder</a></li> -->
    </ul>
    <div class="tab-content">
      <div id="descricao" class="tab-pane fade">
        <div class="card">
          <div class="card-body">
            <div class="d-flex mb-3 flex-column">
              @if($data['apresentation'] != null)
              {!! $data['apresentation'] !!}
              @else
              <div class="text-muted">
                Nada para informar.
              </div>
              @endif
            </div>
            @auth('admin-web')
            <div class="d-flex">
              {!! Form::open(array('route' => ['events.edit', $data['id']],'method'=>'POST')) !!}
              {!! Form::hidden('info', 'apresentation') !!}
              {!! Form::submit('Editar campo', ['class'=>'btn btn-primary']) !!}
              {!! Form::close() !!}
            </div>
            @endauth
          </div>
        </div>
      </div>
      <div id="programacao" class="tab-pane fade">
        <div class="card">
          <div class="card-body">
            <div class="d-flex mb-3 flex-column">
              @if($data['programacao'] != null)
              {!! $data['programacao'] !!}
              @else
              <div class="text-muted">
                Nada para informar.
              </div>
              @endif
            </div>
            @auth('admin-web')
            <div class="d-flex">
              {!! Form::open(array('route' => ['events.edit', $data['id']],'method'=>'POST')) !!}
              {!! Form::hidden('info', 'programacao') !!}
              {!! Form::submit('Editar campo', ['class'=>'btn btn-primary']) !!}
              {!! Form::close() !!}
            </div>
            @endauth
          </div>
        </div>
      </div>
      <div id="folder" class="tab-pane fade in active">
        <div class="card">
          <div class="card-body">
            <div class="d-flex mb-3 flex-column">
              @if($data['folder'] != null)
              {!! $data['folder'] !!}
              @else
              <div class="text-muted">
                Nada para informar.
              </div>
              @endif
            </div>
            @auth('admin-web')
            <div class="d-flex">
              {!! Form::open(array('route' => ['events.edit', $data['id']],'method'=>'POST')) !!}
              {!! Form::hidden('info', 'folder') !!}
              {!! Form::submit('Editar campo', ['class'=>'btn btn-primary']) !!}
              {!! Form::close() !!}
            </div>
            @endauth
          </div>
        </div>
      </div>
    </div> 
  </div>
</div>
<div class="d-flex flex-column">
  <div class="d-flex mr-auto mb-3">
    <h2>Palestras:</h2>
  </div>
  <div id="accordion d-flex text-justify">
    <div class="card">
      @foreach ($palestra as $palestra)
      <div class="card-header d-flex" id="heading{{$palestra->id}}">
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$palestra->id}}" aria-expanded="false" aria-controls="collapse{{$palestra->id}}">
          {{$palestra->titulo}}
        </button>
        @auth('admin-web')
        <div class="d-flex">
          {!! Form::open(array('route' => ['events.edit', $data['id']],'method'=>'POST')) !!}
          {!! Form::hidden('info', 'palestras') !!}
          {!! Form::hidden('old', $palestra->id) !!}
          {!! Form::submit('Editar campo', ['class'=>'btn btn-primary']) !!}
          {!! Form::close() !!}
        </div>
        @endauth
      </div>
      <div id="collapse{{$palestra->id}}" class="collapse" aria-labelledby="heading{{$palestra->id}}" data-parent="#accordion">
        <div class="card-body">

          {!! $palestra->apresentacao !!}

          @if(Auth::user())
          {!! Form::open(array('route' => ['events.palestras', $data['id'],$palestra->id],'method'=>'POST')) !!}
          {!! Form::hidden('info', 'inscricao_palestra') !!}
          {!! Form::submit('Inscreva-se', ['class'=>'btn btn-link']) !!}
          {!! Form::close() !!}
          @endif

          @if($errors->any())
          <h4 class="alert alert-success">{{$errors->first()}}</h4>
          @endif

          @auth('admin-web')
          <h5>Pessoas inscritas: {{$contagem}}</h5>
          @endauth
        </div>
      </div>
      @endforeach
      @auth('admin-web')
      <div class="card-header">
        {!! Form::open(array('route' => ['events.edit', $data['id']],'method'=>'POST')) !!}
        {!! Form::hidden('info', 'add_palestra') !!}
        {!! Form::submit('+ Adicionar palestra', ['class'=>'btn btn-link']) !!}
        {!! Form::close() !!}
      </div>
      @endauth
    </div>
  </div>
</div>
<div class="d-flex flex-column" id="palestras">
  <div class="d-flex mr-auto mb-3">
    <h2>
      Inscrição evento:
    </h2>
  </div>
  
  <div class="tab-content">
    <div id="inscricao" class="tab-pane fade in active">
      <div class="card">
        <div class="card-body">
          @auth('user-web')
          @if(Auth::user()->tipo == '2' )
          {!! Form::open(array('route' => ['events.inscricoes', $data['id']],'method'=>'POST')) !!}
          {!! Form::hidden('info', 'inscricao_docente') !!}
          {!! Form::submit('Inscrição Docente', ['class'=>'btn btn-link']) !!}
          {!! Form::close() !!}
          @endif
          @endauth
          @auth('admin-web')
          @if($data['inicio_inscricoes'] == null)
          Datas não definidas!
          <br>
          <br>
          {!! Form::open(array('route' => ['events.inscricoes', $data['id']],'method'=>'POST')) !!}
          {!! Form::hidden('info', 'mostrar_edicao') !!}
          {!! Form::submit('Definir datas', ['class'=>'btn btn-danger']) !!}
          {!! Form::close() !!}
          @elseif($data['inicio_inscricoes']  != null)
          Deseja mudar as datas?
          {!! Form::open(array('route' => ['events.inscricoes', $data['id']],'method'=>'POST')) !!}
          {!! Form::hidden('info', 'mostrar_edicao') !!}
          {!! Form::submit('Redefinir datas', ['class'=>'btn btn-danger']) !!}
          {!! Form::close() !!}
          @endauth
          @else
          @auth('user-web')
          @if(Auth::user()->tipo == null || Auth::user()->tipo == '1')
          {!! Form::open(array('route' => ['events.escolha', $data['id']],'method'=>'GET')) !!}
          {!! Form::submit('Inscrever-se', ['class'=>'btn btn-primary']) !!}
          {!! Form::close() !!}
          @endif
          @endauth
          @guest
          Ainda não é cadastrado? <a class="btn btn-link" href="{{ route('register') }}">Clique aqui </a>e cadastre-se!
          @endguest
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@auth('admin-web')
<div class="d-flex flex-column" id="credenciamento">
  <div class="d-flex mr-auto mb-3">
    <h2>
      Credenciamento:
    </h2>
  </div>
  <div class="d-flex flex-column text-justify">
    <ul class="nav nav-tabs ml-0 mb-0">
      <li class="active">
        <a data-toggle="tab" href="#confirmacao">Confirmação da Inscrição</a>
      </li>
      <li class="present">
        <a data-toggle="tab" href="#ata">Ata de presença</a>
      </li>
    </ul>
    <div class="tab-content">
      <div id="confirmacao" class="tab-pane fade in active">
        <div class="card">
          <div class="card-body">
            <div class="d-flex mb-5 flex-column">

              <table  class="table">
                <thead>
                  <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Status inscrições</th>
                    @auth('admin-web')
                    <th scope="col">Ação</th>
                    @endauth
                  </tr>
                </thead>
                <tbody> 
                 @foreach ($inscricaos as $inscricaos)
                 <tr>
                  <td scope="row">{{$inscricaos->user->name}}</td>
                  <td>{{$inscricaos->user->email}}</td>
                  @if($inscricaos->status == 0)
                  <td>Aguardando confirmação...</td>
                  @else
                  <td>Inscrição confirmada!</td>
                  @endif
                  @auth('admin-web')
                  <td>
                    @if($inscricaos->status == 0)
                    <a class="btn btn-success" href="javascript:(confirm('Confirmar status da inscrição de {{$inscricaos->user->name}}?') ? window.location.href='{{route('events.aprovar', $inscricaos->id)}}' : false)">Status</a>
                    @else
                    <a class="btn btn-warning" href="javascript:(confirm('Mudar status da inscrição de {{$inscricaos->user->name}}?') ? window.location.href='{{route('events.aprovar', $inscricaos->id)}}' : false)">Status</a>
                    @endif
                    <a class="btn btn-danger" href="javascript:(confirm('Deletar essa inscrição?') ? window.location.href='{{route('events.deletarIns', $inscricaos->id)}}' : false)">Deletar</a>
                  </td>
                  @endauth
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div id="ata" class="tab-pane fade">
      <div class="card">
        <div class="card-body">
          <div class="d-flex mb-5 flex-column">

            <table  class="table">
              <thead>
                <tr>
                  <th scope="col">Nome</th>
                  <th scope="col">Status presença</th>
                  <th scope="col">Ação</th>
                </tr>
              </thead>
              <tbody> 
               @foreach ($presenca as $presenca)
               <tr>
                @if($presenca->status == 1)
                <td scope="row">{{$presenca->user->name}}</td>
                @if($presenca->presenca == 0)
                <td>Faltou</td>
                @else
                <td>Presente</td>
                @endif
                @auth('admin-web')
                <td>
                  <a class="btn btn-success" href="{{route('events.presenca', $presenca->id)}}">Status</a>
                </td>
                @endauth
                @endif
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
@endauth
@auth('admin-web')
<div class="d-flex flex-column" id="credenciamento">
  <div class="d-flex mr-auto mb-3">
    <h2>
      Certificados:
    </h2>
  </div>
  <div class="d-flex flex-column text-justify" id="tabela">
    <div class="tab-content">
      <div id="confirmacao" class="tab-pane fade in active">
        <div class="card">
          <div class="card-body">
            <div class="d-flex mb-5 flex-column">

              <table  class="table">
                <thead>
                  <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col">Status</th>
                    <th scope="col">Ação</th>
                  </tr>
                </thead>
                <tbody> 
                  <tr   >
                    <td>
                     @foreach($certificado as $certificado)
                     @if($certificado->presenca == 1)
                     <tr>
                      <td class="nome">{{$certificado->user->name}}</td>
                      <td class="nome">{{$certificado->user->email}}</td>
                      @if($certificado->envio == 0)
                      <td class="nome" id="nome"><strong>Não enviado</strong></td>
                      @else
                      <td class="nome" id="nome"><strong>Enviado</strong></td>
                      @endif
                      <td>
                        <a target="_blank" href="{{(url('/certificado/download/'.$certificado->evento->id.'/usuario/'.$certificado->user->id) )}}" class="btn btn-success" >Abrir</a>
                        <a href="{{url('/send/certificado/'.$certificado->evento->id.'/evento/'.$certificado->user->id).'/presenca'}}" class="btn btn-info">Enviar</a>
                      </td>
                      @endif
                    </tr>
                    @endforeach
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endauth

<!-- <div class="d-flex flex-column" id="relatorio">
  <div class="d-flex mr-auto mb-3">
    <h2>
      Relatório final:
    </h2>
  </div>
  <div class="d-flex flex-column text-justify">
    <div class="card">
      @auth('admin-web')
      <div class="card-body">
        {!! Form::submit('Enviar fotos', ['class'=>'btn btn-danger']) !!}
        {!! Form::submit('Preencher relatório', ['class'=>'btn btn-danger']) !!}
      </div>
      @endauth
    </div>
  </div>
</div> -->
<script type="text/javascript">
  var tempo = window.setInterval(carrega, 1000);
  function carrega()
  {
    $('#tabela').load("showevent.blade.php");
  }
</script>
<!-- Pagina organizador evento -->

@endsection

