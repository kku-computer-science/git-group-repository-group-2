*** Settings ***
Library           SeleniumLibrary

*** Variables ***
${SERVER}         localhost:8000
${HOME URL}       http://${SERVER}/
${CHROME_BROWSER_PATH}    ${EXECDIR}${/}ChromeForTesting${/}chrome.exe
${CHROME_DRIVER_PATH}     ${EXECDIR}${/}ChromeForTesting${/}chromedriver.exe
@{EXPECTED_WORDS_HOME_EN}
...    Publications (In the Last 5 Years)
...    Number
...    Year
...    Report total number of articles ( 5 years : cumulative)
@{EXPECTED_WORDS_HOME_TH}
...    รายงานจำนวนบทความทั้งหมด (5 ปี : สะสม)
...    จำนวน
...    ปี
...    ผลงานตีพิมพ์ (5 ปีล่าสุด)
@{EXPECTED_WORDS_HOME_CN}
...    近5年内的出版物
...    数量
...    年份
...    报告总文章数（5年累计）

*** Keywords ***
Open Browser To Home Page
    ${chrome_options}=    Evaluate    sys.modules['selenium.webdriver'].ChromeOptions()    sys
    ${chrome_options.binary_location}=    Set Variable    ${CHROME_BROWSER_PATH}
    ${service}=    Evaluate    sys.modules["selenium.webdriver.chrome.service"].Service(executable_path=r"${CHROME_DRIVER_PATH}")
    Create Webdriver    Chrome    options=${chrome_options}    service=${service}
    Go To    ${HOME URL}
    Home Page Should Be Open
    Maximize Browser Window
    Wait Until Element Is Visible    css=.nav-item.dropdown    10s

Home Page Should Be Open
    Location Should Be    ${HOME URL}

Switch Language To
    [Arguments]    ${lang_code}    ${expected_language}
    Click Element    id=navbarDropdownMenuLink
    Wait Until Element Is Visible    css:div.dropdown-menu[aria-labelledby="navbarDropdownMenuLink"]    10s
    ${option_text}=    Get Text    xpath=//a[contains(@href, "/lang/${lang_code}")]
    Log    Option language is: ${option_text}
    Click Element    xpath=//a[contains(@href, "/lang/${lang_code}")]
    Sleep    5s
    ${new_lang}=    Get Text    id=navbarDropdownMenuLink
    Log    New language is: ${new_lang}
    Should Contain    ${new_lang}    ${expected_language}

*** Test Cases ***
Open Home Page
    [Tags]    UAT001-OpenHomePage
    Open Browser To Home Page
    Close Browser

Verify Default Language Is English
    [Tags]    UAT004-DefaultLanguageIsEnglish
    Open Browser To Home Page
    ${default_lang}=    Get Text    id=navbarDropdownMenuLink
    Log    Default language is: ${default_lang}
    Should Contain    ${default_lang}    ENGLISH
    [Teardown]    Close Browser

Switch To English Directly
    [Tags]    UAT002-SwitchToEnglishDirectlyAndCheck
    Open Browser To Home Page
    Go To    ${HOME URL}lang/en
    Sleep    5s
    ${new_lang}=    Get Text    id=navbarDropdownMenuLink
    Should Contain    ${new_lang}    ENGLISH
    ${html_source}=    Get Source
    Log    HTML Source: ${html_source}
    FOR    ${word}    IN    @{EXPECTED_WORDS_HOME_EN}
        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END
    [Teardown]    Close Browser


Switch Language To Thai
    [Tags]    UAT003-SwitchToTHAndCheck
    Open Browser To Home Page
    Sleep    5s
    Switch Language To    th    ไทย
    Sleep    5s
    ${html_source}=    Get Source
    Log    HTML Source: ${html_source}
    FOR    ${word}    IN    @{EXPECTED_WORDS_HOME_TH}
        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END
    [Teardown]    Close Browser

Switch Language To Chinese
    [Tags]    UAT004-SwitchToCNAndCheck
    Open Browser To Home Page
    Sleep    5s
    Switch Language To    zh    中文
    Sleep    5s
    ${html_source}=    Get Source
    Log    HTML Source: ${html_source}
    FOR    ${word}    IN    @{EXPECTED_WORDS_HOME_CN}
        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END
    [Teardown]    Close Browser
