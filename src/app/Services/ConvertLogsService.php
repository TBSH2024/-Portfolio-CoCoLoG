<?php

namespace App\Services;

class ConvertLogsService
{
    protected static $moodMap = [
        1 => '非常に良い',
        2 => '良い',
        3 => '普通',
        4 => '悪い',
        5 => '非常に悪い',
    ];

    protected static $energyLevelMap = [
        0 => '元気',
        1 => '普通',
        2 => '疲れている',
    ];

    protected static $sleepMap = [
        0 => 'よく眠れた',
        1 => 'まぁまぁ',
        2 => '眠れなかった',
    ];

    public static function convertItem($item)
    {
        $item->convertedMood = self::$moodMap[$item->mood] ?? '不明';
        $item->convertedEnergy = self::$energyLevelMap[$item->energy_level] ?? '不明';
        $item->convertedSleep = self::$sleepMap[$item->sleep_quality] ?? '不明';

        return $item;
    }

    public static function convertItems($items)
    {
        return $items->map(function ($item) {
            return self::convertItem($item);
        });
    }
}
