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

Logout Dashboard
    Wait Until Element Is Visible    xpath=//a[contains(text(),'Logout')]
    Click Element    xpath=//a[contains(text(),'Logout')]

*** Test Cases ***
# Open Dashboard Page Staff
#     [Tags]    UAT001-OpenStaffPages
#     Open Browser To Login Page
#     Login Page Should Be Open
#     Staff Login
#     Sleep    2s
#     Staff Page Should Be Open
#     [Teardown]    Close All Browsers

# Open Highlight Page Staff
#     [Tags]    UAT002-OpenHighlightPage
#     Open Browser To Login Page
#     Staff Login
#     Click Element    xpath=//a[contains(@href,'highlight')]
#     Location Should Be    ${HIGHLIGHT URL}
#     [Teardown]    Close All Browsers

# Highlight Complete Form Submission
#     [Tags]    UAT003-CompleteHighlightForm
#     Open Browser To Login Page
#     Staff Login
#     Click Element    xpath=//a[contains(@href,'highlight')]
#     Location Should Be    ${HIGHLIGHT URL}
    
#     # Fill in title and detail
#     Input Text    id=title    ${TITLE}
#     Input Text    id=detail    ${DETAIL} 
    
#     # Upload image
#     ${IMAGE_PATH}=    Set Variable    ${EXECDIR}${/}highlight_image_test01.jpg
#     Choose File    id=thumbnail    ${IMAGE_PATH}
    
#     # Verify image preview appears
#     Wait Until Element Is Visible    id=preview
#     Element Should Be Visible    id=preview
    
#     # Enter tags
#     Input Text    id=tags    KKU
#     Press Keys    id=tags    ENTER
#     Input Text    id=tags    มข.
#     Press Keys    id=tags    ENTER
#     Input Text    id=tags    cpkku
#     Press Keys    id=tags    ENTER
#     Input Text    id=tags    computing
#     Press Keys    id=tags    ENTER
#     Input Text    id=tags    phet
#     Press Keys    id=tags    ENTER
    
#     # Verify tags appear in tag list
#     Wait Until Element Contains    id=tag-list    KKU
#     Element Should Contain    id=tag-list    มข.
#     Element Should Contain    id=tag-list    cpkku
#     Element Should Contain    id=tag-list    computing
#     Element Should Contain    id=tag-list    phet
    
#     # Submit form (uncomment if you want to actually submit)
#     # Click Button    xpath=//button[@type='submit']
    
#     [Teardown]    Close All Browsers

# As Administrative Staff, I want to upload multiple highlights
#     [Tags]    UAT004-UploadMultipleHighlights
#     Open Browser To Login Page
#     Staff Login
#     Click Element    xpath=//a[contains(@href,'highlight')]
    
#     # [Highlight_1] Fill Highlight
#     Input Text    id=title    ${TITLE_1}
#     Input Text    id=detail    ${DETAIL_1}
    
#     # [Highlight_1] Upload image
#     ${IMAGE_PATH}=    Set Variable    ${EXECDIR}${/}highlight_image_test01.jpg
#     Choose File    id=thumbnail    ${IMAGE_PATH}
    
#     # [Highlight_1] Enter tags
#     Input Text    id=tags    KKU
#     Press Keys    id=tags    ENTER
#     Input Text    id=tags    มข.
#     Press Keys    id=tags    ENTER
#     Input Text    id=tags    cpkku
#     Press Keys    id=tags    ENTER
#     Input Text    id=tags    computing
#     Press Keys    id=tags    ENTER
#     Input Text    id=tags    phet
#     Press Keys    id=tags    ENTER
#     sleep    2s
    
#     # [Highlight_2] Submit Form
#     Execute JavaScript    document.querySelector("button.btn-primary").scrollIntoView({behavior: "smooth", block: "center"});
#     Sleep    1s

#     Wait Until Element Is Visible    xpath=//button[contains(.,'Upload')]
#     Wait Until Element Is Enabled    xpath=//button[contains(.,'Upload')]

#     Execute JavaScript    document.querySelector("button[type='submit']").click();

#     # [Highlight_2] Fill Highlight
#     Input Text    id=title    ${TITLE_2}
#     Input Text    id=detail    ${DETAIL_2}
    
#     # [Highlight_2] Upload image
#     ${IMAGE_PATH}=    Set Variable    ${EXECDIR}${/}highlight_image_test02.jpg
#     Choose File    id=thumbnail    ${IMAGE_PATH}
    
#     # [Highlight_2] Enter tags
#     Input Text    id=tags    KKU
#     Press Keys    id=tags    ENTER
#     Input Text    id=tags    มข.
#     Press Keys    id=tags    ENTER
#     Input Text    id=tags    cpkku
#     Press Keys    id=tags    ENTER
#     Input Text    id=tags    cp
#     Press Keys    id=tags    ENTER
#     Input Text    id=tags    ITEX2025
#     Press Keys    id=tags    ENTER
#     sleep    2s
    
#     # [Highlight_2] Submit Form
#     Execute JavaScript    document.querySelector("button.btn-primary").scrollIntoView({behavior: "smooth", block: "center"});
#     Sleep    1s

#     Wait Until Element Is Visible    xpath=//button[contains(.,'Upload')]
#     Wait Until Element Is Enabled    xpath=//button[contains(.,'Upload')]

#     Execute JavaScript    document.querySelector("button[type='submit']").click();

#     # [Enter] Manage Highlight
#     Wait Until Element Is Visible    xpath=//a[contains(text(),'Manage Highlight')]
#     Click Element    xpath=//a[contains(text(),'Manage Highlight')]

#     # [Highlight_1] Check data
#     ${html_source}=    Get Source
#     Should Contain    ${html_source}    ${TITLE_1}
#     Should Contain    ${html_source}    ${DETAIL_1}
#     Should Contain    ${html_source}    KKU
#     Should Contain    ${html_source}    มข.
#     Should Contain    ${html_source}    cpkku
#     Should Contain    ${html_source}    cp
#     Should Contain    ${html_source}    phet

#     # [Highlight_2] Check data
#     Should Contain    ${html_source}    ${TITLE_2}
#     Should Contain    ${html_source}    ${DETAIL_2}
#     Should Contain    ${html_source}    KKU
#     Should Contain    ${html_source}    มข.
#     Should Contain    ${html_source}    cpkku
#     Should Contain    ${html_source}    cp
#     Should Contain    ${html_source}    ITEX2025

#     # [Enter] Highlight detail page
#     Wait Until Element Is Visible    xpath=(//a[contains(@href,'highlights') and contains(@class,'btn-outline-primary')])[1]
#     Click Element    xpath=(//a[contains(@href,'highlights') and contains(@class,'btn-outline-primary')])[1]
    
#     # [Highlight_1] Highlight detail page
#     ${html_source}=    Get Source
#     Should Contain    ${html_source}    ${TITLE_1}
#     Should Contain    ${html_source}    ${DETAIL_1}
#     Should Contain    ${html_source}    KKU
#     Should Contain    ${html_source}    มข.
#     Should Contain    ${html_source}    cpkku
#     Should Contain    ${html_source}    computing
#     Should Contain    ${html_source}    phet

#     # [Enter] Manage Highlight
#     Wait Until Element Is Visible    xpath=//a[contains(text(),'Back')]
#     Click Element    xpath=//a[contains(text(),'Back')]
    
#     # [Enter] Highlight detail page
#     Wait Until Element Is Visible    xpath=(//a[contains(@href,'highlights') and contains(@class,'btn-outline-primary')])[2]
#     Click Element    xpath=(//a[contains(@href,'highlights') and contains(@class,'btn-outline-primary')])[2]

#     # [Highlight_2] Highlight detail page
#     ${html_source}=    Get Source
#     Should Contain    ${html_source}    ${TITLE_2}
#     Should Contain    ${html_source}    ${DETAIL_2}
#     Should Contain    ${html_source}    KKU
#     Should Contain    ${html_source}    มข.
#     Should Contain    ${html_source}    cpkku
#     Should Contain    ${html_source}    cp
#     Should Contain    ${html_source}    ITEX2025

#     # [Enter] Manage Highlight
#     Wait Until Element Is Visible    xpath=//a[contains(text(),'Back')]
#     Click Element    xpath=//a[contains(text(),'Back')]

#     # [Enter] Highlight detail page
#     Wait Until Element Is Visible    xpath=(//a[contains(@href,'highlights') and contains(@class,'btn-outline-success')])[1]
#     Click Element    xpath=(//a[contains(@href,'highlights') and contains(@class,'btn-outline-success')])[1]

#     # [Enter] Manage Highlight
#     Wait Until Element Is Visible    xpath=//a[contains(text(),'Back')]
#     Click Element    xpath=//a[contains(text(),'Back')]

#     # # [Delete_Highlight_1] Highlight - using the button inside the form
#     # Wait Until Element Is Visible    xpath=(//button[contains(@class,'btn-outline-danger') or contains(@class,'show_confirm')])[1]
#     # Execute JavaScript    document.querySelector("button.show_confirm").click();
    
#     # # [Delete_Highlight_1] Handle the confirmation dialog for first highlight
#     # Wait Until Element Is Visible    xpath=//div[contains(@class,'swal-modal')]
#     # Wait Until Element Is Visible    xpath=//button[contains(@class,'swal-button--confirm')]
#     # Click Element    xpath=//button[contains(@class,'swal-button--confirm')]
#     # Sleep    3s  # Wait for deletion to complete

#     # # [Delete_Highlight_1] Handle the success modal after deletion
#     # Wait Until Element Is Visible    xpath=//div[contains(@class,'swal-modal')]
#     # Wait Until Element Is Visible    xpath=//div[contains(text(),'Deleted Successfully')]
#     # Wait Until Element Is Visible    xpath=//button[contains(@class,'swal-button--confirm')]
#     # Click Element    xpath=//button[contains(@class,'swal-button--confirm')]
#     # Sleep    2s
    
#     # # [Delete_Highlight_2] Highlight - now it should be the first element after previous deletion
#     # Wait Until Element Is Visible    xpath=(//button[contains(@class,'btn-outline-danger') or contains(@class,'show_confirm')])[1]
#     # Execute JavaScript    document.querySelector("button.show_confirm").click();
    
#     # # [Delete_Highlight_2] Handle the confirmation dialog for second highlight
#     # Wait Until Element Is Visible    xpath=//div[contains(@class,'swal-modal')]
#     # Wait Until Element Is Visible    xpath=//button[contains(@class,'swal-button--confirm')]
#     # Click Element    xpath=//button[contains(@class,'swal-button--confirm')]
#     # Sleep    2s  # Wait for deletion to process
    
#     # # [Delete_Highlight_2] Handle the success modal after deletion
#     # Wait Until Element Is Visible    xpath=//div[contains(@class,'swal-modal')]
#     # Wait Until Element Is Visible    xpath=//div[contains(text(),'Deleted Successfully')]
#     # Wait Until Element Is Visible    xpath=//button[contains(@class,'swal-button--confirm')]
#     # Click Element    xpath=//button[contains(@class,'swal-button--confirm')]
#     # Sleep    2s  # Wait for success modal to close
    
#     # # Wait for all SweetAlert modals to disappear completely
#     # Wait Until Page Does Not Contain Element    xpath=//div[contains(@class,'swal-overlay')]    timeout=10s
#     # Wait Until Page Does Not Contain Element    xpath=//div[contains(@class,'swal-modal')]    timeout=10s
    
#     Sleep    2s
    
#     # Now proceed with logout
#     Wait Until Element Is Visible    xpath=//a[contains(text(),'Logout')]
#     Click Element    xpath=//a[contains(text(),'Logout')]
    
#     [Teardown]    Close All Browsers

As Administrative Staff, I want to check highlight detail that created
    [Tags]    UAT004-CheckHighlightDetail
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

    # [Enter] Manage Highlight
    Wait Until Element Is Visible    xpath=//a[contains(text(),'Manage Highlight')]
    Click Element    xpath=//a[contains(text(),'Manage Highlight')]

    # Count the number of edit buttons to determine the latest
    ${highlight_count}=    Get Element Count    xpath=//a[contains(@href,'highlights') and contains(@class,'btn-outline-success')]
    Log    Found ${highlight_count} highlights

    # [Enter] Highlight edit page - target the most recent highlight (last in list if order is oldest first)
    Wait Until Element Is Visible    xpath=(//a[contains(@href,'highlights') and contains(@class,'btn-outline-primary')])[${highlight_count}]
    Click Element    xpath=(//a[contains(@href,'highlights') and contains(@class,'btn-outline-primary')])[${highlight_count}]
    
    # [Highlight_1] Highlight detail page
    ${html_source}=    Get Source
    Should Contain    ${html_source}    ${TITLE_1}
    Should Contain    ${html_source}    ${DETAIL_1}
    Should Contain    ${html_source}    KKU
    Should Contain    ${html_source}    มข.
    Should Contain    ${html_source}    cpkku
    Should Contain    ${html_source}    computing
    Should Contain    ${html_source}    phet

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

    # [Highlight_2] Check data
    ${html_source}=    Get Source
    Should Contain    ${html_source}    ${TITLE_2}
    Should Contain    ${html_source}    ${DETAIL_2}
    Should Contain    ${html_source}    KKU
    Should Contain    ${html_source}    มข.
    Should Contain    ${html_source}    cpkku
    Should Contain    ${html_source}    cp
    Should Contain    ${html_source}    ITEX2025

    # [Logout] Logout
    Logout Dashboard
    [Teardown]    Close All Browsers

# As Administrative Staff, I want to delete highlight that created
#     [Tags]    UAT004-DeleteHighlight
#     Open Browser To Login Page
#     Staff Login
#     Click Element    xpath=//a[contains(@href,'highlight')]
    
#     # [Enter] Manage Highlight
#     Wait Until Element Is Visible    xpath=//a[contains(text(),'Manage Highlight')]
#     Click Element    xpath=//a[contains(text(),'Manage Highlight')]

#     # Count the number of edit buttons to determine the latest
#     ${highlight_count}=    Get Element Count    xpath=//a[contains(@href,'highlights') and contains(@class,'btn-outline-success')]
#     Log    Found ${highlight_count} highlights

#     # [Delete_Highlight_1] Highlight - using the button inside the form
#     Wait Until Element Is Visible    xpath=(//button[contains(@class,'btn-outline-danger') or contains(@class,'show_confirm')])[${highlight_count}]
#     Execute JavaScript    document.querySelector("button.show_confirm").click();
    
#     # [Delete_Highlight_1] Handle the confirmation dialog for first highlight
#     Wait Until Element Is Visible    xpath=//div[contains(@class,'swal-modal')]
#     Wait Until Element Is Visible    xpath=//button[contains(@class,'swal-button--confirm')]
#     Click Element    xpath=//button[contains(@class,'swal-button--confirm')]
#     Sleep    3s  # Wait for deletion to complete

#     # [Delete_Highlight_1] Handle the success modal after deletion
#     Wait Until Element Is Visible    xpath=//div[contains(@class,'swal-modal')]
#     Wait Until Element Is Visible    xpath=//div[contains(text(),'Deleted Successfully')]
#     Wait Until Element Is Visible    xpath=//button[contains(@class,'swal-button--confirm')]
#     Click Element    xpath=//button[contains(@class,'swal-button--confirm')]
#     Sleep    2s

#     # [Logout] Logout
#     Logout Dashboard
#     [Teardown]    Close All Browsers
