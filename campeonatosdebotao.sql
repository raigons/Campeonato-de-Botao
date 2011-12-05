-- phpMyAdmin SQL Dump
-- version 3.1.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Dez 30, 2009 as 05:35 PM
-- Versão do Servidor: 5.1.30
-- Versão do PHP: 5.2.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `campeonatosdebotao`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `campeonato`
--

CREATE TABLE IF NOT EXISTS `campeonato` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `edicao` varchar(200) NOT NULL,
  `andamento` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `campeonato`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `classificacao`
--

CREATE TABLE IF NOT EXISTS `classificacao` (
  `idGrupo` int(3) NOT NULL,
  `idTime` int(2) NOT NULL,
  `golsPro` int(3) NOT NULL DEFAULT '0',
  `golsContra` int(3) NOT NULL DEFAULT '0',
  `vitoria` int(1) NOT NULL DEFAULT '0',
  `empate` int(1) NOT NULL DEFAULT '0',
  `derrota` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `classificacao`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `fases`
--

CREATE TABLE IF NOT EXISTS `fases` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `fases`
--

INSERT INTO `fases` (`id`, `nome`) VALUES
(1, 'Quartas de Final'),
(2, 'Semi-Final'),
(3, 'Final');

-- --------------------------------------------------------

--
-- Estrutura da tabela `grupo`
--

CREATE TABLE IF NOT EXISTS `grupo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grupo` char(1) NOT NULL,
  `time1` int(2) NOT NULL,
  `time2` int(2) NOT NULL,
  `time3` int(2) NOT NULL,
  `time4` int(2) NOT NULL,
  `idCampeonato` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `grupo`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jogo`
--

CREATE TABLE IF NOT EXISTS `jogo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time1` int(2) NOT NULL,
  `time2` int(2) NOT NULL,
  `golTime1` int(2) DEFAULT NULL,
  `golTime2` int(2) DEFAULT NULL,
  `grupo` int(3) DEFAULT NULL,
  `fase` int(1) DEFAULT NULL,
  `idaVolta` int(1) DEFAULT NULL,
  `rodada` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `jogo`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jogo_matamata`
--

CREATE TABLE IF NOT EXISTS `jogo_matamata` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `time1` int(2) DEFAULT NULL,
  `time2` int(2) DEFAULT NULL,
  `golTime1` int(2) DEFAULT NULL,
  `golTime2` int(2) DEFAULT NULL,
  `grupoTime1` int(2) DEFAULT NULL,
  `grupoTime2` int(2) DEFAULT NULL,
  `fase` int(11) NOT NULL,
  `idaVolta` tinyint(1) DEFAULT NULL,
  `idCampeonato` int(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `jogo_matamata`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `time`
--

CREATE TABLE IF NOT EXISTS `time` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `nome` varchar(25) NOT NULL,
  `nomeCompleto` varchar(120) NOT NULL,
  `escudo` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Extraindo dados da tabela `time`
--

INSERT INTO `time` (`id`, `nome`, `nomeCompleto`, `escudo`) VALUES
(1, 'Atlético-MG', 'Clube Atlético Mineiro', 'img/escudo/atleticoMG.gif'),
(2, 'Atlético-PR', 'Clube Atlético Paranaense', 'img/escudo/atleticoPR.gif'),
(3, 'Botafogo', 'Botafogo de Futebol e Regatas', 'img/escudo/botafogo.gif'),
(4, 'Corinthians', 'Sport Club Corinthians Paulista', 'img/escudo/corinthians.gif'),
(5, 'Cruzeiro', 'Cruzeiro Esporte Clube', 'img/escudo/cruzeiro.gif'),
(6, 'Flamengo', 'Clube de Regatas do Flamengo', 'img/escudo/flamengo.gif'),
(7, 'Fluminense', 'Fuminense Football Club', 'img/escudo/fluminense.gif'),
(8, 'Goiás', 'Goiás Esporte Clube', 'img/escudo/goias.gif'),
(9, 'Grêmio', 'Grêmio de FootBall Porto Alegrense', 'img/escudo/gremio.gif'),
(10, 'Internacional ', 'Sport Club Internacional', 'img/escudo/internacional.gif'),
(11, 'Palmeiras', 'Sociedade Esportiva Palmeiras', 'img/escudo/palmeiras.gif'),
(12, 'Ponte Preta', 'Associação Atlética Ponte Preta', 'img/escudo/pontePreta.gif'),
(13, 'Portuguesa', 'Associação Portuguesa de Desportos', 'img/escudo/portuguesa.gif'),
(14, 'Santos', 'Santos Futebol Clube', 'img/escudo/santos.gif'),
(15, 'São Paulo', 'São Paulo Futebol Clube', 'img/escudo/saopaulo.gif'),
(16, 'Vasco', 'Clube de Regatas Vasco Da Gama', 'img/escudo/vasco.gif');
