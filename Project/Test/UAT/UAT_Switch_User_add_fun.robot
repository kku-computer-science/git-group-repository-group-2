@@ -0,0 +1,219 @@
* Settings *
Library           SeleniumLibrary

* Variables *

${SERVER}    https://csweb0267.cpkkuhost.com
${USER_USERNAME}             pusadee@kku.ac.th
${USER_PASSWORD}             123456789
${LOGIN URL}    ${SERVER}/login
${USER URL}    ${SERVER}/dashboard
${PROFILE URL}              ${SERVER}/profile
${FUND URL}                  ${SERVER}/funds 
${PRO URL}                  ${SERVER}/researchProjects
${FUN ADD URL}               ${SERVER}/funds/create

${CHROME_BROWSER_PATH}       ${EXECDIR}${/}ChromeForTesting${/}chrome.exe
${CHROME_DRIVER_PATH}        ${EXECDIR}${/}ChromeForTesting${/}chromedriver.exe
@{LANGUAGES}
...    en
...    th
...    zn

@{EXPECTED_WORDS_EN}
...   Increase Research Funding
...   Fill in the research funddetails
...   Capital Level
...   Research Fund Name
...   Supporting Agencies / Research Projects 


@{EXPECTED_WORDS__TH}
...    เพิ่มเงินทุนวิจัย
...    กรอกข้อมูลเงินทุนวิจัย
...    ประเภทของเงินทุนวิจัย
...    ระดับทุน
...    ชื่อเงินทุนวิจัย
...    หน่วยงานที่สนับสนุน / โครงการวิจัย


@{EXPECTED_WORDS_CN}
...   增加研究资金 
...   填写研究资金详情
...    研究资助类型
...    资金级别
...    研究基金名称
...    支持机构/研究项目

 

* Keywords *

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
    Wait Until Element Is Visible    id=username    10s
    Input Text      id=username    ${USER_USERNAME}
    Wait Until Element Is Visible    id=password    10s
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



* Test Cases *

Switch Language To CN
    [Tags]    UAT001-UserProfile
    Open Browser To Login Page
    Login Page Should Be Open
    User Login

    ${current_url}=    Get Location
    Log To Console    After Login URL: ${current_url}

    Go To    ${FUN ADD URL}
    Sleep    3s
    ${current_url}=    Get Location
    Log To Console    After Go To URL: ${current_url}
    Location Should Be    ${FUN ADD URL}

    Click Element    id=navbarDropdown
    Wait Until Element Is Visible    css:ul.dropdown-menu[aria-labelledby="navbarDropdown"]    10s
    Click Element    xpath=//a[contains(@href, "/language/zh")]
    Sleep    3s
    Reload Page
    Sleep    3s

    ${new_lang}=    Get Text    id=navbarDropdown
    Log To Console    New language after switch: ${new_lang}
    Should Contain    ${new_lang}    中文

    ${html_source}=    Get Source
    Log To Console    Page HTML: ${html_source}

    FOR    ${word}    IN    @{EXPECTED_WORDS_CN}

        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END

    Sleep    3s
    Close Browser

Switch Language To EN
    [Tags]    UAT001-UserProfile
    Open Browser To Login Page
    Login Page Should Be Open
    User Login

    ${current_url}=    Get Location
    Log To Console    After Login URL: ${current_url}

    Go To    ${FUN ADD URL}
    Sleep    3s
    ${current_url}=    Get Location
    Log To Console    After Go To URL: ${current_url}
    Location Should Be    ${FUN ADD URL}

    Click Element    id=navbarDropdown
    Wait Until Element Is Visible    css:ul.dropdown-menu[aria-labelledby="navbarDropdown"]    10s
    Click Element    xpath=//a[contains(@href, "/language/en")]
    Sleep    3s
    Reload Page
    Sleep    3s

    ${new_lang}=    Get Text    id=navbarDropdown
    Log To Console    New language after switch: ${new_lang}
    Should Contain    ${new_lang}    English

    ${html_source}=    Get Source
    Log To Console    Page HTML: ${html_source}

    FOR    ${word}    IN    @{EXPECTED_WORDS_EN}

        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END

    Sleep    3s
    Close Browser

Switch Language To TH
    [Tags]    UAT001-UserProfile
    Open Browser To Login Page
    Login Page Should Be Open
    User Login

    ${current_url}=    Get Location
    Log To Console    After Login URL: ${current_url}

    Go To    ${FUN ADD URL}
    Sleep    3s
    ${current_url}=    Get Location
    Log To Console    After Go To URL: ${current_url}
    Location Should Be    ${FUN ADD URL}

    Click Element    id=navbarDropdown
    Wait Until Element Is Visible    css:ul.dropdown-menu[aria-labelledby="navbarDropdown"]    10s
    Click Element    xpath=//a[contains(@href, "/language/th")]
    Sleep    3s
    Reload Page
    Sleep    3s

    ${new_lang}=    Get Text    id=navbarDropdown
    Log To Console    New language after switch: ${new_lang}
    Should Contain    ${new_lang}    ไทย

    ${html_source}=    Get Source
    Log To Console    Page HTML: ${html_source}

    FOR    ${word}    IN    @{EXPECTED_WORDS_TH}

        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END

    Sleep    3s
    Close Browser