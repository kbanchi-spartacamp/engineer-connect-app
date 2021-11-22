<?php

namespace App\Consts;

class MailConst
{
    const TEST = 'TEST';
    const RESERVATION = 'RESERVATION';
    const MAIL_TEMPLATE_LIST = [
        'テスト' => self::TEST,
        '予約完了' => self::RESERVATION,
    ];
}
