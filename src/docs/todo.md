
# Etapes

## Général

- 1 - Lire le cahier des charges
- 2 - Créer un nouveau projet API Platform
- 3 - Lister les entités à créer
- 4 - Pour chaque entité, lister les propriétés et leurs types

## Symfony

- 5 - Créer les entités avec le maker de Symfony (voir la doc Symfony)
- 6 - Relier les entités entre elles (creer des relations)
- 7 - Créer une migration (voir la doc Symfony)
- 8 - Jouer la migration
- 9 - Créer des fixtures (voir la doc Symfony ou HautelookAliceBundle)

## API Platform

- 10 - Déclarer les entités en tant que ressources 
- 11 - Désactiver les opérations inutiles
- 12 - Personnaliser les groupes de normalization et de denormalization
    - a) sans les relations
    - b) avec les relations

## API Platform (suite 1)

- 13 - Ajouter les contraintes de validation via les annotations
- 14 - Ajouter une contrainte de validation personnalisée (Ex. la recette doit avoir au moins 3 ingrédients. Ex2: le titre ou le contenu de la recette ne doit pas contenir de mots vulgaires.)
- 15 - Configurer les filtres de recherche via les annotations
- 16 - Configurer la pagination
    - je veux pouvoir récupérer ma liste des catégories sans pagination
    - je veux pouvoir récupérer ma liste des recettes avec une pagination de X éléments par page (configurable par le client)
- 17 - Configurer les sous-ressources
    - je veux pouvoir récupérer la liste des recettes d'une catégorie donnée
    - je veux pouvoir récupérer la liste des commentaires d'une recette donnée

## Symfony (suite 1)

- 18 - Ajouter JWT sur le projet
- 19 - Utiliser les voters sur les operations (voter de base avec le ROLE_ADMin & le ROLE_USER, les voters avec des expressions (voir doc Symfony))
- 20 - Créer un voter personnalisé (Ex. Sur l'opération de get simple d'une recette, si je suis admin et que la recette est privée, alors je peux la voir, sinon non)

## API Platform (suite 2)

- 21 - Créer un ContextBuilder (Ex. Si l'utilisateur est connecté, alors il peut voir les commentaires, sinon non.)
- 22 - Créer un normalizer (Ex. Si le nom de la recette contient "gratuit", alors on affiche les commentaires, sinon non)
- 23 - Créer un dénormalizer (Ex. ?)
- 24 - Créer des opérations personnalisées (Ex. je veux récupérer la liste de toutes les recettes (nom et lien, pour un selecteur par exemple) mais aussi la liste des recettes avec certaines informations supplémentaires (temps de préparation, difficulté, catégorie) pour un fils d'actualité)
- 25 - Exposer une donnée qui n'est pas une entité (Ex. les catégories ne sont plus des entités mais des données statiques contenus dans un fichier JSON)
    - a) Créer un state processor
    - b) Créer un state provider

## Symfony (suite 2)

- 26 - Ecouter un événement et ajouter une action (Ex. Quand un commentaire est ajouté, alors envoyer un mail à l'auteur de la recette)

## API Platform (suite 3)

- 27 - Personnaliser une requête de récupération de collection (Ex. je veux récupérer que les recettes que j'ai créé. Ex2. je veux récupérer que les recettes dont la note est supérieure à 3)
- 28 - Personnaliser une requête de récupération d'une ressource (Ex. si le recette est privée, alors je ne peux pas la récupérer)
- 29 - Personnaliser la documentation de l'API (Ex. je veux ajouter une description sur le champ "status" de la recette, par exemple en indiquant que je peux mettre "public" ou "private" dans la requête de POST)
