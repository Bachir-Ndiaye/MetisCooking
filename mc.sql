-- Exported from QuickDBD: https://www.quickdatabasediagrams.com/
-- Link to schema: https://app.quickdatabasediagrams.com/#/d/Pge4Ue
-- NOTE! If you have used non-SQL datatypes in your design, you will have to change these here.

-- Modify this code to update the DB schema diagram.
-- To reset the sample schema, replace everything with
-- two dots ('..' - without quotes).

SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS Role, Categories, Allergene, Users, Dishes, Ingredients, Comments, CommandOrder, Ingredients_Dishes, Allergene_Dishes,Users_Dishes;
SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE `Role` (
    `id` int  NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(100) 
);

CREATE TABLE `Categories` (
    `id` int  NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(100)
);

CREATE TABLE `Allergene` (
    `id` int  NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(100)
);


CREATE TABLE `Users` (
    `id` int  NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `Name` VARCHAR(100) ,
    `Firstname` VARCHAR(100) ,
    `Lastname` VARCHAR(100) ,
    `Phone` VARCHAR(20) ,
    `Email` VARCHAR(100) ,
    `Adress` VARCHAR(100) ,
    `PostalCode` VARCHAR(10) ,
    `City` VARCHAR(100) ,
    `Password` VARCHAR(100) ,
    `RIB`  VARCHAR(100) ,
    `PaymentMethod` VARCHAR(100) ,
    `Role_id` int,
    FOREIGN KEY (Role_id) REFERENCES Role(id)
);

CREATE TABLE `Ingredients` (
    `id` int  NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `name`  VARCHAR(100) ,
    `Category_id` int,
    FOREIGN KEY (Category_id) REFERENCES Categories(id)
);


CREATE TABLE `Dishes` (
    `id` int  NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(100) ,
    `Price` int NOT NULL,
    `Title` VARCHAR(100),
    `Description` VARCHAR(200) ,
    `Image` VARCHAR(100) ,
    `CookingTime` DATE ,
    `Ingredients_id` int ,
    `Allergene_id` int ,
    FOREIGN KEY (Ingredients_id) REFERENCES Ingredients(id),
    FOREIGN KEY (Allergene_id) REFERENCES Allergene(id) 
);


CREATE TABLE `Comments` (
    `id` int  NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `Title` VARCHAR(100) ,
    `Message` VARCHAR(100),
    `PublishAt` DATE ,
    `User_id` int ,
    FOREIGN KEY (User_id) REFERENCES Users(id)
);

CREATE TABLE `CommandOrder` (
    `id` int  NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `Amount` int NOT NULL,
    `CreatedAt` DATE ,
    `User_id` int,
    `Dish_id` int,
    FOREIGN KEY (User_id) REFERENCES Users(id),
    FOREIGN KEY (Dish_id) REFERENCES Dishes(id)
);

CREATE TABLE `Ingredients_Dishes` (
    `Ingredient_id` int,
    `Dish_id` int,
    FOREIGN KEY (Ingredient_id) REFERENCES Ingredients(id),
    FOREIGN KEY (Dish_id) REFERENCES Dishes(id)
);

CREATE TABLE `Allergene_Dishes` (
    `Allergene_id` int,
    `Dish_id` int,
    FOREIGN KEY (Allergene_id) REFERENCES Allergene(id),
    FOREIGN KEY (Dish_id) REFERENCES Dishes(id)
);

CREATE TABLE `Users_Dishes` (
    `User_id` int,
    `Dish_id`   int,
    FOREIGN KEY (User_id) REFERENCES Users(id),
    FOREIGN KEY (Dish_id) REFERENCES Dishes(id)
);





