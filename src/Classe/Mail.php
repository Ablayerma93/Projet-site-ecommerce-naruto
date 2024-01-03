<?php

namespace App\Classe;

use Mailjet\Client;
use Mailjet\Resources;

class Mail
{
    private $api_key = '98a618515e0db59e5a40ba3c7b331540';
    private $api_key_secret = '6b6e869e59f63300d5af7439f7479c49';
    
    public function send ($to_email, $to_name, $subject, $content)
    {
        $mj = new Client ($this->api_key, $this->api_key_secret,true,['version' => 'v3.1']);
      
$body = [
    'Messages' => [
        [
            'From' => [
                'Email' => "abdoulaye33093@gmail.com",
                'Name' => "L'univers Naruto"
            ],
            'To' => [
                [
                    'Email' => $to_email,
                    'Name' => $to_name
                ]
            ],
            'TemplateID' => 5234273,
            'TemplateLanguage' => true,
            'Subject' => $subject,
            'Variables' => [
                'content' => $content,
            ]
        ]
        
    ]
];
$response = $mj->post(Resources::$Email, ['body' => $body]);
$response->success();
    }
}