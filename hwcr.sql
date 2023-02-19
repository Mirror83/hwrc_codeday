CREATE DATABASE hwcr;

USE hwcr;
CREATE TABLE kws_officer(
	officer_number VARCHAR(10) NOT NULL,
    officer_first_name VARCHAR(255) NOT NULL,
    officer_second_name VARCHAR(255) NOT NULL,
    area_of_deployment TEXT NOT NULL,
    officer_rank TEXT NOT NULL,
    PRIMARY KEY (officer_number)
);

INSERT INTO kws_officer(officer_number, officer_first_name, officer_second_name, area_of_deployment, officer_rank)
VALUES("KWSKA003", "John", "Kamau", "Kajiado", "Field officer"), ("KWSKA104", "Abdi", "Shakar", "Voi", "Field officer")

