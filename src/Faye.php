<?php namespace Staskjs\LaravelFaye;

use GuzzleHttp\Exception\RequestException;
use Illuminate\Broadcasting\Broadcasters\Broadcaster;

class Faye extends Broadcaster {

    private $url;

    private $senderName;

    public function __construct() {

        $this->setUrl(null);

        $this->setSenderName(null);

        $this->client = new \GuzzleHttp\Client();
    }

    public function setUrl($url) {
        if (empty($url)) {
            $this->url = config('laravel-faye.faye_url') . '/faye';
            return;
        }
        $this->url = $url;
    }

    public function setSenderName($senderName) {
        if (empty($senderName)) {
            $this->senderName = config('laravel-faye.sender_name');
            return;
        }
        $this->senderName = $senderName;
    }

    public function broadcast(array $channels, $event, array $payload = []) {
        foreach ($channels as $channel) {
            $this->publish($channel, $payload);
        }
    }

    public function auth($request) {
        return parent::verifyUserCanAccessChannel($request, $channelName);
    }

    public function validAuthenticationResponse($request, $result) {
        return $result;
    }

    private function publish($channel, $data = [], $ext = []) {
        if (empty($this->url)) {
            throw new \Exception('Faye url is not set. Use FAYE_URL environment variable');
        }

        if (!starts_with($channel, '/')) {
            throw new \Exception("Channel should start with forward slash: $channel");
        }

        $message = [
            'channel' => !empty($this->senderName) ? '/' . $this->senderName . $channel : $channel,
            'data' => $data,
            'ext' => $ext,
        ];

        $response = $this->client->request('POST', $this->url, [
            'form_params' => ['message' => json_encode($message)],
        ]);
    }
}
