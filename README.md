# Laravel Account Status

Configurable statuses for your user accounts.

- Handle access to application conditionally.
- Redirect to an account status view if not `ACTIVE`.
- Artisan command to toggle status for given user.
- Artisan command to activate X accounts.

## Getting started

Require the package

```
composer require 26b/laravel-account-status
```

To setup your database using the builtin migration.

```
php artisan vendor:publish --tag=account-status-migrations
php artisan migrate
```

Now that you have migrated, you might want to set your existing users to the `ACTIVE` state. You can do this X at a time.

```
php artisan account-status:activate 100
```

## Usage

### Commands

**Toggle**
You can change the status for a given user `ID` like this.

```
php artisan account-status:toggle ID SUSPENDED
```

**Activate**
When you have, for example, `QUEUED` users you can change their status to `ACTIVE` by running the command
```
php artisan account-status:activate 50
```

## Custom configuration

Publish the configuration file should you need to customise it.

```
php artisan vendor:publish --tag=account-status-config
```
