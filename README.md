# GET-test-api
Mini API REST en PHP no framework

Resources :

 2 types d'objets:
    User (id, name, email)
    Task (id, user_id, title, description, creation_date, status)
    
Endpoints :
 
 Schema d'url générique: http://api-host/version/resource/id
 
 Exp : http://api-host = http://localhost:8888/GET-test-api
 
 GET :
   
   http://api-host/1/users
   
   http://api-host/1/users/2
   
   http://api-host/1/tasks
   
   http://api-host/1/tasks/1
   
   http://api-host/1/tasksByUser/2

 
 POST :
 
   http://api-host/1/users?name=worker-6&email=worker6@yopmail.com
 
   http://api-host/1/tasks?user_id=2&title=task-4&description=description-of-task-4&status=0
 
   http://api-host/1/tasksByUser/2?title=task-6&description=description-of-task-6&status=1
   
 DELETE :
 
   http://api-host/1/users/8
   
   http://api-host/1/tasks/4
   
   http://api-host/1/tasksByUser/1  

Rappelle CDC de test :


1/ Développer en PHP une mini API REST avec output en json

Cette api doit:

Gérer 2 types d'objets: User (id, name, email) Task (id, user_id, title, description, creation_date, status)

Mettre à disposition des endpoints permettant de récupérer les données d'un user et d'une task. (ex: /user/$id)

L'api doit être capable de manipuler la liste des taches associées à un utilisateur en offrant la possibilité de: Récupérer cette liste de taches Créer et ajouter une nouvelle tache Supprimer une tache

En développant cette API, vous devez garder en tête qu'elle est susceptible d'évoluer (nouveaux retours, nouveaux attributs dans les objets)
 