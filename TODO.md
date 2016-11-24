# Projet Twitter

## Fonctionnalités 

* X authentification / création de compte
* s'abonner aux autres utilisateurs
* X créer des messages 
    * ajouter des photos / vidéos
* X visualiser les messages 
* "j'aime", "retweet"
* créer des listes 

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
