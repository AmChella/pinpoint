<?php
namespace Amchella\Pinpoint;

use Symfony\Component\Yaml\Yaml;
use Amchella\Pinpoint\Pinpoint;
use Amchella\Pinpoint\MessageBuilder;
use \DateTime;
use \DateTimeZone;

class App {
    public $yaml;
    public Pinpoint $service;
    public MessageBuilder $messageBuilder;

    public function __construct() {
        $this->yaml = Yaml::parseFile(__DIR__ . '/config/app.yaml');
        $this->service = new Pinpoint([
            'profile' => $this->yaml['pinpoint']['profile'],
            'region'  => $this->yaml['pinpoint']['region'],
            'version'  => '2018-07-26',
        ], '#');
        $this->messageBuilder = new MessageBuilder();
    }

    private function convertTime(String $time) {
        $localDateTime = new DateTime($time);

        // Set the timezone to UTC (Zulu time)
        $localDateTime->setTimeZone(new DateTimeZone('UTC'));

        // Get the Zulu (UTC) time string
        return $localDateTime->format('Ymd\THis\Z');
    }

    public function mail(Array $ins) {
        $startTime = $this->convertTime($ins['start']);
        $endTime = $this->convertTime($ins['end']);
        $REQ = 'CANCEL';
        if ($ins['browser'] === 'Creation') {
            $REQ = 'REQUEST';
        }

        $STATUS = $ins['status'];
        $state = "";
        if ($REQ === 'CANCEL') {
            $STATUS = 'CANCELLED';
            $state = " - $STATUS";
        }

        $iData = [
            'ics' => [
                'uid' => $ins['uid'], 'start_date' => $startTime, 'end_date' => $endTime,
                'organizer' => 'Chella S', 'summary'=> $ins['summary'],
                'description'=> $ins['description'],
                'status' => $STATUS, 'REQ' => $REQ, 'location' => 'Chennai',
                'organizer_email' => $this->yaml['mail']['organizer']
            ],
            'email' => [
                'LS_LOGO_URL' => $this->yaml['template']['logo_url'],
                'firstName' => $this->yaml['template']['learner_name'],
                'hostFirstname' => $this->yaml['template']['trainer_first_name'],
                'hostLastname' => $this->yaml['template']['trainer_last_name'],
                'duration' => '60',
                'CURRENT_YEAR' => 2023, 'subject' => $this->yaml['template']['subject'] . $state
            ]
        ];

        $content = $this->messageBuilder->build($iData);
        $message = [
            'FromEmailAddress' => $this->yaml['mail']['from'],
            'Destination' => [
                'ToAddresses' => $this->yaml['mail']['to']

            ],
            'Content' => [
                'Raw' => [
                        'Data' => $content
                ]
            ],
        ];
        // return $message;
        // print_r($service->getTemplate('sample_template'));
        $this->service->sendMessage($message);
        return true;
    }

    public function getUids() {
        return $this->yaml['uids'];
    }
}