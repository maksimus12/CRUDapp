CREATE
DATABASE if not exists myNewApp;

use
myNewApp;

CREATE TABLE `users`
(
    `id`       int NOT NULL AUTO_INCREMENT,
    `email`    varchar(255) DEFAULT NULL,
    `password` varchar(255) DEFAULT NULL,
    `role`     int          DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE if not exists `students`
(
    `id`
    int
    NOT
    NULL
    AUTO_INCREMENT,
    `fname`
    varchar
(
    255
) DEFAULT NULL,
    PRIMARY KEY
(
    `id`
)
    ) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE =utf8mb4_general_ci;

CREATE TABLE `meetings`
(
    `id`               int NOT NULL AUTO_INCREMENT,
    `student_id`       int          DEFAULT NULL,
    `topic`            varchar(255) DEFAULT NULL,
    `body`             text,
    `user_id`          int          DEFAULT NULL,
    `created_at`       datetime     DEFAULT CURRENT_TIMESTAMP,
    `updated_at`       datetime     DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    `meeting_datetime` datetime     DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY                `user_id` (`user_id`),
    KEY                `student_id` (`student_id`),
    CONSTRAINT `meetings_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
    CONSTRAINT `meetings_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;