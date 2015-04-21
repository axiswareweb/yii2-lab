<?php
// More details about translation: https://github.com/yiisoft/yii2/blob/master/docs/guide/tutorial-i18n.md
// More details about DbMessageSource: http://www.yiiframework.com/doc-2.0/yii-i18n-dbmessagesource.html

// In config:
//'components' => [
//    // ...
//    'i18n' => [
//        'translations' => [
//            '*' => [
//                'class' => 'yii\i18n\DbMessageSource',
//                'on missingTranslation' => ['app\components\TranslationEventHandler', 'handleMissingTranslation']
//            ],
//        ],
//    ],
//

namespace app\components;

use yii\i18n\MissingTranslationEvent;
use app\common\models\I18nSourceMessage;

class TranslationEventHandler
{
    public static function handleMissingTranslation(MissingTranslationEvent $event) {
        /*
         * I18nSourceMessage is model, what corresponds to `source_message` table
         * I18nSourceMessage::hasMessage is method what checks if record exists by `message` field in `source_message`
         */
        if (!I18nSourceMessage::hasMessage($event->message)) {
            $messageItem = new I18nSourceMessage();
            $messageItem->category = $event->category;
            $messageItem->message = $event->message;
            $messageItem->save();
        }
    }
}
