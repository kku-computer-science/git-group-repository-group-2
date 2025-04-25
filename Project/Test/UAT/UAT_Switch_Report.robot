*** Settings ***
Library           SeleniumLibrary

*** Variables ***
${SERVER}                    localhost:8000
${HOME URL}                  http://${SERVER}/
${REPORT URL}                http://${SERVER}/reports
${CHROME_BROWSER_PATH}       ${EXECDIR}${/}ChromeForTesting${/}chrome.exe
${CHROME_DRIVER_PATH}        ${EXECDIR}${/}ChromeForTesting${/}chromedriver.exe
@{EXPECTED_WORDS_REPORT_EN}
...    Total number of articles statistics for 5 years
...    Total number of articles statistics cumulative
...    Source
@{EXPECTED_WORDS_REPORT_TH}
...    สถิติจำนวนบทความทั้งหมดใน 5 ปี
...    สถิติจำนวนบทความสะสม
...    แหล่งที่มา
@{EXPECTED_WORDS_REPORT_CN}
...    过去5年文章总数统计
...    累计文章总数统计
...    来源

*** Keywords ***
Open Browser To Report Page
    ${chrome_options}=    Evaluate    sys.modules['selenium.webdriver'].ChromeOptions()    sys
    ${chrome_options.binary_location}=    Set Variable    ${CHROME_BROWSER_PATH}
    ${service}=    Evaluate    sys.modules["selenium.webdriver.chrome.service"].Service(executable_path=r"${CHROME_DRIVER_PATH}")
    Create Webdriver    Chrome    options=${chrome_options}    service=${service}
    Go To    ${REPORT URL}
    Report Page Should Be Open
    Maximize Browser Window
    Wait Until Element Is Visible    css=.nav-item.dropdown    10s

Report Page Should Be Open
    Location Should Be    ${REPORT URL}

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
Open Report Page
    [Tags]    UAT001-OpenReportPage
    Open Browser To Report Page
    Report Page Should Be Open

Open Report Page And Check EN
    [Tags]    UAT002-OpenReportPageAndCheckEN
    Open Browser To Report Page
    Sleep    5s
    ${html_source}=    Get Source
    Log    HTML Source: ${html_source}
    FOR    ${word}    IN    @{EXPECTED_WORDS_REPORT_EN}
        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END
    Close Browser

Open Researcher_Profile Page And Check TH
    [Tags]    UAT003-OpenReportPageAndCheckTH
    Open Browser To Report Page
    Switch Language To    th    ไทย
    Sleep    5s
    ${html_source}=    Get Source
    Log    HTML Source: ${html_source}
    FOR    ${word}    IN    @{EXPECTED_WORDS_REPORT_TH}
        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END
    Close Browser

Open Researcher_Profile Page And Check CN
    [Tags]    UAT004-OpenReportPageAndCheckCN
    Open Browser To Report Page
    Switch Language To    zh    中文
    Sleep    5s
    ${html_source}=    Get Source
    Log    HTML Source: ${html_source}
    FOR    ${word}    IN    @{EXPECTED_WORDS_REPORT_CN}
        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END
    Close Browser