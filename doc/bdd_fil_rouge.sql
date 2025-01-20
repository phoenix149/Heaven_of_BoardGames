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

CREATE TABLE Jeu(
   jeu_id INT auto_increment,
   jeu_nom VARCHAR(50)  NOT NULL,
   jeu_img VARCHAR(500)  NOT NULL,
   jeu_prix DECIMAL(19,4) NOT NULL,
   jeu_EAN VARCHAR(50)  NOT NULL,
   jeu_dte_creation DATE,
   jeu_temps VARCHAR(50)  NOT NULL,
   jeu_qte_stc INT NOT NULL,
   jeu_note DECIMAL(2,1)  ,
   pays_id INT NOT NULL,
   ctg_id INT NOT NULL,
   age_id INT NOT NULL,
   m_id INT NOT NULL,
   PRIMARY KEY(jeu_id),
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
   description VARCHAR(250)  NOT NULL,
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

insert into abonnement values 
(1, "2024-03-26", "Standard", 0, "2024-04-26", "Automatique"),
(2, "2024-05-26", "Standard", 0, "2024-06-26", "Automatique");

insert into type_utilisateur values
(1, "Admin"),
(2, "Utilisateurs"),
(3, "Non enregistré");

insert into utilisateurs values 
(1, "Phoenix", "phoenix@gmail.com", "pheonixmdp", 1),
(2, "Jordev", "jordev@gmail.com", "jordevmdp", 3),
(3, "Michel", "michel@gmail.com", "michelmdp", 2);

insert into theme_de_jeu values 
(1, "Jeu de cartes"),
(2, "Jeu de stratégie"),
(3, "Jeu de hasard"),
(4, "Jeu coopératif"),
(5, "Jeu d'ambiance");

insert into auteurs values 
(1, "Antoine Bauza"),
(2, "Bruno Faidutti"),
(3, "Ludovic Maublanc"),
(4, "Reiner Knizia");

insert into age values 
(1, "A partir de 5 ans"),
(2, "A partir de 8 ans"),
(3, "A partir de 10 ans"),
(4, "A partir de 13 ans");


