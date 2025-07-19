<?php
return [

    /*
    |--------------------------------------------------------------------------
    | Private Key Firebase
    |--------------------------------------------------------------------------
    |
    | You can get this file in Firebase Console and download it from here this path
    | how you can get this file in Firebase Console
    | -> go to project settings -> service accounts
    | -> click  Firebase Admin SDK  and Genrate new private key button
    |
    */
    'private_key_file' => storage_path('app/private-key-firebase.json'),

    /*
    |--------------------------------------------------------------------------
    | Auth Scope
    |--------------------------------------------------------------------------
    |
    | this get in doc firebase
    |
    */
    'auth_scope' => 'https://www.googleapis.com/auth/firebase.messaging',


    /*
    |--------------------------------------------------------------------------
    | Send Message Url
    |--------------------------------------------------------------------------
    |
    | this end point to send message to device . but you shoud to now 
    | here we have FIREBASE_PROJECT_ID in .env file
    | how you can get this project id 
    | go here https://console.developers.google.com/
    | you can get all project firebase here and id all projects
    |
    */
    'send_message_url' => 'https://fcm.googleapis.com/v1/projects/' . env('FIREBASE_PROJECT_ID') . '/messages:send'
];
