# crud-php
Repositório para a criação de um CRUD em PHP OO

Considerações iniciais:  
**Versão do PHP**: 7.1.15  
**Endereço inicial**: crud-php/public  
**Necessário executar**: composer update  
**Arquivo com os dados do banco**: crud-php/config.php
**Script para criação do banco de dados**:  
  
    
```
CREATE TABLE `telefone` (  
  `idusuario` int(11) NOT NULL,  
  `telefone` varchar(11) NOT NULL,  
  PRIMARY KEY (`idusuario`,`telefone`)  
) ENGINE=InnoDB DEFAULT CHARSET=utf8;  
```  
```    
CREATE TABLE `usuario` (  
  `id` int(11) NOT NULL AUTO_INCREMENT,  
  `nome` varchar(60) DEFAULT NULL,  
  `cep` char(8) DEFAULT NULL,  
  `rua` varchar(45) DEFAULT NULL,  
  `numero` int(5) DEFAULT NULL,  
  `complemento` varchar(150) DEFAULT NULL,  
  `bairro` varchar(45) DEFAULT NULL,  
  `cidade` varchar(45) DEFAULT NULL,  
  `uf` char(2) DEFAULT NULL,  
  PRIMARY KEY (`id`)  
) ENGINE=InnoDB DEFAULT CHARSET=utf8;  
```

**Obs.:** No momento está faltando ainda salvar na tabela de telefones, deixei esta questão por último mas ainda não fiz. O restante acredito que está OK.
