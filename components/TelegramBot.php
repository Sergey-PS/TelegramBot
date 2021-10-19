<?php

namespace app\components;

use GuzzleHttp\Client;

class TelegramBot
{
    protected $token = '2015394936:AAGW4xJSMgGxIRkplRCbDxXqXKdR2d2Qb8o';
    protected $updateId;
    const I_DO_NOT_UNDERSTAND = 'Не понимаю Вас! Наберите: <b><u>кот</u></b> или <b><u>пес</u></b>.';
    const BEAUTIFUL = ['Красивый',
        "Привлекательная",
        "Обольстительная",
        "Прекрасная",
        "Восхитительная",
        'Чудная',
        "Обаятельная",
        'Очаровательная',
        "Чарующая",
        "Пленительная",
        "Прелестная",
        "Покоряющая",
        "Неотразимая",
        "Прельстительная",
    ];

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function query($method, $params = [])
    {
        $url = 'https://api.telegram.org/bot';
        $url .= $this->token;
        $url .= '/' . $method;
        if (!empty($params)) {
            $url .= '?' . http_build_query($params);
        }
        $client = new Client();
        $result = $client->request('GET', $url, $params);
        return json_decode($result->getBody());
    }

    public function getUpdates()
    {
        $response = $this->query('getUpdates', [
            'offset' => $this->updateId + 1,
        ]);
        if (!empty($response->result)) {
            $this->updateId = $response->result[count($response->result) - 1]->update_id;
        }
        return $response->result;
    }


    public function sendMessages($chat_id, $url)
    {

        if ($url == null) {
            $response = $this->query('sendMessage', [
                'chat_id' => $chat_id,
                'text' => self::I_DO_NOT_UNDERSTAND,
                "parse_mode" => 'HTML',
            ]);
        } else {
            $rnd_cat = self::BEAUTIFUL[rand(0, count(self::BEAUTIFUL) - 1)] . ' животинка!';
            $response = $this->query('sendPhoto', [
                'chat_id' => $chat_id,
                'photo' => $url,
                'caption' => $rnd_cat,
            ]);
        }
        return $response;
    }
}