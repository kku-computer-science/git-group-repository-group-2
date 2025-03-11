import pytest
import pymysql
from unittest.mock import patch, MagicMock
from function_to_scrape import connect_to_db, fetch_teachers, scrape_tci_data
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.support.ui import Select

# Mock การเชื่อมต่อฐานข้อมูล
@pytest.fixture
def mock_db_connection():
    mock_conn = MagicMock(spec=pymysql.connections.Connection)
    return mock_conn

# Test: เชื่อมต่อฐานข้อมูล
def test_connect_to_db():
    with patch("pymysql.connect") as mock_connect:
        mock_connect.return_value = MagicMock()
        conn = connect_to_db()
        assert conn is not None
        
# Test: ดึงข้อมูลอาจารย์จากฐานข้อมูล
def test_fetch_teachers(mock_db_connection):
    mock_cursor = mock_db_connection.cursor.return_value
    mock_cursor.fetchall.return_value = [
        (1, "Punyaphol", "Horata", "ปัญญาพล", "หอระตะ"),
        (2, "Yanika", "Kongsorot", "ญานิกา", "คงโสรส"),
    ]
    
    teachers = fetch_teachers(mock_db_connection)
    assert teachers == ["Punyaphol Horata (ปัญญาพล หอระตะ)", "Yanika Kongsorot (ญานิกา คงโสรส)"]

# Test: ทดสอบ Web Scraping (Mock WebDriver)
@patch("function_to_scrape.setup_webdriver")
def test_scrape_tci_data(mock_setup_webdriver):
    mock_driver = MagicMock()
    mock_setup_webdriver.return_value = mock_driver

    mock_select_element = MagicMock()
    mock_select_element.tag_name = "select"

    mock_option_element = MagicMock()
    mock_option_element.get_attribute.return_value = "author"

    mock_select_element.find_elements.return_value = [mock_option_element]
    mock_driver.find_element.return_value = mock_select_element

    # กำหนด HTML ที่จะใช้ในการทดสอบ (กรณีที่มี citation)
    mock_driver.page_source = """<html>
        <div class='filter_panel card col-md-9'>
            <div class='content'>
                <div class='content'>
                    <p>Extended Hierarchical Extreme Learning Machine with Multilayer Perceptron</p>
                    <p class='authors'><a>Punyaphol Horata</a></p>
                    <p>Journal: Example Journal, 2024, pp. 10-20</p>
                    <p style='float:right;'>cited 5</p>
                </div>
            </div>
        </div>
    </html>"""

    mock_driver.find_element.return_value = mock_select_element
    mock_driver.find_element.return_value.send_keys(Keys.ENTER)

    # เรียกฟังก์ชัน scrape_tci_data
    results = scrape_tci_data(["Punyaphol Horata"])

    # ตรวจสอบผลลัพธ์
    assert len(results) == 1
    assert results[0]["Title"] == "Extended Hierarchical Extreme Learning Machine with Multilayer Perceptron"
    assert results[0]["Authors"] == "Punyaphol Horata"
    assert results[0]["Citations"] == "5"  # ตอนนี้ Citation ควรมีข้อมูล

    # กรณีที่ไม่มี citation_section
    mock_driver.page_source = """<html>
        <div class='filter_panel card col-md-9'>
            <div class='content'>
                <div class='content'>
                    <p>Another Paper Without Citations</p>
                    <p class='authors'><a>Punyaphol Horata</a></p>
                    <p>Journal: Example Journal, 2024, pp. 30-40</p>
                </div>
            </div>
        </div>
    </html>"""

    results_no_citations = scrape_tci_data(["Punyaphol Horata"])

    # ตรวจสอบว่า Citation ไม่มีข้อมูล
    assert len(results_no_citations) == 1
    assert results_no_citations[0]["Citations"] == ""  # ไม่มีข้อมูล Citation
