## Project 4 - Doc finder

<p> This project is about developing a tool to help patients find doctors of a given specialty in their area. It aims to uses several features of the Laravel fraemwork as well as working with MySQL databases with mutliple tables. Front end techologies will be HTML/CSS/JavaScript</p>

<h1> Project Summary </h1>

<p> 
 Steps to explore the DocFinder app. 
 
 1. User is provided with a landing page which instructs her/him to sign up and log in if already signed up. 
 
 2. Upon logging in, user is presented with the search interface for searching physicians. There are 2 search options: <br>
 <br>
  a. Search by hospital or speciality name (text search).
  b. Dropdown to search by speciality.
 
 Currently, the database is pre-loaded with physicians that the user can search.
 <br>
 </p>
 
 <h1> Technical details</h1>
 <p> 
 The project uses the MVC features of the Laravel framework. Authentication is used so user has to be logged in before he can search. Authentication is checked via filters for each route and redirected to the login page if authentication fails.
 
 The database has 2 tables and one pivot table for many to many relationship. One is a table for physicians and their specialities. the other table is for hospitals. Pivot table stores which physicians are working for which hospitals. As in the real world, physicians often work for multiple hospitals. 
 The search query for hospitals uses eager loading for more efficient queries.
 
 Website is deployed on pagoda servers.
 </p>


