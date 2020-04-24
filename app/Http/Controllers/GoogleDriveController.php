<?php

namespace App\Http\Controllers;

use Google_Client;
use Google_Service_Classroom;
use Google_Service_Drive;
use Google_Service_Drive_DriveFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;


class GoogleDriveController extends Controller
{
    private $drive;
    private $classroom;

    public function __construct(Google_Client $client)
    {
        $this->middleware(function ($request, $next) use ($client) {
            $client->refreshToken(Auth::user()->refresh_token);
            $this->drive = new Google_Service_Drive($client);
            $this->classroom = new Google_Service_Classroom($client);
            return $next($request);
        });
    }

    public function getFolders()
    {
        $this->ListFolders('root');
//        $list = [];
//        return view('drive.index', compact('list'));
    }

    public function ListFolders($id)
    {
        $query = "mimeType='application/vnd.google-apps.folder' and '" . $id . "' in parents and trashed=false";
        $optParams = [
            'fields' => 'files(id,name)',
            'q' => $query];
        $results = $this->drive->files->ListFiles($optParams);
        $list = $results->getFiles();
//        $list = [];
//        dd($list);

        if (count($list) == 0) {
            print Redirect::to('/api/v');
        } else {
            print view('drive.index', compact('list'));
        }

    }

    public function isEmpty()
    {
        return view('drive.empty');
    }

    public function uploadFiles(Request $request)
    {
        if ($request->isMethod('GET')) {
            return view('drive.upload');
        } else {
            $this->createFile($request->file('file'));
        }
    }

    public function client()
    {
//        $client = self::getClient();
//        dd($client);
//        $client = new Google_Client();
//
//        $service = new Google_Service_Classroom($client);

        $optParams = array(
            'pageSize' => 10
        );
        $results = $this->classroom->courses->listCourses($optParams);
        dd($results);
    }


    function getClient()
    {
        $client = new Google_Client();
        $client->setApplicationName('Google Classroom API PHP Quickstart');
        $client->setScopes(Google_Service_Classroom::CLASSROOM_COURSES_READONLY);
        $client->setAuthConfig('credentials.json');
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');

        // Load previously authorized token from a file, if it exists.
        // The file token.json stores the user's access and refresh tokens, and is
        // created automatically when the authorization flow completes for the first
        // time.
        $tokenPath = 'token.json';
        if (file_exists($tokenPath)) {
            $accessToken = json_decode(file_get_contents($tokenPath), true);
            $client->setAccessToken($accessToken);
        }

        // If there is no previous token or it's expired.
        if ($client->isAccessTokenExpired()) {
            // Refresh the token if possible, else fetch a new one.
            if ($client->getRefreshToken()) {
                $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
            } else {
                // Request authorization from the user.
                $authUrl = $client->createAuthUrl();
                printf("Open the following link in your browser:\n%s\n", $authUrl);
                print 'Enter verification code: ';
                $authCode = trim(fgets(STDIN));

                // Exchange authorization code for an access token.
                $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
                $client->setAccessToken($accessToken);

                // Check to see if there was an error.
                if (array_key_exists('error', $accessToken)) {
                    throw new Exception(join(', ', $accessToken));
                }
            }
            // Save the token to a file.
            if (!file_exists(dirname($tokenPath))) {
                mkdir(dirname($tokenPath), 0700, true);
            }
            file_put_contents($tokenPath, json_encode($client->getAccessToken()));
        }
        return $client;
    }

}
