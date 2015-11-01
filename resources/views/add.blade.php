<div class="modal-content">

<h4>預約上課 Booking - <small>{{ $_GET['month'] }}/{{ $_GET['day'] }}</small></h4>
<div class="row hide" id="errors">
    <div class="card-panel red lighten-3"></div>
</div>
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
        <div class="input-field col s12">
          <i class="material-icons prefix">schedule</i>
          <input id="icon_time" name="time" type="time" class="validate">
        </div>
      </div>

      <div class="row">
        <div class="input-field col s12">
          <i class="material-icons prefix">message</i>
          <textarea id="icon_time" name="message" class="materialize-textarea" length="500"></textarea>
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
    $('button[name="booking"]').click(function(e) {
        var $form = $('form#booking_form');
        $.ajax({
            url:$form.attr('action'),
            type: 'POST',
            data: $form.serialize(),
            success: function(data) {
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
                    $('#errors').find('div').append('<li>' + value + '</li>');
                });
                $('#errors').stop().removeClass('hide').fadeIn().fadeOut(10000);
            }
        });
    });
});
</script>
