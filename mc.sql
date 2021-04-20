-- Exported from QuickDBD: https://www.quickdatabasediagrams.com/
-- Link to schema: https://app.quickdatabasediagrams.com/#/d/Pge4Ue
-- NOTE! If you have used non-SQL datatypes in your design, you will have to change these here.
-- To reset the sample schema, replace everything with
-- two dots ('..' - without quotes).

SET FOREIGN_KEY_CHECKS = 0;
DROP DATABASE IF EXISTS metiscooking;
CREATE DATABASE metiscooking;
USE metiscooking;
DROP TABLE IF EXISTS categories, role, entrees,plats,desserts, allergene, users, dishes, ingredients, comments, commandorder, ingredients_dishes, allergene_dishes,users_dishes,newsletters;
SET FOREIGN_KEY_CHECKS = 1;


-- Create Tables
CREATE TABLE `categories` (
    `id` int  NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(255)
);

CREATE TABLE `entrees` (
    `id` int  NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(255),
    `category_id` int,
    FOREIGN KEY (category_id) REFERENCES categories(id)
);

CREATE TABLE `plats` (
    `id` int  NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(255),
    `category_id` int,
    FOREIGN KEY (category_id) REFERENCES categories(id)
);

CREATE TABLE `desserts` (
    `id` int  NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(255)
);


CREATE TABLE `role` (
    `id` int  NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(255) 
);

CREATE TABLE `allergene` (
    `id` int  NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(255)
);


CREATE TABLE `users` (
    `id` int  NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `firstname` VARCHAR(255) ,
    `lastname` VARCHAR(255) ,
    `phone` VARCHAR(10) ,
    `email` VARCHAR(100) ,
    `adress` VARCHAR(100) ,
    `postal_code` VARCHAR(10) ,
    `city` VARCHAR(255) ,
    `password` VARCHAR(255) ,
    `rib`  VARCHAR(100) ,
    `payment_method` VARCHAR(100) ,
    `role_id` int,
    FOREIGN KEY (role_id) REFERENCES role(id)
);

CREATE TABLE `ingredients` (
    `id` int  NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `name`  VARCHAR(100) ,
    `category_id` int,
    FOREIGN KEY (category_id) REFERENCES categories(id)
);


CREATE TABLE `dishes` (
    `id` int  NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(255) ,
    `price` int NOT NULL,
    `title` VARCHAR(100),
    `description` TEXT ,
    `image` VARCHAR(100) ,
    `cooking_time` DATETIME ,
    `ingredients_id` int ,
    `allergene_id` int ,
    FOREIGN KEY (ingredients_id) REFERENCES ingredients(id),
    FOREIGN KEY (allergene_id) REFERENCES allergene(id) 
);


CREATE TABLE `comments` (
    `id` int  NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `title` VARCHAR(100) ,
    `comment` TEXT,
    `publish_at` DATETIME ,
    `user_id` int ,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE `commandorder` (
    `id` int  NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `amount` int NOT NULL,
    `created_at` DATETIME ,
    `user_id` int,
    `dish_id` int,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (dish_id) REFERENCES dishes(id)
);

CREATE TABLE `ingredients_dishes` (
    `ingredient_id` int,
    `dish_id` int,
    FOREIGN KEY (ingredient_id) REFERENCES ingredients(id),
    FOREIGN KEY (dish_id) REFERENCES dishes(id)
);

CREATE TABLE `allergene_dishes` (
    `allergene_id` int,
    `dish_id` int,
    FOREIGN KEY (allergene_id) REFERENCES allergene(id),
    FOREIGN KEY (dish_id) REFERENCES dishes(id)
);

CREATE TABLE `users_dishes` (
    `user_id` int,
    `dish_id`   int,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (dish_id) REFERENCES dishes(id)
);

CREATE TABLE `newsletters` (
    `id` int  NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `email` VARCHAR(100) 
);

-- Insert Data in Tables (jeu de données)
INSERT INTO `categories` (`name`) VALUES ("entrees"),
                                          ("plats"),
                                          ("desserts");

INSERT INTO `entrees` (`name`) VALUES ("Avocats thon"),
                                      ("Crevettes"),
                                      ("Rouleau d'été"),
                                      ("Accra de morue"),
                                      ("Houmouss"),
                                      ("Salades"),
                                      ("soupe misso"),
                                      ("Crevettes"),
                                      ("Fataya"),
                                      ("Tartines chèvre");

INSERT INTO `plats` (`name`) VALUES   ("Cassoulet"),
                                      ("Poulet Tikka"),
                                      ("Poulet Curry"),
                                      ("Mafé"),
                                      ("Yassa"),
                                      ("Boudin entier"),
                                      ("Couscous"),
                                      ("Attiéké"),
                                      ("Rougaille Porc"),
                                      ("Tartiflette");

INSERT INTO `desserts` (`name`) VALUES   ("tiramisu"),
                                      ("Flambée banane"),
                                      ("Tapioka coco"),
                                      ("Glace aux choix"),
                                      ("Moelleux chocolat"),
                                      ("Tarte tatin"),
                                      ("Yaourt nature"),
                                      ("Muffins"),
                                      ("Salades de fruits"),
                                      ("Baba au rhum");

-- Show tables
SELECT * FROM `categories`;
SELECT * FROM `entrees`;
SELECT * FROM `plats`;
SELECT * FROM `desserts`;