<?php
require_once  __DIR__ . "/vendor/autoload.php";

use Amchella\Pinpoint\Pinpoint;
use Amchella\Pinpoint\MessageBuilder;
use Aws\Exception\AwsException;

try {
    $service = new Pinpoint([
        'profile' => 'pinpoint',
        'region'  => 'eu-central-1',
        'version'  => '2018-07-26',
    ], '858733414094');
    $msgBuilder = new MessageBuilder();
    $subject = "Calendar Sync - Sample";


    $iData = [
        'ics' => [
            'uid' => 'test24', 'start_date' => '20231118T190000Z', 'end_date' => '20231118T200000Z',
            'organizer' => 'Chella S', 'summary'=> 'New Session',
            'description'=> 'You have a new session',
            'status' => 'CONFIRMED', 'req_type' => 'creation', 'location' => 'Chennai',
            'organizer_email' => 'chellapandi.soundarapandian@learnship.com'
        ],
        'email' => [
            'LS_LOGO_URL' => 'https://learnship-production-messaging-email-assets.s3.eu-central-1.amazonaws.com/shared/img/learnship_logo_dark.png',
            'firstName' => 'Hitesh kumardewangan', 'hostFirstname' => 'Anup Nathaniel', 'hostLastname' => 'Samson', 'duration' => '60',
            'CURRENT_YEAR' => 2023, 'subject' => $subject
        ]
    ];
    $content = $msgBuilder->build($iData);
    $message = [
        'FromEmailAddress' => 'chellapandi.soundarapandian@learnship.com',
        'Destination' => [
            'ToAddresses' => [
                '2chellaa@gmail.com', 'gowerisankari.appaji@learnship.com', 'hitesh.kumardewangan@learnship.com', 'anup.nathaniel@learnship.com'
            ]
        ],
        'Content' => [
            'Raw' => [
                    'Data' => $content
            ]
        ],
    ];
    // print_r($ics);
    // print_r($service->getTemplate('sample_template'));
    $service->sendMessage($message);
} catch (\Exception $e) {
    echo $e->getMessage(), "\n";
}
