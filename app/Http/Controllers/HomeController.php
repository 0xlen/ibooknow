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
        $startTime = strtotime($input['month'].'/'. $input['day']. ' ' .$input['start_time']);
        $endTime   = strtotime($input['month'].'/'. $input['day']. ' ' .$input['end_time']);

        if ( ($endTime - $startTime) % 3600 != 0 ) {
            return response()->json(['bookingTime' => '預約時間需以 1 小時單位 Booking time required in 1 hour units'], 422);
        }

        $summary     = '程式課程 '. $input['start_time']. ' - ' .$input['end_time'];
        $description = 'Name: ' . $input['full_name'] . PHP_EOL .
                       'Class: '. $input['class'] . ' ('. $input['student_id'] . ')' . PHP_EOL .
                       'Email: '. $input['email'] . PHP_EOL;
        $description .= (isset($input['message'])) ? $input['message'] : '' ;

        $event = new \Google_Service_Calendar_Event([
            'summary' => $summary,
            'description' => $description,
            'start' => [
                'dateTime' => date(DATE_RFC3339, $startTime),
                'timeZone' => 'Asia/Taipei',
            ],
            'end' => [
                'dateTime' => date(DATE_RFC3339, $endTime),
                'timeZone' => 'Asia/Taipei',
            ],
            'attendees' => [
                ['email' => $input['email']],
            ],
            'reminders' => [
                'useDefault' => FALSE,
                'overrides' => [
                    ['method' => 'email', 'minutes' => 24 * 60],
                    ['method' => 'popup', 'minutes' => 30],
                ],
            ],
        ]);

        $this->_addEvent($event);

        return response()->json([
            'success'  =>  [
                'message'  =>  '已成功預約 Your booking was successful.'
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
