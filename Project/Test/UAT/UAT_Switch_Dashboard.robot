*** Settings ***
Library           SeleniumLibrary

*** Variables ***
${SERVER}                    localhost:8000
${ADMIN_USERNAME}             admin@gmail.com
${ADMIN_PASSWORD}             12345678
${LOGIN URL}                  http://${SERVER}/login
${ADMIN URL}                  http://${SERVER}/dashboard
${CHROME_BROWSER_PATH}       ${EXECDIR}${/}ChromeForTesting${/}chrome.exe
${CHROME_DRIVER_PATH}        ${EXECDIR}${/}ChromeForTesting${/}chromedriver.exe
@{LANGUAGES}
...    en
...    th
...    zn

@{EXPECTED_WORDS_ADMIN_EN}
...    Research Information Management System
...    English
...    Logout
...    Dashboard
...    Profile
...    User Profile
...    Option
...    Manage Fund
...    Research Project
...    Research Group
...    Manage Publications
...    Admin
...    Users
...    Roles
...    Permissions
...    Departments
...    Manage Programs
...    Manage Expertise
...    Manage Image

@{EXPECTED_WORDS_DASHBOARD_TH}
...    ระบบการจัดการข้อมูลการวิจัย

@{EXPECTED_WORDS_ADMIN_CN}
...    研究信息管理系统
...    英语
...    退出
...    仪表板
...    个人资料
...    用户资料
...    选项
...    管理资金
...    研究项目
...    研究小组
...    管理出版物
...    管理员
...    用户
...    角色
...    权限
...    部门
...    管理课程
...    管理专业知识
...    管理图片
 
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

Admin Login
    Input Text      id=username    ${ADMIN_USERNAME}
    Input Text      id=password    ${ADMIN_PASSWORD}
    Click Button    xpath=//button[@type='submit']
    Sleep    2s 
    Location Should Be    ${ADMIN URL} 

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
# Open Admin Page
#     [Tags]    UAT001-OpenAdminPage
#     Open Browser To Login Page
#     Login Page Should Be Open
#     Admin Login
#     Sleep    2s
#     Switch Language To    th    ไทย
#     Sleep    5s
#     Close Browser

Dashboard Page Switch Language To TH
    [Tags]    UAT001-OpenAdminPage
    Open Browser To Login Page
    Login Page Should Be Open
    Admin Login
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

# Dashboard Page Switch Language To CN
#     [Tags]    UAT001-OpenAdminPage
#     Open Browser To Login Page
#     Login Page Should Be Open
#     Admin Login
#     Sleep    2s
#     Switch Language To    zh    中文
#     Sleep    5s
#     Close Browser


