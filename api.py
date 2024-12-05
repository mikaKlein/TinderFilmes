import requests

# Substitua pela sua chave de API da TMDb
TMDB_API_KEY = "eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIwNzU2ZmZkZjJiNGYwMDBlYzI0OTBlOTFmZThkYTE2NyIsIm5iZiI6MTczMzQyMzQxMi44MzcsInN1YiI6IjY3NTFmMTM0ODRjYTkyOGQwMGM5ZWQ0MiIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.CxjgTlLToeGXuL4fNf0A9QJohqlGL084U6kgk38dbQ0"
TMDB_BASE_URL = "https://api.themoviedb.org/3"

def getToken():
    url = f"{TMDB_BASE_URL}/authentication/token/new"
    headers = {
        "Authorization": "Bearer " + TMDB_API_KEY,
        "accept": "application/json"
    }
    print(headers)
    print(url)
    return requests.get(url, headers=headers, verify=False)

def search_movie(query):
    """
    Busca filmes com base em um termo.
    :param query: Nome do filme ou termo de pesquisa.
    :return: JSON com os resultados da pesquisa.
    """
    url = f"{TMDB_BASE_URL}/search/movie"
    params = {
        "api_key": TMDB_API_KEY,
        "query": query,
        "language": "pt-BR"  # Retorna os dados em português
    }
    response = requests.get(url, params=params)
    return response.json()

def get_movie_details(movie_id):
    """
    Obtém os detalhes de um filme pelo ID.
    :param movie_id: ID do filme.
    :return: JSON com os detalhes do filme.
    """
    url = f"{TMDB_BASE_URL}/movie/{movie_id}"
    params = {
        "api_key": TMDB_API_KEY,
        "language": "pt-BR"  # Retorna os dados em português
    }
    response = requests.get(url, params=params)
    return response.json()

def get_popular_movies():
    """
    Obtém uma lista dos filmes mais populares.
    :return: JSON com os filmes populares.
    """
    url = f"{TMDB_BASE_URL}/movie/popular"
    params = {
        "api_key": TMDB_API_KEY,
        "language": "pt-BR"  # Retorna os dados em português
    }
    response = requests.get(url, params=params)
    return response.json()


print(getToken())