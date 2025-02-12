*** Settings ***
Library           SeleniumLibrary

*** Variables ***
${SERVER}         localhost:8000
${HOME URL}      http://${SERVER}/
${RESEARCHER_CS URL}      http://${SERVER}/researchers/1
${RESEARCHER_IT URL}      http://${SERVER}/researchers/2
${RESEARCHER_GIS URL}      http://${SERVER}/researchers/3
${RESEARCH_PROJECT URL}      http://${SERVER}/researchproject
${RESEARCH_GROUP URL}      http://${SERVER}/researchgroup
${RESEARCH_GROUP_DETAIL URL}      http://${SERVER}/researchgroupdetail/3
${REPORT URL}    http://${SERVER}/reports
${CHROME_BROWSER_PATH}    ${EXECDIR}${/}ChromeForTesting${/}chrome.exe
${CHROME_DRIVER_PATH}    ${EXECDIR}${/}ChromeForTesting${/}chromedriver.exe

*** Keywords ***
Open Browser To Home Page
    ${chrome_options}    Evaluate    sys.modules['selenium.webdriver'].ChromeOptions()    sys
    ${chrome_options.binary_location}    Set Variable    ${CHROME_BROWSER_PATH}
    ${service}    Evaluate    sys.modules["selenium.webdriver.chrome.service"].Service(executable_path=r"${CHROME_DRIVER_PATH}")
    Create Webdriver    Chrome    options=${chrome_options}    service=${service}
    Go To    ${HOME URL}
    Home Page Should Be Open
    Maximize Browser Window
    Wait Until Element Is Visible    css=.nav-item.dropdown    10s

Home Page Should Be Open
    Location Should Be    ${Home URL}

Open Browser To Researcher_CS Page
    ${chrome_options}    Evaluate    sys.modules['selenium.webdriver'].ChromeOptions()    sys
    ${chrome_options.binary_location}    Set Variable    ${CHROME_BROWSER_PATH}
    ${service}    Evaluate    sys.modules["selenium.webdriver.chrome.service"].Service(executable_path=r"${CHROME_DRIVER_PATH}")
    Create Webdriver    Chrome    options=${chrome_options}    service=${service}
    Go To    ${RESEARCHER_CS URL}
    Researcher_CS Page Should Be Open
    Maximize Browser Window
    Wait Until Element Is Visible    css=.nav-item.dropdown    10s

Researcher_CS Page Should Be Open
    Location Should Be    ${RESEARCHER_CS URL}

Open Browser To Researcher_IT Page
    ${chrome_options}    Evaluate    sys.modules['selenium.webdriver'].ChromeOptions()    sys
    ${chrome_options.binary_location}    Set Variable    ${CHROME_BROWSER_PATH}
    ${service}    Evaluate    sys.modules["selenium.webdriver.chrome.service"].Service(executable_path=r"${CHROME_DRIVER_PATH}")
    Create Webdriver    Chrome    options=${chrome_options}    service=${service}
    Go To    ${RESEARCHER_IT URL}
    Researcher_IT Page Should Be Open
    Maximize Browser Window
    Wait Until Element Is Visible    css=.nav-item.dropdown    10s

Researcher_IT Page Should Be Open
    Location Should Be    ${RESEARCHER_IT URL}

Open Browser To Researcher_GIS Page
    ${chrome_options}    Evaluate    sys.modules['selenium.webdriver'].ChromeOptions()    sys
    ${chrome_options.binary_location}    Set Variable    ${CHROME_BROWSER_PATH}
    ${service}    Evaluate    sys.modules["selenium.webdriver.chrome.service"].Service(executable_path=r"${CHROME_DRIVER_PATH}")
    Create Webdriver    Chrome    options=${chrome_options}    service=${service}
    Go To    ${RESEARCHER_GIS URL}
    Researcher_GIS Page Should Be Open
    Maximize Browser Window
    Wait Until Element Is Visible    css=.nav-item.dropdown    10s

Researcher_GIS Page Should Be Open
    Location Should Be    ${RESEARCHER_GIS URL}

Open Browser To Research_Project Page
    ${chrome_options}    Evaluate    sys.modules['selenium.webdriver'].ChromeOptions()    sys
    ${chrome_options.binary_location}    Set Variable    ${CHROME_BROWSER_PATH}
    ${service}    Evaluate    sys.modules["selenium.webdriver.chrome.service"].Service(executable_path=r"${CHROME_DRIVER_PATH}")
    Create Webdriver    Chrome    options=${chrome_options}    service=${service}
    Go To    ${RESEARCH_PROJECT URL}
    Research_Project Page Should Be Open
    Maximize Browser Window
    Wait Until Element Is Visible    css=.nav-item.dropdown    10s

Research_Project Page Should Be Open
    Location Should Be    ${RESEARCH_PROJECT URL}

Open Browser To Research_Group Page
    ${chrome_options}    Evaluate    sys.modules['selenium.webdriver'].ChromeOptions()    sys
    ${chrome_options.binary_location}    Set Variable    ${CHROME_BROWSER_PATH}
    ${service}    Evaluate    sys.modules["selenium.webdriver.chrome.service"].Service(executable_path=r"${CHROME_DRIVER_PATH}")
    Create Webdriver    Chrome    options=${chrome_options}    service=${service}
    Go To    ${RESEARCH_GROUP URL}
    Research_Group Page Should Be Open
    Maximize Browser Window
    Wait Until Element Is Visible    css=.nav-item.dropdown    10s

Research_Group Page Should Be Open
    Location Should Be    ${RESEARCH_GROUP URL}

Open Browser To Research_Group_Detail Page
    ${chrome_options}    Evaluate    sys.modules['selenium.webdriver'].ChromeOptions()    sys
    ${chrome_options.binary_location}    Set Variable    ${CHROME_BROWSER_PATH}
    ${service}    Evaluate    sys.modules["selenium.webdriver.chrome.service"].Service(executable_path=r"${CHROME_DRIVER_PATH}")
    Create Webdriver    Chrome    options=${chrome_options}    service=${service}
    Go To    ${RESEARCH_GROUP_DETAIL URL}
    Research_Group_Detail Page Should Be Open
    Maximize Browser Window
    Wait Until Element Is Visible    css=.nav-item.dropdown    10s

Research_Group_Detail Page Should Be Open
    Location Should Be    ${RESEARCH_GROUP_DETAIL URL}

Open Browser To Report Page
    ${chrome_options}    Evaluate    sys.modules['selenium.webdriver'].ChromeOptions()    sys
    ${chrome_options.binary_location}    Set Variable    ${CHROME_BROWSER_PATH}
    ${service}    Evaluate    sys.modules["selenium.webdriver.chrome.service"].Service(executable_path=r"${CHROME_DRIVER_PATH}")
    Create Webdriver    Chrome    options=${chrome_options}    service=${service}
    Go To    ${REPORT URL}
    Report Page Should Be Open
    Maximize Browser Window
    Wait Until Element Is Visible    css=.nav-item.dropdown    10s

Report Page Should Be Open
    Location Should Be    ${REPORT URL}


        