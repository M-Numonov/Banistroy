<?php

namespace Sprint\Migration;


class feedback20190918094812 extends Version
{
    protected $description = "";

    public function up()
    {
        $helper = $this->getHelperManager();
        $helper->Event()->saveEventType('CALLBACK', array (
  'LID' => 'ru',
  'EVENT_TYPE' => 'email',
  'NAME' => 'Заявка на обратной звонок',
  'DESCRIPTION' => '',
  'SORT' => '150',
));
        $helper->Event()->saveEventType('CALLBACK', array (
  'LID' => 'en',
  'EVENT_TYPE' => 'email',
  'NAME' => 'Call order',
  'DESCRIPTION' => '',
  'SORT' => '150',
));
        $helper->Event()->saveEventMessage('CALLBACK', array (
  'LID' => 
  array (
    0 => 's1',
  ),
  'ACTIVE' => 'Y',
  'EMAIL_FROM' => '#DEFAULT_EMAIL_FROM#',
  'EMAIL_TO' => '#DEFAULT_EMAIL_FROM#',
  'SUBJECT' => '#SITE_NAME#: Заявка на обратной звонок',
  'MESSAGE' => 'Информационное сообщение сайта #SITE_NAME#
------------------------------------------

Вам было отправлено сообщение через форму обратной связи

Автор: #AUTHOR#
Номер автора: #TEXT#

Сообщение сгенерировано автоматически.',
  'BODY_TYPE' => 'text',
  'BCC' => '',
  'REPLY_TO' => '',
  'CC' => '',
  'IN_REPLY_TO' => '',
  'PRIORITY' => '',
  'FIELD1_NAME' => NULL,
  'FIELD1_VALUE' => NULL,
  'FIELD2_NAME' => NULL,
  'FIELD2_VALUE' => NULL,
  'SITE_TEMPLATE_ID' => '',
  'ADDITIONAL_FIELD' => 
  array (
  ),
  'LANGUAGE_ID' => 'ru',
));
    }

    public function down()
    {
        //your code ...
    }
}
