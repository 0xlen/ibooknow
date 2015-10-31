<?php namespace app\Http\Controllers;

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

        $client = $this->_getClient();
        $service = new \Google_Service_Calendar($client);

        // Print the next 10 events on the user's calendar.
        $calendarId = '5sbpquu8mg8t01eue4iv8s6cuk@group.calendar.google.com';
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
    }

    private function _getClient() {
        $APPLICATION_NAME = 'Google Calendar API PHP Quickstart';
        $SCOPES = implode(' ', [
            \Google_Service_Calendar::CALENDAR_READONLY
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
