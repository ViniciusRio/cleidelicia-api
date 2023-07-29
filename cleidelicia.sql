CREATE SCHEMA IF NOT EXISTS cleidelicia;

CREATE TABLE IF NOT EXISTS cleidelicia.Recipes
(
    id               serial UNIQUE PRIMARY KEY,
    title            varchar NOT NULL,
    description      varchar NOT NULL,
    method           varchar NOT NULL,
    ingredients      varchar NOT NULL,
    level            varchar NOT NULL,
    preparation_time integer NOT NULL,
    cooking_time     integer NOT NULL,
    servers          integer NOT NULL,
    image            varchar,
    created_at       timestamp DEFAULT (now()),
    updated_at       timestamp
);