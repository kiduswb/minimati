<?php

    require_once '../Database.php';
    session_start();

    if(isset($_SESSION['db_info'])) {
        $db_info = $_SESSION['db_info'];
        $sql = new mysqli($db_info['DB_HOST'], $db_info['DB_USER'],$db_info['DB_PASS'], $db_info['DB_NAME']);

        $query1 = <<<_QRY
CREATE TABLE `admin` (
    `pwd_hash` text NOT NULL,
    `upload_dir` text NOT NULL,
    `edits` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

_QRY;

        $query2 = <<<_QRY
INSERT INTO `admin` (`pwd_hash`, `upload_dir`, `edits`) VALUES
('$2y$10$9kOSNNKcDj/wh4LcVZJwvun4ywsmlXnOf6SQcu0hAWTMLdCHkacfS', '../assets/images/blog/', 0);
_QRY;

        $query3 = <<<_QRY
CREATE TABLE `blog` (
    `ID` int(11) NOT NULL,
    `slug` text NOT NULL,
    `title` text NOT NULL,
    `subtitle` text NOT NULL,
    `content` text NOT NULL,
    `timestamp` bigint(20) NOT NULL,
    `photo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
_QRY;

        $query4 = <<<_QRY
ALTER TABLE `blog`
  ADD PRIMARY KEY (`ID`);
_QRY;

        $sql->query($query1);
        $sql->query($query2);
        $sql->query($query3);
        $sql->query($query4);

        header("Location: ../cleanup.php");
    }
?>