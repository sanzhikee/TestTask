<?php
/**
 * Created by PhpStorm.
 * User: Sarsenbi.S
 * Date: 29.01.2018
 * Time: 14:41
 */

return array(
    'guest' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Guest',
        'bizRule' => null,
        'data' => null
    ),
    'admin' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Administrator',
        'children' => array(
            'guest'
        ),
        'bizRule' => null,
        'data' => null
    ),
);