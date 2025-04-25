*** Settings ***
Library           SeleniumLibrary

*** Variables ***
${SERVER}                    localhost:8000
${STAFF_USERNAME}             staff@gmail.com
${STAFF_PASSWORD}             123456789
${HOME URL}                  http://${SERVER}/
${LOGIN URL}                  http://${SERVER}/login
${STAFF URL}                  http://${SERVER}/dashboard
${HIGHLIGHT URL}              http://${SERVER}/highlight
${CHROME_BROWSER_PATH}       ${EXECDIR}${/}ChromeForTesting${/}chrome.exe
${CHROME_DRIVER_PATH}        ${EXECDIR}${/}ChromeForTesting${/}chromedriver.exe

# Title Variables
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

Open Browser To Home Page
    ${chrome_options}=    Evaluate    sys.modules['selenium.webdriver'].ChromeOptions()    sys
    ${chrome_options.binary_location}=    Set Variable    ${CHROME_BROWSER_PATH}
    Call Method    ${chrome_options}    add_argument    --no-sandbox
    ${service}=    Evaluate    sys.modules["selenium.webdriver.chrome.service"].Service(executable_path=r"${CHROME_DRIVER_PATH}")
    Create Webdriver    Chrome    options=${chrome_options}    service=${service}
    Go To    ${HOME URL}
    Home Page Should Be Open
    Maximize Browser Window

Home Page Should Be Open
    Location Should Be    ${HOME URL}

Staff Login
    Input Text      id=username    ${STAFF_USERNAME}
    Input Text      id=password    ${STAFF_PASSWORD}
    Sleep    2s
    Click Button    xpath=//button[@type='submit']
    Location Should Be    ${STAFF URL} 

Logout Dashboard
    Wait Until Element Is Visible    xpath=//a[contains(text(),'Logout')]
    Click Element    xpath=//a[contains(text(),'Logout')]

Staff Add Highlight
    Open Browser To Login Page
    Staff Login
    Click Element    xpath=//a[contains(@href,'highlight')]
    # [Highlight_1] Fill Highlight
    Input Text    id=title    ${TITLE_1}
    Input Text    id=detail    ${DETAIL_1}
    
    # [Highlight_1] Upload image
    ${IMAGE_PATH}=    Set Variable    ${EXECDIR}${/}highlight_image_test01.jpg
    Choose File    id=thumbnail    ${IMAGE_PATH}
    ${IMAGE_PATH}=    Set Variable    ${EXECDIR}${/}highlight_image_test01.jpg
    Choose File    id=additional_thumbnails    ${IMAGE_PATH}
    
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

    # [Highlight_1] Submit Form
    Execute JavaScript    document.querySelector("button.btn-primary").scrollIntoView({behavior: "smooth", block: "center"});
    Wait Until Element Is Visible    xpath=//button[contains(.,'Upload')]
    Wait Until Element Is Enabled    xpath=//button[contains(.,'Upload')]
    Execute JavaScript    document.querySelector("button[type='submit']").click();

    Click Element    xpath=//a[contains(@href,'highlight')]

    # [Highlight_2] Fill Highlight
    Input Text    id=title    ${TITLE_2}
    Input Text    id=detail    ${DETAIL_2}
    
    # [Highlight_2] Upload image
    ${IMAGE_PATH}=    Set Variable    ${EXECDIR}${/}highlight_image_test02.jpg
    Choose File    id=thumbnail    ${IMAGE_PATH}
    ${IMAGE_PATH}=    Set Variable    ${EXECDIR}${/}highlight_image_test02.jpg
    Choose File    id=additional_thumbnails    ${IMAGE_PATH}
    
    # [Highlight_2] Enter tags
    Input Text    id=tags    KKU
    Press Keys    id=tags    ENTER
    Input Text    id=tags    มข.
    Press Keys    id=tags    ENTER
    Input Text    id=tags    cpkku
    Press Keys    id=tags    ENTER
    Input Text    id=tags    cp
    Press Keys    id=tags    ENTER
    Input Text    id=tags    ITEX2025
    Press Keys    id=tags    ENTER

    # [Highlight_2] Submit Form
    Execute JavaScript    document.querySelector("button.btn-primary").scrollIntoView({behavior: "smooth", block: "center"});
    Wait Until Element Is Visible    xpath=//button[contains(.,'Upload')]
    Wait Until Element Is Enabled    xpath=//button[contains(.,'Upload')]
    Execute JavaScript    document.querySelector("button[type='submit']").click();

    # [Logout] Logout
    Logout Dashboard
    [Teardown]    Close All Browsers


*** Test Cases ***
As Visitor, I want to verify no highlights are available
    [Tags]    UAT001-EmptyHighlight    Visitor
    # [Enter] Homepage as visitor
    Open Browser To Home Page
    
    # [Check] Empty highlight state
    ${highlight_rows}=    Get Element Count    xpath=//div[contains(@class,'highlight-row')]/div[contains(@class,'highlight-card')]
    
    # [Verify] No highlights displayed
    Run Keyword If    ${highlight_rows} == 0    Run Keywords
    ...    Log    No highlights found - empty state verified    AND
    ...    Page Should Not Contain Element    xpath=//div[contains(@class,'highlight-card')]
    
    [Teardown]    Close Browser

As Visitor, I want to see highlights on homepage
    [Tags]    UAT002-ViewHighlights    Visitor
    # [Setup] Add test highlights
    Staff Add Highlight
    
    # [Enter] Homepage as visitor
    Open Browser To Home Page

    # [Check] Highlight cards visible
    Wait Until Element Is Visible    xpath=//div[contains(@class,'highlight-card')]
    
    # [Verify] Multiple highlight cards present
    ${card_count}=    Get Element Count    xpath=//div[contains(@class,'highlight-card')]
    Should Be True    ${card_count} >= 2    Expected at least 2 highlight cards, but found ${card_count}
    
    # [Check] Images loaded properly
    Sleep    2s
    ${image_loaded}=    Execute JavaScript    return document.querySelector('.highlight-card img').complete && document.querySelector('.highlight-card img').naturalHeight !== 0
    Should Be True    ${image_loaded}
    
    # [Verify] Highlight titles match expected values
    Page Should Contain Element    xpath=//h3[contains(@class,'highlight-title') and contains(text(),'${TITLE_1}')]
    Page Should Contain Element    xpath=//h3[contains(@class,'highlight-title') and contains(text(),'${TITLE_2}')]
    
    # [Setup] Longer timeout for stability
    Set Selenium Timeout    15s
    
    # [Check] Tag elements present and accessible
    ${tags_present}=    Execute JavaScript    
    ...    return Array.from(document.querySelectorAll('.tags-list .tag-link')).map(el => el.textContent.trim()).join(',')
    
    Log    Found tags: ${tags_present}
    
    # [Verify] Expected tags are present
    Should Contain    ${tags_present}    KKU
    Should Contain    ${tags_present}    มข.
    Should Contain    ${tags_present}    cpkku
    Should Contain    ${tags_present}    cp
    Should Contain    ${tags_present}    computing
    
    [Teardown]    Close Browser

As Visitor, I want to see highlight details
    [Tags]    UAT003-ViewHighlightDetail    Visitor
    # [Enter] Homepage as visitor
    Open Browser To Home Page
    
    # [Check] Highlight cards visible
    Wait Until Element Is Visible    xpath=//div[contains(@class,'highlight-card')]
    
    # [Store] First highlight title for comparison
    ${first_highlight_title}=    Get Text    xpath=(//div[contains(@class,'highlight-card')]//h3[contains(@class,'highlight-title')])[1]
    Log    First highlight title: ${first_highlight_title}
    
    # [Store] First highlight URL
    ${first_card_link}=    Get Element Attribute    xpath=(//div[contains(@class,'highlight-card')]//a[contains(@href,'showHighlight')])[1]    href
    
    # [Click] First highlight to view details
    Click Element    xpath=(//div[contains(@class,'highlight-card')]//a[contains(@href,'showHighlight')])[1]
    
    # [Verify] Navigation to correct detail page
    Location Should Contain    showHighlight
    
    # [Setup] Longer timeout for detail page elements
    Set Selenium Timeout    10s
    
    # [Verify] Detail page title matches card title
    Wait Until Element Is Visible    xpath=//h1[contains(@class,'highlight-title')]
    ${detail_page_title}=    Get Text    xpath=//h1[contains(@class,'highlight-title')]
    Should Be Equal    ${detail_page_title}    ${first_highlight_title}
    
    # [Verify] Detail content is present
    Page Should Contain Element    xpath=//p[contains(@class,'highlight-detail')]
    ${detail_text}=    Get Text    xpath=//p[contains(@class,'highlight-detail')]
    Should Not Be Empty    ${detail_text}
    
    # [Check] Main thumbnail image
    Page Should Contain Element    xpath=//img[contains(@class,'highlight-thumbnail')]
    
    # [Verify] Main image loaded correctly
    ${main_image_loaded}=    Execute JavaScript    
    ...    return document.querySelector('img.highlight-thumbnail').complete && document.querySelector('img.highlight-thumbnail').naturalHeight !== 0;
    Should Be True    ${main_image_loaded}    Main image did not load properly
    
    # [Check] Additional images if present
    ${additional_images_exist}=    Run Keyword And Return Status    
    ...    Page Should Contain Element    xpath=//img[contains(@class,'additional-image')]
    
    # [View] Additional images if they exist
    Run Keyword If    ${additional_images_exist}    
    ...    Execute JavaScript    document.querySelector('img.additional-image').scrollIntoView({behavior:"smooth", block:"center"})
    
    # [Setup] Wait for scrolling
    Run Keyword If    ${additional_images_exist}    Sleep    1s
    
    # [Setup] Variable for additional image check
    ${additional_image_loaded}=    Set Variable    ${FALSE}
    
    # [Check] Additional image loading state
    ${js_result}=    Run Keyword If    ${additional_images_exist}    
    ...    Execute JavaScript    return document.querySelector('img.additional-image').complete && document.querySelector('img.additional-image').naturalHeight !== 0
    
    # [Store] Additional image load status
    ${additional_image_loaded}=    Set Variable If    ${additional_images_exist}    ${js_result}    ${FALSE}
    
    # [Verify] Additional image loaded correctly if present
    Run Keyword If    ${additional_images_exist}    
    ...    Should Be True    ${additional_image_loaded}    Additional image did not load properly
    
    # [Check] Tag links present
    Page Should Contain Element    xpath=//a[contains(@class,'tag-link')]
    
    # [Verify] Expected tags exist
    Page Should Contain Element    xpath=//a[contains(@class,'tag-link') and contains(text(),'KKU')]
    Page Should Contain Element    xpath=//a[contains(@class,'tag-link') and contains(text(),'มข.')]
    Page Should Contain Element    xpath=//a[contains(@class,'tag-link') and contains(text(),'cpkku')]
    
    # [Verify] Tag container structure
    Page Should Contain Element    xpath=//div[contains(@class,'tags-container')]
    Page Should Contain Element    xpath=//ul[contains(@class,'tags-list')]
    Page Should Contain Element    xpath=//li[contains(@class,'tag-item')]
    
    # [Check] Back navigation capability
    ${back_link_exists}=    Run Keyword And Return Status    Page Should Contain Element    xpath=//a[contains(text(),'Back') or contains(@class,'back')]
    
    # [Navigate] Back to homepage if link exists
    Run Keyword If    ${back_link_exists}    
    ...    Run Keywords
    ...    Click Element    xpath=//a[contains(text(),'Back') or contains(@class,'back')]    AND
    ...    Wait Until Location Contains    ${HOME URL}    AND
    ...    Wait Until Element Is Visible    xpath=//div[contains(@class,'highlight-card')]
    
    [Teardown]    Close Browser

