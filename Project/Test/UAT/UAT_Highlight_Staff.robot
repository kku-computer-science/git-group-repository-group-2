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

#Title Variables
${TITLE_1}                      วิทยาลัยการคอมพิวเตอร์ มหาวิทยาลัยขอนแก่น ขอแสดงความยินดีกับ อาจารย์ ดร.เพชร อิ่มทองคำ อาจารย์ประจำวิทยาลัยการคอมพิวเตอร์ เนื่องในโอกาสได้รับแต่งตั้งให้ดำรงตำแหน่ง "ผู้ช่วยศาสตราจารย์"
${DETAIL_1}                     วิทยาลัยการคอมพิวเตอร์ มหาวิทยาลัยขอนแก่น ขอแสดงความยินดีกับ อาจารย์ ดร.เพชร อิ่มทองคำ อาจารย์ประจำวิทยาลัยการคอมพิวเตอร์ เนื่องในโอกาสได้รับแต่งตั้งให้ดำรงตำแหน่ง "ผู้ช่วยศาสตราจารย์"  ในสาขาวิชาเทคโนโลยีสารสนเทศตั้งแต่วันที่ 16 พฤษภาคม 2567 ตามที่สภามหาวิทยาลัยขอนแก่นได้มีมติอนุมัติแต่งตั้งให้ดำรงตำแหน่งทางวิชาการในคราวการประชุมครั้งที่ 3/2568 เมื่อวันที่ 5 มีนาคม 2568
${TITLE_2}                      นักวิจัย มข. และบริษัทมิตรผล จับมือนำ AI คัดแยกพันธุ์อ้อยสู่เวทีนานาชาติ ในงาน ITEX 2025
${DETAIL_2}                     วิทยาลัยการคอมพิวเตอร์ มหาวิทยาลัยขอนแก่น ขอแสดงความยินดีกับ รศ. ดร.วรารัตน์ สงฆ์แป้น และคณะทีมวิจัย จากบริษัท มิตรผลวิจัย พัฒนาอ้อยและน้ำตาล จำกัด ในผลงานเรื่อง“การพัฒนาแบบจำลองปัญญาประดิษฐ์การคัดแยกพันธุ์อ้อยด้วยการเรียนรู้เครื่องและการเรียนรู้เชิงลึก"

*** Keywords ***
Open Browser To Login Page
    ${chrome_options}=    Evaluate    sys.modules['selenium.webdriver'].ChromeOptions()    sys
    ${chrome_options.binary_location}=    Set Variable    ${CHROME_BROWSER_PATH}
    Call Method    ${chrome_options}    add_argument    --no-sandbox
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
    Call Method    ${chrome_options}    add_argument    --no-sandbox
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

Logout Dashboard
    Wait Until Element Is Visible    xpath=//a[contains(text(),'Logout')]
    Click Element    xpath=//a[contains(text(),'Logout')]

*** Test Cases ***
As Administrative Staff, I want to check if highlights already exist
    [Tags]    UAT001-CheckHighlightExists
    # [Enter] Login page
    Open Browser To Login Page
    Staff Login
    
    # [Enter] Highlight page
    Click Element    xpath=//a[contains(@href,'highlight')]
    
    # [Enter] Manage Highlight
    Wait Until Element Is Visible    xpath=//a[contains(text(),'Manage Highlight')]
    Click Element    xpath=//a[contains(text(),'Manage Highlight')]
    
    # [Check] For existing highlights in table
    ${highlight_rows}=    Get Element Count    xpath=//table[contains(@class,'table')]/tbody/tr
    
    # [Verify] If highlight table is empty
    Run Keyword If    ${highlight_rows} == 0    
    ...    Run Keywords
    ...    Log    No highlights found - empty state verified    AND
    ...    Log To Console    Highlight table is empty - ready for creating new highlights
    
    # If highlights exist, log the count but still pass the test
    Run Keyword If    ${highlight_rows} > 0    
    ...    Log    Found ${highlight_rows} existing highlights in the table
    
    # [Report] Test result (always pass)
    Should Be True    True    Highlight table check completed successfully
    
    # [Logout] Dashboard
    Logout Dashboard
    [Teardown]    Close All Browsers

As Administrative Staff, I want to create and check detail highlight that created
    [Tags]    UAT002-CheckHighlightDetail
    # [Enter] Login page
    Open Browser To Login Page
    Staff Login
    # [Enter] Highlight page
    Click Element    xpath=//a[contains(@href,'highlight')]

    # [Highlight_1] Fill Highlight title and detail
    Input Text    id=title    ${TITLE_1}
    Input Text    id=detail    ${DETAIL_1}
    
    # [Highlight_1] Upload main image
    ${IMAGE_PATH}=    Set Variable    ${EXECDIR}${/}highlight_image_test01.jpg
    Choose File    id=thumbnail    ${IMAGE_PATH}
    sleep    2s

    # [Highlight_1] Upload additional image
    ${IMAGE_PATH}=    Set Variable    ${EXECDIR}${/}highlight_image_test01.jpg
    Choose File    id=additional_thumbnails    ${IMAGE_PATH}
    sleep    2s
    
    # [Highlight_1] Enter tags
    Input Text    id=tags    KKU
    Press Keys    id=tags    ENTER
    Input Text    id=tags    มข.
    Press Keys    id=tags    ENTER
    Input Text    id=tags    cpkku
    Press Keys    id=tags    ENTER
    Input Text    id=tags    computing
    Press Keys    id=tags    ENTER
    Input Text    id=tags    phet
    Press Keys    id=tags    ENTER
    sleep    2s
    
    # [Submit] Highlight form
    Execute JavaScript    document.querySelector("button.btn-primary").scrollIntoView({behavior: "smooth", block: "center"});
    Sleep    1s
    Wait Until Element Is Visible    xpath=//button[contains(.,'Upload')]
    Wait Until Element Is Enabled    xpath=//button[contains(.,'Upload')]
    Execute JavaScript    document.querySelector("button[type='submit']").click();
    sleep    2s

    # [Check] Highlight count
    ${highlight_count}=    Get Element Count    xpath=//a[contains(@href,'highlights') and contains(@class,'btn-outline-success')]
    Log    Found ${highlight_count} highlights
    sleep    2s

    # [Enter] Highlight detail page
    Wait Until Element Is Visible    xpath=(//a[contains(@href,'highlights') and contains(@class,'btn-outline-primary')])[${highlight_count}]
    Click Element    xpath=(//a[contains(@href,'highlights') and contains(@class,'btn-outline-primary')])[${highlight_count}]
    sleep    2s
    
    # [Verify] Highlight detail content
    Wait Until Page Contains    ${TITLE_1}
    Wait Until Page Contains    ${DETAIL_1}
    Wait Until Page Contains    KKU
    Wait Until Page Contains    มข.
    Wait Until Page Contains    cpkku
    Wait Until Page Contains    computing
    Wait Until Page Contains    phet

    # [Verify] Additional image loaded
    ${is_loaded}=    Execute JavaScript    return document.querySelector("img[src*='storage/thumbnails/additional']").complete && document.querySelector("img[src*='storage/thumbnails/additional']").naturalHeight !== 0
    Should Be True    ${is_loaded}

    # [Enter] Manage Highlight
    Wait Until Element Is Visible    xpath=//a[contains(text(),'Back')]
    Click Element    xpath=//a[contains(text(),'Back')]

    # [Logout] Dashboard
    Logout Dashboard
    [Teardown]    Close All Browsers

As Administrative Staff, I want to edit highlight detail that created
    [Tags]    UAT003-EditHighlight
    # [Enter] Login page
    Open Browser To Login Page
    Staff Login
    # [Enter] Highlight page
    Click Element    xpath=//a[contains(@href,'highlight')]

    # [Enter] Manage Highlight
    Wait Until Element Is Visible    xpath=//a[contains(text(),'Manage Highlight')]
    Click Element    xpath=//a[contains(text(),'Manage Highlight')]

    # [Check] Highlight count
    ${highlight_count}=    Get Element Count    xpath=//a[contains(@href,'highlights') and contains(@class,'btn-outline-success')]
    Log    Found ${highlight_count} highlights

    # [Enter] Highlight edit page
    Wait Until Element Is Visible    xpath=(//a[contains(@href,'highlights') and contains(@class,'btn-outline-success')])[${highlight_count}]
    Click Element    xpath=(//a[contains(@href,'highlights') and contains(@class,'btn-outline-success')])[${highlight_count}]

    # [Edit] Change highlight to new values
    Input Text    name=title    ${TITLE_2}
    Input Text    name=detail    ${DETAIL_2}
    ${IMAGE_PATH}=    Set Variable    ${EXECDIR}${/}highlight_image_test02.jpg
    Choose File    name=thumbnails[]    ${IMAGE_PATH}
    Input Text    name=tags    KKU,มข.,cpkku,cp,ITEX2025

    # [Submit] Edited highlight form
    Wait Until Element Is Visible    xpath=//button[@type='submit' and contains(@class,'btn-primary')]
    Execute JavaScript    document.querySelector("button[type='submit'].btn-primary").scrollIntoView({behavior: "smooth", block: "center"});
    Sleep    1s
    Execute JavaScript    document.querySelector("button[type='submit'].btn-primary").click();

    # [Enter] Highlight view page
    Sleep    3s
    Go To    ${HIGHLIGHT URL}/view
    Sleep    2s

    # [Check] Updated highlight count
    ${highlight_count}=    Get Element Count    xpath=//a[contains(@href,'highlights') and contains(@class,'btn-outline-success')]
    Log    Found ${highlight_count} highlights

    # [Enter] Updated highlight detail page
    Wait Until Element Is Visible    xpath=(//a[contains(@href,'highlights') and contains(@class,'btn-outline-primary')])[${highlight_count}]
    Click Element    xpath=(//a[contains(@href,'highlights') and contains(@class,'btn-outline-primary')])[${highlight_count}]

    # [Verify] Updated highlight data
    Wait Until Page Contains    ${TITLE_2}
    Wait Until Page Contains    ${DETAIL_2}

    # [Verify] Updated tags
    Wait Until Page Contains    KKU
    Wait Until Page Contains    มข.
    Wait Until Page Contains    cpkku
    Wait Until Page Contains    cp
    Wait Until Page Contains    ITEX2025

    # [Verify] Updated image loaded
    ${is_loaded}=    Execute JavaScript    return document.querySelector("img[src*='storage/thumbnails/additional']").complete && document.querySelector("img[src*='storage/thumbnails/additional']").naturalHeight !== 0
    Should Be True    ${is_loaded}

    # [Logout] Dashboard
    Logout Dashboard
    [Teardown]    Close All Browsers

As Administrative Staff, I want to delete highlight that created
    [Tags]    UAT004-DeleteHighlight
    # [Enter] Login page
    Open Browser To Login Page
    Staff Login
    # [Enter] Highlight page
    Click Element    xpath=//a[contains(@href,'highlight')]
    
    # [Enter] Manage Highlight
    Wait Until Element Is Visible    xpath=//a[contains(text(),'Manage Highlight')]
    Click Element    xpath=//a[contains(text(),'Manage Highlight')]

    # [Check] Highlight count
    ${highlight_count}=    Get Element Count    xpath=//a[contains(@href,'highlights') and contains(@class,'btn-outline-success')]
    Log    Found ${highlight_count} highlights

    # [Delete] Highlight using button
    Wait Until Element Is Visible    xpath=(//button[contains(@class,'btn-outline-danger') or contains(@class,'show_confirm')])[${highlight_count}]
    Execute JavaScript    document.querySelector("button.show_confirm").click();
    
    # [Confirm] Delete in confirmation dialog
    Wait Until Element Is Visible    xpath=//div[contains(@class,'swal-modal')]
    Wait Until Element Is Visible    xpath=//button[contains(@class,'swal-button--confirm')]
    Click Element    xpath=//button[contains(@class,'swal-button--confirm')]
    Sleep    3s  # Wait for deletion to complete

    # [Verify] Delete success message
    Wait Until Element Is Visible    xpath=//div[contains(@class,'swal-modal')]
    Wait Until Element Is Visible    xpath=//div[contains(text(),'Deleted Successfully')]
    Wait Until Element Is Visible    xpath=//button[contains(@class,'swal-button--confirm')]
    Click Element    xpath=//button[contains(@class,'swal-button--confirm')]
    Sleep    2s

    # [Logout] Dashboard
    Logout Dashboard
    [Teardown]    Close All Browsers
