## Overview
Movie Library is a web application that allows users to browse, filter, sort, and manage a collection of movies and rating this movie after doing sign up or log in.
The app includes features for pagination, filtering by genre or director, and sorting by release year. 
It also includes functionality for user authentication, rating movies, and managing movie data through an API

## Features
- Movie Browsing:Browse through a collection of movies with pagination support.
- Filtering: Filter movies by genre or director.
Sorting: Sort movies by release year in ascending or descending order.
- User Authentication:Register and login to manage your own movie ratings.
- Rating System:Users can rate movies, and only users who have rated a movie can update or delete their ratings.
- API Support: Access and manage movie data via a RESTful API.

**Installation**
- PHP 7.x or higher
- Composer
- Laravel 8.x or higher
- MySQL or any supported database
- Gitbash
  
**Steps:**
- Clone the repository:git clone https://github.com/FaezaAldarweesh/movie_library.git
- composer install
- cp .env.example .env
- php artisan key:generate
- php artisan migrate
- php artisan serve

## API Endpoint
**movie:**
- GET /api/movie: Get a list of movies (supports pagination, filtering, and sorting).
- POST /api/movie: Add a new movie.
- GET /api/movie/{id}: Get details of a specific movie.
- PUT /api/movie/{id}: Update movie details.
- DELETE /api/movie/{id}: Delete a movie.
  
Filtering Movies: Use genre and director query parameters to filter movies.
Sorting Movies: Use release_year and order query parameters to sort movies by release year.
Pagination: Use the per_page query parameter to control the number of movies displayed per page

Example API Request:GET /api/movie?per_page=5&genre=action&director=John+Doe&release_year=desc

**Ratings:**
- POST /api/rating: Add a rating to a movie (requires authentication).
- GET /api/rating/{rating}: Get details of a specific rating.
- PUT /api/rating/{rating}: Update movie details (only by the user who created it).
- DELETE /api/rating/{id_rating}: Delete a rating (only by the user who created it).

## Postman documentation link:
https://documenter.getpostman.com/view/34467473/2sAXjF9FSw

## Contact
For any inquiries or support, please reach out to Faeza Aldarweesh at faeza.aldarweesh@gmail.com

