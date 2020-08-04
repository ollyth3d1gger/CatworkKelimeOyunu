@extends('layouts.admin', [
  'page_header' => 'SSS',
  'dash' => '',
  'quiz' => 'active',
  'users' => '',
  'questions' => '',
  'top_re' => '',
  'all_re' => '',
  'sett' => ''
])

@section('content')
<div class="box">
    <div class="box-body">
      <!-- Button trigger modal -->
      <div class="margin-bottom">
      <a href="{{ route('faq.add') }}" class="btn btn-md btn-primary">SSS Ekle</a>
        
      </div>

      <table class="table table-bordered">
        <thead>
          <tr>
            <th>SN</th>
            <th>Başlık</th>
            <th>Detay</th>

           
            <th><i class="fa fa-pencil" aria-hidden="true"></i>
            </th>
            <th><i class="fa fa-trash" aria-hidden="true"></i>
            </th>
          </tr>
        </thead>

        <tbody>

          <?php $i=0;?>
          @foreach ($faqs as $faq)
            <?php $i++; ?>
            <tr>
              <td><?php echo $i;?></td>
              <td>{{ $faq->title }}</td>

              <td>{{substr(strip_tags($faq->details),0,100)}}{{strlen(strip_tags($faq->details))>250 ? "..." : ""}}</td>
              
               <td><a href="{{ route('faq.edit',$faq->id) }}" class="btn btn-sm btn-primary">
                 <i class="fa fa-pencil"></i>
               </a></td>
              <td>
                <form method="POST" action="{{ route('faq.delete',$faq->id) }}">
                  {{ method_field('DELETE') }}
                  {{ csrf_field() }}
                  <button onclick="return confirm('Emin misiniz?')" type="submit" class="btn btn-sm btn-danger">
                    <i class="fa fa-trash-o"></i>
                  </button>
                </form>
              </td>
               
              
            </tr>
          @endforeach



        </tbody>
      </table>
    </div>
    

  </div>
@endsection
