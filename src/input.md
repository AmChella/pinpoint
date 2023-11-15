[
                'ConfigurationSetName' => 'tms-test',
                "Template" => [
                    "TemplateName" => "sample_template"
                ],
                'Content' => [ // REQUIRED
                    // 'Raw' => [
                    //     'Data' => <<<EOF
                    //     From: chellapandi.soundarapandian@learnship.com
                    //     To: 2chellaa@gmail.com
                    //     Subject: Email with ICS attachment
                    //     MIME-Version: 1.0
                    //     Content-Type: multipart/mixed; boundary="boundary_example"
                    //     --boundary_example
                    //     Content-Type: text/html; charset="UTF-8"
                    //     Content-Transfer-Encoding: 7bit

                    //     --boundary_example
                    //     Content-Type: text/calendar; charset="UTF-8"; method=REQUEST
                    //     Content-Transfer-Encoding: base64
                    //     Content-Disposition: attachment; filename="event.ics"

                    //     BEGIN:VCALENDAR
                    //     CALSCALE:GREGORIAN
                    //     METHOD:REQUEST
                    //     PRODID:-//Test Cal//EN
                    //     VERSION:2.0
                    //     BEGIN:VEVENT
                    //     Sequence:0
                    //     UID:test-2
                    //     DTSTART;VALUE=DATE:20231128
                    //     DTEND;VALUE=DATE:20231128
                    //     SUMMARY:Test
                    //     DESCRIPTION:Test Event for ICS
                    //     ORGANIZER;CN=Chella S:mailto:chella@learnship.com
                    //     STATUS:CONFIRMED
                    //     END:VEVENT
                    //     END:VCALENDAR

                    //     --boundary_example--
                    //     EOF,
                    // ],
                    // 'Body' => [
                    //     'Text' => [
                    //         'Charset' => 'utf-8',
                    //         'Data' => "Sample Mail"
                    //     ]
                    // ],
                    'Subject' => [ // REQUIRED
                        'Charset' => 'utf-8',
                        'Data' => 'Test Email PINPOINT', // REQUIRED
                    ]
                    // 'Simple' => [
                    //     'Body' => [ // REQUIRED
                    //         // 'Html' => [
                    //         //     'Charset' => 'utf-8',
                    //         //     'Data' => 'Test Email', // REQUIRED
                    //         // ],
                    //         'Text' => [
                    //             'Charset' => 'utf-8',
                    //             'Data' => 'Test Email', // REQUIRED
                    //         ],
                    //     ],
                    //     'Subject' => [ // REQUIRED
                    //         'Charset' => 'utf-8',
                    //         'Data' => 'Test Email PINPOINT', // REQUIRED
                    //     ],
                    // ]
                ],
                'Destination' => [ // REQUIRED
                    // 'BccAddresses' => [],
                    // 'CcAddresses' => [],
                    'ToAddresses' => ['2chellaa@gmail.com'],
                ],
                // 'EmailTags' => [
                //     [
                //         'Name' => 'Samp', // REQUIRED
                //         'Value' => 'Test', // REQUIRED
                //     ],
                // ],
                // 'FeedbackForwardingEmailAddress' => 'chellapandi.soundarapandian@learnship.com',
                'FromEmailAddress' => 'chellapandi.soundarapandian@learnship.com',
                // 'ReplyToAddresses' => [],
                'Attachments' => [
                    [
                        'ContentType' => 'text/calendar',
                        'Data' => base64_encode($icsContent),
                        'Filename' => 'meeting.ics',
                    ],
                ]
            ]