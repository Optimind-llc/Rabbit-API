<?php

return [

    /*
     * Table names
     */
    'users_table_name' => 'users',
    'admins_table_name' => 'admins',
    'owners_table_name' => 'owners',

    /*
     * Models
     */
    'users_model' => App\Models\Access\User\User::class,
    'admins_model' => App\Models\Access\Admin\Admin::class,
    'owners_model' => App\Models\Access\Owner\Owner::class,

    /*
     * Configurations for the user
     */
    'users' => [
        /*
         * Administration tables
         */
        'default_per_page' => 25,

        /*
         * Whether or not the user has to confirm their email when signing up
         */
        'confirm_email' => false,

        /*
         * Whether or not the users email can be changed on the edit profile screen
         */
        'change_email' => false,
    ],

    /*
     * Socialite session variable name
     * Contains the name of the currently logged in provider in the users session
     * Makes it so social logins can not change passwords, etc.
     */
    'socialite_session_name' => 'socialite_provider',
];