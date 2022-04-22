USE gestorpedreira;

CREATE USER 'yii2app'@'localhost' IDENTIFIED BY 'CTeSP-DS-Grupo03';
GRANT ALL ON gestorpedreira.* TO 'yii2app'@'localhost';
FLUSH privileges;