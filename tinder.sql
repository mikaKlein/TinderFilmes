-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09/12/2024 às 17:43
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

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
  `idFilme` int(11) NOT NULL,
  `anoLancamento` int(4) NOT NULL,
  `diretor` varchar(300) NOT NULL,
  `genero` varchar(100) NOT NULL,
  `duracao` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `filme`
--

INSERT INTO `filme` (`nome`, `caminhoFoto`, `descricao`, `idFilme`, `anoLancamento`, `diretor`, `genero`, `duracao`) VALUES
('Annabelle', 'uploads/annabelle.png', 'Uma boneca antiga chamada Annabelle traz terror para a vida de um jovem casal, sendo possuída por uma entidade maléfica.', 1, 2014, 'John R. Leonetti', 'Terror', 99),
('Enrolados', 'uploads/enrolados.png', 'Rapunzel, uma jovem princesa com cabelos mágicos, embarca em uma emocionante aventura ao escapar de sua torre.', 2, 2010, 'Nathan Greno, Byron Howard', 'Animação', 100),
('Freira', 'uploads/freira.png', 'Um padre e uma noviça enfrentam uma força demoníaca enquanto investigam a morte de uma freira em um convento na Romênia.', 3, 2018, 'Corin Hardy', 'Terror', 96),
('Harry Potter 1', 'uploads/harry_potter1.png', 'Harry Potter descobre que é um bruxo e começa sua jornada em Hogwarts, enfrentando o sombrio Lord Voldemort.', 4, 2001, 'Chris Columbus', 'Fantasia', 152),
('Harry Potter 3', 'uploads/harry_potter3.png', 'Harry lida com a fuga de Sirius Black, suposto assassino de seus pais, enquanto aprende sobre seu próprio passado.', 6, 2004, 'Alfonso Cuarón', 'Fantasia', 142),
('Harry Potter 4', 'uploads/harry_potter4.png', 'Harry participa do Torneio Tribruxo, enfrentando desafios perigosos e descobrindo a crescente ameaça de Voldemort.', 7, 2005, 'Mike Newell', 'Fantasia', 157),
('Harry Potter 5', 'uploads/harry_potter5.png', 'A Ordem da Fênix é reativada enquanto Harry treina seus amigos para combater a ascensão de Voldemort.', 8, 2007, 'David Yates', 'Fantasia', 138),
('Harry Potter 6', 'uploads/harry_potter6.png', 'Harry e Dumbledore exploram o passado de Voldemort e descobrem os segredos dos Horcruxes.', 9, 2009, 'David Yates', 'Fantasia', 153),
('Harry Potter 7', 'uploads/harry_potter7.png', 'Harry, Ron e Hermione deixam Hogwarts para destruir os Horcruxes e enfrentar Voldemort em uma batalha final.', 10, 2010, 'David Yates', 'Fantasia', 146),
('Harry Potter 8', 'uploads/harry_potter8.png', 'A batalha final em Hogwarts decide o destino do mundo bruxo, culminando no confronto definitivo entre Harry e Voldemort.', 11, 2011, 'David Yates', 'Fantasia', 130),
('Invocação do Mal', 'uploads/invocação_do_mal.png', 'Ed e Lorraine Warren enfrentam uma presença demoníaca em uma das investigações mais assustadoras de suas carreiras.', 12, 2013, 'James Wan', 'Terror', 112),
('Jogos Vorazes 1', 'uploads/jogos_vorazes1.png', 'Katniss Everdeen é forçada a participar dos Jogos Vorazes, um evento mortal transmitido para controlar o povo de Panem.', 13, 2012, 'Gary Ross', 'Ação/Aventura', 142),
('Jogos Vorazes 2', 'uploads/jogos_vorazes2.png', 'Katniss retorna à arena em uma edição especial dos Jogos Vorazes enquanto a rebelião contra o Capitol se intensifica.', 14, 2013, 'Francis Lawrence', 'Ação/Aventura', 146),
('Menino do Pijama Listrado', 'uploads/menino_pijama.png', 'A improvável amizade entre o filho de um comandante nazista e um menino judeu em um campo de concentração muda suas vidas.', 15, 2008, 'Mark Herman', 'Drama', 94),
('Procurando Nemo', 'uploads/procurando_nemo.png', 'Marlin, um peixe-palhaço, viaja pelo oceano com Dory para resgatar seu filho Nemo, que foi capturado por mergulhadores.', 16, 2003, 'Andrew Stanton', 'Animação', 100),
('Toy Story', 'uploads/toy_story.png', 'Os brinquedos de Andy, liderados por Woody e Buzz, enfrentam aventuras emocionantes enquanto exploram o mundo humano.', 17, 1995, 'John Lasseter', 'Animação', 81),
('O Senhor dos Anéis: A Sociedade do Anel', 'uploads/6751e4b3cc669.jpg', 'Um jovem hobbit, Frodo Bolseiro, embarca em uma perigosa jornada para destruir o Anel do Poder e salvar a Terra Média do mal iminente de Sauron.', 18, 2001, 'Peter Jackson', 'Fantasia, Aventura', 178);

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
(0, 'admin', 'admin', 'senha@123', 1),
(3, 'mikaeloklein@aluno.feliz.ifrs.edu.br', 'Mikael Odair Klein', '$2y$10$CY4SpYcmjDA4cLBku15RQef/ugdsA7LC8IC5sO7tY1B/r7flD0F9O', 0),
(4, 'r.michel@aluno.feliz.ifrs.edu.br', 'Renan Michel Hardt', '$2y$10$Y8qPVVKcEJildos7I3.HIuhKEUVp0N9Q.aN2FFlAVu6zWqROQnwUm', 0),
(5, 'renan@aluno.feliz.ifrs.edu.br', 'Renan Michel', '$2y$10$sOf1iiQ4hDJf9fJ4GX6rbOEEeOCe8wg92bmrEBD1shnlcf5SQTkKa', 0),
(6, 'ale@aluno.feliz.ifrs.edu.br', 'Ale', '$2y$10$DubtCKXS.RPJ6j4hOfad9euBw1O9RuFzHlBzitgLtbSSI.uD5fSMe', 0),
(7, 'amanda@aluno.feliz.ifrs.edu.br', 'Mikael Odair Klein', '$2y$10$Fijc9L.5iT0o3thcZ0lpx.19S0..yLgvwSOfz0BDYUdTNc1fvf6MK', 0),
(8, 'mikaelok@aluno.feliz.ifrs.edu.br', 'Renan Michel', '$2y$10$oGVdyueWdVv8zxeerdIssujtyeFPjBuUWSlDZJ5wP8bNMweh8EiTm', 0);

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
-- Despejando dados para a tabela `voto`
--

INSERT INTO `voto` (`idVoto`, `idFilme`, `idUser`, `numStars`) VALUES
(1, 1, 3, 3),
(2, 2, 3, 5),
(3, 3, 3, 3),
(4, 4, 3, 5),
(6, 6, 3, 1),
(7, 7, 3, 1),
(8, 8, 3, 1),
(9, 9, 3, 1),
(10, 10, 3, 1),
(11, 11, 3, 1),
(12, 12, 3, 1),
(13, 13, 3, 1),
(14, 14, 3, 1),
(15, 15, 3, 1),
(16, 16, 3, 1),
(17, 17, 3, 1),
(18, 1, 4, 5),
(19, 2, 4, 3),
(20, 3, 4, 1),
(21, 4, 4, 1),
(23, 6, 4, 1),
(24, 7, 4, 1),
(25, 8, 4, 1),
(26, 9, 4, 1),
(27, 10, 4, 1),
(28, 11, 4, 1),
(29, 12, 4, 1),
(30, 13, 4, 1),
(31, 14, 4, 1),
(32, 15, 4, 1),
(33, 16, 4, 1),
(34, 17, 4, 1),
(35, 1, 0, 1),
(36, 2, 0, 1),
(37, 3, 0, 1),
(38, 4, 0, 1),
(40, 6, 0, 1),
(41, 7, 0, 1),
(42, 8, 0, 1),
(43, 9, 0, 1),
(44, 10, 0, 1),
(45, 11, 0, 1),
(46, 12, 0, 1),
(47, 13, 0, 1),
(48, 14, 0, 1),
(49, 15, 0, 1),
(50, 16, 0, 1),
(51, 17, 0, 1),
(52, 18, 0, 1),
(53, 1, 5, 1),
(54, 2, 5, 1),
(55, 3, 5, 1),
(56, 4, 5, 1),
(57, 1, 6, 3),
(58, 1, 7, 3),
(59, 2, 7, 4),
(60, 3, 7, 5),
(61, 4, 7, 2),
(62, 6, 7, 5),
(63, 7, 7, 2),
(64, 8, 7, 4),
(65, 9, 7, 4),
(66, 10, 7, 5),
(67, 11, 7, 5),
(68, 12, 7, 5),
(69, 13, 7, 5),
(70, 14, 7, 5),
(71, 15, 7, 5),
(72, 16, 7, 5),
(73, 17, 7, 5),
(74, 18, 7, 5),
(75, 18, 3, 4);

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
  MODIFY `idFilme` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `voto`
--
ALTER TABLE `voto`
  MODIFY `idVoto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

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
