*** Settings ***
Library           SeleniumLibrary

*** Variables ***
${SERVER}                    localhost:8000
${HOME URL}                  http://${SERVER}/
${LOGIN URL}                http://${SERVER}/login
${CHROME_BROWSER_PATH}       ${EXECDIR}${/}ChromeForTesting${/}chrome.exe
${CHROME_DRIVER_PATH}        ${EXECDIR}${/}ChromeForTesting${/}chromedriver.exe
@{EXPECTED_WORDS_LOGIN_EN}
...    Account Login
...    Username
...    Password
...    Remember Me
...    Login
...    *** If you forget your password, please contact the administrator
...    For the username, use KKU-Mail to log in
...    For students logging in for the first time, use your student ID to log in
@{EXPECTED_WORDS_LOGIN_TH}
...    เข้าสู่ระบบบัญชี
...    ชื่อผู้ใช้
...    รหัสผ่าน
...    จดจำฉัน
...    เข้าสู่ระบบ
...    *** หากลืมรหัสผ่าน ให้ติดต่อผู้ดูแลระบบ
...    สำหรับ Username ใช้ KKU-Mail ในการเข้าสู่ระบบ
...    สำหรับนักศึกษาที่เข้าระบบเป็นครั้งแรกให้เข้าสู่ระด้วยรหัสนักศึกษา
@{EXPECTED_WORDS_LOGIN_CN}
...    账户登录
...    用户名
...    密码
...    记住我
...    登录
...    *** 如果忘记密码，请联系管理员
...    用户名请使用 KKU-Mail 登录
...    首次登录的学生请使用学号登录
   
*** Keywords ***
Open Browser To Login Page
    ${chrome_options}=    Evaluate    sys.modules['selenium.webdriver'].ChromeOptions()    sys
    ${chrome_options.binary_location}=    Set Variable    ${CHROME_BROWSER_PATH}
    ${service}=    Evaluate    sys.modules["selenium.webdriver.chrome.service"].Service(executable_path=r"${CHROME_DRIVER_PATH}")
    Create Webdriver    Chrome    options=${chrome_options}    service=${service}
    Go To    ${LOGIN URL}
    Login Page Should Be Open
    Maximize Browser Window
    Wait Until Element Is Visible    id=loginLangDropdown    10s

Login Page Should Be Open
    Location Should Be    ${LOGIN URL}

Switch Language To
    [Arguments]    ${lang_code}    ${expected_language}
    # Click the language dropdown button
    Click Element    id=loginLangDropdown
    # Wait until the dropdown menu appears (it’s associated via aria-labelledby="loginLangDropdown")
    Wait Until Element Is Visible    css:div.dropdown-menu[aria-labelledby="loginLangDropdown"]    10s
    # Get the text of the option using its href fragment (e.g., "/lang/th")
    ${option_text}=    Get Text    xpath=//a[contains(@href, "/lang/${lang_code}")]
    Log    Option language is: ${option_text}
    # Click the language option
    Click Element    xpath=//a[contains(@href, "/lang/${lang_code}")]
    Sleep    5s
    # Retrieve the updated text from the dropdown toggle button
    ${new_lang}=    Get Text    id=loginLangDropdown
    Log    New language is: ${new_lang}
    Should Contain    ${new_lang}    ${expected_language}


*** Test Cases ***
Open Login Page
    [Tags]    UAT001-OpenLoginPage
    Open Browser To Login Page
    Sleep    5s
    Close Browser

Open Login Page And Check EN
    [Tags]    UAT002-OpenLoginPageAndCheckEN
    Open Browser To Login Page
    Sleep    5s
    ${html_source}=    Get Source
    Log    HTML Source: ${html_source}
    FOR    ${word}    IN    @{EXPECTED_WORDS_LOGIN_EN}
        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END
    Close Browser

Open Login Page And Check TH
    [Tags]    UAT003-OpenLoginPageAndCheckTH
    Open Browser To Login Page
    Switch Language To    th    ไทย
    Sleep    5s
    ${html_source}=    Get Source
    Log    HTML Source: ${html_source}
    FOR    ${word}    IN    @{EXPECTED_WORDS_LOGIN_TH}
        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END
    Close Browser

Open Login Page And Check CN
    [Tags]    UAT004-OpenLoginPageAndCheckCN
    Open Browser To Login Page
    Switch Language To    zh    中文
    Sleep    5s
    ${html_source}=    Get Source
    Log    HTML Source: ${html_source}
    FOR    ${word}    IN    @{EXPECTED_WORDS_LOGIN_CN}
        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END
    Close Browser
