# Laravue

![Deploy workflow badge](https://github.com/baddwin/laravue/actions/workflows/deploy.yml/badge.svg)

## About Laravue

Laravue is a web application built with latest Laravel framework to date (v8) with
Laravel Breeze package and Inertia JS, which powered by Vue JS 3 and Tailwind CSS.

For Sail users, the `docker-compose.yml` file has been customized
to be used with [Podman](https://podman.io) and [Podman Compose](https://github.com/containers/podman-compose).
Just `cd` to clone directory of this repo, then run command:

    podmain-compose up

The change is just in the `laravel.test` service section:

    volumes:
            - '.:/var/www/html:z'

The bound volume need to be aded `:z` in order that Podman has read-write acces to host filesystem.

To access shell inside Podman, run this command:

    podman exec -it laravue_laravel.test_1 /bin/bash

## REST API Documentation

### POST `{{laravel_host}}/api/token/create`

Querying for Sanctum API token for other endpoints authentication.

Request body sample (JSON):

```json
{
	"email": "user1@example.com",
	"password": "user123"
}
```

Response sample (success):

```json
{
  "token": "2|MNX1UJEqWKpbwmPpRiOFCamlgzIspfBwSTO7nXDC",
  "token_type": "Bearer"
}
```

### GET `{{laravel_host}}/api/rewards`

Show user points and available rewards to redeem,
as well as past redeemed rewards.

Needs token as Bearer auth value.

Response sample (success):

```json
{
  "points": 1,
  "rewards": [],
  "redeems": [
    {
      "id": 5,
      "name": "Hadiah Kelima"
    }
  ]
}
```

### POST `{{laravel_host}}/api/redeem/:reward_id`

Query redeem action to exchange points with available rewards.

Need token as Bearer auth value.

`:reward_id` *(mandatory)* is the ID of available reward to redeem.

Response sample (success):

```json
{
  "status": "success",
  "reward": {
    "name": "Hadiah Kelima",
    "id": 5
  },
  "points": 0
}
```

`"points"` is the remaining user point after redeem action.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
