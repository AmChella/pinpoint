<?php
namespace Amchella\Pinpoint;

use \Exception;
use \DateTime;
use \DateInterval;
use \DateTimeZone;
use Spatie\IcalendarGenerator\Components\Calendar;
use Spatie\IcalendarGenerator\Components\{Event, TimeZone};
use Spatie\IcalendarGenerator\Enums\{ParticipationStatus, EventStatus, RecurrenceFrequency};
use Spatie\IcalendarGenerator\ValueObjects\RRule;

class MessageBuilder {
    public function build(Array $input) {
        return $this->getMailContent($input);
    }

    public function buildRepeat(Array $input) {
        return $this->getMailRepeatContent($input);
    }

    public function getHumanReadableDateFormat(String $date) {
        // RFC3339/ISO8601 formatted datetime string
        $dateTimeString = $date;

        // Create a DateTime object from the string
        $dateTime = DateTime::createFromFormat('Ymd\THis\Z', $dateTimeString);

        // Format the DateTime object to a human-readable format
        return $dateTime->format('d M Y H:i');
    }


    private function getMailRepeatContent($input) {
        $start = new DateTime($input['starttime'], new DateTimeZone('Asia/Calcutta'));
        $end = new DateTime($input['endtime'], new DateTimeZone('Asia/Calcutta'));
        $status = EventStatus::confirmed();
        $method = 'REQUEST';
        if ($input['type'] === 'cancel') {
            $status = EventStatus::cancelled();
            $method = 'CANCEL';
        }

        // $timezone = Timezone::create('Asia/Calcutta');
        $rrule = RRule::frequency(RecurrenceFrequency::daily());
        $icsContent = Calendar::create('Learnship online')
        ->event(Event::create("Recurring sesison ics integration")
            ->startsAt($start)
            ->endsAt($end)
            ->description('Session recurring invitation')
            ->uniqueIdentifier($input['uid'])
            ->organizer($input['org'])
            ->attendee('2chellaa@gmail.com', 'Chella S', ParticipationStatus::needs_action(), true)
            ->rrule($rrule)
            ->status($status)
        )
        ->productIdentifier('ics/learnship')
        ->method($method)
        ->get();

        // print_r($icsContent);
        // return $icsContent;

        return <<<EOT
        From: chelapandi.soundarapandian@learnship.com
        To: 2chellaa@gmail.com
        Subject: ICS Test
        MIME-Version: 1.0
        Content-Type: multipart/mixed; boundary="boundary_example"

        --boundary_example
        Content-Type: text/plain; charset="UTF-8"
        Content-Transfer-Encoding: 7bit

        Sample mail

        --boundary_example
        Content-Type: text/calendar;charset="UTF-8";method=REQUEST
        Content-Disposition: attachment; filename="event.ics"

        {$icsContent}

        --boundary_example--
        EOT;
    }


    private function getMailContent(Array $input) {
        $start = new DateTime($input['starttime'], new DateTimeZone('Asia/Calcutta'));
        $end = new DateTime($input['endtime'], new DateTimeZone('Asia/Calcutta'));
        $status = EventStatus::confirmed();
        $method = 'REQUEST';
        if ($input['type'] === 'cancel') {
            $status = EventStatus::cancelled();
            $method = 'CANCEL';
        }

        // $timezone = Timezone::create('Asia/Calcutta');
        $icsContent = Calendar::create('Learnship online')
        ->event(Event::create("Sample sesison ics integration")
            ->startsAt($start)
            ->endsAt($end)
            ->description('Session invitation')
            ->uniqueIdentifier($input['uid'])
            ->organizer($input['org'])
            ->attendee('2chellaa@gmail.com', 'Chella S', ParticipationStatus::needs_action(), true)
            ->status($status)
        )
        ->productIdentifier('ics/learnship')
        ->method($method)
        // ->timezone($timezone)
        ->get();

        // print_r($icsContent);
        // return $icsContent;

        return <<<EOT
        From: chelapandi.soundarapandian@learnship.com
        To: 2chellaa@gmail.com
        Subject: ICS Test
        MIME-Version: 1.0
        Content-Type: multipart/mixed; boundary="boundary_example"

        --boundary_example
        Content-Type: text/plain; charset="UTF-8"
        Content-Transfer-Encoding: 7bit

        Sample mail

        --boundary_example
        Content-Type: text/calendar;charset="UTF-8";method=REQUEST
        Content-Disposition: attachment; filename="event.ics"

        {$icsContent}

        --boundary_example--
        EOT;
    }
}