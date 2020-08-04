@extends('layouts.admin', [
  'page_header' => 'Özel CSS Ayarları',
  'dash' => 'active',
  'quiz' => '',
  'users' => '',
  'questions' => '',
  'top_re' => '',
  'all_re' => '',
  'sett' => '',
])

@section('content')
  <div class="box">
    <div class="box-body">
      <div class="form-group{{ $errors->has('css') ? ' has-error' : '' }}">
    <form action="{{ route('css.store') }}" method="POST">
      {{ csrf_field() }}
    <label for="css">Özel CSS:</label>
    <small class="text-danger">{{ $errors->first('css','CSS Boş olamaz !') }}</small>
    <textarea placeholder="a {
      color:red;
    }" required id="he" class="form-control" name="css" rows="10" cols="30">{{ $css_get }}</textarea>
    <div style="margin-top: 15px;" >
      <input type="submit" value="CSS EKLE" class="btn btn-md btn-primary">
    </div>
    </form>
    </div>
    <br>
    <div class="form-group{{ $errors->has('js') ? ' has-error' : '' }}">
    <form action="{{ route('js.store') }}" method="POST">
      {{ csrf_field() }}
    <label for="js">Özel JS:</label>
    <small class="text-danger">{{ $errors->first('js','Javascript Boş Olamaz !') }}</small>
    <textarea required placeholder="$(document).ready(function{
      //code
  });" class="form-control" name="js" rows="10" cols="30">{{ $js_get }}</textarea>
    <div style="margin-top: 15px;" class="form-group">
      <input type="submit" value="JS EKLE" class="btn btn-md btn-primary">
    </div>
    </form>
    </div>
  </div>
    </div>

@endsection
