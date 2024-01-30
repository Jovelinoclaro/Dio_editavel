
#### Projeto DIO ###

Projeto para cadastrar dados no Distribuidores Internos de Fibra Ópticos mias conlhecidos como DIO.

01) Para criar seu banco de dados manualmente ou com Python
Arquivo -> bancoDados.py
execulte para criar

-- Copiando estrutura para tabela nuclear.lab_01
CREATE TABLE IF NOT EXISTS `lab_01` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dio_fibra` int NOT NULL,
  `dio_a` varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `dio_b` varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `dio_c` varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

2) Ao clicar em editar vai esta editando e salvado no mesmo local
Continue ...

