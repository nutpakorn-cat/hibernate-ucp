-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- โฮสต์: 127.0.0.1
-- เวลาในการสร้าง: 
-- เวอร์ชั่นของเซิร์ฟเวอร์: 5.5.32
-- รุ่นของ PHP: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- ฐานข้อมูล: `hbn-ucp`
--
CREATE DATABASE IF NOT EXISTS `hbn-ucp` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `hbn-ucp`;

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `authme`
--

CREATE TABLE IF NOT EXISTS `authme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `lastlogin` bigint(20) DEFAULT NULL,
  `x` smallint(6) DEFAULT '0',
  `y` smallint(6) DEFAULT '0',
  `z` smallint(6) DEFAULT '0',
  `world` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'world',
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'your@email.com',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `iconomy`
--

CREATE TABLE IF NOT EXISTS `iconomy` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `balance` double(64,2) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `tb_plugins`
--

CREATE TABLE IF NOT EXISTS `tb_plugins` (
  `plugins_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `plugins_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`plugins_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- dump ตาราง `tb_plugins`
--

INSERT INTO `tb_plugins` (`plugins_id`, `plugins_name`) VALUES
(13, 'status_server');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `tb_plugins_data`
--

CREATE TABLE IF NOT EXISTS `tb_plugins_data` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(10000) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=50 ;

--
-- dump ตาราง `tb_plugins_data`
--

INSERT INTO `tb_plugins_data` (`id`, `key`, `name`, `value`) VALUES
(43, 'panel_left', 'status_server', '$this->load->view(''status_server/status'');'),
(44, 'panel_right', 'status_server', ''),
(45, 'panel_left_admin', 'status_server', ''),
(46, 'panel_right_admin', 'status_server', ''),
(47, 'btn', 'status_server', ''),
(48, 'info', 'status_server', ''),
(49, 'info_admin', 'status_server', '');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `tb_setting`
--

CREATE TABLE IF NOT EXISTS `tb_setting` (
  `server_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `server_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `server_admin` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `server_pass` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `server_ip` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `server_port` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `server_rcon` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `server_rcon_port` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `game_world` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `start_money` double(64,2) NOT NULL,
  PRIMARY KEY (`server_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- dump ตาราง `tb_setting`
--

INSERT INTO `tb_setting` (`server_id`, `server_name`, `server_admin`, `server_pass`, `server_ip`, `server_port`, `server_rcon`, `server_rcon_port`, `game_world`, `start_money`) VALUES
(1, 'HibernateUCP', 'admin', '9f6992966d4c363eb52e0aff8fe1a6d3f09b0f6669473828', 'localhost', '25565', 'testpass', '65535', 'world', 1000);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
