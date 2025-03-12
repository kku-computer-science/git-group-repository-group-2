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
As Administrative Staff, I want to check highlight detail that created
    [Tags]    UAT001-CheckHighlightDetail
    Open Browser To Login Page
    Staff Login
    Click Element    xpath=//a[contains(@href,'highlight')]

    # [Highlight_1] Fill Highlight
    Input Text    id=title    ${TITLE_1}
    Input Text    id=detail    ${DETAIL_1}
    
    # [Highlight_1] Upload image
    ${IMAGE_PATH}=    Set Variable    ${EXECDIR}${/}highlight_image_test01.jpg
    Choose File    id=thumbnail    ${IMAGE_PATH}
    sleep    2s

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
    
    # [Highlight_1] Submit Form
    Execute JavaScript    document.querySelector("button.btn-primary").scrollIntoView({behavior: "smooth", block: "center"});
    Sleep    1s
    Wait Until Element Is Visible    xpath=//button[contains(.,'Upload')]
    Wait Until Element Is Enabled    xpath=//button[contains(.,'Upload')]
    Execute JavaScript    document.querySelector("button[type='submit']").click();
    sleep    2s

    ${highlight_count}=    Get Element Count    xpath=//a[contains(@href,'highlights') and contains(@class,'btn-outline-success')]
    Log    Found ${highlight_count} highlights
    sleep    2s

    # [Enter] Highlight detail page
    Wait Until Element Is Visible    xpath=(//a[contains(@href,'highlights') and contains(@class,'btn-outline-primary')])[${highlight_count}]
    Click Element    xpath=(//a[contains(@href,'highlights') and contains(@class,'btn-outline-primary')])[${highlight_count}]
    sleep    2s
    
    # [Highlight_1] Highlight detail page
    Wait Until Page Contains    ${TITLE_1}
    Wait Until Page Contains    ${DETAIL_1}
    # Wait Until Page Contains    KKU
    # Wait Until Page Contains    มข.
    # Wait Until Page Contains    cpkku
    # Wait Until Page Contains    computing
    # Wait Until Page Contains    phet

    # [Enter] Manage Highlight
    Wait Until Element Is Visible    xpath=//a[contains(text(),'Back')]
    Click Element    xpath=//a[contains(text(),'Back')]

    # [Logout] Logout
    Logout Dashboard
    [Teardown]    Close All Browsers

As Administrative Staff, I want to edit highlight detail that created
    [Tags]    UAT004-EditHighlight
    Open Browser To Login Page
    Staff Login
    Click Element    xpath=//a[contains(@href,'highlight')]

    # [Enter] Manage Highlight
    Wait Until Element Is Visible    xpath=//a[contains(text(),'Manage Highlight')]
    Click Element    xpath=//a[contains(text(),'Manage Highlight')]

    # Count the number of edit buttons to determine the latest
    ${highlight_count}=    Get Element Count    xpath=//a[contains(@href,'highlights') and contains(@class,'btn-outline-success')]
    Log    Found ${highlight_count} highlights

    # [Enter] Highlight edit page
    Wait Until Element Is Visible    xpath=(//a[contains(@href,'highlights') and contains(@class,'btn-outline-success')])[${highlight_count}]
    Click Element    xpath=(//a[contains(@href,'highlights') and contains(@class,'btn-outline-success')])[${highlight_count}]

    # [Edit_Highlight_1] Change highlight_1 to new values
    Input Text    name=title    ${TITLE_2}
    Input Text    name=detail    ${DETAIL_2}
    ${IMAGE_PATH}=    Set Variable    ${EXECDIR}${/}highlight_image_test02.jpg
    Choose File    name=thumbnails[]    ${IMAGE_PATH}
    Input Text    name=tags    KKU,มข.,cpkku,cp,ITEX2025

    # Submit the edited highlight form
    Wait Until Element Is Visible    xpath=//button[@type='submit' and contains(@class,'btn-primary')]
    Execute JavaScript    document.querySelector("button[type='submit'].btn-primary").scrollIntoView({behavior: "smooth", block: "center"});
    Sleep    1s
    Execute JavaScript    document.querySelector("button[type='submit'].btn-primary").click();

    Sleep    3s
    Go To    ${HIGHLIGHT URL}/view
    Sleep    2s

    # Count the number of edit buttons to determine the latest
    ${highlight_count}=    Get Element Count    xpath=//a[contains(@href,'highlights') and contains(@class,'btn-outline-success')]
    Log    Found ${highlight_count} highlights

    # [Enter] Highlight edit page - target the most recent highlight (last in list if order is oldest first)
    Wait Until Element Is Visible    xpath=(//a[contains(@href,'highlights') and contains(@class,'btn-outline-primary')])[${highlight_count}]
    Click Element    xpath=(//a[contains(@href,'highlights') and contains(@class,'btn-outline-primary')])[${highlight_count}]


    # [Highlight_1] Check detail page elements directly instead of using source
    Wait Until Page Contains    ${TITLE_2}
    Wait Until Page Contains    ${DETAIL_2}
    
    # # Check for tags
    # Page Should Contain Element    xpath=//span[contains(@class,'badge') and contains(text(),'KKU')]
    # Page Should Contain Element    xpath=//span[contains(@class,'badge') and contains(text(),'มข.')]
    # Page Should Contain Element    xpath=//span[contains(@class,'badge') and contains(text(),'cpkku')]
    # Page Should Contain Element    xpath=//span[contains(@class,'badge') and contains(text(),'cp')]
    # Page Should Contain Element    xpath=//span[contains(@class,'badge') and contains(text(),'ITEX2025')]

    # [Highlight_2] Check data
    Wait Until Page Contains    ${TITLE_2}
    Wait Until Page Contains    ${DETAIL_2}

    # Check for tags
    # Wait Until Page Contains    KKU
    # Wait Until Page Contains    มข.
    # Wait Until Page Contains    cpkku
    # Wait Until Page Contains   cp
    # Wait Until Page Contains    ITEX2025

    # [Logout] Logout
    Logout Dashboard
    [Teardown]    Close All Browsers

As Administrative Staff, I want to delete highlight that created
    [Tags]    UAT004-DeleteHighlight
    Open Browser To Login Page
    Staff Login
    Click Element    xpath=//a[contains(@href,'highlight')]
    
    # [Enter] Manage Highlight
    Wait Until Element Is Visible    xpath=//a[contains(text(),'Manage Highlight')]
    Click Element    xpath=//a[contains(text(),'Manage Highlight')]

    # Count the number of edit buttons to determine the latest
    ${highlight_count}=    Get Element Count    xpath=//a[contains(@href,'highlights') and contains(@class,'btn-outline-success')]
    Log    Found ${highlight_count} highlights

    # [Delete_Highlight_1] Highlight - using the button inside the form
    Wait Until Element Is Visible    xpath=(//button[contains(@class,'btn-outline-danger') or contains(@class,'show_confirm')])[${highlight_count}]
    Execute JavaScript    document.querySelector("button.show_confirm").click();
    
    # [Delete_Highlight_1] Handle the confirmation dialog for first highlight
    Wait Until Element Is Visible    xpath=//div[contains(@class,'swal-modal')]
    Wait Until Element Is Visible    xpath=//button[contains(@class,'swal-button--confirm')]
    Click Element    xpath=//button[contains(@class,'swal-button--confirm')]
    Sleep    3s  # Wait for deletion to complete

    # [Delete_Highlight_1] Handle the success modal after deletion
    Wait Until Element Is Visible    xpath=//div[contains(@class,'swal-modal')]
    Wait Until Element Is Visible    xpath=//div[contains(text(),'Deleted Successfully')]
    Wait Until Element Is Visible    xpath=//button[contains(@class,'swal-button--confirm')]
    Click Element    xpath=//button[contains(@class,'swal-button--confirm')]
    Sleep    2s

    # [Logout] Logout
    Logout Dashboard
    [Teardown]    Close All Browsers
