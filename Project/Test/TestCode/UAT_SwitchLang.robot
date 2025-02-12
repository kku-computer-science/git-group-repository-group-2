*** Settings ***
Resource          resource.robot

*** Variables ***
@{EXPECTED_WORDS_HOME}    รายงานจำนวนบทความทั้งหมด (สะสมในช่วง 5 ปี)    จำนวน    ปี    งานวิจัยทั้งหมด    ผลงานตีพิมพ์ (5 ปี ย้อนหลัง)
@{EXPECTED_WORDS_DEPARTMENT_CS}    นักวิจัย    สาขาวิชาวิทยาการคอมพิวเตอร์    งานวิจัยที่สนใจ    ค้นหา
@{EXPECTED_WORDS_DEPARTMENT_IT}    นักวิจัย    สาขาวิชาเทคโนโลยีสารสนเทศ    งานวิจัยที่สนใจ    ค้นหา
@{EXPECTED_WORDS_DEPARTMENT_GIS}    นักวิจัย    สาขาวิชาภูมิสารสนเทศศาสตร์    งานวิจัยที่สนใจ    ค้นหา
@{EXPECTED_WORDS_RESEARCH_PROJECT}    โครงการบริการวิชาการ / โครงการวิจัย    แสดง    รายการ    ค้นหา    ลำดับ    ปี    ชื่อโครงการ    รายละเอียด    หัวหน้าโครงการ    สถานะ    ปิดโครงการ
@{EXPECTED_WORDS_RESEARCH_GROUP}    กลุ่มวิจัย   ผู้ดูแลห้องปฏิบัติการ    รายละเอียดเพิ่มเติม
@{EXPECTED_WORDS_RESEARCH_GROUP_DETAIL}    ผู้ดูแลห้องปฏิบัติการ    นักศึกษา
@{EXPECTED_WORDS_REPORT}    สถิติจำนวนบทความทั้งหมด 5 ปี    สถิติจำนวนบทความที่ได้รับการอ้างอิง
@{EXPECTED_WORDS_NAV_BAR}    หน้าแรก    สาขาวิชา    โครงการวิจัย    กลุ่มวิจัย    รายงาน
@{EXPECTED_PATHS}    http://${SERVER}/researchers/1    http://${SERVER}/researchers/2    http://${SERVER}/researchers/3
@{EXPECTED_WORDS_DEPARTMENT_EN}    Computer Science    Infomation Technology    Geo-Informatics
@{EXPECTED_WORDS_DEPARTMENT_TH}    สาขาวิชาวิทยาการคอมพิวเตอร์    สาขาวิชาเทคโนโลยีสารสนเทศ    สาขาวิชาภูมิสารสนเทศศาสตร์

*** Test Cases ***
Open Department Dropdown
    [Tags]    UAT001-OpenDepartmentDropdown
    Open Browser To Home Page
    Sleep    5s
    Click Element    id=navbarDropdown
    Wait Until Element Is Visible    css:ul.dropdown-menu[aria-labelledby="navbarDropdown"]    10s
    ${class_value}=    Get Element Attribute    id=navbarDropdown    class
    Should Contain    ${class_value}    show
    [Teardown]    Close Browser

Open SwitchLanguage Dropdown TH
    [Tags]    UAT002-OpenSwitchLanguageDropdown
    Open Browser To Home Page
    Sleep    5s
    Click Element    id=navbarDropdownMenuLink
    Wait Until Element Is Visible    css:div.dropdown-menu[aria-labelledby="navbarDropdownMenuLink"]    10s
    ${option_text}=    Get Text    xpath=(//div[contains(@class,"dropdown-menu") and @aria-labelledby="navbarDropdownMenuLink"]//a[contains(@class, "dropdown-item")])[1]
    Log    Option language is: ${option_text}
    Click Element    xpath=(//div[contains(@class,"dropdown-menu") and @aria-labelledby="navbarDropdownMenuLink"]//a[contains(@class, "dropdown-item")])[1]
    Sleep    5s
    ${new_lang}=    Get Text    id=navbarDropdownMenuLink
    Log    New language is: ${new_lang}
    Should Contain    ${new_lang}    ${option_text}
    [Teardown]    Close Browser

Open SwitchLanguage Dropdown EN
    [Tags]    UAT002-OpenSwitchLanguageDropdown
    Open Browser To Home Page
    Sleep    5s
    ${current_lang}=    Get Text    id=navbarDropdownMenuLink
    Log    Current language is: ${current_lang}
    Should Be Equal As Strings    ${current_lang}    ENGLISH
    Click Element    id=navbarDropdownMenuLink
    Wait Until Element Is Visible    css:div.dropdown-menu[aria-labelledby="navbarDropdownMenuLink"]    10s
    ${thai_option}=    Get Text    xpath=(//div[contains(@class,"dropdown-menu") and @aria-labelledby="navbarDropdownMenuLink"]//a[contains(@class, "dropdown-item")])[1]
    Log    Option language to switch to TH: ${thai_option}
    Click Element    xpath=(//div[contains(@class,"dropdown-menu") and @aria-labelledby="navbarDropdownMenuLink"]//a[contains(@class, "dropdown-item")])[1]
    Sleep    5s
    ${lang_after_thai}=    Get Text    id=navbarDropdownMenuLink
    Log    Language after switching to TH: ${lang_after_thai}
    Should Not Be Equal As Strings    ${lang_after_thai}    ENGLISH
    Click Element    id=navbarDropdownMenuLink
    Wait Until Element Is Visible    css:div.dropdown-menu[aria-labelledby="navbarDropdownMenuLink"]    10s
    ${english_option}=    Get Text    xpath=(//div[contains(@class,"dropdown-menu") and @aria-labelledby="navbarDropdownMenuLink"]//a[contains(@class, "dropdown-item")])[1]
    Log    Option language to switch back to EN: ${english_option}
    Click Element    xpath=(//div[contains(@class,"dropdown-menu") and @aria-labelledby="navbarDropdownMenuLink"]//a[contains(@class, "dropdown-item")])[1]
    Sleep    5s
    ${lang_after_english}=    Get Text    id=navbarDropdownMenuLink
    Log    Language after switching back to EN: ${lang_after_english}
    Should Be Equal As Strings    ${lang_after_english}    ENGLISH
    [Teardown]    Close Browser

Verify Dropdown Contains Specific Word EN
    [Tags]    UAT003-VerifyDropdownContainsSpecificWord
    Open Browser To Home Page
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
    [Tags]    UAT004-VerifyDropdownContainsSpecificWord
    Open Browser To Home Page
    Sleep    5s
    Click Element    id=navbarDropdownMenuLink
    Wait Until Element Is Visible    css:div.dropdown-menu[aria-labelledby="navbarDropdownMenuLink"]    10s
    ${option_text}=    Get Text    xpath=(//div[contains(@class,"dropdown-menu") and @aria-labelledby="navbarDropdownMenuLink"]//a[contains(@class, "dropdown-item")])[1]
    Log    Option language is: ${option_text}
    Click Element    xpath=(//div[contains(@class,"dropdown-menu") and @aria-labelledby="navbarDropdownMenuLink"]//a[contains(@class, "dropdown-item")])[1]
    Sleep    5s
    ${new_lang}=    Get Text    id=navbarDropdownMenuLink
    Log    New language is: ${new_lang}
    Should Contain    ${new_lang}    ${option_text}
    Click Element    id=navbarDropdown
    Wait Until Element Is Visible    css:ul.dropdown-menu[aria-labelledby="navbarDropdown"]    10s
    ${dropdown_text}=    Get Text    css:ul.dropdown-menu[aria-labelledby="navbarDropdown"]
    Log    Dropdown text: ${dropdown_text}
    FOR    ${word}    IN    @{EXPECTED_WORDS_DEPARTMENT_TH}
        Log    Checking for: ${word}
        Should Contain    ${dropdown_text}    ${word}
    END
    [Teardown]    Close Browser

Switch Language And Verify Summary Texts In Nav Bar
    [Tags]    UAT005-VerifySummaryTextHomePage
    Open Browser To Home Page
    Sleep    5s
    Click Element    id=navbarDropdownMenuLink
    Wait Until Element Is Visible    css:div.dropdown-menu[aria-labelledby="navbarDropdownMenuLink"]    10s
    Click Element    xpath=(//div[contains(@class, "dropdown-menu") and @aria-labelledby="navbarDropdownMenuLink"]//a[contains(@class, "dropdown-item")])[1]
    Sleep    5s
    ${html_source}=    Get Source
    Log    HTML Source: ${html_source}
    FOR    ${word}    IN    @{EXPECTED_WORDS_NAV_BAR}
        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END
    [Teardown]    Close Browser

Switch Language And Verify Summary Texts In Home Page
    [Tags]    UAT006-VerifySummaryTextHomePage
    Open Browser To Home Page
    Sleep    5s
    Click Element    id=navbarDropdownMenuLink
    Wait Until Element Is Visible    css:div.dropdown-menu[aria-labelledby="navbarDropdownMenuLink"]    10s
    Click Element    xpath=(//div[contains(@class, "dropdown-menu") and @aria-labelledby="navbarDropdownMenuLink"]//a[contains(@class, "dropdown-item")])[1]
    Sleep    5s
    ${html_source}=    Get Source
    Log    HTML Source: ${html_source}
    FOR    ${word}    IN    @{EXPECTED_WORDS_HOME}
        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END
    [Teardown]    Close Browser

Switch Language And Verify Summary Texts In Researcher_CS Page
    [Tags]    UAT007-VerifySummaryTextHomePage
    Open Browser To Researcher_CS Page
    Sleep    5s
    Click Element    id=navbarDropdownMenuLink
    Wait Until Element Is Visible    css:div.dropdown-menu[aria-labelledby="navbarDropdownMenuLink"]    10s
    Click Element    xpath=(//div[contains(@class, "dropdown-menu") and @aria-labelledby="navbarDropdownMenuLink"]//a[contains(@class, "dropdown-item")])[1]
    Sleep    5s
    ${html_source}=    Get Source
    Log    HTML Source: ${html_source}
    FOR    ${word}    IN    @{EXPECTED_WORDS_DEPARTMENT_CS}
        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END
    [Teardown]    Close Browser

Switch Language And Verify Summary Texts In Researcher_IT Page
    [Tags]    UAT008-VerifySummaryTextHomePage
    Open Browser To Researcher_IT Page
    Sleep    5s
    Click Element    id=navbarDropdownMenuLink
    Wait Until Element Is Visible    css:div.dropdown-menu[aria-labelledby="navbarDropdownMenuLink"]    10s
    Click Element    xpath=(//div[contains(@class, "dropdown-menu") and @aria-labelledby="navbarDropdownMenuLink"]//a[contains(@class, "dropdown-item")])[1]
    Sleep    5s
    ${html_source}=    Get Source
    Log    HTML Source: ${html_source}
    FOR    ${word}    IN    @{EXPECTED_WORDS_DEPARTMENT_IT}
        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END
    [Teardown]    Close Browser

Switch Language And Verify Summary Texts In Researcher_GIS Page
    [Tags]    UAT009-VerifySummaryTextHomePage
    Open Browser To Researcher_GIS Page
    Sleep    5s
    Click Element    id=navbarDropdownMenuLink
    Wait Until Element Is Visible    css:div.dropdown-menu[aria-labelledby="navbarDropdownMenuLink"]    10s
    Click Element    xpath=(//div[contains(@class, "dropdown-menu") and @aria-labelledby="navbarDropdownMenuLink"]//a[contains(@class, "dropdown-item")])[1]
    Sleep    5s
    ${html_source}=    Get Source
    Log    HTML Source: ${html_source}
    FOR    ${word}    IN    @{EXPECTED_WORDS_DEPARTMENT_GIS}
        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END
    [Teardown]    Close Browser

Switch Language And Verify Summary Texts In Research_Project Page
    [Tags]    UAT010-VerifySummaryTextHomePage
    Open Browser To Research_Project Page
    Sleep    5s
    Click Element    id=navbarDropdownMenuLink
    Wait Until Element Is Visible    css:div.dropdown-menu[aria-labelledby="navbarDropdownMenuLink"]    10s
    Click Element    xpath=(//div[contains(@class, "dropdown-menu") and @aria-labelledby="navbarDropdownMenuLink"]//a[contains(@class, "dropdown-item")])[1]
    Sleep    5s
    ${html_source}=    Get Source
    Log    HTML Source: ${html_source}
    FOR    ${word}    IN    @{EXPECTED_WORDS_RESEARCH_PROJECT}
        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END
    [Teardown]    Close Browser

Switch Language And Verify Summary Texts In Research_Group Page
    [Tags]    UAT011-VerifySummaryTextHomePage
    Open Browser To Research_Group Page
    Sleep    5s
    Click Element    id=navbarDropdownMenuLink
    Wait Until Element Is Visible    css:div.dropdown-menu[aria-labelledby="navbarDropdownMenuLink"]    10s
    Click Element    xpath=(//div[contains(@class, "dropdown-menu") and @aria-labelledby="navbarDropdownMenuLink"]//a[contains(@class, "dropdown-item")])[1]
    Sleep    5s
    ${html_source}=    Get Source
    Log    HTML Source: ${html_source}
    FOR    ${word}    IN    @{EXPECTED_WORDS_RESEARCH_GROUP}
        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END
    [Teardown]    Close Browser

Switch Language And Verify Summary Texts In Research_Group_Detail Page
    [Tags]    UAT012-VerifySummaryTextHomePage
    Open Browser To Research_Group_Detail Page
    Sleep    5s
    Click Element    id=navbarDropdownMenuLink
    Wait Until Element Is Visible    css:div.dropdown-menu[aria-labelledby="navbarDropdownMenuLink"]    10s
    Click Element    xpath=(//div[contains(@class, "dropdown-menu") and @aria-labelledby="navbarDropdownMenuLink"]//a[contains(@class, "dropdown-item")])[1]
    Sleep    5s
    ${html_source}=    Get Source
    Log    HTML Source: ${html_source}
    FOR    ${word}    IN    @{EXPECTED_WORDS_RESEARCH_GROUP_DETAIL}
        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END
    [Teardown]    Close Browser

Switch Language And Verify Summary Texts In Report Page
    [Tags]    UAT013-VerifySummaryTextHomePage
    Open Browser To Report Page
    Sleep    5s
    Click Element    id=navbarDropdownMenuLink
    Wait Until Element Is Visible    css:div.dropdown-menu[aria-labelledby="navbarDropdownMenuLink"]    10s
    Click Element    xpath=(//div[contains(@class, "dropdown-menu") and @aria-labelledby="navbarDropdownMenuLink"]//a[contains(@class, "dropdown-item")])[1]
    Sleep    5s
    ${html_source}=    Get Source
    Log    HTML Source: ${html_source}
    FOR    ${word}    IN    @{EXPECTED_WORDS_REPORT}
        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END
    [Teardown]    Close Browser
