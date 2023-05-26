/* Database name */
CREATE DATABASE bmw_store_house;
USE bmw_store_house;

/* User's Info Table */
CREATE TABLE usersinfo (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL
);

/* Cars' Series Table */
CREATE TABLE `carseries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brand` varchar(255) NOT NULL,
  `series` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'available',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `carseries` (`brand`, `series`, `model`) VALUES
('BMW', '1 Series', '118i'),
('BMW', '1 Series', '120i'),
('BMW', '1 Series', 'M135i'),
('BMW', '2 Series', '218i'),
('BMW', '2 Series', '220i'),
('BMW', '2 Series', '230i'),
('BMW', '2 Series', 'M235i'),
('BMW', '2 Series', 'M2'),
('BMW', '3 Series', '318i'),
('BMW', '3 Series', '320i'),
('BMW', '3 Series', '330i'),
('BMW', '3 Series', '340i'),
('BMW', '3 Series', 'M3'),
('BMW', '4 Series', '420i'),
('BMW', '4 Series', '430i'),
('BMW', '4 Series', '440i'),
('BMW', '4 Series', 'M4'),
('BMW', '5 Series', '520i'),
('BMW', '5 Series', '530i'),
('BMW', '5 Series', '540i'),
('BMW', '5 Series', 'M5'),
('BMW', '6 Series', '630i'),
('BMW', '6 Series', '640i'),
('BMW', '6 Series', '650i'),
('BMW', '6 Series', 'M6'),
('BMW', '7 Series', '730i'),
('BMW', '7 Series', '740i'),
('BMW', '7 Series', '750i'),
('BMW', '7 Series', 'M760i'),
('BMW', '8 Series', '840i'),
('BMW', '8 Series', 'M850i'),
('BMW', '8 Series', 'M8'),
('BMW', 'M Series', 'M2'),
('BMW', 'M Series', 'M3'),
('BMW', 'M Series', 'M4'),
('BMW', 'M Series', 'M5'),
('BMW', 'M Series', 'M6'),
('BMW', 'X Series', 'X1'),
('BMW', 'X Series', 'X2'),
('BMW', 'X Series', 'X3'),
('BMW', 'X Series', 'X4'),
('BMW', 'X Series', 'X5'),
('BMW', 'X Series', 'X6'),
('BMW', 'X Series', 'X7'),
('BMW', 'Z Series', 'Z4'),
('BMW', 'i Series', 'i3'),
('BMW', 'i Series', 'i8'),
('BMW', 'i Series', 'iX3'),
('BMW', 'i Series', 'iX'),
('BMW', 'i Series', 'i4');

/* Car's Info Table */

CREATE TABLE `carsinfo` (
  `cars_id` int(11) AUTO_INCREMENT PRIMARY KEY,
  `email` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(255) NOT NULL,
  `address` VARCHAR(255) NOT NULL,
  `series` VARCHAR(50) NOT NULL,
  `model` VARCHAR(50) NOT NULL,
  `fuel_type` VARCHAR(20) NOT NULL,
  `transmission` VARCHAR(20) NOT NULL,
  `mileage` VARCHAR(20) NOT NULL,
  `km_mile` VARCHAR(10) NOT NULL,
  `price` VARCHAR(20) NOT NULL,
  `currency` VARCHAR(10) NOT NULL,
  `year` VARCHAR(10) NOT NULL,
  `description` VARCHAR(520) NOT NULL,
  `car_photo` VARCHAR(520) NOT NULL,
  `user_id` INT(11) NOT NULL
);

CREATE TABLE `adminlogin` (
  `admin_id` int(2) AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(20) NOT NULL,
  `password` VARCHAR(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `adminlogin` (`username`, `password`) VALUES
('admin','adminadmin') 
