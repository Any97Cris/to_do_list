CREATE DATABASE IF NOT EXISTS todolist CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE todolist;

CREATE TABLE IF NOT EXISTS tasks (
    id           VARCHAR(32)  NOT NULL,
    title        VARCHAR(120) NOT NULL,
    description  VARCHAR(500) NOT NULL,
    status       VARCHAR(20)  NOT NULL DEFAULT 'pending',
    created_at   DATETIME     NOT NULL,
    completed_at DATETIME     NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
