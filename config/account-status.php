<?php

use TwentySixB\LaravelAccountStatus\AccountStatus;

return [

    /**
     * Default user model.
     *
     * @todo Check if there's a more automatic way.
     * @var string
     */
    'user_model' => \App\Models\User::class,

    /**
     * Column containing the user status.
     *
     * @var string
     */
    'model_column' => 'status',

    /**
     * Default status for a user.
     *
     * @var string
     */
    'default_status' => AccountStatus::ACTIVE,

    /**
     * Routes that the middleware should not block for non active users.
     *
     * @var array
     */
    'non_protected_routes' => [
        'logout',
    ],

    /**
     * List of valid status.
     *
     * @var array
     */
    'valid_statuses' => [
        AccountStatus::ACTIVE,
        AccountStatus::QUEUED,
        AccountStatus::SUSPENDED,
    ],
];
