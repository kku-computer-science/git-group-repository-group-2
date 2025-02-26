*** Settings ***
Library           SeleniumLibrary

*** Variables ***
${SERVER}                    localhost:8000
${HOME URL}                  http://${SERVER}/
${RESEARCH_GROUP URL}                http://${SERVER}/researchgroup
${CHROME_BROWSER_PATH}       ${EXECDIR}${/}ChromeForTesting${/}chrome.exe
${CHROME_DRIVER_PATH}        ${EXECDIR}${/}ChromeForTesting${/}chromedriver.exe
@{EXPECTED_WORDS_RESEARCH_GROUP_EN}
...    Research Group
...    Laboratory Supervisor
...    More details
...    Advanced GIS Technology (AGT)
@{EXPECTED_WORDS_RESEARCH_GROUP_TH}
...    กลุ่มวิจัย
...    ผู้ควบคุมห้องปฏิบัติการ
...    รายละเอียดเพิ่มเติม
...    เทคโนโลยี GIS ขั้นสูง (AGT)
@{EXPECTED_WORDS_RESEARCH_GROUP_CN}
...    研究小组
...    实验室主管
...    更多详情

*** Keywords ***
Open Browser To Research_Group Page
    ${chrome_options}=    Evaluate    sys.modules['selenium.webdriver'].ChromeOptions()    sys
    ${chrome_options.binary_location}=    Set Variable    ${CHROME_BROWSER_PATH}
    ${service}=    Evaluate    sys.modules["selenium.webdriver.chrome.service"].Service(executable_path=r"${CHROME_DRIVER_PATH}")
    Create Webdriver    Chrome    options=${chrome_options}    service=${service}
    Go To    ${RESEARCH_GROUP URL}
    Research_Group Page Should Be Open
    Maximize Browser Window
    Wait Until Element Is Visible    css=.nav-item.dropdown    10s

Research_Group Page Should Be Open
    Location Should Be    ${RESEARCH_GROUP URL}

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
Open Research_Group Page
    [Tags]    UAT001-OpenResearch_GroupPage
    Open Browser To Research_Group Page
    Research_Group Page Should Be Open

Open Research_Group Page And Check EN
    [Tags]    UAT002-OpenResearch_GroupPageAndCheckEN
    Open Browser To Research_Group Page
    Sleep    5s
    ${html_source}=    Get Source
    Log    HTML Source: ${html_source}
    FOR    ${word}    IN    @{EXPECTED_WORDS_RESEARCH_GROUP_EN}
        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END
    Close Browser

Open Research_Group Page And Check TH
    [Tags]    UAT003-OpenResearch_GroupPageAndCheckTH
    Open Browser To Research_Group Page
    Switch Language To    th    ไทย
    Sleep    5s
    ${html_source}=    Get Source
    Log    HTML Source: ${html_source}
    FOR    ${word}    IN    @{EXPECTED_WORDS_RESEARCH_GROUP_TH}
        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END
    Close Browser

Open Research_Group Page And Check CN
    [Tags]    UAT004-OpenResearch_GroupPageAndCheckCN
    Open Browser To Research_Group Page
    Switch Language To    zh    中文
    Sleep    5s
    ${html_source}=    Get Source
    Log    HTML Source: ${html_source}
    FOR    ${word}    IN    @{EXPECTED_WORDS_RESEARCH_GROUP_CN}
        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END
    Close Browser