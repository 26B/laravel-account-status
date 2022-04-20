<?php

namespace TwentySixB\LaravelAccountStatus;

use Spatie\LaravelPackageTools\PackageServiceProvider;
use Spatie\LaravelPackageTools\Package;
use TwentySixB\LaravelAccountStatus\Console\Commands\Activate;
use TwentySixB\LaravelAccountStatus\Console\Commands\Toggle;

class AccountStatusServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package) : void
    {
        $package->name('laravel-account-status')
            ->hasConfigFile()
            ->hasViews('account-status')
            ->hasRoute('web')
            ->hasMigration('update_users_table')
            ->hasCommands([
                Toggle::class,
                Activate::class,
            ]);
    }
}
