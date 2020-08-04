@extends('layouts.admin', [
  'page_header' => "Klasik Sorulara Gelen Cevaplar / ".e($mix[0]->title),
  'dash' => '',
  'quiz' => '',
  'users' => '',
  'questions' => '',
  'top_re' => '',
  'all_re' => 'active',
  'sett' => ''
])

@section('content')
  <div class="content-block box">
    <div class="box-body table-responsive">
      <table id="topTable" class="table table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>Yarışmacı Ad</th>
            <th>Yarışmacı ID</th>
            <th>Yarışma Başlık</th>
            <th>Soru</th>
            <th>Yarışmacı Cevabı</th>
            <th>Yapılacak</th>
          </tr>
        </thead>
        <tbody>
        @php $key = 0;@endphp
          @if ($mix)
            @foreach ($mix as $mixer)
              <tr>
                <td>
                  {{$key+1}}
                </td>
                <td>{{$mixer->name}}</td>
                <td>{{$mixer->user_id}}</td>
                <td>{{$mixer->title}}</td>
                <td>

                {{ $mixer->question }}
                </td>
                <td>
                  {{$mixer->user_answer}}
                </td>
                <td>
                  @if($mixer->user_answer == $mixer->answer)
                  @else
                    <button onclick="correcter()" type="submit" class="btn-primary">Doğru Olarak İşaretle</button>
                    <script>function correcter() {

                        $.ajax( {

                            type: 'POST',
                            url: '/start_quiz/{{ $mixer->topic_id }}/quiz/update',

                            data: {

                                _token: "{{ csrf_token() }}",
                                mark: {{ $mixer->per_q_mark }},
                                topic_id :  "{{ $mixer->topic_id }}",
                                user_id : "{{ $mixer->user_id }}",
                                question_id: "{{ $mixer->question_id }}",
                                answer: "{{ encrypt($mixer->answer)  }}",
                                user_answer: "{{ $mixer->answer }}"


                            },

                            success: function(data) {
                                console.log(data);

                            }
                        });

                           // window.location.reload();
                            }
                    </script>
                  @endif
                    <a data-toggle="modal" data-target="#delete{{ $mixer->topic_id }}" title="It will delete the answer sheet of this student" href="#" class="btn btn-sm btn-warning">
                    Yarışmacı Cevaplarını Sil
                  </a>

                  <div id="delete{{ $mixer->topic_id }}" class="delete-modal modal fade" role="dialog">
                      <!-- Delete Modal -->
                      <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <div class="delete-icon"></div>
                          </div>
                          <div class="modal-body text-center">
                            <h4 class="modal-heading">Are You Sure ?</h4>
                            <p>Do you really want to delete these record? This process cannot be undone.</p>
                          </div>
                          <div class="modal-footer">
                            {!! Form::open(['method' => 'DELETE', 'action' => ['AllReportController@delete', 'topicid' => $mixer->topic_id, 'userid' => $mixer->user_id] ]) !!}
                                {!! Form::reset("No", ['class' => 'btn btn-gray', 'data-dismiss' => 'modal']) !!}
                                {!! Form::submit("Yes", ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                          </div>
                        </div>
                      </div>
                    </div>

                </td>
              </tr>
            @endforeach
          @endif
        </tbody>
      </table>
    </div>
  </div>
@endsection
