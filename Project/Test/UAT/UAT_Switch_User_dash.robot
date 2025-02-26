*** Settings ***
Library           SeleniumLibrary

*** Variables ***
${SERVER}    https://csweb0267.cpkkuhost.com
${USER_USERNAME}             pusadee@kku.ac.th
${USER_PASSWORD}             123456789
${LOGIN URL}    ${SERVER}/login
${USER URL}    ${SERVER}/dashboard
${CHROME_BROWSER_PATH}       ${EXECDIR}${/}ChromeForTesting${/}chrome.exe
${CHROME_DRIVER_PATH}        ${EXECDIR}${/}ChromeForTesting${/}chromedriver.exe
@{LANGUAGES}
...    en
...    th
...    zh

@{EXPECTED_WORDS_USER_EN}
...    Research Information Management System
...    Welcome to the computer science research data management system.
...    Hello
...    Dashboard
...    Profile
...    User Profile
...    Option
...    Manage Fund
...    Research Project
...    Research Group
...    Manage Publications
...    Logout


@{EXPECTED_WORDS_DASHBOARD_TH}
...    ระบบการจัดการข้อมูลการวิจัย
...    ยินดีต้อนรับสู่ระบบจัดการข้อมูลการวิจัยวิทยาการคอมพิวเตอร์
...    สวัสดี
...    แดชบอร์ด
...    ข้อมูลส่วนตัว
...    ข้อมูลผู้ใช้
...    ตัวเลือก
...    จัดการกองทุน
...    โครงการวิจัย
...    กลุ่มวิจัย
...    จัดการผลงานตีพิมพ์
...    ออกจากระบบ
       
        

@{EXPECTED_WORDS_USER_CN}
...    研究信息管理系统
...    欢迎使用计算机科学研究数据管理系统
...    您好
...    仪表板
...    个人资料
...    用户资料
...    选项
...    资金管理
...    研究项目
...    研究小组
...    管理出版物
...    退出登录



*** Keywords ***
Open Browser To Login Page
    ${chrome_options}=    Evaluate    sys.modules['selenium.webdriver'].ChromeOptions()    sys
    ${chrome_options.binary_location}=    Set Variable    ${CHROME_BROWSER_PATH}
    ${service}=    Evaluate    sys.modules["selenium.webdriver.chrome.service"].Service(executable_path=r"${CHROME_DRIVER_PATH}")
    Create Webdriver    Chrome    options=${chrome_options}    service=${service}
    Go To    ${LOGIN URL}
    Login Page Should Be Open
    Maximize Browser Window

Login Page Should Be Open
    Location Should Be    ${LOGIN URL}

User Login
    Input Text      id=username    ${USER_USERNAME}
    Input Text      id=password    ${USER_PASSWORD}
    Click Button    xpath=//button[@type='submit']
    Sleep    2s 
    Location Should Be    ${USER URL} 

Switch Language To
    [Arguments]    ${lang_code}    ${expected_language}
    # Click the language dropdown button
    Click Element    id=navbarDropdown
    # Wait for the dropdown menu to appear
    Wait Until Element Is Visible    css:ul.dropdown-menu[aria-labelledby="navbarDropdown"]    10s
    # Retrieve and log the text of the option
    ${option_text}=    Get Text    xpath=//a[contains(@href, "/language/${lang_code}")]
    Log    Option language is: ${option_text}
    # Click the language option
    Click Element    xpath=//a[contains(@href, "/language/${lang_code}")]
    Sleep    5s
    # Get the updated text from the dropdown button
    ${new_lang}=    Get Text    id=navbarDropdown
    Log    New language is: ${new_lang}
    Should Contain    ${new_lang}    ${expected_language}



*** Test Cases ***
# Open User Page
#     [Tags]    UAT001-OpenUserPage
#     Open Browser To Login Page
#     Login Page Should Be Open
#     User Login
#     Sleep    2s
#     Switch Language To    th    ไทย
#     Sleep    5s
#     Close Browser

Dashboard Page Switch Language To TH
    [Tags]    UAT001-OpenUserPage
    Open Browser To Login Page
    Login Page Should Be Open
    User Login
    Sleep    2s
    Switch Language To    th    ไทย
    ${html_source}=    Get Source
    Log    HTML Source: ${html_source}
    FOR    ${word}    IN    @{EXPECTED_WORDS_DASHBOARD_TH}
        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END
    Sleep    5s
    Close Browser

Dashboard Page Switch Language To CN
    [Tags]    UAT001-OpenUserPage
    Open Browser To Login Page
    Login Page Should Be Open
    User Login
    Sleep    2s
    Switch Language To    zh    中文
    ${html_source}=    Get Source
    Log    HTML Source: ${html_source}
    FOR    ${word}    IN    @{EXPECTED_WORDS_USER_CN}
        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END
    Sleep    5s
    Close Browser

Dashboard Page Switch Language To EN
    [Tags]    UAT001-OpenUserPage
    Open Browser To Login Page
    Login Page Should Be Open
    User Login
    Sleep    2s
    Switch Language To    en    English
    ${html_source}=    Get Source
    Log    HTML Source: ${html_source}
    FOR    ${word}    IN    @{EXPECTED_WORDS_USER_EN}
        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END
    Sleep    5s
    Close Browser
