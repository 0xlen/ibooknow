<style>
.small-preloader {
    width: 25px !important;
    height: 25px !important;
}
</style>

<div class="modal-content">

<h4>預約上課 Booking - <small>{{ $_GET['month'] }}/{{ $_GET['day'] }}</small></h4>
<div class="row">
    <form class="col s12" method="POST" action="{{ url('/add') }}" id="booking_form">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="hidden" name="month" value="{{ $_GET['month'] }}">
      <input type="hidden" name="day" value="{{ $_GET['day'] }}">

      <div class="row">
        <div class="input-field col s12">
          <i class="material-icons prefix">account_circle</i>
          <input id="icon_prefix" name="full_name" type="text" class="validate">
          <label for="icon_prefix">姓名 Full Name</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <i class="material-icons prefix">room</i>
          <input id="icon_class" name="class" type="text" class="validate">
          <label for="icon_class">班級 Class</label>
        </div>
        <div class="input-field col s6">
          <i class="material-icons prefix">info</i>
          <input id="icon_student_id" name="student_id" type="text" class="validate">
          <label for="icon_student_id">學號 Student ID No.</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <i class="material-icons prefix">email</i>
          <input id="icon_email" name="email" type="email" class="validate">
          <label for="icon_email">信箱 Email</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
            <p>開始時間 Start time</p>
            <div class="input-field col s12">
              <i class="material-icons prefix">schedule</i>
              <input id="icon_start_time" name="start_time" type="time" class="validate">
            </div>
        </div>
        <div class="input-field col s6">
            <p>結束時間 End time</p>
            <div class="input-field col s12">
              <i class="material-icons prefix">alarm_on</i>
              <input id="icon_end_time" name="end_time" type="time" class="validate">
            </div>
        </div>
      </div>

      <div class="row">
        <div class="input-field col s12">
          <i class="material-icons prefix">message</i>
          <textarea id="icon_time" name="message" class="materialize-textarea"></textarea>
          <label for="icon_time">訊息 Message</label>
        </div>
      </div>

    </form>
</div>
</div>
<div class="modal-footer">
    <button name="booking" class="waves-effect waves-light btn">預約 Submit <i class="material-icons right">send</i></button>
</div>

<script>
$(function() {

    $('textarea[name="message"]').characterCounter();

    $('button[name="booking"]').click(function(e) {
        var $form = $('form#booking_form');
        $.ajax({
            url:$form.attr('action'),
            type: 'POST',
            data: $form.serialize(),
            beforeSend: function() {
                var preloader = '<div class="preloader-wrapper small small-preloader active">';
                preloader += '<div class="spinner-layer spinner-blue-only">';
                preloader += '<div class="circle-clipper left">';
                preloader += '<div class="circle"></div>';
                preloader += '</div><div class="gap-patch">';
                preloader += '<div class="circle"></div>';
                preloader += '</div><div class="circle-clipper right">';
                preloader += '<div class="circle"></div>';
                preloader += '</div>';
                preloader += '</div>';
                preloader += '</div>';

                $('button[name="booking"]').addClass('disabled').attr('disabled', 'disabled')
                        .parent().prepend(preloader);
            },
            success: function(data) {
                console.log(data);
                if (data.success) {
                    Materialize.toast(data.success.message, 4000);
                    $('#calendar').fullCalendar( 'refetchEvents' )
                    $('#modal1').closeModal();
                }
            },
            error: function(data) {
                $('#errors').find('div').empty();

                var errors = data.responseJSON;
                $.each(errors, function(index, value) {
                    Materialize.toast(value, 3000);
                });
                $('button[name="booking"]').removeClass('disabled').removeAttr('disabled');
                $('div.small-preloader').remove();
            }
        });
    });
});
</script>
