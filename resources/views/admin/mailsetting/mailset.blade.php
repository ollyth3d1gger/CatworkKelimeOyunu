<style type="text/css">

.field-icon {
  float: right;
  margin-left: -25px;
  margin-top: -25px;
  position: relative;
  z-index: 2;
}

.container{
  padding-top:50px;
  margin: auto;
}

</style>
@extends('layouts.admin', [
  'page_header' => 'Mail Ayarları',
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
    <div class="row">
  
  <form action="{{ route('mail.update') }}" method="POST">
    {{ csrf_field() }}
    <div class="col-md-6">
      <label for="MAIL_FROM_NAME">Gönderen Adı: <small>(ör. Catwork)</small></label>
    <input type="text" name="MAIL_FROM_NAME" value="{{ $env_files['MAIL_FROM_NAME'] }}"  class="form-control">
    <br>
    <label for="MAIL_FROM_ADDRESS">Gönderen Adres: <small>(info@test.com)</small></label>
    <input type="text" name="MAIL_FROM_ADDRESS" value="{{ $env_files['MAIL_FROM_ADDRESS'] }}" class="form-control">
    <br>
    <label for="MAIL_DRIVER">Mail Driver: <small>(ör. sendmail,smtp,mail)</small></label>
    <input type="text" name="MAIL_DRIVER" value="{{ $env_files['MAIL_DRIVER'] }}" class="form-control">
    <br>
    <label for="MAIL_HOST">Mail Sunucu: <small>(ör. smtp.gmail.com)</small></label>
    <input type="text" name="MAIL_HOST" value="{{ $env_files['MAIL_HOST'] }}" class="form-control">
    </div>
  

    <div class="col-md-6">
    <label for="MAIL_PORT">Mail Port: <small>(587,487)</small></label>
    <input type="text" name="MAIL_PORT" value="{{ $env_files['MAIL_PORT'] }}" class="form-control">
    <br>
    <label for="MAIL_USERNAME">Mail Kullanıcı: <small>(ex. username@gmail.com)</small></label>
    <input type="text" name="MAIL_USERNAME" value="{{ $env_files['MAIL_USERNAME'] }}" class="form-control">
    <br>

    <label for="MAIL_PASSWORD">Mail Şifre:</label>
    <input type="password" value="{{ $env_files['MAIL_PASSWORD'] }}" name="MAIL_PASSWORD" class="form-control" id="password-field">
     <div class="col-md-12">
     <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
    </div>


    <br>
    <label for="MAIL_ENCRYPTION">Mail Şifreleme: <small>(TLS,SSL)</small></label>
    <input type="text" value="{{ $env_files['MAIL_ENCRYPTION'] }}" name="MAIL_ENCRYPTION" class="form-control">
    <br>
  
</div>
    <div class="col-md-12">
    <button type="submit" class="btn btn-md btn-success"><i class="fa fa-save"></i>Ayarı Kaydet</button>
      
    </div>

</form>
</div>
  </div>
</div>




@endsection

@section('scripts')
<script type="text/javascript">
  
  $(".toggle-password").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});

</script>

@endsection