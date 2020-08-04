@extends('layouts.admin', [
  'page_header' => 'Dashboard',
  'dash' => 'active',
  'quiz' => '',
  'users' => '',
  'questions' => '',
  'top_re' => '',
  'all_re' => '',
  'sett' => ''
])

@section('content')
<h3>API Setting</h3>
<div class="dashboard-block col-md-8">
   
  <form action="{{ route('api.update') }}" method="POST">
    {{ csrf_field() }}
   
    <label for="MAIL_FROM_NAME">STRIPE KEY:</label>
    <input type="text" name="STRIPE_KEY" value="{{ $env_files['STRIPE_KEY'] }}"  class="form-control">
    <br>
    <label for="MAIL_FROM_ADDRESS">STRIPE SECRET:</label>
    <input type="text" name="STRIPE_SECRET" value="{{ $env_files['STRIPE_SECRET'] }}" class="form-control">
    <br>
 
    <label for="MAIL_DRIVER">MAILCHIMP APIKEY:</label>
    <input type="text" name="MAILCHIMP_APIKEY" value="{{ $env_files['MAILCHIMP_APIKEY'] }}" class="form-control">
    <br>
    <label for="MAIL_HOST">MAILCHIMP LIST ID:</label>
    <input type="text" name="MAILCHIMP_LIST_ID" value="{{ $env_files['MAILCHIMP_APIKEY'] }}" class="form-control">
    <br>
    <label for="MAIL_PORT">TMDB API KEY:</label>
    <input type="text" name="TMDB_API_KEY" value="{{ $env_files['TMDB_API_KEY'] }}" class="form-control">
    <br>
    <label for="MAIL_USERNAME">PAYPAL CLIENT ID:</label>
    <input type="text" name="PAYPAL_CLIENT_ID" value="{{ $env_files['PAYPAL_CLIENT_ID'] }}" class="form-control">
    <br>
    <label for="MAIL_PASSWORD">PAYPAL SECRET ID:</label>
    <input type="text" value="{{ $env_files['PAYPAL_SECRET_ID'] }}" name="PAYPAL_SECRET_ID" class="form-control">
    <br>
    <label for="MAIL_ENCRYPTION">PAYPAL MODE:</label>
    <input type="text" value="{{ $env_files['PAYPAL_MODE'] }}" name="PAYPAL_MODE" class="form-control">
    <br>
    <label for="MAIL_ENCRYPTION">PAYU METHOD:</label>
    <input type="text" value="{{ $env_files['PAYU_METHOD'] }}" name="PAYU_METHOD" class="form-control">
    <br>
    <label for="MAIL_ENCRYPTION">PAYU DEFAULT:</label>
    <input type="text" value="{{ $env_files['PAYU_DEFAULT'] }}" name="PAYU_DEFAULT" class="form-control">
    <br>
    <label for="MAIL_ENCRYPTION">PAYU MERCHANT KEY:</label>
    <input type="text" value="{{ $env_files['PAYU_MERCHANT_KEY'] }}" name="PAYU_MERCHANT_KEY" class="form-control">
    <br>
    <label for="MAIL_ENCRYPTION">PAYU MERCHANT SALT:</label>
    <input type="text" value="{{ $env_files['PAYU_MERCHANT_SALT'] }}" name="PAYU_MERCHANT_SALT" class="form-control">
    <br>
    <input type="submit" class="btn btn-md btn-success">
    
  </form>

</div>
@endsection