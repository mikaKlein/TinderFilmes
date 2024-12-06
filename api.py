import requests
import json
import os
from dotenv import load_dotenv

load_dotenv(".env")

API_KEY = os.getenv("TMDB_API_KEY")
BASE_URL = os.getenv("TMDB_BASE_URL")

def getToken():
    url = f"{BASE_URL}/authentication/token/new"
    headers = {
        "Authorization": "Bearer " + API_KEY,
        "accept": "application/json"
    }
    return requests.get(url, headers=headers)

def getPopularMovies():
    url = f"{BASE_URL}/movie/popular"
    headers = {
        "Authorization": "Bearer " + API_KEY,
        "accept": "application/json"
    }
    return requests.get(url, headers=headers)

def getMovieDetails(movie_id):
    url = f"{BASE_URL}/movie/{movie_id}"
    headers = {
        "Authorization": "Bearer " + API_KEY,
        "accept": "application/json"
    }
    return requests.get(url, headers=headers)

def getMovieCredits(movie_id):
    url = f"{BASE_URL}/movie/{movie_id}/credits"
    headers = {
        "Authorization": "Bearer " + API_KEY,
        "accept": "application/json"
    }
    return requests.get(url, headers=headers)

def getMovieReviews(movie_id):
    url = f"{BASE_URL}/movie/{movie_id}/reviews"
    headers = {
        "Authorization": "Bearer " + API_KEY,
        "accept": "application/json"
    }
    return requests.get(url, headers=headers)

def getMovieByName(name):
    url = f"{BASE_URL}/search/movie"
    headers = {
        "Authorization": "Bearer " + API_KEY,
        "accept": "application/json"
    }
    params = {
        "query": name
    }
    return requests.get(url, headers=headers, params=params)




print(getToken().json())
print(getPopularMovies().json())
print(getMovieDetails(550).json())
print(getMovieCredits(550).json())
print(getMovieReviews(550).json())