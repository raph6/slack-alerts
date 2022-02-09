<?php
/**
 * @author Raphaël BLEUZET <https://github.com/raph6>
 */
namespace raph6\SlackAlerts;

class SlackAlerts
{
    private $_ch;

    /**
     * @var array
     */
    private $webhookUrls;

    /**
     * @var string
     */
    private $text;

    public function __construct($webhookUrls = null)
    {
        // webhook urls
        if (!is_null($webhookUrls)) {
            if (!is_array($webhookUrls)) {
                $this->webhookUrls = ['default' => $webhookUrls];
            } else {
                $this->webhookUrls = $webhookUrls;
            }
        }

        // curl init
        $this->_ch = curl_init();
        curl_setopt($this->_ch, CURLOPT_HTTPHEADER, ['Content-type: application/json']);
    }

    /**
     * @param mixed $webhookUrls
     * @return SlackAlerts
     */
    public function setWebhookUrl($webhookUrls)
    {
        if (is_string($webhookUrls)) {
            $this->webhookUrls = ['default' => $webhookUrls];
        } 
        
        if (is_array($webhookUrls)) {
            $this->webhookUrls = $webhookUrls;
        }

        return $this;
    }

    /**
     * @param string $text
     * @return SlackAlerts
     */
    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }

    public function send($to = 'default')
    {
        $data = [
            'type' => 'mrkdown',
            'text' => $this->text,
        ];
        curl_setopt($this->_ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($this->_ch, CURLOPT_POST, true);
        curl_setopt($this->_ch, CURLOPT_URL, $this->webhookUrls[$to]);
        curl_exec($this->_ch);
        curl_close($this->_ch); 
    }
}
