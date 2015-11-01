@extends('app')

@section('content')

<style>

	body {
		margin: 40px 10px;
		padding: 0;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		font-size: 14px;
	}
		
	#loading {
		display: none;
		position: absolute;
		top: 10px;
		right: 10px;
	}

	#calendar {
		max-width: 900px;
		margin: 0 auto;
	}

    td.fc-day:hover {
        background-color: #f5f5f5;
    }

</style>
<body>

	<div id='loading'>loading...</div>

	<div id='calendar'></div>

    <div id="modal1" class="modal modal-fixed-footer"></div>

    @if (isset($news))
    <!-- Modal Structure -->
    <div id="modalNews" class="modal">
        <div class="modal-content">
          <h4>注意事項 Notice</h4>
          {!! nl2br(e($news)) !!}
        </div>
        <div class="modal-footer">
          <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">OK</a>
        </div>
    </div>
    @endif

</body>
</html>

@endsection

@section('script')
<script>

	$(document).ready(function() {

        @if (isset($news))
            $('div#modalNews').openModal();
        @endif
	
		$('#calendar').fullCalendar({

			googleCalendarApiKey: 'AIzaSyCcf7T7FcD3Y6v0nW_qtwtAfz9v9WZnrT8',
            timezone: 'local',
            lazyFetching: true,
		
            events: {
                googleCalendarId: '5sbpquu8mg8t01eue4iv8s6cuk@group.calendar.google.com',
            },

            header: {
                left: 'prev,next, today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
			
			eventClick: function(event) {
				return false;
			},

            dayClick: function(moment, jsEvent, view) {
                var param = '?month=' + (moment.month()+1) + '&day=' + moment.date();
                $('#modal1').load("{{ url('/add') }}" + param, function() {
                    $(this).openModal();
                });

                // change the day's background color just for fun
                // $(this).css('background-color', 'red');
            },

			loading: function(bool) {
				$('#loading').toggle(bool);
			}
			
		});

	});

</script>
@endsection
