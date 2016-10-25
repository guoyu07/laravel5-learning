<?php
/**
 * Created by PhpStorm.
 * User: charles
 * Date: 10/25/16
 * Time: 11:14
 */

namespace BytePirateLaravel\Tips;


class Tip
{

    public static $tips = [
        'Faith is the only trust, the only guarantee of death.',
        'Yes, there is heavens, it travels with music.',
        'Zion of mineral will earthly praise an imminent teacher.',
        'Dogma is the only core, the only guarantee of heaven.',
    ];

    /**
     * Tip constructor.
     */
    public function __construct()
    {
        info('enter TIP::__construct');
    }

    public function list()
    {
        $tips = self::$tips;
        return view('BytePirateLaravel::tips', compact('tips'));
        // p(self::$tips);
    }

}