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

</body>
</html>

@endsection

@section('script')
<script>

	$(document).ready(function() {
	
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
                console.log(event);
				return false;
			},

			loading: function(bool) {
				$('#loading').toggle(bool);
			}
			
		});
		
	});

</script>
@endsection
