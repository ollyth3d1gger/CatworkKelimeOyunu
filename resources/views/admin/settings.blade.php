@extends('layouts.admin', [
  'page_header' => 'Ayarlar',
  'dash' => '',
  'quiz' => '',
  'users' => '',
  'questions' => '',
  'top_re' => '',
  'all_re' => '',
  'sett' => 'active'
])
@section('content')

  @php
    $setting = $settings[0];
  @endphp
  {!! Form::model($setting, ['method' => 'PATCH', 'action' => ['SettingController@update', $setting->id], 'files' => true]) !!}
  <div class="row">
    <div class="col-md-8">
      <div class="box">
        <div class="box-body settings-block">
          <div class="form-group{{ $errors->has('welcome_txt') ? ' has-error' : '' }}">
            {!! Form::label('welcome_txt', 'Proje Adı') !!}
            <p class="label-desc">Lütfen Proje Adını Girin</p>
            {!! Form::text('welcome_txt', null, ['class' => 'form-control']) !!}
            <small class="text-danger">{{ $errors->first('welcome_txt') }}</small>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group{{ $errors->has('logo') ? ' has-error' : '' }}">
                {!! Form::label('logo', 'Logo Seçin') !!}
                <p class="label-desc">Lütfen bi Logo Seçin</p>
                {!! Form::file('logo') !!}
                <small class="text-danger">{{ $errors->first('logo') }}</small>
              </div>
              <div class="logo-block">
                <img src="{{asset('/images/logo/'. $setting->logo)}}" class="img-responsive"  alt="{{$setting->welcome_txt}}">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group{{ $errors->has('favicon') ? ' has-error' : '' }}">
                {!! Form::label('favicon', 'Favicon ICO') !!}
                <p class="label-desc">Favicon ICO Seçin</p>
                {!! Form::file('favicon') !!}
                <small class="text-danger">{{ $errors->first('favicon') }}</small>
              </div>
            </div>

            <div class="col-md-6">
               <div class="form-group{{ $errors->has('w_email') ? ' has-error' : '' }}">
                  {!! Form::label('w_email', 'Varsayılan Email') !!}
                   <p class="label-desc">Lütfen Varsayılan Email Girin</p>
                  {!! Form::email('w_email', null, ['class' => 'form-control', 'placeholder' => 'eg: foo@bar.com','required']) !!}
                  <small class="text-danger">{{ $errors->first('w_email') }}</small>
              </div>
            </div>
            <div  class="col-md-6">
              <div class="form-group{{ $errors->has('currency_code') ? ' has-error' : '' }}">
                {!! Form::label('currency_code', 'Para Birimi') !!}
                 <p class="label-desc">- Para birimi Girin</p>
                {!! Form::text('currency_code', null, ['class' => 'form-control']) !!}
                <small class="text-danger">{{ $errors->first('currency_code') }}</small>
              </div>

            </div>
            <div class="col-md-6">
               <div class="form-group{{ $errors->has('currency_symbol') ? ' has-error' : '' }} currency-symbol-block">
                {!! Form::label('currency_symbol', 'Para Birimi Sembol') !!}
                <p class="label-desc"> - Lütfen Para Birimi Sembolü Seçin</p>
                  <div class="input-group">
                    {!! Form::text('currency_symbol', null, ['class' => 'form-control currency-icon-picker']) !!}
                    <span class="input-group-addon simple-input"><i class="glyphicon glyphicon-user"></i></span>
                  </div>
                <small class="text-danger">{{ $errors->first('currency_symbol') }}</small>
              </div>
            </div>
             <div class="col-md-6">
                <div class="form-group">
                   <label for="status">Sağ tık Deaktivasyon:</label>
                    <input {{ $setting->right_setting == 1 ? "checked" : "" }} type="checkbox" class="toggle-input" name="rightclick" id="rightclick">
                    <label for="rightclick"></label>
                  </div>
               </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="status">Öğeyi İncele Deaktivasyon:</label>
                    <input {{ $setting->element_setting == 1 ? "checked" : "" }} type="checkbox" class="toggle-input" name="inspect" id="inspect">
                    <label for="inspect"></label>
              </div>
            </div>
            {{-- <div class="col-md-6">
              <div class="form-group">
               <label for="">User can repeat Quiz?</label>
                <select name="userquiz" id="">
                       <option @if($setting->userquiz == 1) selected @endif value="1">Yes</option>
                       <option @if($setting->userquiz == 0) selected @endif value="0">No</option>
                </select>
             </div>
            </div>  --}}             
          </div>

          
          {!! Form::submit("Ayarları Kaydet", ['class' => 'btn btn-wave btn-block']) !!}
        </div>
       
       
      </div>
    </div>
  </div>
  {!! Form::close() !!}

@endsection
