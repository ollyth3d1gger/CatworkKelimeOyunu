@extends('layouts.admin', [
  'page_header' => 'Yarışmacılar',
  'dash' => '',
  'quiz' => '',
  'users' => 'active',
  'questions' => '',
  'top_re' => '',
  'all_re' => '',
  'sett' => ''
])

@section('content')
@include('message')
  @if ($auth->role == 'A')
    <div class="margin-bottom">
      <button type="button" class="btn btn-wave" data-toggle="modal" data-target="#createModal">Yeni Yarışmacı Ekle</button>
      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#AllDeleteModal">Tüm Yarışmacıları Sil</button>
    </div>
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
            {!! Form::open(['method' => 'POST', 'action' => 'DestroyAllController@AllUsersDestroy']) !!}
                {!! Form::reset("No", ['class' => 'btn btn-gray', 'data-dismiss' => 'modal']) !!}
                {!! Form::submit("Yes", ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
    <!-- Create Modal -->
    <div id="createModal" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Yarışmacı Ekle</h4>
          </div>
          {!! Form::open(['method' => 'POST', 'action' => 'UsersController@store']) !!}
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    {!! Form::label('name', 'Yarışmacı Adı') !!}
                    <span class="required">*</span>
                    {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Yarışmacı İsmi Girin']) !!}
                    <small class="text-danger">{{ $errors->first('name') }}</small>
                  </div>
                  <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    {!! Form::label('email', 'Email Adresi') !!}
                    <span class="required">*</span>
                    {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'eg: info@example.com', 'required' => 'required']) !!}
                    <small class="text-danger">{{ $errors->first('email') }}</small>
                  </div>
                  <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    {!! Form::label('password', 'Şifre') !!}
                    <span class="required">*</span>
                    {!! Form::password('password', ['class' => 'form-control', 'placeholder'=>'Şifre Girin', 'required' => 'required']) !!}
                    <small class="text-danger">{{ $errors->first('password') }}</small>
                  </div>
                  <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                      {!! Form::label('role', 'Kullanıcı Rolü') !!}
                      <span class="required">*</span>
                      {!! Form::select('role', ['S' => 'Student', 'A'=>'Administrator'], null, ['class' => 'form-control select2', 'required' => 'required']) !!}
                      <small class="text-danger">{{ $errors->first('role') }}</small>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                    {!! Form::label('mobile', 'Telefon numarası') !!}
                    <span class="required">*</span>
                    {!! Form::text('mobile', null, ['class' => 'form-control', 'placeholder' => 'eg: +91-123-456-7890', 'required' => 'required']) !!}
                    <small class="text-danger">{{ $errors->first('mobile') }}</small>
                  </div>
                  <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                    {!! Form::label('city', 'Şehir') !!}
                    {!! Form::text('city', null, ['class' => 'form-control', 'placeholder'=>'İkamet ettiğiniz Şehri Girin']) !!}
                    <small class="text-danger">{{ $errors->first('city') }}</small>
                  </div>
                  <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                    {!! Form::label('address', 'Adres') !!}
                    {!! Form::textarea('address', null, ['class' => 'form-control', 'rows'=>'5', 'placeholder' => 'Adres Girin']) !!}
                    <small class="text-danger">{{ $errors->first('address') }}</small>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <div class="btn-group pull-right">
                {!! Form::reset("Sıfırla", ['class' => 'btn btn-default']) !!}
                {!! Form::submit("Ekle", ['class' => 'btn btn-wave']) !!}
              </div>
            </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
    <div class="content-block box">
      <div class="box-body table-responsive">
        <table id="example1" class="table table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Yarışmacı Adı</th>
              <th>Email</th>
              <th>Cep Tel.</th>
              <th>Şehir</th>
              <th>Adres</th>
              <th>Kullanıcı Rolü</th>
              <th>Aksiyonlar</th>
            </tr>
          </thead>
          <tbody>
            @if ($users)
              @php($n = 1)
              @foreach ($users as $key => $user)
                <tr>
                  <td>
                    {{$n}}
                    @php($n++)
                  </td>
                  <td>{{$user->name}}</td>
                  <td>{{$user->email}}</td>
                  <td>{{$user->mobile}}</td>
                  <td>{{$user->city}}</td>
                  <td>{{$user->address}}</td>
                  <td>{{$user->role == 'S' ? 'Student' : '-'}}</td>
                  <td>
                    <!-- Edit Button -->
                    <a type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#{{$user->id}}EditModal"><i class="fa fa-edit"></i> Düzenle</a>
                    <!-- Delete Button -->
                    <a type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#{{$user->id}}deleteModal"><i class="fa fa-close"></i> Sil</a>
                    <div id="{{$user->id}}deleteModal" class="delete-modal modal fade" role="dialog">
                      <!-- Delete Modal -->
                      <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <div class="delete-icon"></div>
                          </div>
                          <div class="modal-body text-center">
                            <h4 class="modal-heading">Are You Sure ?</h4>
                            <p>Do you really want to delete these records? This process cannot be undone.</p>
                          </div>
                          <div class="modal-footer">
                            {!! Form::open(['method' => 'DELETE', 'action' => ['UsersController@destroy', $user->id]]) !!}
                                {!! Form::reset("No", ['class' => 'btn btn-gray', 'data-dismiss' => 'modal']) !!}
                                {!! Form::submit("Yes", ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                          </div>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
                <!-- edit model -->
                <div id="{{$user->id}}EditModal" class="modal fade" role="dialog">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Yarışmacı Düzenle </h4>
                      </div>
                      {!! Form::model($user, ['method' => 'PATCH', 'action' => ['UsersController@update', $user->id]]) !!}
                        <div class="modal-body">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                {!! Form::label('name', 'İsim') !!}
                                <span class="required">*</span>
                                {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'İsim Girin']) !!}
                                <small class="text-danger">{{ $errors->first('name') }}</small>
                              </div>
                              <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                {!! Form::label('email', 'Email adresi') !!}
                                <span class="required">*</span>
                                {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'eg: info@example.com', 'required' => 'required']) !!}
                                <small class="text-danger">{{ $errors->first('email') }}</small>
                              </div>
                              {{-- <label for="">Change Password: </label>
                              <input type="checkbox" name="changepass"> --}}
                              {{-- <input type="radio" value="1" name="changepass" id="ch1">&nbsp;Yes
                               <input type="radio" value="0" name="changepass" checked id="ch2">&nbsp;No --}}
                               <br>
                              <div id="pass" class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                {!! Form::label('password', 'Şifre') !!}
                                <span class="required">*</span>
                               
                                <input class="form-control" type="password" value="" placeholder="Şifre Girin" name="password">
                                <small class="text-danger">{{ $errors->first('password') }}</small>
                              </div>

                              <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                                  {!! Form::label('role', 'Kullanıcı Rolü') !!}
                                  
                                  {!! Form::select('role', ['S' => 'Student', 'A'=>'Administrator'], null, ['class' => 'form-control select2', 'required' => 'required']) !!}
                                  <small class="text-danger">{{ $errors->first('role') }}</small>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                                {!! Form::label('mobile', 'Cep Tel.') !!}
                                
                                {!! Form::text('mobile', null, ['class' => 'form-control', 'placeholder' => 'eg: +91-123-456-7890']) !!}
                                <small class="text-danger">{{ $errors->first('mobile') }}</small>
                              </div>
                              <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                {!! Form::label('city', 'Şehir') !!}
                                {!! Form::text('city', null, ['class' => 'form-control', 'placeholder'=>'İkamet edilen Şehir']) !!}
                                <small class="text-danger">{{ $errors->first('city') }}</small>
                              </div>
                              <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                {!! Form::label('address', 'Adres') !!}
                                {!! Form::textarea('address', null, ['class' => 'form-control', 'rows'=>'5', 'placeholder' => 'Adres girin']) !!}
                                <small class="text-danger">{{ $errors->first('address') }}</small>
                              </div>
                              
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <div class="btn-group pull-right">
                            {!! Form::submit("Güncelle", ['class' => 'btn btn-wave']) !!}
                          </div>
                        </div>
                      {!! Form::close() !!}
                    </div>
                  </div>
                </div>
              @endforeach
            @endif
          </tbody>
        </table>
      </div>
    </div>
  @endif
@endsection
@section('scripts')


<script>
  $('#ch1').click(function(){
    $('#pass').show();
  });

  $('#ch2').click(function(){
    $('#pass').hide();
  });
</script>

@endsection
