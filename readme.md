## ibooknow

A easy appointment system for tutor and students.  
connect and extend your google calendar

## requirement
Google calendar api authentication

## setup
1. `composer install`

2. public your calendar and change your calendar ID at line:
   86 and line: 94 in `app/Http/Controllers/HomeController.php`

    ```
    $calendarId = '5sbpquu8mg8t01eue4iv8s6cuk@group.calendar.google.com';
    ```

3. create these files and input your `client secret` and     
   `refresh_token`

   `config/google/client_secret.json`

   `config/google/.refresh_token`

   (important! use [Google OAuth 2.0 Playground][googleplayground] to get your refresh token)

   **create your own project to get API keys in [Google API Console][googleapiconsole] and create new OAuth 2.0 (web application) credentials, download as .json file.**

  **By use Google OAuth2.0 Playground with custom Client ID and secret settings, you can get your own refresh currectly.**

  **See more detail in [this video][generaterefreshtoken].**

4. Run your own calendar

### License

[MIT license](http://opensource.org/licenses/MIT)



[googleplayground]: https://developers.google.com/oauthplayground "Google Playground"

[googleapiconsole]:https://console.developers.google.com/apis/credentials?project=sincere-venture-111420 "Google API Console"

[generaterefreshtoken]:https://www.youtube.com/watch?v=hfWe1gPCnzc "Generating a refresh token for YouTube API calls using the OAuth playground"
