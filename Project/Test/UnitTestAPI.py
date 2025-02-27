import unittest
import requests
import requests_mock
import json

# Function for testing
def fetch_scopus_data(author_id, api_key):
    url = f"https://api.elsevier.com/content/search/scopus?query=AU-ID({author_id})&start=0&count=25"
    headers = {"X-ELS-APIKey": api_key, "Accept": "application/json"}
    
    try:
        response = requests.get(url, headers=headers, timeout=5)
        response.raise_for_status() 
        return response.json()
    except requests.exceptions.RequestException:
        return None


# Unit Test Class
class TestScopusAPI(unittest.TestCase):

    @requests_mock.Mocker()
    def test_fetch_scopus_data_success(self, mock_request):
        """Test case for successful API response"""
        author_id = "6506519783"
        api_key = "" # your api key
        
        mock_url = f"https://api.elsevier.com/content/search/scopus?query=AU-ID({author_id})&start=0&count=25"
        mock_response = {
            "search-results": {
                "entry": [
                    {
                        "prism:coverDate": "2021-05-10",
                        "dc:title": "Research Paper Title",
                        "dc:creator": "John Doe",
                        "subtypeDescription": "Article",
                        "prism:pageRange": "1-10",
                        "prism:publicationName": "Journal of Science",
                        "citedby-count": "10",
                        "prism:doi": "10.1234/exampledoi"
                    }
                ]
            }
        }

        mock_request.get(mock_url, json=mock_response, status_code=200)
        
        result = fetch_scopus_data(author_id, api_key)

        self.assertIsNotNone(result)
        self.assertIn("search-results", result)
        self.assertEqual(result["search-results"]["entry"][0]["dc:title"], "Research Paper Title")

    @requests_mock.Mocker()
    def test_fetch_scopus_data_error(self, mock_request):
        """Test case for API response with error (404)"""
        author_id = "6506519783"
        api_key = "" # your api key
        
        mock_url = f"https://api.elsevier.com/content/search/scopus?query=AU-ID({author_id})&start=0&count=25"
        mock_request.get(mock_url, status_code=404)
        
        result = fetch_scopus_data(author_id, api_key)

        self.assertIsNone(result)

    @requests_mock.Mocker()
    def test_fetch_scopus_data_empty_response(self, mock_request):
        """Test case when the API returns an empty response"""
        author_id = "6506519783"
        api_key = "" # your api key
        
        mock_url = f"https://api.elsevier.com/content/search/scopus?query=AU-ID({author_id})&start=0&count=25"
        mock_response = {"search-results": {"entry": []}}  # No data
        mock_request.get(mock_url, json=mock_response, status_code=200)

        result = fetch_scopus_data(author_id, api_key)

        self.assertIsNotNone(result)
        self.assertEqual(len(result["search-results"]["entry"]), 0)

    @requests_mock.Mocker()
    def test_fetch_scopus_data_timeout(self, mock_request):
        """Test case when the API times out"""
        author_id = "6506519783"
        api_key = "" # your api key
        
        mock_url = f"https://api.elsevier.com/content/search/scopus?query=AU-ID({author_id})&start=0&count=25"
        mock_request.get(mock_url, exc=requests.exceptions.Timeout)  # Mock timeout

        result = fetch_scopus_data(author_id, api_key)

        self.assertIsNone(result)

    @requests_mock.Mocker()
    def test_fetch_scopus_data_malformed_json(self, mock_request):
        """Test case when the API returns malformed JSON"""
        author_id = "6506519783"
        api_key = "" # your api key
        
        mock_url = f"https://api.elsevier.com/content/search/scopus?query=AU-ID({author_id})&start=0&count=25"
        mock_request.get(mock_url, text="Invalid JSON Response", status_code=200)

        result = fetch_scopus_data(author_id, api_key)

        self.assertIsNone(result)

    @requests_mock.Mocker()
    def test_fetch_scopus_data_server_error(self, mock_request):
        """Test case when the API returns a 500 Internal Server Error"""
        author_id = "6506519783"
        api_key = "" # your api key
        
        mock_url = f"https://api.elsevier.com/content/search/scopus?query=AU-ID({author_id})&start=0&count=25"
        mock_request.get(mock_url, status_code=500)  # Internal Server Error

        result = fetch_scopus_data(author_id, api_key)

        self.assertIsNone(result)


# Run tests and display results
if __name__ == '__main__':
    suite = unittest.TestLoader().loadTestsFromTestCase(TestScopusAPI)
    runner = unittest.TextTestRunner(verbosity=2)
    runner.run(suite)

