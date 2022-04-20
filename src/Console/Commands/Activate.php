<?php

namespace TwentySixB\LaravelAccountStatus\Console\Commands;

use Illuminate\Console\Command;
use TwentySixB\LaravelAccountStatus\AccountStatus;
use TwentySixB\LaravelAccountStatus\Events\StatusUpdated;

/**
 * Activates a given amount of users.
 */
class Activate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'account-status:activate {amount}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mass activation of queued accounts.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $model  = config('account-status.user_model');
        $column = config('account-status.model_column');

        $query = $model::select('id', $column)
            ->where($column, '<>', AccountStatus::ACTIVE)
            ->orWhereNull($column)
            ->limit($this->argument('amount'));

        $this->withProgressBar(
            $query->get(),
            function ($row) use ($column) {
                $previous_state = $row->getAttribute($column);
                $row->setAttribute(
                    $column,
                    AccountStatus::ACTIVE
                );
                $row->save();
                StatusUpdated::dispatch($row, $previous_state);
            }
        );
    }
}
