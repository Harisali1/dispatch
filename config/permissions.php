<?php


/**
 * Permissions config
 *
 * @author Muhammad Adnan <adnannadeem1994@gmail.com>
 * @date   23/10/2020
 */

return [
    'Roles'=>
        [
            'List' => 'role.index',
            'Create' => 'role.create|role.store',
            'Edit' => 'role.edit|role.update',
            'View' => 'role.show',
            'Set Permissions' => 'role.set-permissions|role.set-permissions.update',
        ],

    'Sub Admin'=>
        [
            'List' => 'sub-admin.index|sub-admin.data',
            'Create' => 'sub-admin.create|sub-admin.store',
            'Edit' => 'sub-admin.edit|sub-admin.update',
            'Status Change' => 'sub-admin.active|sub-admin.inactive',
            'Delete' => 'sub-admin.destroy',
        ],

    'Control'=>
        [
            'Delivery Type List' => 'delivery_type.index',
            'Delivery Type Create' => 'delivery_type.create|delivery_type.store',
            'Delivery Type Edit' => 'delivery_type.edit|delivery_type.update',
            'Delivery Type Delete' => 'delivery_type.destroy',
            'Delivery Preference List' => 'delivery_preference.index',
            'Delivery Preference Create' => 'delivery_preference.create|delivery_preference.store',
            'Delivery Preference Edit' => 'delivery_preference.edit|delivery_preference.update',
            'Delivery Preference Delete' => 'delivery_preference.destroy',
            'Order Category List' => 'order_category.index',
            'Order Category Create' => 'order_category.create|order_category.store',
            'Order Category Edit' => 'order_category.edit|order_category.update',
            'Order Category Delete' => 'order_category.destroy',
        ],

    'Routes'=>
        [
            'Joey Routes List' => 'joey.route.index',
            'Joey Route Map' => 'job.route',
            'Make Route' => 'job.routes'

        ],

    'Schedule' => [
        'Schedule List' => 'schedule.index',
        'Schedule Create' => 'schedule.create|schedule.store',
        'Schedule Edit' => 'schedule.edit|schedule.update',
        'Schedule Delete' => 'schedule.destroy',
        'Schedule Search' => 'schedule.search',
        'Shift Publisher List' => 'shift.publisher.index',
    ],

];
