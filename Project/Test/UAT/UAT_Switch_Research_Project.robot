*** Settings ***
Library           SeleniumLibrary

*** Variables ***
${SERVER}                    localhost:8000
${HOME URL}                  http://${SERVER}/
${RESEARCH_PROJECT URL}      http://${SERVER}/researchproject
${CHROME_BROWSER_PATH}       ${EXECDIR}${/}ChromeForTesting${/}chrome.exe
${CHROME_DRIVER_PATH}        ${EXECDIR}${/}ChromeForTesting${/}chromedriver.exe
@{EXPECTED_WORDS_RESEACHPROJECT_EN}
...    Academic Service Projects / Research Projects
...    Show
...    Entries
...    Search :
...    No.
...    Project Name
...    Details
...    Project Leader
...    Status
...    Project Duration
...    Research Fund Type
...    Funding Agency
...    Responsible Agency
...    Allocated Budget
...    Project Closed
...    Baht
@{EXPECTED_WORDS_RESEACHPROJECT_TH}
...    โครงการบริการวิชาการ / โครงการวิจัย
...    แสดง
...    รายการ
...    ค้นหา :
...    ลำดับที่
...    ชื่อโครงการ
...    รายละเอียด
...    หัวหน้าโครงการ
...    สถานะ
...    ระยะเวลาโครงการ
...    ประเภททุนวิจัย
...    หน่วยงานผู้ให้ทุน
...    หน่วยงานที่รับผิดชอบ
...    งบประมาณที่จัดสรร
...    โครงการปิดแล้ว
...    บาท
@{EXPECTED_WORDS_RESEACHPROJECT_CN}
...    学术服务项目/研究项目
...    搜索：
...    显示
...    记录
...    编号
...    年份
...    项目名称
...    详情
...    项目负责人
...    状态
...    项目周期
...    研究基金类型
...    资助机构
...    责任机构
...    拨款预算
...    项目结束
...    泰铢

*** Keywords ***
Open Browser To Research_Project Page
    ${chrome_options}=    Evaluate    sys.modules['selenium.webdriver'].ChromeOptions()    sys
    ${chrome_options.binary_location}=    Set Variable    ${CHROME_BROWSER_PATH}
    ${service}=    Evaluate    sys.modules["selenium.webdriver.chrome.service"].Service(executable_path=r"${CHROME_DRIVER_PATH}")
    Create Webdriver    Chrome    options=${chrome_options}    service=${service}
    Go To    ${RESEARCH_PROJECT URL}
    Research_Project Page Should Be Open
    Maximize Browser Window
    Wait Until Element Is Visible    css=.nav-item.dropdown    10s

Research_Project Page Should Be Open
    Location Should Be    ${RESEARCH_PROJECT URL}

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
Open Research_Project Page
    [Tags]    UAT001-OpenResearchProjectPage
    Open Browser To Research_Project Page
    Research_Project Page Should Be Open

Open Research_Project Page And Check EN
    [Tags]    UAT002-UAT002-SwitchToEnglishDirectlyAndCheck
    Open Browser To Research_Project Page
    Sleep    5s
    ${html_source}=    Get Source
    Log    HTML Source: ${html_source}
    FOR    ${word}    IN    @{EXPECTED_WORDS_RESEACHPROJECT_EN}
        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END
    Close Browser

Open Researcher_Profile Page And Check TH
    [Tags]   UAT003-SwitchToTHAndCheck
    Open Browser To Research_Project Page
    Switch Language To    th    ไทย
    Sleep    5s
    ${html_source}=    Get Source
    Log    HTML Source: ${html_source}
    FOR    ${word}    IN    @{EXPECTED_WORDS_RESEACHPROJECT_TH}
        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END
    Close Browser

Open Researcher_Profile Page And Check CN
    [Tags]   UAT004-SwitchToCNAndCheck
    Open Browser To Research_Project Page
    Switch Language To    zh    中文
    Sleep    5s
    ${html_source}=    Get Source
    Log    HTML Source: ${html_source}
    FOR    ${word}    IN    @{EXPECTED_WORDS_RESEACHPROJECT_CN}
        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END
    Close Browser
