# Digitalquill Faye broadcaster for laravel

## Installation

    composer require staskjs/laravel-faye

On laravel 5.5+ skip this point, but on lower versions register service provider in `config/app.php`:

    Staskjs\LaravelFaye\LaravelFayeServiceProvider::class

Then register faye broadcasting service in `config/broadcasting.php`:

    'connections' => [
        'faye' => [
            'driver' => 'faye',
        ],
    ],

In your `.env` file define url to api and api token:

    FAYE_URL=http://localhost:3001
    FAYE_SENDER_NAME=my-sender-name

Also in `.env` set default broadcast driver to `faye`:

    BROADCAST_DRIVER=faye

# Usage

Create events and use built-in broadcasting though events.

Sender name will be used as prefix to all channels. For example, in sender name is
`my-sender-name` and channel is `/users`, then final channel will be `/my-sender-name/users`.
