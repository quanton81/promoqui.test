CREATE TABLE IF NOT EXISTS `node_tree` (
  `idNode` int(11) NOT NULL auto_increment,
  `level` int(11) NOT NULL default 1,
  `iLeft` int(11) default NULL,
  `iRight` int(11) default NULL,
  PRIMARY KEY  (`idNode`),
  KEY `level` (`level`),
  KEY `iLeft` (`iLeft`),
  KEY `iRight` (`iRight`)
) ENGINE=INNODB DEFAULT CHARSET=utf8
;

INSERT INTO `node_tree` (`idNode`, `level`, `iLeft`, `iRight`) VALUES
(1, 2, 2, 3),
(2, 2, 4, 5),
(3, 2, 6, 7),
(4, 2, 8, 9),
(5, 1, 1, 24),
(6, 2, 10, 11),
(7, 2, 12, 19),
(8, 3, 15, 16),
(9, 3, 17, 18),
(10, 2, 20, 21),
(11, 3, 13, 14),
(12, 2, 22, 23)
;

CREATE TABLE `node_tree_names` (
    `idNode` int(11) NOT NULL auto_increment,
    `language` varchar(255) NOT NULL,
    `nodeName` varchar(255) NOT NULL,
    KEY `language` (`language`),
    KEY `nodeName` (`nodeName`),
    CONSTRAINT fk_idNode
    FOREIGN KEY (idNode)
    REFERENCES node_tree(idNode)
) ENGINE=INNODB DEFAULT CHARSET=utf8
;

INSERT INTO `node_tree_names` (`idNode`, `language`, `nodeName`) VALUES
(1, 'english', 'Marketing'),
(1, 'italian', 'Marketing'),
(2, 'english', 'Help Desk'),
(2, 'italian', 'Supporto tecnico'),
(3, 'english', 'Managers'),
(3, 'italian', 'Managers'),
(4, 'english', 'Costumer Account'),
(4, 'italian', 'Assistenza Cliente'),
(5, 'english', 'Docebo'),
(5, 'italian', 'Docebo'),
(6, 'english', 'Accounting'),
(6, 'italian', 'Amministrazione'),
(7, 'english', 'Sales'),
(7, 'italian', 'Supporto Vendite'),
(8, 'english', 'Italy'),
(8, 'italian', 'Italia'),
(9, 'english', 'Europe'),
(9, 'italian', 'Europa'),
(10, 'english', 'Developers'),
(10, 'italian', 'Sviluppatori'),
(11, 'english', 'North America'),
(11, 'italian', 'Nord America'),
(12, 'english', 'Quality Assurance'),
(12, 'italian', 'Controllo Qualità')
;
