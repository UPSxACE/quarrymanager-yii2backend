use gestorpedreira;

ALTER TABLE profile
ADD COLUMN dataNascimento date
AFTER full_name;

ALTER TABLE profile
ADD COLUMN genero tinyint
AFTER full_name; 