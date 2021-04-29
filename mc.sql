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
INSERT INTO `dishes` (`type`,`name`,`image_link`, `description` ) VALUES            ("plat", "Cassoulet", "cassoulet", "Le cassoulet (de l'occitan cassolet, caçolet) est une spécialité régionale du Languedoc, à base de haricots secs, généralement blancs, et de viande"),
                                                                                    ("plat","Poulet Tikka", "tikka", "Le poulet tikka est un plat à base de poulet originaire d'Asie du Sud. Il est populaire en Inde et au Pakistan1. Il est traditionnellement composé de petits morceaux de poulet désossés cuits en brochettes dans un tandoor, un four d'argile, après avoir mariné dans un mélange d'épices et de yogurt. C'est pour ainsi dire une version sans os du poulet tandoori2. Le mot tikka signifie « morceaux » ou « bouts "),
                                                                                    ("plat","Poulet Curry", "curry", "Le poulet tikka masala (en hindi : चिकन टिक्का मसाला ; en anglais : chicken tikka masala) est un plat composé de morceaux de poulets cuits (poulet tikka) cuisinés dans une sauce de différentes épices (n'incluant pas le curry). C'est un plat populaire en Occident, où on considère généralement qu'il relève de la cuisine indienne. L'homme politique Robin Cook l'a une fois qualifié de « véritable plat national du Royaume-Uni1"),
                                                                                    ("plat","Mafé", "mafe", "Le mafé ou tiga dèguè na est une sauce à base de pâte d'arachide originaire du Mali notamment du peuple mandingue, consommée dans toute une partie de l'Afrique subsaharienne. Au Mali, « Tiga dèguè na » signifie « la sauce de pâte d'arachide ». Dans certains pays comme le Sénégal , la Mauritanie ou le Burkina Faso le mot désigne également le plat en lui-même1, un plat à base de viande ou de poisson cuit dans une sauce au beurre de cacahuète et servi avec du riz créole. Il est le plat national du Mali"),
                                                                                    ("plat","Yassa", "yassa", "Le yassa est un plat sénégalais à base d'oignons frits et de riz et qui peut être accompagné de viande marinée dans le citron puis frite ou braisée, de poulet ou de poisson. C'est un plat simple, rapide à faire et souvent apprécié de tous grâce à ses ingrédients de base simples et économiques"),
                                                                                    ("plat","Bolognaise", "bolognaise", "La sauce bolognaise (en italien ragù bolognese prononcé : [raˈɡu boloɲˈɲeːze] ou ragù alla bolognese) est une sauce de la région de Bologne. Elle se cuisine essentiellement à base de viande de bœuf, d'oignon, de céleri, de carottes et de coulis ou concentré de tomate. Elle est internationalement connue comme accompagnement des spaghettis, ce qui ne correspond cependant pas à la tradition de la région bolonaise, où elle est surtout utilisée pour garnir les tagliatelles, les lasagnes, ou encore la polenta"),
                                                                                    ("plat","Couscous", "couscous", "Le couscous (en berbère : ⵙⴽⵙⵓ seksu ou ⴽⵙⴽⵙⵓ keskesu1, en arabe maghrébin : الطعام، كسكسي، كسكس، سكسو, seksu, kuskus, kusksi, kesksu, t’am) est d'une part une semoule de blé dur préparée à l'huile d'olive (un des aliments de base traditionnel de la cuisine des pays du Maghreb) et d'autre part, une spécialité culinaire issue de la cuisine berbère, à base de couscous, de légumes, d'épices, d'huile d'olive et de viande (rouge ou de volaille) ou de poisson"),
                                                                                    ("plat","Attiéké", "attieke", "Le mot attiéké est une déformation du mot « adjèkè » de la langue ébrié parlée dans le sud de la Côte d'Ivoire. À l'origine (et parfois encore aujourd'hui), les femmes ébriées ne confectionnent pas de la même manière l'attiéké qu'elles vendent, et celui qui est consommé par leur propre ménage. Elles qualifiaient d'adjèkè le produit préparé pour le commerce et la vente, afin de marquer la différence avec le produit consommé à la maison (« Ahi »). Ce sont ensuite les transporteurs bambaras qui ont propagé ce mot le faisant passer à « atchèkè ». Les colons français (certainement pour motif d'esthétisme à l'écriture) écrivirent « attiéké » ; mais, dans la rue, on prononce souvent « tch(i)éké », avec amuïssement du a initial"),
                                                                                    ("plat","Hamburger", "hamburger", "Un hamburger (initialement hamburg-er, soit « galette de Hambourg » en allemand, et non pas « galette de jambon » en anglais) ou par aphérèse burger, est un sandwich d'origine allemande, composé de deux pains de forme ronde (bun) généralement garnis de steak haché (généralement du bœuf) et de crudités, salade, tomate, oignon, cornichon (pickles), et de sauce…). "),
                                                                                    ("plat","Kebab Premium", "kebab", "Le terme kebab ou kébab1, emprunté à l'arabe : کباب, kabāb2, signifie « grillade », « viande grillée » et désigne différents plats à base de viande grillée dans de nombreux pays ayant généralement fait partie des mondes ottoman et perse (dont l'Inde du Nord)"),
                                                                                    ("dessert","Tiramisu","tiramisu", "Le tiramisu (de l'italien « tiramisù » [ˌtiramiˈsu], du vénitien « tiramesù », littéralement « tire-moi vers le haut », « remonte-moi le moral », « redonne-moi des forces ») est une pâtisserie et un dessert traditionnel de la cuisine italienne"),
                                                                                    ("dessert","Flambée banane","banane", "La banane flambée est un dessert sucré à base de banane. "),
                                                                                    ("dessert","Tapioka coco","coco", "Le tapioca est une fécule, utilisée en cuisine, produite à partir des racines du manioc amer séchées puis traitées. Son goût est neutre. On l'utilise notamment comme épaississant pour les soupes et les desserts. Le tapioca ordinaire se présente sous forme de grains irréguliers d'environ 3 mm"),
                                                                                    ("dessert","Glace aux choix", "glace", "La crème glacée, aussi appelée glace, est un entremets congelé, voire surgelé, élaboré à partir de la crème, elle-même faite à partir de lait, de sucre, de fruits et d'arômes variés ; on y ajoute parfois des jaunes d'œufs"),
                                                                                    ("dessert","Moelleux chocolat","moelleux", "Le moelleux au chocolat est une recette particulière de gâteau au chocolat. Il ne doit pas être confondu avec le fondant au chocolat, qui contient plus d'œuf et moins de farine. Du fait de sa composition, un moelleux au chocolat est un peu sec s'il est trop cuit"),
                                                                                    ("dessert","Tarte tatin","tatin", "La tarte Tatin est une tarte aux pommes caramélisées au sucre et au beurre dont la pâte est disposée au-dessus de la garniture avant la cuisson au four. Elle est ensuite renversée sur un plat et servie tiède"),
                                                                                    ("dessert","Yaourt nature", "yaourt", "Le yaourt, yahourt, yogourt ou yoghourt, est un lait fermenté par le développement des seules bactéries lactiques thermophiles Lactobacillus delbrueckii subsp. bulgaricus et Streptococcus thermophilus qui doivent être ensemencées simultanément et se trouver vivantes dans le produit fini."),
                                                                                    ("dessert","Muffins", "muffins", "Les muffins sont de petits gâteaux individuels s'apparentant aux madeleines"),
                                                                                    ("dessert","Salades de fruits", "fruits", "La salade de fruits est un dessert composé d'un mélange de fruits. La salade de fruits peut se déguster en toutes saisons. Il en existe différentes recettes en fonction des saisons ou des pays. Dans certains pays, la salade de fruits est pimentée, comme le rujak de la cuisine indonésienne"),
                                                                                    ("dessert","Baba au rhum", "rhum", "Le baba au rhum est un savarin servi imbibé d'un sirop au rhum"),
                                                                                    ("entree","Avocats thon", "avocats", "L'avocat est le fruit de l'avocatier (Persea americana), un arbre de la famille des Lauraceae, originaire du Mexique. Il en existe trois grandes variétés. La variété la plus populaire est l'avocat Hass"),
                                                                                    ("entree","Crevettes", "crevettes", "La salade César (en anglais : Caesar salad ; en espagnol : ensalada César ; en italien : Caesar salad) est une recette de cuisine de salade composée de la cuisine américaine, traditionnellement préparée en salle à côté de la table, à base de laitue romaine, œuf dur, croûtons, parmesan et de « sauce César » à base de parmesan râpé, huile d'olive, pâte d'anchois, ail, vinaigre de vin, moutarde, jaune d'œuf et sauce Worcestershire"),
                                                                                    ("entree","Rouleau d'été", "rouleau","Le rouleau de printemps1, appelé gỏi cuốn, bo cuốn ou bi cuốn en vietnamien selon la farce, spring roll en anglais, est une spécialité culinaire du Vietnam. Le rouleau de printemps est également un plat chinois, nommé chūnjuǎn (春卷), très connu en Occident, mais on le trouve rarement en France"),
                                                                                    ("entree","Accra de morue", "accra", "Les acras de morue ou accras ou akras sont de petits beignets frits à la morue, aux herbes, aux épices, plus ou moins relevés au piment de Cayenne. Mise en bouche traditionnelle de la cuisine antillaise et la cuisine guyanaise, servis en apéritif, ou en entrée, des variantes peuvent être préparées avec d'autres poissons, crustacés, ou aux légumes"),
                                                                                    ("entree","Houmouss", "houmouss", "Le houmous ou hommos est une préparation culinaire du Proche-Orient, composée notamment de purée de pois chiches et de tahini. Il s'agit d'un plat typique de la cuisine arabe, juive, arménienne et levantine"),
                                                                                    ("entree","Salades", "salades", "De la salade, de la salade, rien que de la salade ! ..."),
                                                                                    ("entree","soupe misso", "misso", "Vous avez chaud, benh de la soupe misso rien que pour vous rechauffez le corps"),
                                                                                    ("entree","Crevettes huile", "huile", " Un mélange magnifique d'huile et de crevettes, que demande le peuple ?"),
                                                                                    ("entree","Fataya", "fataya", "Le samoussa est un beignet originaire d'Asie centrale et du Moyen Orient et devenu un mets populaire dans le sous-continent indien depuis qu'il y a été introduit au XIIIᵉ siècle ou au XIVᵉ siècle. Des sources le donnent aussi originaire d'Europe méridionale."),
                                                                                    ("entree","Tartines chèvre", "chevre", "Tartine de harcha aux figues séchées,crème de bûchette de chèvre & marmelade de tomates au thym");

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