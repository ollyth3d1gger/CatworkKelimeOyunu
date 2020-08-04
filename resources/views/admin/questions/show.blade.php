@extends('layouts.admin', [
  'page_header' => "Sorular/ {$topic->title} ",
  'dash' => '',
  'quiz' => '',
  'users' => '',
  'questions' => 'active',
  'top_re' => '',
  'all_re' => '',
  'sett' => ''
])

@section('content')
  <div class="margin-bottom">
    <button type="button" class="btn btn-wave" data-toggle="modal" data-target="#createModal">Soru Ekle</button>
    <button type="button" class="btn btn-wave" data-toggle="modal" data-target="#importQuestions">Soruları İçe Aktar</button>
  </div>
  <!-- Create Modal -->
  <div id="createModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Soru Ekle</h4>
          <select id="graph_select">


            <option value="test-question">Test Sorusu</option>
            <option value="written" style="display: none">Klasik Soru</option>
            <option value="kelime" style="display: none">Kelime Sorusu</option>
          </select>
        </div>
        <div id="test">
        {!! Form::open(['method' => 'POST', 'action' => 'QuestionsController@store', 'files' => true]) !!}
          <input type="hidden" name="type" value="test">
          <div class="modal-body">
            <div class="row">
              <div class="col-md-4">
                {!! Form::hidden('topic_id', $topic->id) !!}
                <div class="form-group{{ $errors->has('question') ? ' has-error' : '' }}">
                  {!! Form::label('question', 'Soru') !!}
                  <span class="required">*</span>
                  {!! Form::textarea('question', null, ['class' => 'form-control', 'placeholder' => 'Lütfen Soru Metni Girin', 'rows'=>'8', 'required' => 'required']) !!}
                  <small class="text-danger">{{ $errors->first('question') }}</small>
                </div>
                <div class="form-group{{ $errors->has('answer') ? ' has-error' : '' }}">
                    {!! Form::label('answer', 'Doğru Cevap') !!}
                    <span class="required">*</span>
                    {!! Form::select('answer', array('A'=>'A', 'B'=>'B', 'C'=>'C', 'D'=>'D'),null, ['class' => 'form-control select2', 'required' => 'required', 'placeholder'=>'']) !!}
                    <small class="text-danger">{{ $errors->first('answer') }}</small>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group{{ $errors->has('a') ? ' has-error' : '' }}">
                  {!! Form::label('a', 'A - Seçeneği') !!}
                  <span class="required">*</span>
                  {!! Form::text('a', null, ['class' => 'form-control', 'placeholder' => 'Lütfen A Seçeneğini Girin', 'required' => 'required']) !!}
                  <small class="text-danger">{{ $errors->first('a') }}</small>
                </div>
                <div class="form-group{{ $errors->has('b') ? ' has-error' : '' }}">
                  {!! Form::label('b', 'B - Seçeneği') !!}
                  <span class="required">*</span>
                  {!! Form::text('b', null, ['class' => 'form-control', 'placeholder' => 'Lütfen B Seçeneğini Girin', 'required' => 'required']) !!}
                  <small class="text-danger">{{ $errors->first('b') }}</small>
                </div>
                <div class="form-group{{ $errors->has('c') ? ' has-error' : '' }}">
                  {!! Form::label('c', 'C - Seçeneği') !!}
                  <span class="required">*</span>
                  {!! Form::text('c', null, ['class' => 'form-control', 'placeholder' => 'Lütfen C Seçeneğini Girin', 'required' => 'required']) !!}
                  <small class="text-danger">{{ $errors->first('c') }}</small>
                </div>
                <div class="form-group{{ $errors->has('d') ? ' has-error' : '' }}">
                  {!! Form::label('d', 'D - Seçeneği') !!}
                  <span class="required">*</span>
                  {!! Form::text('d', null, ['class' => 'form-control', 'placeholder' => 'Lütfen D Seçeneğini Girin', 'required' => 'required']) !!}
                  <small class="text-danger">{{ $errors->first('d') }}</small>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group{{ $errors->has('code_snippet') ? ' has-error' : '' }}">
                    {!! Form::label('code_snippet', 'Soru Kod Betiği') !!}
                    {!! Form::textarea('code_snippet', null, ['class' => 'form-control', 'placeholder' => 'Soru Kod Betiği Girin', 'rows' => '5']) !!}
                    <small class="text-danger">{{ $errors->first('code_snippet') }}</small>
                </div>
                <div class="form-group{{ $errors->has('answer_ex') ? ' has-error' : '' }}">
                    {!! Form::label('answer_exp', 'Cevap Açıklaması') !!}
                    {!! Form::textarea('answer_exp', null, ['class' => 'form-control', 'placeholder' => 'Cevap Açıklaması Girin', 'rows' => '4']) !!}
                    <small class="text-danger">{{ $errors->first('answer_ex') }}</small>
                </div>
              </div>
              <div class="col-md-12">
                <div class="extras-block">
                  <h4 class="extras-heading">Soru için Görsel ve Video</h4>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group{{ $errors->has('question_video_link') ? ' has-error' : '' }}">
                        {!! Form::label('question_video_link', 'Soruya Bir Video Ekle') !!}
                        {!! Form::text('question_video_link', null, ['class' => 'form-control', 'placeholder'=>'https://myvideolink.com/embed/..']) !!}
                        <small class="text-danger">{{ $errors->first('question_video_link') }}</small>
                        <p class="help">YouTube ve Vimeo Video Desteği(Embed Code)</p>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group{{ $errors->has('question_img') ? ' has-error' : '' }}">
                        {!! Form::label('question_img', 'Soruya Bir Görsel Ekle') !!}
                        {!! Form::file('question_img') !!}
                        <small class="text-danger">{{ $errors->first('question_img') }}</small>
                         <p class="help"> .JPG, .JPEG ve .PNG destekler</p>
                      </div>
                    </div>
                  </div>
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
        <div id="klasik">
          {!! Form::open(['method' => 'POST', 'action' => 'QuestionsController@store', 'files' => true]) !!}
          <div class="modal-body">
            <div class="row">
              <div class="col-md-4">
                <input type="hidden" name="type" value="klasik">
                {!! Form::hidden('topic_id', $topic->id) !!}
                <div class="form-group{{ $errors->has('question') ? ' has-error' : '' }}">
                  {!! Form::label('question', 'Soru Metni') !!}
                  <span class="required">*</span>
                  {!! Form::textarea('question', null, ['class' => 'form-control', 'placeholder' => 'Soru Metnini girin', 'rows'=>'8', 'required' => 'required']) !!}
                  <small class="text-danger">{{ $errors->first('question') }}</small>
                </div>
                <div class="form-group{{ $errors->has('answer') ? ' has-error' : '' }}">
                  {!! Form::label('answer', 'Doğru Cevap') !!}
                  <span class="required">*</span>
                  {!! Form::textarea('answer',null, ['class' => 'form-control', 'rows'=>'8', 'required' => 'required', 'placeholder' => 'Cevapları aralarına virgül koyarak girin']) !!}
                  <small class="text-danger">{{ $errors->first('answer') }}</small>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group{{ $errors->has('code_snippet') ? ' has-error' : '' }}">
                  {!! Form::label('code_snippet', 'Kod Betiği') !!}
                  {!! Form::textarea('code_snippet', null, ['class' => 'form-control', 'placeholder' => 'Please Enter Code Snippets', 'rows' => '5']) !!}
                  <small class="text-danger">{{ $errors->first('code_snippet') }}</small>
                </div>
                <div class="form-group{{ $errors->has('answer_ex') ? ' has-error' : '' }}">
                  {!! Form::label('answer_exp', 'Cevap Açıklaması') !!}
                  {!! Form::textarea('answer_exp', null, ['class' => 'form-control', 'placeholder' => 'Please Enter Answer Explanation', 'rows' => '4']) !!}
                  <small class="text-danger">{{ $errors->first('answer_ex') }}</small>
                </div>
              </div>
              <div class="col-md-12">
                <div class="extras-block">
                  <h4 class="extras-heading">Soru için Video ve Görsel</h4>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group{{ $errors->has('question_video_link') ? ' has-error' : '' }}">
                        {!! Form::label('question_video_link', 'Soruya video Ekle') !!}
                        {!! Form::text('question_video_link', null, ['class' => 'form-control', 'placeholder'=>'https://myvideolink.com/embed/..mp4']) !!}
                        <small class="text-danger">{{ $errors->first('question_video_link') }}</small>
                        <p class="help">YouTube ve Vimeo Video Desteği (Only Embed Code Link)</p>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group{{ $errors->has('question_img') ? ' has-error' : '' }}">
                        {!! Form::label('question_img', 'Soruya görsel Ekle') !!}
                        {!! Form::file('question_img') !!}
                        <small class="text-danger">{{ $errors->first('question_img') }}</small>
                        <p class="help">.JPG, .JPEG ve .PNG destekler</p>
                      </div>
                    </div>
                  </div>
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
        <div id="kelime">
          {!! Form::open(['method' => 'POST', 'action' => 'QuestionsController@store', 'files' => true]) !!}
          <div class="modal-body">
            <div class="row">
              <div class="col-md-4">
                <input type="hidden" name="type" value="kelime">
                {!! Form::hidden('topic_id', $topic->id) !!}
                <div class="form-group{{ $errors->has('question') ? ' has-error' : '' }}">
                  {!! Form::label('question', 'Soru Metni') !!}
                  <span class="required">*</span>
                  {!! Form::textarea('question', null, ['class' => 'form-control', 'placeholder' => 'Soru Metnini girin', 'rows'=>'8', 'required' => 'required']) !!}
                  <small class="text-danger">{{ $errors->first('question') }}</small>
                </div>
                <div class="form-group{{ $errors->has('answer') ? ' has-error' : '' }}">
                  {!! Form::label('answer', 'Doğru Cevap') !!}
                  <span class="required">*</span>
                  {!! Form::textarea('answer',null, ['class' => 'form-control', 'rows'=>'8', 'required' => 'required', 'placeholder' => 'Doğru Kelimeyi Büyük Harflerle Girin. Ör:TATTOO']) !!}
                  <small class="text-danger">{{ $errors->first('answer') }}</small>
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

        <script>$(function () {
                $("#graph_select").change(function() {
                    var val = $(this).val();
                    if(val === "written") {
                        $("#klasik").show();
                        $("#test").hide();
                        $("#kelime").hide();
                    }
                    else if(val === "test-question") {
                        $("#test").show();
                        $("#klasik").hide();
                        $("#kelime").hide();
                    }
                    else if(val === "kelime") {
                        $("#kelime").show();
                        $("#test").hide();
                        $("#klasik").hide();

                    }
                });
            });</script>
      </div>
    </div>
  </div>
  <!-- Import Questions Modal -->
  <div id="importQuestions" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Soruları İçe Aktar(Excel Dosyası)</h4>
        </div>
        {!! Form::open(['method' => 'POST', 'action' => 'QuestionsController@importExcelToDB', 'files' => true]) !!}
          <div class="modal-body">
            {!! Form::hidden('topic_id', $topic->id) !!}
            <div class="form-group{{ $errors->has('question_file') ? ' has-error' : '' }}">
              {!! Form::label('question_file', 'Import Question Via Excel File', ['class' => 'col-sm-3 control-label']) !!}
              <span class="required">*</span>
              <div class="col-sm-9">
                {!! Form::file('question_file', ['required' => 'required']) !!}
                <p class="help-block">Sadece Excel Dosyası (.CSV ve .XLS)</p>
                <small class="text-danger">{{ $errors->first('question_file') }}</small>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <div class="btn-group pull-right">
              {!! Form::reset("Sıfırla", ['class' => 'btn btn-default']) !!}
              {!! Form::submit("İçe Aktar", ['class' => 'btn btn-wave']) !!}
            </div>
          </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
  <div class="box">
    <div class="box-body table-responsive">
      <table id="questions_table" class="table table-hover table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>Sorular</th>
            <th>Doğru Cevap</th>

            <th>Aksiyonlar</th>
          </tr>
        </thead>
        <tbody>
          @if ($questions)
            @foreach ($questions as $key => $question)
              @php
                $answer = strtolower($question->answer);
              @endphp
              <tr>
                <td>
                  {{$key+1}}
                </td>
                <td>{{$question->question}}</td>
                <td>{{$question->answer}}</td>

                <td>
                  <!-- Edit Button -->
                  <a type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#{{$question->id}}EditModal"><i class="fa fa-edit"></i> Düzenle</a>
                  <!-- Delete Button -->
                  <a type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#{{$question->id}}deleteModal"><i class="fa fa-close"></i> Sil</a>
                  <div id="{{$question->id}}deleteModal" class="delete-modal modal fade" role="dialog">
                    <!-- Delete Modal -->
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <div class="delete-icon"></div>
                        </div>
                        <div class="modal-body text-center">
                          <h4 class="modal-heading">Emin misin ?</h4>
                          <p>
                            Bu kayıtları gerçekten silmek istiyor musunuz? Bu işlem geri alınamaz.</p>
                        </div>
                        <div class="modal-footer">
                          {!! Form::open(['method' => 'DELETE', 'action' => ['QuestionsController@destroy', $question->id]]) !!}
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
              <div id="{{$question->id}}EditModal" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Soruyu Düzenle</h4>
                    </div>
                    {!! Form::model($question, ['method' => 'PATCH', 'action' => ['QuestionsController@update', $question->id], 'files' => true]) !!}
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-md-4">
                            {!! Form::hidden('topic_id', $topic->id) !!}
                            <div class="form-group{{ $errors->has('question') ? ' has-error' : '' }}">
                              {!! Form::label('question', 'Soru') !!}
                              <span class="required">*</span>
                              {!! Form::textarea('question', null, ['class' => 'form-control', 'placeholder' => 'Lütfen bir Soru metni girin', 'rows'=>'8', 'required' => 'required']) !!}
                              <small class="text-danger">{{ $errors->first('question') }}</small>
                            </div>
                            <div class="form-group{{ $errors->has('answer') ? ' has-error' : '' }}">
                                {!! Form::label('answer', 'Doğru Cevap') !!}
                                <span class="required">*</span>
                                {!! Form::select('answer', array('A'=>'A', 'B'=>'B', 'C'=>'C', 'D'=>'D'),null, ['class' => 'form-control select2', 'required' => 'required', 'placeholder'=>'']) !!}
                                <small class="text-danger">{{ $errors->first('answer') }}</small>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group{{ $errors->has('a') ? ' has-error' : '' }}">
                              {!! Form::label('a', 'A - Seçeneği') !!}
                              <span class="required">*</span>
                              {!! Form::text('a', null, ['class' => 'form-control', 'placeholder' => 'Lütfen A Seçeneğini Girin', 'required' => 'required']) !!}
                              <small class="text-danger">{{ $errors->first('a') }}</small>
                            </div>
                            <div class="form-group{{ $errors->has('b') ? ' has-error' : '' }}">
                              {!! Form::label('b', 'B - Seçeneği') !!}
                              <span class="required">*</span>
                              {!! Form::text('b', null, ['class' => 'form-control', 'placeholder' => 'Lütfen B Seçeneğini Girin', 'required' => 'required']) !!}
                              <small class="text-danger">{{ $errors->first('b') }}</small>
                            </div>
                            <div class="form-group{{ $errors->has('c') ? ' has-error' : '' }}">
                              {!! Form::label('c', 'C - Seçeneği') !!}
                              <span class="required">*</span>
                              {!! Form::text('c', null, ['class' => 'form-control', 'placeholder' => 'Lütfen C Seçeneğini Girin', 'required' => 'required']) !!}
                              <small class="text-danger">{{ $errors->first('c') }}</small>
                            </div>
                            <div class="form-group{{ $errors->has('d') ? ' has-error' : '' }}">
                              {!! Form::label('d', 'D - Seçeneği') !!}
                              <span class="required">*</span>
                              {!! Form::text('d', null, ['class' => 'form-control', 'placeholder' => 'Lütfen D Seçeneğini Girin', 'required' => 'required']) !!}
                              <small class="text-danger">{{ $errors->first('d') }}</small>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group{{ $errors->has('code_snippet') ? ' has-error' : '' }}">
                                {!! Form::label('code_snippet', 'Soru Code Betiği') !!}
                                {!! Form::textarea('code_snippet', null, ['class' => 'form-control', 'placeholder' => 'Soru Kod Betiği Girin', 'rows' => '5']) !!}
                                <small class="text-danger">{{ $errors->first('code_snippet') }}</small>
                            </div>
                            <div class="form-group{{ $errors->has('answer_ex') ? ' has-error' : '' }}">
                                {!! Form::label('answer_exp', 'Cevap Açıklaması Girin') !!}
                                {!! Form::textarea('answer_exp', null, ['class' => 'form-control',  'placeholder' => 'Lütfen bir Cevap Açıklaması Girin',  'rows' => '4']) !!}
                                <small class="text-danger">{{ $errors->first('answer_ex') }}</small>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="extras-block">
                              <h4 class="extras-heading">Soru için Görsel/Videolar</h4>
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group{{ $errors->has('question_video_link') ? ' has-error' : '' }}">
                                    {!! Form::label('question_video_link', 'Soruya Bir Video Ekle') !!}
                                    {!! Form::text('question_video_link', null, ['class' => 'form-control', 'placeholder'=>'https://myvideolink.com/embed/..']) !!}
                                    <small class="text-danger">{{ $errors->first('question_video_link') }}</small>
                                    <p class="help">YouTube ve Vimeo Desteği (Embed Code Linki)</p>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group{{ $errors->has('question_img') ? ' has-error' : '' }}">
                                    {!! Form::label('question_img', 'Soruya Görsel Ekle') !!}
                                    {!! Form::file('question_img') !!}
                                    <small class="text-danger">{{ $errors->first('question_img') }}</small>
                                    <p class="help">.JPG, .JPEG ve .PNG destekler</p>
                                  </div>
                                </div>
                              </div>
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
@endsection

