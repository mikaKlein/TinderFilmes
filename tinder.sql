-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22/11/2024 às 12:59
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `tinder`
--

CREATE DATABASE IF NOT EXISTS `tinder` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `tinder`;
-- --------------------------------------------------------

--
-- Estrutura para tabela `filme`
--

CREATE TABLE `filme` (
  `nome` varchar(300) NOT NULL,
  `caminhoFoto` varchar(300) NOT NULL,
  `descricao` varchar(300) NOT NULL,
  `idFilme` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO filme (nome, caminhoFoto, descricao, idFilme)
VALUES
('Annabelle', 'uploads/annabelle.png', 'Um casal enfrenta forças sobrenaturais quando uma antiga boneca amaldiçoada chamada Annabelle invade suas vidas.', 1),
('Enrolados', 'uploads/enrolados.png', 'Rapunzel, uma princesa com cabelos mágicos, embarca em uma aventura emocionante ao lado do ladrão Flynn Rider.', 2),
('Freira', 'uploads/freira.png', 'Um padre e uma noviça investigam a morte misteriosa de uma freira, enfrentando uma força demoníaca aterrorizante.', 3),
('Harry Potter 1', 'uploads/harry_potter1.png', 'Harry descobre que é um bruxo e começa sua jornada em Hogwarts, enfrentando perigos e desvendando segredos.', 4),
('Harry Potter 2', 'uploads/harry_potter2.png', 'Harry retorna a Hogwarts e enfrenta o mistério da Câmara Secreta, onde perigos antigos ameaçam a escola.', 5),
('Harry Potter 3', 'uploads/harry_potter3.png', 'Harry descobre mais sobre o passado de seus pais enquanto lida com a ameaça de Sirius Black, um fugitivo de Azkaban.', 6),
('Harry Potter 4', 'uploads/harry_potter4.png', 'Harry participa do Torneio Tribruxo, enfrentando desafios mortais enquanto uma força sombria se aproxima.', 7),
('Harry Potter 5', 'uploads/harry_potter5.png', 'A Ordem da Fênix ressurge enquanto Harry lidera seus amigos contra Voldemort e a opressão do Ministério da Magia.', 8),
('Harry Potter 6', 'uploads/harry_potter6.png', 'Harry e Dumbledore investigam o passado de Voldemort, descobrindo os segredos dos Horcruxes.', 9),
('Harry Potter 7', 'uploads/harry_potter7.png', 'Harry, Ron e Hermione deixam Hogwarts para destruir os Horcruxes e derrotar Voldemort de uma vez por todas.', 10),
('Harry Potter 8', 'uploads/harry_potter8.png', 'A batalha final em Hogwarts decide o destino do mundo bruxo enquanto Harry enfrenta Voldemort.', 11),
('Invocação do Mal', 'uploads/invocação_do_mal.png', 'Ed e Lorraine Warren enfrentam uma das investigações mais aterrorizantes de suas carreiras, lutando contra forças demoníacas.', 12),
('Jogos Vorazes 1', 'uploads/jogos_vorazes1.png', 'Katniss Everdeen luta pela sobrevivência em uma arena mortal, desafiando o sistema opressor de Panem.', 13),
('Jogos Vorazes 2', 'uploads/jogos_vorazes2.png', 'Katniss retorna à arena em um torneio de campeões enquanto a rebelião contra o Capitol ganha força.', 14),
('Menino do Pijama Listrado', 'uploads/menino_pijama.png', 'Uma amizade improvável surge entre o filho de um comandante nazista e um menino judeu em um campo de concentração.', 15),
('Procurando Nemo', 'uploads/procurando_nemo.png', 'Um peixe-palhaço atravessa o oceano em busca de seu filho perdido, enfrentando desafios e fazendo amigos inesquecíveis.', 16),
('Toy Story', 'uploads/toy_story.png', 'Os brinquedos de Andy ganham vida e vivem aventuras incríveis enquanto enfrentam mudanças em suas vidas.', 17);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `idUser` int(11) NOT NULL,
  `emailInstitucional` varchar(300) NOT NULL,
  `nome` varchar(300) NOT NULL,
  `senha` varchar(300) NOT NULL,
  `isGerente` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`idUser`, `emailInstitucional`, `nome`, `senha`, `isGerente`) VALUES
(0, 'admin', 'admin', 'senha@123', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `voto`
--

CREATE TABLE `voto` (
  `idVoto` int(11) NOT NULL,
  `idFilme` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `numStars` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `filme`
--
ALTER TABLE `filme`
  ADD PRIMARY KEY (`idFilme`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUser`);

--
-- Índices de tabela `voto`
--
ALTER TABLE `voto`
  ADD PRIMARY KEY (`idVoto`),
  ADD KEY `idFilme` (`idFilme`),
  ADD KEY `idUser` (`idUser`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `filme`
--
ALTER TABLE `filme`
  MODIFY `idFilme` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `voto`
--
ALTER TABLE `voto`
  MODIFY `idVoto` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `voto`
--
ALTER TABLE `voto`
  ADD CONSTRAINT `voto_ibfk_1` FOREIGN KEY (`idFilme`) REFERENCES `filme` (`idFilme`),
  ADD CONSTRAINT `voto_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `usuario` (`idUser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;