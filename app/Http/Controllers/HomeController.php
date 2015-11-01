<?php namespace app\Http\Controllers;

use app\Http\Requests;
use app\Http\Requests\BookingRequests;

class HomeController extends Controller {

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function getIndex()
    {
        return view('home');
    }

    public function getAdd()
    {
        return view('add');
    }

    public function postAdd(BookingRequests $request)
    {
        $input = $request->all();

        $event = new \Google_Service_Calendar_Event([
            'summary' => 'Google I/O 2015',
            'location' => '800 Howard St., San Francisco, CA 94103',
            'description' => 'A chance to hear more about Google\'s developer products.',
            'start' => [
                'dateTime' => '2015-11-05T09:00:00-07:00',
                'timeZone' => 'America/Los_Angeles',
            ],
            'end' => [
                'dateTime' => '2015-11-06T17:00:00-07:00',
                'timeZone' => 'America/Los_Angeles',
            ],
            'recurrence' => [
                'RRULE:FREQ=DAILY;COUNT=2'
            ],
            'attendees' => [
                ['email' => 'lpage@example.com'],
            ],
            'reminders' => [
                'useDefault' => FALSE,
                'overrides' => [
                    ['method' => 'email', 'minutes' => 24 * 60],
                    ['method' => 'popup', 'minutes' => 10],
                ],
            ],
        ]);

        $this->_addEvent($event);

        return response()->json([
            'success'  =>  [
                'message'  =>  '成功預約 Your booking was successful.'
            ]
        ]);
    }

    public function _addEvent(\Google_Service_Calendar_Event $event)
    {

        $client = $this->_getClient();
        $service = new \Google_Service_Calendar($client);

        // Print the next 10 events on the user's calendar.
        $calendarId = '5sbpquu8mg8t01eue4iv8s6cuk@group.calendar.google.com';
        $event = $service->events->insert($calendarId, $event);

        /*
        $optParams = array(
            'maxResults' => 10,
            'orderBy' => 'startTime',
            'singleEvents' => TRUE,
            'timeMin' => date('c'),
        );
        $results = $service->events->listEvents($calendarId, $optParams);

        if (count($results->getItems()) == 0) {
            print "No upcoming events found.\n";
        } else {
            print "Upcoming events:\n";
            foreach ($results->getItems() as $event) {
                $start = $event->start->dateTime;
                if (empty($start)) {
                    $start = $event->start->date;
                }
                printf("%s (%s)\n", $event->getSummary(), $start);
            }
        }
        */
    }

    private function _getClient() {
        $APPLICATION_NAME = 'Google Calendar API PHP Quickstart';
        $SCOPES = implode(' ', [
            \Google_Service_Calendar::CALENDAR
        ]);

        $CLIENT_SECRET_PATH = config_path() . '/google/client_secret.json';
        $REFRESH_TOKEN_PATH = config_path() . '/google/.refresh_token';

        $client = new \Google_Client();
        $client->setApplicationName($APPLICATION_NAME);
        $client->setScopes($SCOPES);
        $client->setAuthConfigFile($CLIENT_SECRET_PATH);
        $client->setAccessType('offline');

        $refresh_token = file_get_contents($REFRESH_TOKEN_PATH);
        $refresh_token = explode(PHP_EOL, $refresh_token)[0];  // trim end of file line
        if ($client->isAccessTokenExpired()) {
            $client->refreshToken($refresh_token);
            $accessToken = $client->getAccessToken();
        }
        $client->setAccessToken($accessToken);

        return $client;
    }

}
