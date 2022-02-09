```php
$slack1 = new SlackAlerts('https://hooks.slack.com/services/xxxxxx/yyyyyyy/zzzzzz');
$slack1->setText('test');
$slack1->send();

//  ---

$slack2 = new SlackAlerts([
    'default' => 'https://hooks.slack.com/services/xxxxxx/yyyyyy/zzzzzz',
    'channel2' => 'https://hooks.slack.com/services/yyyyyy/xxxxxx/ssssss'
]);
$slack2->setText('test');
$slack2->send('channel2');
```