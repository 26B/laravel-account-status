# Laravel Account Status

Configurable statuses for your user accounts.

- Handle access to application conditionally.
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

To protect your routes and redirect to the account status page you can add the builtin middleware to your kernel or individually to your routes.

```php
    \TwentySixB\LaravelAccountStatus\Http\Middleware\EnsureAccountActive::class,
```

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

### Factories

You can add some states to your factories to test your app.

```php
$user = User::factory()->queued()->make();
```

```php
use TwentySixB\LaravelAccountStatus\AccountStatus;

...

/**
 * Indicate that the model's is in a queued state.
 *
 * @return \Illuminate\Database\Eloquent\Factories\Factory
 */
public function queued()
{
    return $this->state(
        function (array $attributes) {
            return [
                'status' => AccountStatus::QUEUED,
            ];
        }
    );
}
```

## Customizing

Publish the configuration file should you need to customise it.

```
php artisan vendor:publish --tag=account-status-config
```

To customize the "account blocked template" you can publish the views and change them at your will.
```
php artisan vendor:publish --tag=account-status-views
```

## Roadmap

- Maybe provide a logout method on the builin view.
- Rule to use when login in.
