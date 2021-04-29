-- Exported from QuickDBD: https://www.quickdatabasediagrams.com/
-- Link to schema: https://app.quickdatabasediagrams.com/#/d/Pge4Ue
-- NOTE! If you have used non-SQL datatypes in your design, you will have to change these here.
-- To reset the sample schema, replace everything with
-- two dots ('..' - without quotes).

SET FOREIGN_KEY_CHECKS = 0;
DROP DATABASE IF EXISTS metiscooking;
CREATE DATABASE metiscooking;
USE metiscooking;
DROP TABLE IF EXISTS menus, role, cookers, allergene, users, dishes, ingredients, comments, commandorder, ingredients_dishes, allergene_dishes,users_dishes,newsletters, contact;
SET FOREIGN_KEY_CHECKS = 1;


-- Create Tables
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
    `email` VARCHAR(255) ,
    `adress` VARCHAR(255) ,
    `postal_code` VARCHAR(10) ,
    `city` VARCHAR(255) ,
    `password` VARCHAR(255) ,
    `rib`  VARCHAR(255) ,
    `payment_method` VARCHAR(255) ,
    `role_id` int,
    FOREIGN KEY (role_id) REFERENCES role(id)
);

CREATE TABLE `ingredients` (
    `id` int  NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `name`  VARCHAR(255) ,
    `dishe_id` int
);
CREATE TABLE `dishes` (
    `id` int  NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `type` VARCHAR(255) ,
    `name` VARCHAR(255),
    `description` TEXT ,
    `image_link` VARCHAR(255) ,
    `cooking_time` DATETIME ,
    `allergene_id` int ,
    FOREIGN KEY (allergene_id) REFERENCES allergene(id) 
);

CREATE TABLE `cookers` (
    `id` int  NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `name`  VARCHAR(255)
);


CREATE TABLE `menus` (
    `id` int  NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(255),
    `country` VARCHAR(255),
    `price` int NOT NULL,
    `entree_id` int,
    `plat_id` int,
    `dessert_id` int,
    `cooker_id` int,
    FOREIGN KEY (entree_id) REFERENCES dishes(id),
    FOREIGN KEY (plat_id) REFERENCES dishes(id),
    FOREIGN KEY (dessert_id) REFERENCES dishes(id),
    FOREIGN KEY (cooker_id) REFERENCES cookers(id) 
);


CREATE TABLE `comments` (
    `id` int  NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `title` VARCHAR(255) ,
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
    `email` VARCHAR(255) 
);
CREATE TABLE `contact` (
    `id` int  NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`firstname` VARCHAR(255) ,
    `lastname` VARCHAR(255) ,
	`email` VARCHAR(255) ,
	`comment` TEXT 
);

-- Insert Data in Tables (jeu de données)
INSERT INTO `cookers` (`name`) VALUES ("Paul Bocuse"),
                                      ("Jean Dupont"),
                                      ("Mamadou Sackho"),
                                      ("Etienne Mbappé"),
                                      ("Charles Dibango"),
                                      ("Emmanuel LeNoir"),
                                      ("Gilbert LeBlanc"),
                                      ("Anta Coulibaly"),
                                      ("Fatoumata Cissé"),
                                      ("Said Marzougui");


-- [1-10] => plat
-- [11-20] => dessert
-- [21-30] => entree
INSERT INTO `dishes` (`type`,`name`,`image_link` ) VALUES           ("plat", "Cassoulet", "cassoulet"),
                                                                    ("plat","Poulet Tikka", "tikka"),
                                                                    ("plat","Poulet Curry", "curry"),
                                                                    ("plat","Mafé", "mafe"),
                                                                    ("plat","Yassa", "yassa"),
                                                                    ("plat","Bolognaise", "bolognaise"),
                                                                    ("plat","Couscous", "couscous"),
                                                                    ("plat","Attiéké", "attieke"),
                                                                    ("plat","Hamburger", "hamburger"),
                                                                    ("plat","Kebab Premium", "kebab"),
                                                                    ("dessert","Tiramisu","tiramisu"),
                                                                    ("dessert","Flambée banane","banane"),
                                                                    ("dessert","Tapioka coco","coco"),
                                                                    ("dessert","Glace aux choix", "glace"),
                                                                    ("dessert","Moelleux chocolat","moelleux"),
                                                                    ("dessert","Tarte tatin","tatin"),
                                                                    ("dessert","Yaourt nature", "yaourt"),
                                                                    ("dessert","Muffins", "muffins"),
                                                                    ("dessert","Salades de fruits", "fruits"),
                                                                    ("dessert","Baba au rhum", "rhum"),
                                                                    ("entree","Avocats thon", "avocats"),
                                                                    ("entree","Crevettes", "crevettes"),
                                                                    ("entree","Rouleau d'été", "rouleau"),
                                                                    ("entree","Accra de morue", "accra"),
                                                                    ("entree","Houmouss", "houmouss"),
                                                                    ("entree","Salades", "salades"),
                                                                    ("entree","soupe misso", "misso"),
                                                                    ("entree","Crevettes huile", "huile"),
                                                                    ("entree","Fataya", "fataya"),
                                                                    ("entree","Tartines chèvre", "chevre");

INSERT INTO `menus` (`name`,`country`,`price`,`entree_id`,`plat_id`,`dessert_id`,`cooker_id`) VALUES      ("Menu Yassa", "sn", "25","21","5","11","3"),
                                                                                                          ("Menu Mafé", "ml", "15","22","4","12","4"),
                                                                                                          ("Menu Couscous", "ma", "25","23","7","13","2"),
                                                                                                          ("Menu Attiéké", "ci", "20","24","8","14","5"),
                                                                                                          ("Menu Hamburger", "us", "12","25","9","15","1"),
                                                                                                          ("Menu Kebab", "tr", "9","26","10","16","5"),
                                                                                                          ("Menu Poulet Curry", "gh", "17","27","3","17","6"),
                                                                                                          ("Menu Cassoulet", "fr", "19","28","1","18","7"),
                                                                                                          ("Menu Bolognaise", "it", "15","29","6","19","8"),
                                                                                                          ("Menu Pasta", "it", "23","30","6","20","9");
                                                                                                          
INSERT INTO `contact` (`firstname`, `lastname`, `email`, `comment`) VALUES  ("Adam", "Brosse", "adam.brosse@carrie.com", "Bonjour, Jusqu'ou pouvez vous effectuer les livraisons? merci. Cordialement."),
																			("Thomas", "Pesquet", "thomas.pesquet@iss.com", "Bonjour, votre site est super, mais, livrez vous la stations spaciale, j'aurais fais partager à mes collegues la cuisine lyonnaise! bonne continuation."),
                                                                            ("Bill", "Boquet", "bill.boquet@joueur.com", "Bonjour, est il possible d'etre livreé la nuit, je travaille de nuit et aurais souhaite organiser un dinner apero a quatre heure pour notre dernier vendredi avant nos vacances. au plaisir de vous lire.");                                                                                                          



-- Show tables
SELECT * FROM `cookers`;
SELECT * FROM `menus`;
SELECT * FROM `dishes`;
SELECT * FROM `contact`;