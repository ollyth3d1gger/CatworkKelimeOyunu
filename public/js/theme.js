/** Quick Quiz – Laravel Quiz and Exam System
 *
 * This file contains all template JS functions
 *
--------------------------------------------------------------*/
(function($) {
    "use strict";
    $(document).ready(function(){
        setTimeout(function(){
          $('.myQuestion:first-child').addClass('active');
        }, 500);

        function disableF5(e) { if ((e.which || e.keyCode) == 116 || (e.which || e.keyCode) == 82) e.preventDefault(); };
        history.pushState(null, null, document.URL);
        window.addEventListener('popstate', function () {
          history.pushState(null, null, document.URL);
        });
        $(document).on("keydown", disableF5);

        setTimeout(function(){
          $('.nextbtn').click(function() {
            var activeDiv = $('.myQuestion.active');
            $(activeDiv).removeClass('active');
            if ($(activeDiv).next().length == 0) {
              Cookies.remove('time');
              Cookies.set('done', 'Your Quiz is Over...!', { expires: 1 });
              location.href = "{{$topic->id}}/finish";
            } else {
              $(activeDiv).next().addClass('active');
              $('.myForm')[0].reset();
            }
          });
        }, 700);

        var time = new Date().getTime() + (timer*60000);
        var old;

        if ((Cookies.get('time')) && (Cookies.get('topic_id') == topic_id)) {
          old = Cookies.get('time');
          var time_rem = time-old;
          var counti_time = time-time_rem;
          $('#clock').countdown(counti_time, {elapse: true})
          .on('update.countdown', function(event) {
            var $this = $(this);

            if (event.elapsed) {

              Cookies.set('done', 'Your Quiz is Over...!', { expires: 1 });
              Cookies.remove('time');
              location.href = "{{$topic->id}}/finish";

            } else {
              $this.html(event.strftime('<span>%M:%S</span>'));
            }
          });
        } else {

          //Cookies set for timer
          Cookies.set('time', time, { expires: 1 });

          // Cookies set Topic id
          Cookies.set('topic_id', topic_id, { expires: 1 });

          $('#clock').countdown(time, {elapse: true})
          .on('update.countdown', function(event) {
            var $this = $(this);
            if (event.elapsed) {
              Cookies.set('done', 'Your Quiz is Over...!', { expires: 1 });
              Cookies.remove('time');
              location.href = "{{$topic->id}}/finish";
            } else {
              $this.html(event.strftime('<span>%M:%S</span>'));
            }
          });

        }
    });

})(jQuery);
