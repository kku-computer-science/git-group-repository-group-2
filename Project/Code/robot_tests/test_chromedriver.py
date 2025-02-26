from selenium import webdriver
from selenium.webdriver.chrome.service import Service
from webdriver_manager.chrome import ChromeDriverManager

# ตั้งค่า options สำหรับ chrome
options = webdriver.ChromeOptions()
options.add_argument('--headless')  # เปิดโหมด headless
options.add_argument('--disable-gpu')  # ปิดการใช้ GPU

# ตั้งค่า chrome driver
service = Service(ChromeDriverManager().install())

# สร้าง driver
driver = webdriver.Chrome(service=service, options=options)

# ไปที่เว็บไซต์
driver.get('https://www.google.com')

# พิมพ์ชื่อ title ของเว็บ
print(driver.title)

# ปิด driver
driver.quit()