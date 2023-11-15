<?php
namespace Amchella\Pinpoint;

use \Exception;
use \DateTime;

class MessageBuilder {
    public function build(Array $input) {
        return $this->getMailContent($input);
    }

    public function getHumanReadableDateFormat(String $date) {

        // RFC3339/ISO8601 formatted datetime string
        $dateTimeString = $date;

        // Create a DateTime object from the string
        $dateTime = DateTime::createFromFormat('Ymd\THis\Z', $dateTimeString);

        // Format the DateTime object to a human-readable format
        return $dateTime->format('Y M d H:i:s');
    }


    private function getMailContent(Array $input) {
        if (array_key_exists('ics', $input) === false) {
            throw new Exception("ics information not found");
        }

        if (array_key_exists('start_date', $input['ics']) === false) {
            throw new Exception("ics start date information not found");
        }

        if (array_key_exists('end_date', $input['ics']) === false) {
            throw new Exception("ics end date information not found");
        }

        if (array_key_exists('uid', $input['ics']) === false) {
            throw new Exception("ics uid information not found");
        }

        if (array_key_exists('location', $input['ics']) === false) {
            throw new Exception("ics location information not found");
        }

        if (array_key_exists('organizer', $input['ics']) === false) {
            throw new Exception("ics organizer information not found");
        }

        if (array_key_exists('summary', $input['ics']) === false) {
            throw new Exception("ics summary information not found");
        }

        if (array_key_exists('description', $input['ics']) === false) {
            throw new Exception("ics description information not found");
        }

        if (array_key_exists('status', $input['ics']) === false) {
            throw new Exception("ics status information not found");
        }

        if (array_key_exists('req_type', $input['ics']) === false) {
            throw new Exception("ics req_type information not found");
        }

        $ics = $input['ics'];
        $data = $input['email'];

        $sessionTimings = sprintf("%s - %s",
            $this->getHumanReadableDateFormat($ics['start_date']),
            $this->getHumanReadableDateFormat($ics['end_date'])
        );

        return <<<EOT
        From: chelapandi.soundarapandian@learnship.com
        To: 2chellaa@gmail.com
        Subject: {$data['subject']}
        MIME-Version: 1.0
        Content-Type: multipart/mixed; boundary="boundary_example"

        --boundary_example
        Content-Type: text/html; charset="UTF-8"
        Content-Transfer-Encoding: 7bit

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <style type="text/css">
            td {
                font-family: arial;
                font-size: 13px;
                color: #555555;
            }
            .policy-separator {
                padding-right: 5px;
                padding-left: 5px;
                color: #e0291a;
            }
            </style>
        </head>
        <body>
            <table
            border="0"
            cellpadding="0"
            cellspacing="0"
            width="600"
            style="border:1px solid #ccc;border-collapse:collapse;"
            >
            <thead>
                <tr>
                <td
                    align="center"
                    style="background-color: #333333;color: #ffffff;padding: 25px 30px;"
                >
                    <img
                    width="180"
                    align="middle"
                    alt="Learnship"
                    src="{$data['LS_LOGO_URL']}"
                    />
                </td>
                </tr>
            </thead>
            <tbody>
                <tr>
                <td valign="top" style="padding:10px 30px;">
                    <font face="Arial" color="#555555" style="font-size:14px;"
                    >Dear {$data['firstName']},</font
                    >
                </td>
                </tr>
                <tr>
                <td style="padding:10px 30px;">
                    <font style="font-size: 14px; line-height: 18px;"
                    >The following session(s) have been scheduled for you. Here are
                    the details of the new session(s):<br
                    /></font>
                </td>
                </tr>
                <tr>
                <td style="padding:10px 30px;">
                    <table>
                    <tbody style="vertical-align: top;">
                        <tr>
                        <td>
                            <span
                            style="font-size: 14px; font-weight: bold; line-height: 25px;"
                            >Trainer:</span
                            >
                        </td>
                        <td>
                            <span
                            style="font-size: 14px; color:#19B29D; line-height: 25px;"
                            >
                            {$data['hostFirstname']} {$data['hostLastname']}</span
                            >
                        </td>
                        </tr>
                        <tr>
                        <td>
                            <span
                            style="font-size: 14px; font-weight: bold; line-height: 25px;"
                            >Duration:</span
                            >
                        </td>
                        <td>
                            <span
                            style="font-size: 14px; color:#19B29D; line-height: 25px;"
                            >
                            {$data['duration']} Minutes</span
                            >
                        </td>
                        </tr>
                        <tr>
                        <td>
                            <span
                            style="font-size: 14px; font-weight: bold; line-height: 25px;"
                            >Date &amp; Time:</span
                            >
                        </td>
                        <td>
                            <span
                            style="font-size: 14px; color: #19B29D; line-height: 25px;"
                            >{$sessionTimings}</span
                            >
                        </td>
                        </tr>
                    </tbody>
                    </table>
                </td>
                </tr>
                <tr>
                <td style="padding:10px 30px;">
                    <a
                    href="https://kg76tgyw.r.eu-central-1.awstrack.me/L0/https:%2F%2Fcoach.learnship.com/1/020dfdafdf"
                    style="font-size: 14px; background-color: #42BABD; color: #424242; display:block; line-height: 40px; text-align: center; max-width:100px; text-decoration: none;"
                    >My Schedule</a
                    >
                </td>
                </tr>
                <tr>
                <td
                    valign="top"
                    style="padding:10px 30px; font-size:14px; line-height: 18px"
                >
                    <p style="margin: 0px;">
                    If you have questions, please refer to the
                    <a href="https://tms.learnship.com/faq">FAQs</a>. For further questions related to your
                    schedule get in touch with us at
                    <a href="mailto:learning.specialist@learnship.com"
                        >learning.specialist@learnship.com</a
                    >. In case of technical issues contact us via our service –
                    <a href="https://tms.learnship.tech/support">Customer Support</a>
                    <a href="https://tms.learnship.tech/faq"></a>
                    </p>
                </td>
                </tr>
                <tr>
                <td valign="top" style="padding:10px 30px;">
                    <table border="0" cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr>
                        <td valign="top" height="30">
                            <font face="Arial" style="font-size:14px;" color="#555555"
                            >Warmly,</font
                            >
                        </td>
                        </tr>
                        <tr>
                        <td valign="top" height="30">
                            <font face="Arial" style="font-size:14px;" color="#555555"
                            ><strong>Your Learnship Team</strong></font
                            >
                        </td>
                        </tr>
                        Your Learnship Team
                    </tbody>
                    </table>
                </td>
                </tr>
                <tr>
                <td
                    style="background-color: #333333;padding: 14px 0px;font-size: 10px;font-weight: 300;text-align: center;color: #ffffff;"
                >
                    <div>© {$data['CURRENT_YEAR']} Learnship. All Rights Reserved</div>
                    <div style="margin-top: 5px">
                    This is an automated message. Please do not reply.
                    </div>
                    <div style="margin-top: 5px">
                    <a
                        href="https://kg76tgyw.r.eu-central-1.awstrack.me/L0/https:%2F%2Fsupport.learnship.com%2Fen-en%2Fcontact_support/2/02070000v6dki32o-h1fgn1cd-ac45-579b-1h9t-bvm5113t6o80-000000/W4M7rmSQBZivGb0opUApsIwglFA=119"
                        style="font-weight: 600; color: #e9e9e9; text-decoration: none"
                        >Customer support</a
                    ><span class="policy-separator">/</span
                    ><a
                        href="https://kg76tgyw.r.eu-central-1.awstrack.me/L0/https:%2F%2Fwww.learnship.com%2Fus%2Fgeneral-terms-and-conditions%2F/1/02070000v6dki32o-h1fgn1cd-ac45-579b-1h9t-bvm5113t6o80-000000/Nz_FunpyQ5Q8CcwhXja2N-BKCVk=119"
                        style="font-weight: 600; color: #e9e9e9; text-decoration: none"
                        >Terms of service</a
                    ><span class="policy-separator">/</span
                    ><a
                        href="https://kg76tgyw.r.eu-central-1.awstrack.me/L0/https:%2F%2Fwww.learnship.com%2Fus%2Fprivacy-notice%2F/1/02070000v6dki32o-h1fgn1cd-ac45-579b-1h9t-bvm5113t6o80-000000/yU5KwZQl7mt_aUDF6103oycdO4s=119"
                        style="font-weight: 600;color: #e9e9e9;text-decoration: none;padding-bottom: 5px;"
                        >Privacy policy</a
                    >
                    </div>
                </td>
                </tr>
            </tbody>
            </table>
        </body>
        </html>

        --boundary_example
        Content-Type: text/calendar;charset="UTF-8";method=REQUEST
        Content-Disposition: attachment; filename="event.ics"

        BEGIN:VCALENDAR
        CALSCALE:GREGORIAN
        METHOD:REQUEST
        PRODID:-//Test Cal//EN
        VERSION:2.0
        BEGIN:VEVENT
        SEQUENCE:0
        UID:{$ics['uid']}
        DTSTART;VALUE=DATE-TIME:{$ics['start_date']}
        DTEND;VALUE=DATE-TIME:{$ics['end_date']}
        DTSTAMP;VALUE=DATE-TIME:{$ics['start_date']}
        SUMMARY:{$ics['summary']}
        DESCRIPTION:{$ics['description']}
        ORGANIZER:mailto:chellapandi.soundarapandian@learnship.com
        STATUS:{$ics['status']}
        LOCATION:{$ics['location']}
        END:VEVENT
        END:VCALENDAR

        --boundary_example--
        EOT;
    }
}