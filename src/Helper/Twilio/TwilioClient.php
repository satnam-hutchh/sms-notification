<?php
namespace Hutchh\SmsNotification\Helper\Twilio;
use Hutchh\SmsNotification\Helper\ClientInterface;
use Twilio\Rest\Client;
use Twilio\TwiML\VoiceResponse;
use Illuminate\Support\Facades\Log;
use Twilio\Exceptions\TwilioException;

class TwilioClient implements ClientInterface{
    protected $client;
    protected $twilioServiceId;

    public function __construct($config){
        $this->client = new Client($config['auth_id'], $config['auth_token']);
        $this->setServiceId($config['service_id']);
    }

    public function setServiceId(string $serviceId){
        $this->twilioServiceId = $serviceId;
    }

    public function setSenderNumber(string $phoneNumber){
        $this->twilioPurchasedNumber = $phoneNumber;
    }

    public function sendMesasge(string $phoneNumber, string $message){
        try{
            Log::info("$phoneNumber => $message");
            $message = $this->client->messages->create(
                $phoneNumber,
                [
                    // 'from' => $this->twilioPurchasedNumber,
                    'body' => $message,
                    "messagingServiceSid" => $this->twilioServiceId
                ]
            );
        }catch(\Throwable $e){
        }
    }

    public function makeOtpVoiceCall(string $phoneNumber, string $otpCode){
        $twimlUrl = "https://e5bc-3-105-50-231.ngrok-free.app/api/generate/otpMesage/" .$otpCode;
        // $twimlUrl = env('APP_URL') . ":8003/api/generate/otpMesage/" .$otpCode;
        Log::info($twimlUrl);
        // $twimlUrl = 'https://demo.twilio.com/docs/voice.xml';

        $call = $this->client->calls->create($phoneNumber, $this->twilioPurchasedNumber, [
            "url"   => $twimlUrl
        ]);

        // Log::info($call->sid);
        // return $call->sid;
    }

    public function validate(string $phoneNumber): bool {
        if (empty($phoneNumber)) {
            return false;
        }

        try {
            $phone_number = $this->client
                ->lookups
                ->v2
                ->phoneNumbers($phoneNumber)
                ->fetch();
        } catch (TwilioException $e) {
            Log::info($e);
            return false;
        }
        return true;
    }

    /**
     * Generate the TWIML needed for a voice call sending an OTP code to a user.
     *
     * @param $otpCode
     * @return VoiceResponse
     */
    public function generateVoiceMessage($otpCode)
    {
        /**
         * We add spaces between each digit in the otpCode so Twilio pronounces each number instead of pronouncing the whole word.
         *
         * @See https://www.twilio.com/docs/voice/twiml/say#hints
         */
        $otpCode = implode(' ', str_split($otpCode));
        $voiceMessage = new VoiceResponse();
        // $voiceMessage->say('This is an automated call providing you your OTP from the test app.');
        $voiceMessage->say('Your one time password is ' . $otpCode);
        $voiceMessage->pause(['length' => 1]);
        $voiceMessage->say('Your one time password is ' . $otpCode);
        // $voiceMessage->say('GoodBye');
        return $voiceMessage;
    }
}