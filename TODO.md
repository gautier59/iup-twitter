# Projet Twitter

## Fonctionnalités

* X authentification / création de compte
* s'abonner aux autres utilisateurs
* X créer des messages
* X ajouter des photos / vidéos
* X visualiser les messages
* X j'aime"
* X "retweet"
* créer des listes
* X moteur de recherche
* X ajout d'images
* page profil
* DM

## Recherche

"test"
"test from:user" -> "test"
"test blabla from:user" -> "test blabla"
"test from:user blabla" -> "test blabla"
"from:user test blabla" -> "test blabla"

## Entités

* Utilisateur
    * id
    * pseudo
    * nom/prénom
    * email
    * mot de passe
    * photo de profil
    * date de création / update
    * statut (verrouillé)
* Message
    * id
    * user id
    * corps du message
    * date de création / update
* Statut de message
    * id
    * user id
    * message id
    * statut
    * date de création / update
* Liste
    * id
    * nom (exemple "liste php")
    * date de création / update
* Message privé ? (voir pour étendre Message)
