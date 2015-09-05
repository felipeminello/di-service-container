-- --------------------------------------------------------
-- Servidor:                     192.168.1.4
-- Versão do servidor:           5.6.24-0ubuntu2 - (Ubuntu)
-- OS do Servidor:               debian-linux-gnu
-- HeidiSQL Versão:              9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Copiando estrutura para tabela di-service-container.fornecedores
CREATE TABLE IF NOT EXISTS `fornecedores` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Copiando dados para a tabela di-service-container.fornecedores: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `fornecedores` DISABLE KEYS */;
INSERT INTO `fornecedores` (`id`, `nome`, `email`) VALUES
	(1, 'Joao dos Santos 2', 'joao@santos.com.br'),
	(3, 'Jassinto Amaral de Souza', 'jassinto@amaral.com');
/*!40000 ALTER TABLE `fornecedores` ENABLE KEYS */;


-- Copiando estrutura para tabela di-service-container.produtos
CREATE TABLE IF NOT EXISTS `produtos` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `id_fornecedor` int(5) NOT NULL,
  `nome` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `unidade` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `produtos_fk1` (`id_fornecedor`),
  CONSTRAINT `produtos_fk1` FOREIGN KEY (`id_fornecedor`) REFERENCES `fornecedores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Copiando dados para a tabela di-service-container.produtos: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT INTO `produtos` (`id`, `id_fornecedor`, `nome`, `unidade`) VALUES
	(7, 1, 'Teste prod', 2),
	(8, 1, 'teste prod 2', 33);
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
