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
        $content = $this->messageBuilder->build($ins);
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
        return $this->service->sendMessage($message);
    }


    public function repeatMail(Array $ins) {
        $content = $this->messageBuilder->buildRepeat($ins);
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
        return $this->service->sendMessage($message);
    }

    public function getUids() {
        return $this->yaml['uids'];
    }
}