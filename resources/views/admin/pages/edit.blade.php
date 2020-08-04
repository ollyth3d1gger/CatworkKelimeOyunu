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
  <div class="box">
  <div class="box-body">
      <h3>Sayfa: {{ $page->name }}</h3>
    <hr>
    <form class="col-md-8" action="{{ route('pages.update',$page->id) }}" method="POST">
      {{ csrf_field() }}
      {{ method_field('PUT') }}
      <label for="name">Sayfa Başlık:</label>
      <input required type="text" value="{{ $page->name }}" name="name" class="form-control">
      <br>
      <label for="name">Sayfa İçeriği:</label>
      <textarea name="details" class="form-control">
        {!! $page->details !!}
      </textarea>
      <br>
      <label for="status">Durum</label>
        <label for="Status">Durum</label>
        <input {{$page->status =="1" ? "checked" : ""}} type="checkbox" class="toggle-input" name="status" id="toggle">
        <label for="toggle"></label>
          <br>       
                  
      <button type="submit" class="btn btn-success btn-md">
          <i class="fa fa-save"></i> Güncelle
      </button>
    </form> 
  </div>
  


  </div>
@endsection

@section('scripts')
  <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=9z77wjhpwrx6pvh3r3oeiky25krlx0jzd8m69yte73hjrrgg"></script>
  <script>
  tinymce.init({
                selector: 'textarea',
                plugins: 'table,textcolor,image,lists,link,code,wordcount,advlist, autosave',
                theme: 'modern',
                menubar: 'none',
                height : '200',
                toolbar: 'restoredraft,bold italic underline | fontselect |  fontsizeselect | forecolor backcolor |alignleft aligncenter alignright alignjustify| bullist,numlist | link image'
  });</script>
  <script>
  @endsection
