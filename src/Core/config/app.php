<?php

return [
    "database" => [
        "hostname" => $_ENV["DB_HOSTNAME"],
        "address" => $_ENV["DB_ADDRESS"],
        "port" => $_ENV["DB_PORT"],
        "database" => $_ENV["DB_NAME"],
        "username" => $_ENV["DB_USERNAME"],
        "password" => $_ENV["DB_PASSWORD"],
    ],
    "log" => $_ENV["LOGGER_FILE"]
];