1. S'authentifier et obtenir un jeton (Login)
Requête :

- URL : /auth/token

- Méthode HTTP : POST

- En-têtes HTTP : Authorization: Basic <credentials> (encodage base64 de username:password)

- Paramètres d'URL : Aucun

- Corps de message : Aucun (les informations sont dans l'en-tête)

Réponse :

- Cas "Succès" :

- Code de statut HTTP : 200 OK

- Corps de message (JSON) : {"token": "eyJhbGciOiJIUzI1NiIsIn..."} (Le jeton JWT généré)

- Cas "Identifiants incorrects" :

- Code de statut HTTP : 401 Unauthorized

- Corps de message (JSON) : {"error": "Identifiant ou mot de passe invalide"}



2. Contrôler la validité du JWT
Requête :

- URL : /auth/check

- Méthode HTTP : GET

- En-têtes HTTP : Authorization: Bearer <jwt>



- Paramètres d'URL : Aucun

- Corps de message : Aucun

Réponse :

- Cas "JWT valide" :

- Code de statut HTTP : 200 OK

- Corps de message (JSON) : {"user_id": 1, "username": "bean"} (Le payload du jeton)

- Cas "JWT expiré ou invalide" :

- Code de statut HTTP : 401 Unauthorized

- Corps de message (JSON) : {"error": "Jeton expiré ou invalide"}



3. Consulter le référentiel de la flotte
Requête :

- URL : /ships-reference



- Méthode HTTP : GET

- En-têtes HTTP : Aucun (pas d'authentification requise au début)

- Paramètres d'URL : Aucun

- Corps de message : Aucun

Réponse :

- Cas "Succès" :

- Code de statut HTTP : 200 OK

- Corps de message (JSON) : Un tableau contenant les 5 navires. Exemple : [{"id": 1, "name": "Porte-avion", "tech_name": "aircraft-carrier", "length": 5}, ...]



4. Créer une nouvelle partie
Requête :

- URL : /games

- Méthode HTTP : POST

- En-têtes HTTP : Authorization: Bearer <jwt>

- Paramètres d'URL : Aucun

- Corps de message (JSON) : Vide pour un matchmaking basique (la partie se crée entre les 2 joueurs de la BDD).

Réponse :

- Cas "Succès" :

- Code de statut HTTP : 201 Created

- Corps de message (JSON) : {"game_id": 42, "status": "setup"}



5. Placer ou déplacer un navire
Requête :

- URL : /games/{game_id}/ships



- Méthode HTTP : POST (ou PUT pour modifier)

- En-têtes HTTP : Authorization: Bearer <jwt>

- Paramètres d'URL : game_id (L'identifiant de la partie)

- Corps de message (JSON) : Contient les 3 infos requises : {"ship_id": 1, "x": "D", "y": 5, "orientation": "H"}



Réponse :

- Cas "Placement réussi" :

- Code de statut HTTP : 200 OK (ou 201 Created)

- Corps de message (JSON) : {"status": "placed", "ship_id": 1}

- Cas "Erreur de placement" (chevauchement, hors grille) :

- Code de statut HTTP : 400 Bad Request

- Corps de message (JSON) : {"error": "Les navires ne peuvent pas se chevaucher"}



6. Tirer une torpille
Requête :

- URL : /games/{game_id}/shots



- Méthode HTTP : POST

- En-têtes HTTP : Authorization: Bearer <jwt>

- Paramètres d'URL : game_id (L'identifiant de la partie)

- Corps de message (JSON) : La coordonnée ciblée : {"target_x": "B", "target_y": 6}



Réponse :

- Cas "Tir valide" :

- Code de statut HTTP : 201 Created

- Corps de message (JSON) : {"result": "touché"} (Valeurs possibles : "manqué", "touché", "touché-coulé")

- Cas "Ce n'est pas votre tour / Hors grille" :

- Code de statut HTTP : 400 Bad Request ou 403 Forbidden

- Corps de message (JSON) : {"error": "Attendez votre tour pour jouer"}
