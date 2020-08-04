@extends('layouts.admin', [
  'page_header' => 'Yönetim Paneli',
  'dash' => 'active',
  'quiz' => '',
  'users' => '',
  'questions' => '',
  'top_re' => '',
  'all_re' => '',
  'sett' => ''
])

@section('content')
<!---->
  <div class="dashboard-block">
    <div class="row">
      <div class="col-md-7">
        <div class="row">
          <div class="col-md-6">
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3>{{$user}}</h3>
                <p>Toplam Yarışmacı</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="{{url('/admin/users')}}" class="small-box-footer">
                Daha Fazla Bilgi <i class="fa fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <div class="col-md-6">
            <div class="small-box bg-red">
              <div class="inner">
                <h3>{{$quiz}}</h3>
                <p>Toplam Yarışma</p>
              </div>
              <div class="icon">
                <i class="fa fa-question-circle-o"></i>
              </div>
              <a href="{{url('/admin/topics')}}" class="small-box-footer">
                Daha Fazla Bilgi <i class="fa fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <div class="col-md-6">
            <div class="small-box bg-green">
              <div class="inner">
                <h3>{{$question}}</h3>
                <p>Toplam Soru</p>
              </div>
              <div class="icon">
                <i class="fa fa-question-circle-o"></i>
              </div>
              <a href="{{url('/admin/questions')}}" class="small-box-footer">
                Daha Fazla Bilgi <i class="fa fa-arrow-circle-right"></i>
              </a>
            </div>
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#AllDeleteModal">Bütün Cevapları Sil(Önerilmez)</button>
            <p>Tüm Sonuçları Siler</p>
            <!-- All Delete Button -->
            <div id="AllDeleteModal" class="delete-modal modal fade" role="dialog">
              <!-- All Delete Modal -->
              <div class="modal-dialog modal-sm">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="delete-icon"></div>
                  </div>
                  <div class="modal-body text-center">
                    <h4 class="modal-heading">Are You Sure ?</h4>
                    <p>Do you really want to delete "All these records"? This process cannot be undone.</p>
                  </div>
                  <div class="modal-footer">
                    {!! Form::open(['method' => 'POST', 'action' => 'DestroyAllController@AllAnswersDestroy']) !!}
                        {!! Form::reset("No", ['class' => 'btn btn-gray', 'data-dismiss' => 'modal']) !!}
                        {!! Form::submit("Yes", ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-5">
        <div class="box box-danger">
          <div class="box-header with-border">
            <h4 class="box-title">Son Yarışmacılar</h4>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body no-padding">
            <ul class="users-list clearfix">
              @if ($user_latest)
                @foreach ($user_latest as $user)
                  <li>
                    <a class="users-list-name" href="#" title="{{$user->name}}">{{$user->name}}</a>
                    <span class="users-list-date">{{$user->created_at->diffForHumans()}}</span>
                  </li>
                @endforeach
              @endif
            </ul>
            <!-- /.users-list -->
          </div>
          <!-- /.box-body -->
         
          <div class="box-footer text-center">
            <a href="{{url('admin/users')}}" class="uppercase">Tüm Yarışmacıları Gör</a>
          </div>
       
          <!-- /.box-footer -->
        </div>
      </div>
    </div>
  </div>
@endsection
