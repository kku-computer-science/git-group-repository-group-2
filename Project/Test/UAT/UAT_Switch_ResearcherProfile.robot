*** Settings ***
Library           SeleniumLibrary

*** Variables ***
${SERVER}                    localhost:8000
${HOME URL}                  http://${SERVER}/
${RESEARCHER_CS URL}         http://${SERVER}/researchers/1
${RESEARCHER_DETAIL URL}      http://${SERVER}/detail/3
${CHROME_BROWSER_PATH}       ${EXECDIR}${/}ChromeForTesting${/}chrome.exe
${CHROME_DRIVER_PATH}        ${EXECDIR}${/}ChromeForTesting${/}chromedriver.exe
@{EXPECTED_WORDS_RESEACHERDETAIL_EN}
...    Publications
...    Education
...    Summary
...    Show
...    Entries
...    Search
...    No.
...    Year
...    Author
...    Paper Name
...    Page
...    Source
...    Showing
...    to
...    of
...    entries
...    Previous
...    Next
@{EXPECTED_WORDS_RESEACHERDETAIL_TH}
...    ผลงานตีพิมพ์
...    การศึกษา
...    สรุป
...    แสดง
...    รายการ
...    ค้นหา
...    ลำดับที่
...    ปี
...    ผู้เขียน
...    ชื่อบทความ
...    หน้า
...    แหล่งที่มา
...    กำลังแสดง
...    ถึง
...    จาก
...    รายการ
...    ก่อนหน้า
...    ถัดไป
@{EXPECTED_WORDS_RESEACHERDETAIL_CN}
...    出版物
...    教育
...    概述
...    显示
...    记录
...    搜索
...    编号
...    年份
...    作者
...    论文题目
...    页码
...    来源
...    显示
...    到
...    条
...    共
...    条
...    上一页
...    下一页

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

Open Browser To Researcher_Detail Page
    ${chrome_options}=    Evaluate    sys.modules['selenium.webdriver'].ChromeOptions()    sys
    ${chrome_options.binary_location}=    Set Variable    ${CHROME_BROWSER_PATH}
    ${service}=    Evaluate    sys.modules["selenium.webdriver.chrome.service"].Service(executable_path=r"${CHROME_DRIVER_PATH}")
    Create Webdriver    Chrome    options=${chrome_options}    service=${service}
    Go To    ${RESEARCHER_DETAIL URL}
    Researcher_Detail Page Should Be Open
    Maximize Browser Window
    Wait Until Element Is Visible    css=.nav-item.dropdown    10s

Researcher_Detail Page Should Be Open
    Location Should Be    ${RESEARCHER_DETAIL URL}

Open Browser To Researcher_CS Page
    ${chrome_options}=    Evaluate    sys.modules['selenium.webdriver'].ChromeOptions()    sys
    ${chrome_options.binary_location}=    Set Variable    ${CHROME_BROWSER_PATH}
    ${service}=    Evaluate    sys.modules["selenium.webdriver.chrome.service"].Service(executable_path=r"${CHROME_DRIVER_PATH}")
    Create Webdriver    Chrome    options=${chrome_options}    service=${service}
    Go To    ${RESEARCHER_CS URL}
    Researcher_CS Page Should Be Open
    Maximize Browser Window
    Wait Until Element Is Visible    css=.nav-item.dropdown    10s

Researcher_CS Page Should Be Open
    Location Should Be    ${RESEARCHER_CS URL}

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
Open Researcher_Profile Page
    [Tags]    UAT001-OpenResearcher_ProfilePage
    Open Browser To Researcher_CS Page
    Wait Until Element Is Visible    css:div.card.mb-3    10s
    Click Element    css:div.card.mb-3
    Sleep    5s
    Close Browser

Open Researcher_Profile Page And Check EN
    [Tags]    UAT002-OpenResearcher_ProfilePageAndCheckEN
    Open Browser To Researcher_CS Page
    Wait Until Element Is Visible    css:div.card.mb-3    10s
    Click Element    css:div.card.mb-3
    Sleep    5s
    ${html_source}=    Get Source
    Log    HTML Source: ${html_source}
    FOR    ${word}    IN    @{EXPECTED_WORDS_RESEACHERDETAIL_EN}
        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END
    Close Browser

Open Researcher_Profile Page And Check TH
    [Tags]    UAT003-OpenResearcher_ProfilePageAndCheckTH
    Open Browser To Researcher_CS Page
    Wait Until Element Is Visible    css:div.card.mb-3    10s
    Click Element    css:div.card.mb-3
    Sleep    5s
    Switch Language To    th    ไทย
    Sleep    5s
    ${html_source}=    Get Source
    Log    HTML Source: ${html_source}
    FOR    ${word}    IN    @{EXPECTED_WORDS_RESEACHERDETAIL_TH}
        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END
    Close Browser

Open Researcher_Profile Page And Check CN
    [Tags]    UAT004-OpenResearcher_ProfilePageAndCheckCN
    Open Browser To Researcher_CS Page
    Wait Until Element Is Visible    css:div.card.mb-3    10s
    Click Element    css:div.card.mb-3
    Sleep    5s
    Switch Language To    zh    中文
    Sleep    5s
    ${html_source}=    Get Source
    Log    HTML Source: ${html_source}
    FOR    ${word}    IN    @{EXPECTED_WORDS_RESEACHERDETAIL_CN}
        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END
    Close Browser


