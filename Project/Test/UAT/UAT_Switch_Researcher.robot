*** Settings ***
Library           SeleniumLibrary

*** Variables ***
${SERVER}                    localhost:8000
${HOME URL}                  http://${SERVER}/
${RESEARCHER_CS URL}         http://${SERVER}/researchers/1
${RESEARCHER_IT URL}         http://${SERVER}/researchers/2
${RESEARCHER_GIS URL}        http://${SERVER}/researchers/3
${CHROME_BROWSER_PATH}       ${EXECDIR}${/}ChromeForTesting${/}chrome.exe
${CHROME_DRIVER_PATH}        ${EXECDIR}${/}ChromeForTesting${/}chromedriver.exe
@{EXPECTED_WORDS_DEPARTMENT_EN}
...    Computer Science
...    Infomation Technology
...    Geo-Informatics
@{EXPECTED_WORDS_DEPARTMENT_TH}
...    สาขาวิชาวิทยาการคอมพิวเตอร์
...    สาขาวิชาเทคโนโลยีสารสนเทศ
...    สาขาวิชาภูมิสารสนเทศศาสตร์
@{EXPECTED_WORDS_DEPARTMENT_CN}
...    计算机科学
...    信息技术
...    地理信息学
@{EXPECTED_WORDS_RESEACHER_EN}
...    Researchers
...    Computer Science
...    Research interests
...    Search
...    Expertise
...    Software Engineering
@{EXPECTED_WORDS_RESEACHER_TH}
...    นักวิจัย
...    สาขาวิชาวิทยาการคอมพิวเตอร์
...    ความสนใจในการวิจัย
...    ค้นหา
...    ความเชี่ยวชาญ
...    วิศวกรรมซอฟต์แวร์
@{EXPECTED_WORDS_RESEACHER_CN}
...    研究人员
...    计算机科学
...    研究兴趣
...    搜索
...    专长
...    软件工程

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

Open Browser To Researcher_IT Page
    ${chrome_options}=    Evaluate    sys.modules['selenium.webdriver'].ChromeOptions()    sys
    ${chrome_options.binary_location}=    Set Variable    ${CHROME_BROWSER_PATH}
    ${service}=    Evaluate    sys.modules["selenium.webdriver.chrome.service"].Service(executable_path=r"${CHROME_DRIVER_PATH}")
    Create Webdriver    Chrome    options=${chrome_options}    service=${service}
    Go To    ${RESEARCHER_IT URL}
    Researcher_IT Page Should Be Open
    Maximize Browser Window
    Wait Until Element Is Visible    css=.nav-item.dropdown    10s

Researcher_IT Page Should Be Open
    Location Should Be    ${RESEARCHER_IT URL}

Open Browser To Researcher_GIS Page
    ${chrome_options}=    Evaluate    sys.modules['selenium.webdriver'].ChromeOptions()    sys
    ${chrome_options.binary_location}=    Set Variable    ${CHROME_BROWSER_PATH}
    ${service}=    Evaluate    sys.modules["selenium.webdriver.chrome.service"].Service(executable_path=r"${CHROME_DRIVER_PATH}")
    Create Webdriver    Chrome    options=${chrome_options}    service=${service}
    Go To    ${RESEARCHER_GIS URL}
    Researcher_GIS Page Should Be Open
    Maximize Browser Window
    Wait Until Element Is Visible    css=.nav-item.dropdown    10s

Researcher_GIS Page Should Be Open
    Location Should Be    ${RESEARCHER_GIS URL}

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

Open Department Dropdown
    [Documentation]    Opens the department dropdown and verifies that it is visible.
    Click Element    id=navbarDropdown
    Wait Until Element Is Visible    css:ul.dropdown-menu[aria-labelledby="navbarDropdown"]    10s
    ${class_value}=    Get Element Attribute    id=navbarDropdown    class
    Should Contain    ${class_value}    show

*** Test Cases ***
Open Researcher_CS Page
    [Tags]    UAT001-OpenResearcherCSPage
    Open Browser To Researcher_CS Page
    Close Browser

Open Researcher_IT Page
    [Tags]    UAT002-OpenResearcherITPage
    Open Browser To Researcher_IT Page
    Close Browser

Open Researcher_GIS Page
    [Tags]    UAT003-OpenResearcherGISPage
    Open Browser To Researcher_GIS Page
    Close Browser

Open Department Dropdown
    [Tags]    UAT004-OpenDepartmentDropdown
    Open Browser To Researcher_CS Page
    Sleep    5s
    Open Department Dropdown
    [Teardown]    Close Browser

Verify Dropdown Contains Specific Word EN
    [Tags]    UAT005-VerifyDropdownContainsSpecificWordEN
    Open Browser To Researcher_CS Page
    Sleep    5s
    Click Element    id=navbarDropdown
    Wait Until Element Is Visible    css:ul.dropdown-menu[aria-labelledby="navbarDropdown"]    10s
    ${dropdown_text}=    Get Text    css:ul.dropdown-menu[aria-labelledby="navbarDropdown"]
    Log    Dropdown text: ${dropdown_text}
    FOR    ${word}    IN    @{EXPECTED_WORDS_DEPARTMENT_EN}
        Log    Checking for: ${word}
        Should Contain    ${dropdown_text}    ${word}
    END
    [Teardown]    Close Browser

Verify Dropdown Contains Specific Word TH
    [Tags]    UAT006-VerifyDropdownContainsSpecificWordTH
    Open Browser To Researcher_CS Page
    Sleep    5s
    Switch Language To    th    ไทย
    Sleep    5s
    Click Element    id=navbarDropdown
    Wait Until Element Is Visible    css:ul.dropdown-menu[aria-labelledby="navbarDropdown"]    10s
    ${dropdown_text}=    Get Text    css:ul.dropdown-menu[aria-labelledby="navbarDropdown"]
    Log    Dropdown text: ${dropdown_text}
    FOR    ${word}    IN    @{EXPECTED_WORDS_DEPARTMENT_TH}
        Log    Checking for: ${word}
        Should Contain    ${dropdown_text}    ${word}
    END
    [Teardown]    Close Browser

Verify Dropdown Contains Specific Word CN
    [Tags]    UAT007-VerifyDropdownContainsSpecificWordCN
    Open Browser To Researcher_CS Page
    Sleep    5s
    Switch Language To    zh    中文
    Sleep    5s
    Click Element    id=navbarDropdown
    Wait Until Element Is Visible    css:ul.dropdown-menu[aria-labelledby="navbarDropdown"]    10s
    ${dropdown_text}=    Get Text    css:ul.dropdown-menu[aria-labelledby="navbarDropdown"]
    Log    Dropdown text: ${dropdown_text}
    FOR    ${word}    IN    @{EXPECTED_WORDS_DEPARTMENT_CN}
        Log    Checking for: ${word}
        Should Contain    ${dropdown_text}    ${word}
    END
    [Teardown]    Close Browser

Switch To English Directly
    [Tags]    UAT008-SwitchToEnglishDirectlyAndCheck
    Open Browser To Home Page
    Go To    ${RESEARCHER_CS URL}
    Sleep    5s
    ${new_lang}=    Get Text    id=navbarDropdownMenuLink
    Should Contain    ${new_lang}    ENGLISH
    ${html_source}=    Get Source
    Log    HTML Source: ${html_source}
    FOR    ${word}    IN    @{EXPECTED_WORDS_RESEACHER_EN}
        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END
    [Teardown]    Close Browser


Switch Language To Thai
    [Tags]    UAT009-SwitchToTHAndCheck
    Open Browser To Researcher_CS Page
    Sleep    5s
    Switch Language To    th    ไทย
    Sleep    5s
    ${html_source}=    Get Source
    Log    HTML Source: ${html_source}
    FOR    ${word}    IN    @{EXPECTED_WORDS_RESEACHER_TH}
        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END
    [Teardown]    Close Browser

Switch Language To Chinese
    [Tags]    UAT0010-SwitchToCNAndCheck
    Open Browser To Researcher_CS Page
    Sleep    5s
    Switch Language To    zh    中文
    Sleep    5s
    ${html_source}=    Get Source
    Log    HTML Source: ${html_source}
    FOR    ${word}    IN    @{EXPECTED_WORDS_RESEACHER_CN}
        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END
    [Teardown]    Close Browser

