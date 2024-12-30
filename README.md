<img src="img/PET_SHOP.png" alt="Banner" width="800" height="300">

# TASK DESCRIPTION:

Create an animal adoption platform to connect users interested in adopting pets.

1. At first implement a database with 3 entities (tables) for users, pets and pets_adoption.

2. Display all animals on a single web page(home.php) with a nice GUI (user-friendly interface).

3. There should be a link on the navbar "Senior" that will display all senior animals (animals older than 8 years old).
   
4. Create a show more/show details button that will lead to a new page (details.php) with only the information from that specific record/animal.
   
5. Create a registration and login system for the users. The user should be able to see at least their email and picture when logged in.
Create separate sessions for normal users and administrators.
   

 # Users

6. They will be able only to read and access all data. No action buttons such as create, edit, delete should be available for the animals CRUD.
   
 # Admin  

7. Only the admin is able to create, update and delete data about animals (to perform all CRUD) within his panel, therefore the Dashboard should be created. Normal users must not access this page if they try.

# Pet Adoption

8. When creating the table pet_adoption, consider that should hold the user_id and the pet_id (as foreign keys).
   
9. Each pet card-info should have a button "Take me home" that when clicked, will "adopt" the pet. When it does, a new record should be created in the table pet_adoption.
    

   








