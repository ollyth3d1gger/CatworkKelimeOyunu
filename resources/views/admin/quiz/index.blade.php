@extends('layouts.admin', [
  'page_header' => 'Quiz',
  'dash' => '',
  'quiz' => 'active',
  'users' => '',
  'questions' => '',
  'top_re' => '',
  'all_re' => '',
  'sett' => ''
])

@section('content')
  <div class="margin-bottom">
    <button type="button" class="btn btn-wave" data-toggle="modal" data-target="#createModal">Quiz/Yarışma Ekle</button>
  </div>
  <!-- Create Modal -->
  <div id="createModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Quiz Ekle</h4>
        </div>
        {!! Form::open(['method' => 'POST', 'action' => 'TopicController@store']) !!}
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                  {!! Form::label('title', 'Quiz Başlığı') !!}
                  <span class="required">*</span>
                  {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Lütfen bir Quiz Başlığı girin', 'required' => 'required']) !!}
                  <small class="text-danger">{{ $errors->first('title') }}</small>
                </div>
                <div class="form-group{{ $errors->has('per_q_mark') ? ' has-error' : '' }}">
                  {!! Form::label('per_q_mark', 'Soru Başına Puan') !!}
                  <span class="required">*</span>
                  {!! Form::number('per_q_mark', null, ['class' => 'form-control', 'placeholder' => 'Lütfen bir sorunun kaç puan olacağını girin', 'required' => 'required']) !!}
                  <small class="text-danger">{{ $errors->first('per_q_mark') }}</small>
                </div>
                <div class="form-group{{ $errors->has('timer') ? ' has-error' : '' }}">
                  {!! Form::label('timer', 'Quiz/Yarışma Süresi (dakika olarak)') !!}
                  {!! Form::number('timer', null, ['class' => 'form-control', 'placeholder' => 'Lütfen Quiz süresi girin(dakika olarak)']) !!}
                  <small class="text-danger">{{ $errors->first('timer') }}</small>
                </div>

                <!--<label for="married_status">Quiz Price:</label>-->
                {{-- <select name="married_status" id="ms" class="form-control">
                  <option value="no">Free</option>
                  <option value="yes">Paid</option>
                </select> --}}

            <!--    <input type="checkbox" class="quizfp toggle-input" name="quiz_price" id="toggle">
                <label for="toggle"></label>-->
               
                <div style="display: none;" id="doabox">
                   <br>
                  <label for="dob">Choose Quiz Price: </label>
                  <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                <input value="" name="amount" id="doa" type="text" class="form-control"  placeholder="Please Enter Quiz Price">
                 <small class="text-danger">{{ $errors->first('amount') }}</small>
                 </div>
                </div>
                <br>






              <div class="form-group {{ $errors->has('show_ans') ? ' has-error' : '' }}">
                  <label for="">Cevapları Göster: </label>
                 <input type="checkbox" class="toggle-input" name="show_ans" id="toggle2">
                 <label for="toggle2"></label>
                <br>
              </div>
                
              </div>
              <div class="col-md-6">
                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                  {!! Form::label('description', 'Quiz Açıklaması') !!}
                  {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Lütfen Quiz Açıklaması Girin', 'rows' => '8']) !!}
                  <small class="text-danger">{{ $errors->first('description') }}</small>
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
  <div class="box">
    <div class="box-body table-responsive">
      <table id="search" class="table table-hover table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>Quiz Başlığı</th>
            <th>Açıklama</th>
            <th>Soru Başına Puan</th>
            <th>Süre</th>
            <th>Aksiyonlar</th>
          </tr>
        </thead>
        <tbody>
          @if ($topics)
            @php($i = 1)
            @foreach ($topics as $topic)
              <tr>
                <td>
                  {{$i}}
                  @php($i++)
                </td>
                <td>{{$topic->title}}</td>
                <td title="{{$topic->description}}">{{str_limit($topic->description, 50)}}</td>
                <td>{{$topic->per_q_mark}}</td>
                <td>{{$topic->timer}} dakika</td>
                <td>
                  <!-- Edit Button -->
                  <a type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#{{$topic->id}}EditModal"><i class="fa fa-edit"></i> Düzenle</a>
                  <!-- Delete Button -->
                  <a type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#{{$topic->id}}deleteModal"><i class="fa fa-close"></i> Sil</a>
                  <div id="{{$topic->id}}deleteModal" class="delete-modal modal fade" role="dialog">
                    <!-- Delete Modal -->
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <div class="delete-icon"></div>
                        </div>
                        <div class="modal-body text-center">
                          <h4 class="modal-heading">Emin misiniz ?</h4>
                          <p>
                            Bu kayıtları gerçekten silmek istiyor musunuz? Bu işlem geri alınamaz.</p>
                        </div>
                        <div class="modal-footer">
                          {!! Form::open(['method' => 'DELETE', 'action' => ['TopicController@destroy', $topic->id]]) !!}
                            {!! Form::reset("Hayır", ['class' => 'btn btn-gray', 'data-dismiss' => 'modal']) !!}
                            {!! Form::submit("Evet", ['class' => 'btn btn-danger']) !!}
                          {!! Form::close() !!}
                        </div>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
              <!-- edit model -->
              <div id="{{$topic->id}}EditModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Edit Quiz</h4>
                    </div>
                    {!! Form::model($topic, ['method' => 'PATCH', 'action' => ['TopicController@update', $topic->id]]) !!}
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                              {!! Form::label('title', 'Quiz Başlığı') !!}
                              <span class="required">*</span>
                              {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Lütfen Quiz Başlığı Girin', 'required' => 'required']) !!}
                              <small class="text-danger">{{ $errors->first('title') }}</small>
                            </div>
                            <div class="form-group{{ $errors->has('per_q_mark') ? ' has-error' : '' }}">
                              {!! Form::label('per_q_mark', 'Soru Başına Puan') !!}
                              <span class="required">*</span>
                              {!! Form::number('per_q_mark', null, ['class' => 'form-control', 'placeholder' => 'Lütfen bir sorunun kaç puan olacağını girin', 'required' => 'required']) !!}
                              <small class="text-danger">{{ $errors->first('per_q_mark') }}</small>
                            </div>
                            <div class="form-group{{ $errors->has('timer') ? ' has-error' : '' }}">
                              {!! Form::label('timer', 'Quiz Süresi(dakika olarak)') !!}
                              {!! Form::number('timer', null, ['class' => 'form-control', 'placeholder' => 'Lütfen Quiz Toplam Süresi Girin(dakika olarak)']) !!}
                              <small class="text-danger">{{ $errors->first('timer') }}</small>
                            </div>

                             
                           <label for="">Cevapları Göster: </label>
                           <input {{ $topic->show_ans ==1 ? "checked" : "" }} type="checkbox" class="toggle-input" name="show_ans" id="toggle{{ $topic->id }}">
                           <label for="toggle{{ $topic->id }}"></label>
                          

                          <div style="{{ $topic->amount == NULL ? "display: none" : "" }}" id="doabox2{{ $topic->id }}">
                           
                          <label for="doba">Choose Quiz Price: </label>
                          <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                           <input value="{{ $topic->amount }}" name="amount" id="doa" type="text" class="form-control"  placeholder="Please Enter Quiz Price">
                           <small class="text-danger">{{ $errors->first('amount') }}</small>
                          </div>
                        </div>
               
                             
                            </div>

                          <div class="col-md-6">
                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                              {!! Form::label('description', 'Quiz Açıklaması') !!}
                              {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Lütfen bir Quiz Açıklaması girin']) !!}
                              <small class="text-danger">{{ $errors->first('description') }}</small>
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
@endsection
@section('scripts')
<script type="text/javascript">
  
 
  $(function() {
    $('#fb_check').change(function() {
      $('#fb').val(+ $(this).prop('checked'))
    })
  })

 
                  
                    $(document).ready(function(){

                        $('.quizfp').change(function(){

                          if ($('.quizfp').is(':checked')){
                              $('#doabox').show('fast');
                          }else{
                              $('#doabox').hide('fast');
                          }

                         
                        });

                    });
                                

                               
  $('#priceCheck').change(function(){
    alert('hi');
  });

  function showprice(id)
  {
    if ($('#toggle2'+id).is(':checked')){
      $('#doabox2'+id).show('fast');
    }else{

      $('#doabox2'+id).hide('fast');
    }
  }
                                   

  

</script>



@endsection

