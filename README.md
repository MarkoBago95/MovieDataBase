----Albatros---
First of all there is a video of how it works! : https://www.youtube.com/watch?v=McJnpXxeNeI
15.05.2020 
Marko Bago

Projekat iz predmeta Razvoj web aplikacija(MovieDatabase)

Fakultet za saobraćaj i komunikacije Sarajevo
Prof. dr. Damir Omerašević


Zahtjevi za testiranje alikacije

Instalirajte wamp ili xampp 

Da bi testirali moju alikaciju morate spremiti Albatros folder u www folder u wampu

Također morate napraviti mysql bazu podataka u phpmyAdmin 

Uključite wamp mysql i apache u odjeljku Services

U pregledniku tražite "localhost/Albatros/src/"

//kreiranje baze
-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 19, 2020 at 02:00 PM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `login`
--
CREATE DATABASE IF NOT EXISTS `login` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `login`;

-- --------------------------------------------------------

--
-- Table structure for table `list`
--

DROP TABLE IF EXISTS `list`;
CREATE TABLE IF NOT EXISTS `list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;



