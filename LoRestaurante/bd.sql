-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jun 05, 2018 at 05:10 PM
-- Server version: 5.6.35
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `lo_restaurante`
--
CREATE DATABASE IF NOT EXISTS `lo_restaurante` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `lo_restaurante`;

-- --------------------------------------------------------

--
-- Table structure for table `contato`
--

CREATE TABLE `contato` (
  `id_contato` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mensagem` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contato`
--
ALTER TABLE `contato`
  ADD PRIMARY KEY (`id_contato`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contato`
--
ALTER TABLE `contato`
  MODIFY `id_contato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;




CREATE TABLE `mesa` (
  `id_mesa` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `mesa`
  ADD PRIMARY KEY (`id_mesa`);

ALTER TABLE `mesa`
  MODIFY `id_mesa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

INSERT INTO mesa (id_mesa, nome) values (1, 'Mesa 1');
INSERT INTO mesa (id_mesa, nome) values (2, 'Mesa 2');
INSERT INTO mesa (id_mesa, nome) values (3, 'Mesa 3');
INSERT INTO mesa (id_mesa, nome) values (4, 'Mesa 4');
INSERT INTO mesa (id_mesa, nome) values (5, 'Mesa 5');
INSERT INTO mesa (id_mesa, nome) values (6, 'Mesa 6');
INSERT INTO mesa (id_mesa, nome) values (7, 'Mesa 7');
INSERT INTO mesa (id_mesa, nome) values (8, 'Mesa 8');
INSERT INTO mesa (id_mesa, nome) values (9, 'Mesa 9');
INSERT INTO mesa (id_mesa, nome) values (10, 'Mesa 10');
INSERT INTO mesa (id_mesa, nome) values (11, 'Mesa 11');
INSERT INTO mesa (id_mesa, nome) values (12, 'Mesa 12');
INSERT INTO mesa (id_mesa, nome) values (13, 'Mesa 13');
INSERT INTO mesa (id_mesa, nome) values (14, 'Mesa 14');



--
-- Table structure for table `reserva`
--

CREATE TABLE `reserva` (
  `id_reserva` int(11) NOT NULL,
  `id_mesa` int(11) NOT NULL,
  `data_reserva` date NOT NULL,
  `nome_reserva` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `cpf_reserva` varchar(20) NOT NULL,
  `codigo_reserva` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`id_reserva`),
  ADD KEY `id_mesa` (`id_mesa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reserva`
--
ALTER TABLE `reserva`
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT;