<?php

    require_once '../Database.php';

    $sql = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_HOST);

    $query = <<<_QRY

CREATE TABLE `admin` (
    `pwd_hash` text NOT NULL,
    `upload_dir` text NOT NULL,
    `edits` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `admin` (`pwd_hash`, `upload_dir`, `edits`) VALUES
('$2y$10$9kOSNNKcDj/wh4LcVZJwvun4ywsmlXnOf6SQcu0hAWTMLdCHkacfS', '../assets/images/blog/', 0);

CREATE TABLE `blog` (
    `ID` int(11) NOT NULL,
    `slug` text NOT NULL,
    `title` text NOT NULL,
    `subtitle` text NOT NULL,
    `content` text NOT NULL,
    `timestamp` bigint(20) NOT NULL,
    `photo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE `blog`
  ADD PRIMARY KEY (`ID`);
COMMIT;

_QRY;

    $sql->query($query);
    header("Location: ../cleanup.php");
?>