create database fil_rouge;

use fil_rouge;

CREATE TABLE Type_Payement(
   p_id INT auto_increment,
   p_type VARCHAR(50)  NOT NULL,
   PRIMARY KEY(p_id)
);

CREATE TABLE Livraison(
   lvrs_id INT auto_increment,
   lvrs_type VARCHAR(50)  NOT NULL,
   PRIMARY KEY(lvrs_id)
);

CREATE TABLE Abonnement(
   abn_id INT auto_increment,
   abn_date DATE NOT NULL,
   abn_type VARCHAR(50)  NOT NULL,
   abn_status BOOLEAN NOT NULL,
   abn_dte_expiration DATETIME NOT NULL,
   abn_type_renouvellement VARCHAR(50)  NOT NULL,
   PRIMARY KEY(abn_id)
);

CREATE TABLE Type_Utilisateur(
   tu_id INT auto_increment,
   tu_libelle VARCHAR(50)  NOT NULL,
   PRIMARY KEY(tu_id)
);

CREATE TABLE utilisateurs(
   u_id INT auto_increment,
   u_pseudo VARCHAR(50)  NOT NULL,
   u_email VARCHAR(50)  NOT NULL,
   u_mdp VARCHAR(50)  NOT NULL,
   tu_id INT NOT NULL,
   PRIMARY KEY(u_id),
   FOREIGN KEY(tu_id) REFERENCES Type_Utilisateur(tu_id)
);

CREATE TABLE Theme_de_jeu(
   tdj_id INT auto_increment,
   tdj_nom VARCHAR(50)  NOT NULL,
   PRIMARY KEY(tdj_id)
);

CREATE TABLE Auteurs(
   a_id INT auto_increment,
   a_nom VARCHAR(50)  NOT NULL,
   PRIMARY KEY(a_id)
);

CREATE TABLE Age(
   age_id INT auto_increment,
   age_nom VARCHAR(50)  NOT NULL,
   PRIMARY KEY(age_id)
);

CREATE TABLE Categories(
   ctg_id INT auto_increment,
   ctg_nom VARCHAR(50)  NOT NULL,
   PRIMARY KEY(ctg_id)
);

CREATE TABLE Langues(
   l_id INT auto_increment,
   l_nom VARCHAR(50)  NOT NULL,
   PRIMARY KEY(l_id)
);

CREATE TABLE Mecanisme(
   m_id INT auto_increment,
   m_nom VARCHAR(50)  NOT NULL,
   PRIMARY KEY(m_id)
);

CREATE TABLE Pays(
   pays_id INT auto_increment,
   pays_nom VARCHAR(50)  NOT NULL,
   PRIMARY KEY(pays_id)
);

CREATE TABLE Editeur(
   edit_id INT auto_increment,
   edit_nom VARCHAR(50)  NOT NULL,
   PRIMARY KEY(edit_id)
);

CREATE TABLE Jeu(
   jeu_id INT auto_increment,
   jeu_nom VARCHAR(100)  NOT NULL,
   jeu_img VARCHAR(500)  NOT NULL,
   jeu_prix DECIMAL(15,2) NOT NULL,
   jeu_EAN VARCHAR(50)  NOT NULL,
   jeu_dte_creation DATE,
   jeu_nb_joueurs VARCHAR(50)  NOT NULL,
   jeu_description VARCHAR(2500)  NOT NULL,
   jeu_temps VARCHAR(50)  NOT NULL,
   jeu_qte_stc INT NOT NULL,
   jeu_note DECIMAL(2,1)  ,
   edit_id INT NOT NULL,
   pays_id INT NOT NULL,
   ctg_id INT NOT NULL,
   age_id INT NOT NULL,
   m_id INT NOT NULL,
   PRIMARY KEY(jeu_id),
   FOREIGN KEY(edit_id) REFERENCES Editeur(edit_id),
   FOREIGN KEY(pays_id) REFERENCES Pays(pays_id),
   FOREIGN KEY(ctg_id) REFERENCES Categories(ctg_id),
   FOREIGN KEY(age_id) REFERENCES Age(age_id),
   FOREIGN KEY(m_id) REFERENCES Mecanisme(m_id)
);

CREATE TABLE Client(
   clt_id INT auto_increment,
   clt_prenom VARCHAR(50)  NOT NULL,
   clt_nom VARCHAR(50)  NOT NULL,
   clt_adress VARCHAR(50)  NOT NULL,
   clt_cp VARCHAR(50)  NOT NULL,
   clt_ville VARCHAR(50)  NOT NULL,
   clt_numero_tel VARCHAR(15)  NOT NULL,
   u_id INT NOT NULL,
   abn_id INT,
   PRIMARY KEY(clt_id),
   UNIQUE(u_id),
   FOREIGN KEY(u_id) REFERENCES utilisateurs(u_id),
   FOREIGN KEY(abn_id) REFERENCES Abonnement(abn_id)
);

CREATE TABLE Commande(
   cmd_ref VARCHAR(20) ,
   cmd_date DATETIME NOT NULL,
   cmd_date_livraison_estime DATE NOT NULL,
   cmd_dte_livraison DATE,
   cmd_dte_expedition DATE,
   cmd_status VARCHAR(50)  NOT NULL,
   lvrs_id INT NOT NULL,
   p_id INT NOT NULL,
   clt_id INT NOT NULL,
   PRIMARY KEY(cmd_ref),
   FOREIGN KEY(lvrs_id) REFERENCES Livraison(lvrs_id),
   FOREIGN KEY(p_id) REFERENCES Type_Payement(p_id),
   FOREIGN KEY(clt_id) REFERENCES Client(clt_id)
);

CREATE TABLE jeu_commande(
   jeu_id INT,
   cmd_ref VARCHAR(20) ,
   PRIMARY KEY(jeu_id, cmd_ref),
   FOREIGN KEY(jeu_id) REFERENCES Jeu(jeu_id),
   FOREIGN KEY(cmd_ref) REFERENCES Commande(cmd_ref)
);

CREATE TABLE jeu_langues(
   jeu_id INT,
   l_id INT,
   PRIMARY KEY(jeu_id, l_id),
   FOREIGN KEY(jeu_id) REFERENCES Jeu(jeu_id),
   FOREIGN KEY(l_id) REFERENCES Langues(l_id)
);

CREATE TABLE jeu_theme(
   jeu_id INT,
   tdj_id INT,
   PRIMARY KEY(jeu_id, tdj_id),
   FOREIGN KEY(jeu_id) REFERENCES Jeu(jeu_id),
   FOREIGN KEY(tdj_id) REFERENCES Theme_de_jeu(tdj_id)
);

CREATE TABLE jeu_auteurs(
   jeu_id INT,
   a_id INT,
   PRIMARY KEY(jeu_id, a_id),
   FOREIGN KEY(jeu_id) REFERENCES Jeu(jeu_id),
   FOREIGN KEY(a_id) REFERENCES Auteurs(a_id)
);

insert into type_payement values
(1, "Carte Bancaire"),
(2, "Apple Pay"),
(3, "PayPal"),
(4, "Chèque");

insert into livraison values 
(1, "Chonopost"),
(2, "Colissimo"),
(3, "La Poste");

insert into type_utilisateur values
(1, "Admin"),
(2, "Utilisateurs"),
(3, "Non enregistré"),
(4, "Commercial");

insert into theme_de_jeu values 
(1, "Agents secrets"),
(2, "Antiquité"),
(3, "Aventure"),
(4, "Chiffres et Lettres"),
(5, "Connaissance"),
(6, "Enfants"),
(7, "Enquête"),
(8, "Fantastique"),
(9, "Histoire"),
(10, "Humour"),
(11, "Mathématiques"),
(12, "Mythologie"),
(13, "Sport"),
(14, "Survie"),
(15, "Vie Quotidienne");

insert into auteurs values 
(1, "Antoine Bauza"),
(2, "Bruno Faidutti"),
(3, "Ludovic Maublanc"),
(4, "Reiner Knizia"),
(5, "Adam Kwapiński"),
(6, "Christine Alcouffe"),
(7,"Alexis Allard"),
(8,"Benoit Turpin"),
(9,"Fabien Gridel"),
(10, "Jamey Stegmaier");

insert into age values 
(1, "A partir de 5 ans"),
(2, "A partir de 8 ans"),
(3, "A partir de 10 ans"),
(4, "A partir de 13 ans");

insert into categories values 
(1, "Jeu de plateau"),
(2, "Jeu de dés"),
(3, "Jeu de cartes"),
(4, "Jeu de coopération"),
(5, "Jeu de lettres"),
(6, "Jeu d'adresse"),
(7, "Jeu de connaissances"),
(8, "Jeu de logique"),
(9, "Jeu d'enquête");

insert into langues (l_nom) values 
("Français"),
("Anglais"),
("Allemand");

insert into mecanisme (m_nom) values 
("Cartes"),
("Coopératifs"),
("Plis"),
("Affrontement"),
("Majorité"),
("Placement");

insert into Pays (pays_nom) values 
("France"),
("Angleterre"),
("Allemagne");

insert into editeur (edit_nom) values 
("Gigamic"),
("USAopoly"),
("Mattel"),
("Goliath"),
("Bezier Games"),
("Matagot"),
("Lucky Duck Games");


insert into Jeu (jeu_nom, jeu_img, jeu_prix, jeu_EAN, jeu_dte_creation, jeu_nb_joueurs, jeu_description, jeu_temps, jeu_qte_stc, edit_id, pays_id, ctg_id, age_id, m_id) values
("La Guerre de l'Anneau : Le Jeu de Cartes", "https://les-meeples.fr/images/boardgames/main/la-guerre-de-lanneau-le-jeu-de-cartes-contre-lombre-extension_1719915103.jpg", "18.80", "2199000145717", "2004-01-01", "2 à 4 joueurs", "Deux à quatre joueurs s’affrontent en deux équipes, les Peuples Libres contre l’Ombre. Les Peuples Libres tentent désespérément de mener à bien la destruction de l’Anneau. L’Ombre doit frapper rapidement et de manière décisive avant que les porteurs de l’Anneau ne réussissent leur quête

Chaque joueur possède des cartes représentant les forces et les faiblesses des factions impliquées dans la guerre. Pour gagner, il va falloir se focaliser sur votre objectif mais aussi surveiller les actions de vos adversaires. Pendant une manche, vous jouez des cartes représentant des personnages, armées, objets et événements de la Guerre de l’Anneau. À la fin de chaque manche, les combats sont résolus. Vous gagnez des points de victoire en remportant des combats. Plusieurs scénarios possibles, (de la Comté à la Montagne du Destin, un autre basé sur le premier livre, ou encore le duel, pour deux joueurs).",  "1 à 2h", 12, 2, 2, 1, 2, 4),
("Les Loups-Garous de Thiercelieux", "https://m.media-amazon.com/images/I/81ok3GQCS4L.jpg", 9.95, "3558380086000", "1986-01-01", "8 à 24 joueurs", "De nouvelles options de jeu, plus de pouvoirs révélés pour les joueurs, une compatibilité parfaite avec l’extension Nouvelle Lune, plus de 120 combinaisons possibles entre personnages et métiers… on s’en lèche les babines !
Attribuez des logements et un métier aux Villageois, regardez-les se disputer ces fonctions et s’éliminer les uns les autres pour les obtenir… Une profondeur de jeu inégalée et des centaines d’heures de jeu en perspective !
Cette extension nécessite le jeu de base pour être jouée.", "30 minutes à 1h", 7, 7, 1, 3, 3, 2),
("Uno", "https://www.didacto.com/10860-large_default/uno.jpg", 13.95, "746775036744", "1971-01-10", "2 à 10 joueurs", "Uno est sans aucun doute le jeu de cartes le plus célèbre du monde. 

Créé aux États-Unis en 1971 mais édité seulement en 1985, ce jeu de société s'appuie sur les règles de base du 8 américains, agrémenté de quelques règles supplémentaires qui le rendent unique. Uno est un jeu de défausse et de réflexe qui repose sur la rapidité et la prise de décision. 

Avec des règles faciles à apprendre, vous serez rapidement gagné par la frénésie du jeu. Uno est un excellent jeu d'ambiance pour 2 à 10 joueurs.", "Moins de 30 minutes", 8, 4, 1, 3, 1, 1),
("Harry Potter - Hogwarts Battle", "https://m.media-amazon.com/images/I/91ImqKtxF3L._AC_UF1000,1000_QL80_.jpg", 63.50, "700304047700", "2016-10-20", "2 à 4 joueurs", "C'est à quatre élèves d'assurer la sécurité de l'école en vainquant les méchants et en consolidant leurs défenses. Dans le jeu, les joueurs jouent le rôle d'un étudiant de Poudlard : Harry, Ron, Hermione ou Neville, chacun avec son propre jeu de cartes qui est utilisé pour acquérir des ressources.

En gagnant de l'influence, les joueurs ajoutent plus de cartes à leur jeu sous la forme de personnages iconiques (Hagrid, Severus Rogue, Sirius Black, Dumbledore...), de sorts et d'objets magiques. D'autres cartes leur permettent de recouvrer leurs points de santé ou de lutter contre Voldemort et ses alliés (Bellatrix Strange, Dolores Ombrage, Draco Malefoy et bien d'autres encore), les empêchant ainsi de gagner du pouvoir. Les méchants contrecarrent les joueurs avec leurs attaques et l'art de la magie noire. Ce n'est qu'en travaillant ensemble que les joueurs pourront vaincre tous les méchants et protéger le château des forces du mal.", "30 minutes à 1h", 10, 2, 2, 1, 4, 4),
("Champ D'Honneur", "https://m.media-amazon.com/images/I/71Y3mSegReL.jpg", 45.00, "3421272118717", "1987-01-01", "2 à 4 joueurs", "Champ D'Honneur est un wargame avec une mécanique de bag-building. 
Au début du jeu, recrutez vos armées en sélectionnant par un système de draft les unités que vous utilisez ensuite pour capturer les points clés sur le plateau. Pour réussir dans Champ D'Honneur, vous devez gérer avec succès non seulement vos armées sur le champ de bataille, mais aussi celles qui attendent d'être déployées.
À chaque tour, vous tirez trois pièces de votre sac, puis vous les utilisez à tour de rôle pour effectuer des actions. Chaque pièce montre une unité militaire sur une face et peut être utilisée pour une ou plusieurs actions. ", "30 minutes à 1h", 2, 5, 3,7, 4, 5),
("Dice Throne - Adventures - Occasion", "https://www.okkazeo.com/images/jeux/38856.png", 67.43, "2199000145823", "2020-01-01", "1 à 4 joueurs", "De l’exploration, de l’or, des trésors, des améliorations, des sbires, des combats de boss, et même une marchande nommée Rosella !

Oeuvrez ensemble pendant quelques nuits pour voyager des Sables Pourpres jusqu’à la salle du trône du Roi Fou. Vos héros gagneront des améliorations de deck permanentes à chaque session, mais ne soyez pas trop confiant… Le Roi n’a pas perdu une seule bataille en mille ans et il est impatient de relever un vrai défi !", "1 à 2h", 16, 7, 1, 7, 4, 3),
("Roll Player Adventures", "https://m.media-amazon.com/images/I/71ZK0mtxc+L.jpg", 90.80, "2199000145984", "2023-01-01", "1 à 4 joueurs", "Les personnages du joueur font face à des défis, explorent de nouvelles terres, se font des amis et des ennemis, résolvent des énigmes, combattent des monstres et prennent des décisions importantes qui façonneront l'histoire au fur et à mesure qu'ils progressent dans 11 aventures principales et une quête secondaire jouable.
Choisissez l'un des nombreux personnages, ou importez un personnage favori de Roll Player et emmenez-le dans un voyage héroïque. Si vous importez un personnage que vous avez créé dans Roll Player, toutes les extensions et toutes les cartes promotionnelles utilisées peuvent continuer à être utilisées dans les aventures de Roll Player.", "1 à 2h", 5, 3, 3, 6, 4, 6),
("The Great Wall", "https://paradoxetemporel.fr/wp-content/uploads/2022/05/awrgw01fr_box3d_20220124.jpg", 63.92, "2199000145939", "2000-01-01", "1 à 4 joueurs", "La Grande Muraille se dressait déjà pendant la dynastie Zhou, bien des années avant les troubles actuels. À l’époque, il s’agissait d’une simple série de murs et de forts qui protégeait le pays contre les invasions de tribus nomades. La muraille a survécu à de nombreuses guerres et batailles et été agrandie, reconstruite et réparée à maintes reprises… Bien plus tard, durant les Xe et XIe siècles, pour se défendre des invasions Jurchen Jin, la dynastie des Song du Nord a construit les sections de la Grande Muraille, localisées dans ce qui constitue aujourd’hui les provinces de Shanxi et de Hebei. Malgré le travail des Song, le mur n’a pas tenu, les forçant à se retirer au sud. Les formidables fortifications appartenaient maintenant à leurs ennemis.
Cent ans plus tard. Se servant de la Grande Muraille érigée par ses prédécesseurs, la dynastie Jin a tenté de repousser l’invasion de Mongols venus du nord. Mais la dynastie Song, à présent nommée Song du Sud, conserve ses rancunes envers les Jin. Les Song se sont alliés avec les Mongols pour écraser leur ancien ennemi. Ils n’ont cependant pas prévu la soif insatiable de leurs « alliés », et doivent maintenant faire face à leur tour à la horde mongole. C’est ici que commence notre histoire…", "2 à 3 heures", 8, 5, 1, 9, 3, 4),
("Lewis & Clark", "https://cdn3.philibertnet.com/475376-thickbox_default/lewis-clark.jpg", 32.72, "2199000145885", "2013-10-01", "1 à 5 joueurs", "Dans Lewis & Clark, chaque joueur conduit son propre 'Corps of Discovery' à travers le continent. Son équipe sera complétée par les Indiens et les trappeurs rencontrés au long du voyage.Les joueurs conduisent une expédition à travers le continent Nord-Américain. Votre but ? Atteindre la côte Pacifique le premier en traversant les États-Unis. Lewis & Clark est donc un jeu de course. 

Chaque joueur conduit sa propre expédition à travers les États-Unis. Chaque joueur a en main des cartes Personnage qui forment son expédition. Ces personnages permettent d’effectuer des actions telles que récolter des ressources, avancer sur le parcours ou demander de l’aide aux Indiens. Pour être déclenchée, l’action correspondant à une carte doit être associée à une Force fournie soit par une autre carte soit par des Indiens. À chaque tour de jeu, un joueur doit réaliser une action. Il peut aussi recruter un nouveau Personnage et améliorer sa main de cartes. Enfin, régulièrement, les joueurs pourront établir leur Camp afin de reprendre en main les cartes déjà jouées. Mais le chargement de ressources et le nombre d’Indiens accueillis peuvent éventuellement faire perdre l’avance durement gagnée. La gestion des ressources et des Indiens est donc cruciale dans le jeu. La partie s’arrête immédiatement dès qu’un joueur a amené son Camp sur ou au delà de Fort Clatsop.

Seule la première place compte.", "1 à 2 heures", 11, 5, 3, 2, 4, 6),
("Dragomino", "https://cdn.cultura.com/cdn-cgi/image/width=830/media/pim/68_366284_1_10_FR.PNG", 13.97, "2199000145182", "2010-07-01", "2 à 4 joueurs", "Vous avez été nommé «dresseur de dragon» et vous avez la chance de partir à leur rencontre sur une île mystérieuse. Mais vous n’êtes pas le seul dresseur envoyé sur ces terres. Qui de vous découvrira le plus de bébés dragons ? 

Dragomino est une version enfant de Kingdomino à jouer à partir de 5 ans, dans laquelle vous retrouverez les bonnes sensations de Kingdomino!

Partez explorer l’île aux dragons et tentez de découvrir un maximum de bébés dragons dans les différents paysages que vous traversez !", "Moins de 30 minutes", 12, 6, 3, 2, 1, 3);


insert into jeu_langues values
(1, 1),
(2, 1),
(3, 3),
(4, 2),
(5, 2),
(6, 2),
(7, 3),
(8, 2),
(9, 1),
(10, 3);

insert into jeu_theme values
(1, 2),
(1, 12),
(2, 3),
(2, 7),
(3, 6),
(3, 10),
(4, 3),
(4, 8),
(4, 9),
(5, 5),
(5, 12),
(6, 3),
(6, 9),
(7, 3),
(7, 14),
(8, 2),
(8, 9),
(8, 12),
(9, 3),
(9, 7),
(9, 14),
(10, 6),
(10, 10),
(10, 15);

insert into jeu_auteurs values
(1, 2),
(2, 6),
(3, 1),
(4, 9),
(5, 10),
(6, 3),
(7, 4),
(8, 7),
(9, 5),
(10,8);
