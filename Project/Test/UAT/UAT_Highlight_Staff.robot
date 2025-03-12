*** Settings ***
Library           SeleniumLibrary

*** Variables ***
${SERVER}                    localhost:8000
${STAFF_USERNAME}             staff@gmail.com
${STAFF_PASSWORD}             123456789
${LOGIN URL}                  http://${SERVER}/login
${STAFF URL}                  http://${SERVER}/dashboard
${HIGHLIGHT URL}              http://${SERVER}/highlight
${CHROME_BROWSER_PATH}       ${EXECDIR}${/}ChromeForTesting${/}chrome.exe
${CHROME_DRIVER_PATH}        ${EXECDIR}${/}ChromeForTesting${/}chromedriver.exe

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

Open Browser To Staff Page
    ${chrome_options}=    Evaluate    sys.modules['selenium.webdriver'].ChromeOptions()    sys
    ${chrome_options.binary_location}=    Set Variable    ${CHROME_BROWSER_PATH}
    ${service}=    Evaluate    sys.modules["selenium.webdriver.chrome.service"].Service(executable_path=r"${CHROME_DRIVER_PATH}")
    Create Webdriver    Chrome    options=${chrome_options}    service=${service}
    Go To    ${STAFF URL}
    Staff Page Should Be Open
    Maximize Browser Window

Staff Page Should Be Open
    Location Should Be    ${STAFF URL}

Staff Login
    Input Text      id=username    ${STAFF_USERNAME}
    Input Text      id=password    ${STAFF_PASSWORD}
    Sleep    2s
    Click Button    xpath=//button[@type='submit']
    Location Should Be    ${STAFF URL} 

*** Test Cases ***
Dashboard Page Staff
    [Tags]    UAT001-OpenStaffPage
    Open Browser To Login Page
    Login Page Should Be Open
    Staff Login
    Sleep    2s
    Staff Page Should Be Open
    [Teardown]    Close All Browsers

Highlight Page Staff
    [Tags]    UAT002-OpenHighlightPage
    Open Browser To Login Page
    Staff Login
    Click Element    xpath=//a[contains(@href,'highlight')]
    Location Should Be    ${HIGHLIGHT URL}
    [Teardown]    Close All Browsers

*** Test Cases ***
Highlight Complete Form Submission
    [Tags]    UAT003-CompleteHighlightForm
    Open Browser To Login Page
    Staff Login
    Click Element    xpath=//a[contains(@href,'highlight')]
    Location Should Be    ${HIGHLIGHT URL}
    
    # Fill in title and detail
    Input Text    id=title    Test Highlight Title
    Input Text    id=detail    This is a detailed description for the test highlight submission.
    
    # Upload image
    ${IMAGE_PATH}=    Set Variable    ${EXECDIR}${/}1_up.png
    Choose File    id=thumbnail    ${IMAGE_PATH}
    
    # Verify image preview appears
    Wait Until Element Is Visible    id=preview
    Element Should Be Visible    id=preview
    
    # Enter tags
    Input Text    id=tags    Sports
    Press Keys    id=tags    ENTER
    Input Text    id=tags    News
    Press Keys    id=tags    ENTER
    
    # Verify tags appear in tag list
    Wait Until Element Contains    id=tag-list    Sports
    Element Should Contain    id=tag-list    News
    
    # Submit form (uncomment if you want to actually submit)
    # Click Button    xpath=//button[@type='submit']
    
    [Teardown]    Close All Browsers