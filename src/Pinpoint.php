<?php
    namespace Amchella\Pinpoint;

    use Aws\PinpointEmail\PinpointEmailClient;

    class Pinpoint {
        private PinpointEmailClient $client;
        private String $appId;
        public function __construct(Array $config, String $id) {
            $this->client = new PinpointEmailClient($config);
            $this->appId = $id;
        }

        /**
         * Undocumented function
         *
         * @param  Array $message
         * @return void
         */
        public function sendMessage(Array $message) {
            $this->client->sendEmail($message);
        }

        /**
         * Undocumented function
         *
         * @param  String $name
         * @return void
         */
        public function getTemplate(String $name) {
            $result =  $this->client->getEmailIdentity([
                'TemplateName' => $name,
                'Version'  => 'Version 1'
            ]);
            print_r($result);
        }
    }