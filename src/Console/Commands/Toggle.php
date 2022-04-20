<?php

namespace TwentySixB\LaravelAccountStatus\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use TwentySixB\LaravelAccountStatus\Events\StatusUpdated;
use Illuminate\Database\Eloquent\Model;

/**
 * Performs a status change on a given user ID.
 */
class Toggle extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'account-status:toggle {user} {status}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the status for a given account.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {

            $row = $this->updateRow();

            $columns = [
                'id',
                'email',
                config('account-status.model_column')
            ];

            $this->table(
                $columns,
                [Arr::only($row->attributesToArray(), $columns)]
            );
            $this->info('User account updated');

        } catch (\Throwable $th) {

            $this->error($th->getMessage());
        }
    }

    /**
     * Updates the user record.
     *
     * @return Model
     */
    protected function updateRow() : Model
    {
        $model  = config('account-status.user_model');
        $column = config('account-status.model_column');
        $row    = $model::findOrFail($this->argument('user'));

        if (! in_array($this->argument('status'), config('account-status.valid_statuses'), true)) {
            // TODO: Add custom exception.
            throw new \Exception('Status not valid', 1);
        }

        // TODO: Check for existence of needed columns.
        // if (! in_array(config('account-status.model_column'), $row->attributes, true)) {
        //     throw new \Exception('Schema is not updated', 1);
        // }

        $previous_state = $row->getAttribute($column);

        // Should we do the update here or just trigger an event.
        $row->setAttribute($column, $this->argument('status'));
        $row->saveOrFail();

        StatusUpdated::dispatch($row, $previous_state);

        return $row;
    }
}
