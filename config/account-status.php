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
     *
     *
     * @var string
     */
    'view_name' => 'auth.account-status',

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
