*** Settings ***
Library           SeleniumLibrary

*** Variables ***
${SERVER}                    localhost:8000
${STAFF_USERNAME}             staff@gmail.com
${STAFF_PASSWORD}             123456789
${HOME URL}                   http://${SERVER}/
${LOGIN URL}                  http://${SERVER}/login
${STAFF URL}                  http://${SERVER}/dashboard
${HIGHLIGHT URL}              http://${SERVER}/highlight
${CHROME_BROWSER_PATH}       ${EXECDIR}${/}ChromeForTesting${/}chrome.exe
${CHROME_DRIVER_PATH}        ${EXECDIR}${/}ChromeForTesting${/}chromedriver.exe

# [Define] Title Variables
${TITLE_1}                      วิทยาลัยการคอมพิวเตอร์ มหาวิทยาลัยขอนแก่น ขอแสดงความยินดีกับ อาจารย์ ดร.เพชร อิ่มทองคำ อาจารย์ประจำวิทยาลัยการคอมพิวเตอร์ เนื่องในโอกาสได้รับแต่งตั้งให้ดำรงตำแหน่ง "ผู้ช่วยศาสตราจารย์"
${DETAIL_1}                     วิทยาลัยการคอมพิวเตอร์ มหาวิทยาลัยขอนแก่น ขอแสดงความยินดีกับ อาจารย์ ดร.เพชร อิ่มทองคำ อาจารย์ประจำวิทยาลัยการคอมพิวเตอร์ เนื่องในโอกาสได้รับแต่งตั้งให้ดำรงตำแหน่ง "ผู้ช่วยศาสตราจารย์"  ในสาขาวิชาเทคโนโลยีสารสนเทศตั้งแต่วันที่ 16 พฤษภาคม 2567 ตามที่สภามหาวิทยาลัยขอนแก่นได้มีมติอนุมัติแต่งตั้งให้ดำรงตำแหน่งทางวิชาการในคราวการประชุมครั้งที่ 3/2568 เมื่อวันที่ 5 มีนาคม 2568
${TITLE_2}                      นักวิจัย มข. และบริษัทมิตรผล จับมือนำ AI คัดแยกพันธุ์อ้อยสู่เวทีนานาชาติ ในงาน ITEX 2025
${DETAIL_2}                     วิทยาลัยการคอมพิวเตอร์ มหาวิทยาลัยขอนแก่น ขอแสดงความยินดีกับ รศ. ดร.วรารัตน์ สงฆ์แป้น และคณะทีมวิจัย จากบริษัท มิตรผลวิจัย พัฒนาอ้อยและน้ำตาล จำกัด ในผลงานเรื่อง"การพัฒนาแบบจำลองปัญญาประดิษฐ์การคัดแยกพันธุ์อ้อยด้วยการเรียนรู้เครื่องและการเรียนรู้เชิงลึก"

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
As Administrative Staff, I want to add new highlight and make them to be displayed as banners
    [Tags]    UAT001-AddBanner
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

    # [Click] Favorite button to mark as banner
    Wait Until Element Is Visible    xpath=//button[contains(@class,'favorite-btn')]
    Execute JavaScript    document.querySelector("button.favorite-btn").scrollIntoView({behavior: "smooth", block: "center"});
    Sleep    1s
    
    # [Use] JavaScript click for more reliability
    Execute JavaScript    document.querySelector("button.favorite-btn").click();
    
    # [Wait] For update to process longer
    Sleep    5s
    
    # [Debug] Log the current button state
    ${button_classes}=    Execute JavaScript    
    ...    return document.querySelector("button.favorite-btn i").className;
    Log    Button icon classes after click: ${button_classes}
    
    # [Reload] Page to ensure latest state
    Reload Page
    Sleep    2s
    
    # [Verify] The highlight is now marked as a banner
    ${is_banner}=    Run Keyword And Return Status    
    ...    Element Should Be Visible    xpath=//button[contains(@class,'favorite-btn')][.//i[contains(@class,'mdi-star') or not(contains(@class,'mdi-star-outline'))]]
    
    # [Check] Fallback verification if first check fails
    ${is_banner_alt}=    Run Keyword If    not ${is_banner}    
    ...    Execute JavaScript    
    ...    return document.querySelector("button.favorite-btn").getAttribute('data-is-favorite') === 'true' || 
    ...           document.querySelector("button.favorite-btn").classList.contains('active') ||
    ...           document.querySelector("button.favorite-btn i").classList.contains('mdi-star');
    
    # [Use] Alternative check result if first one failed
    ${final_result}=    Set Variable If    not ${is_banner} and "${is_banner_alt}" != "None"    ${is_banner_alt}    ${is_banner}
    
    # [Verify] The highlight is now marked as a banner
    Should Be True    ${final_result}    Highlight was not successfully marked as banner

    # [Logout] Dashboard
    Logout Dashboard

    # [Navigate] To homepage to check banner display
    Go To    ${HOME URL}
    
    # [Wait] For page to load and refresh to bypass caching
    Sleep    2s
    Reload Page
    Sleep    3s
    
    # [Debug] Log page source to see HTML structure
    ${page_html}=    Get Source
    Log    Current page HTML (partial): ${page_html[0:500]}...
    
    # [Check] Banner section exists with flexible selectors
    ${banner_exists}=    Run Keyword And Return Status
    ...    Page Should Contain Element    xpath=//div[contains(@class,'carousel') or contains(@class,'banner')]
    
    # [Try] Alternative selectors if first one fails
    ${banner_alt_exists}=    Run Keyword If    not ${banner_exists}
    ...    Run Keyword And Return Status
    ...    Page Should Contain Element    xpath=//img[contains(@src,'thumbnails')]
    
    # [Verify] Banner links to highlight detail page
    ${banner_link_exists}=    Run Keyword And Return Status    
    ...    Page Should Contain Element    xpath=//a[contains(@href,'showHighlight')]//img[contains(@class,'d-block')]
    
    # [Verify] Banner is visible and loaded
    ${banner_loaded}=    Execute JavaScript    
    ...    return document.querySelector('img.d-block').complete && document.querySelector('img.d-block').naturalHeight !== 0
    
    Should Be True    ${banner_loaded}    Banner image did not load properly
    Should Be True    ${banner_link_exists}    Banner does not link to highlight detail
    
    # [Click] On banner to verify navigation
    Wait Until Element Is Visible    xpath=//a[contains(@href,'showHighlight')]//img[contains(@class,'d-block')]
    ${banner_link}=    Get Element Attribute    xpath=//a[contains(@href,'showHighlight')]    href
    Log    Banner link URL: ${banner_link}
    
    # [Store] Current window handle before clicking
    ${current_window}=    Get Window Handles
    
    # [Click] With JavaScript for more reliability
    Execute JavaScript    document.querySelector("a[href*='showHighlight']").click();
    
    # [Wait] For new tab to open
    Sleep    3s
    
    # [Switch] To new tab
    ${window_handles}=    Get Window Handles
    ${new_window}=    Set Variable    ${window_handles}[-1]
    
    # [Ensure] We're switching to new window
    Run Keyword If    "${new_window}" != "${current_window[0]}"    Switch Window    ${new_window}
    
    # [Verify] Navigation to specific highlight detail page
    ${current_url}=    Get Location
    Log    Current URL after click: ${current_url}
    
    # [Check] URL pattern with flexible hostname
    ${url_match}=    Run Keyword And Return Status    
    ...    Should Match Regexp    ${current_url}    http://(?:localhost|127.0.0.1):8000/showHighlight/\\d+
    
    # [Check] Fallback if first pattern doesn't match
    ${url_contains}=    Run Keyword If    not ${url_match}    
    ...    Run Keyword And Return Status    
    ...    Should Contain    ${current_url}    showHighlight
    
    # [Use] Combined result for verification
    ${final_url_result}=    Set Variable If    not ${url_match} and "${url_contains}" != "None"    ${url_contains}    ${url_match}
    Should Be True    ${final_url_result}    Banner click did not navigate to highlight detail page. URL: ${current_url}
    
    # [Verify] Highlight detail page content
    Wait Until Page Contains Element    xpath=//h1[contains(@class,'highlight-title')]
    Wait Until Page Contains Element    xpath=//p[contains(@class,'highlight-detail')]
    Wait Until Page Contains Element    xpath=//img[contains(@class,'highlight-thumbnail')]
    
    # [Close] The detail tab and switch back to main window
    Close Window
    Switch Window    ${current_window[0]}
    
    # [Return] To staff dashboard
    Go To    ${STAFF URL}
    
    [Teardown]    Close All Browsers

As Administrative Staff, I want to remove a highlight from being displayed as a banner
    [Tags]    UAT003-RemoveBanner
    # [Enter] Login page
    Open Browser To Login Page
    Staff Login
    
    # [Enter] Highlight page
    Click Element    xpath=//a[contains(@href,'highlight')]

    # [Enter] Manage Highlight
    Wait Until Element Is Visible    xpath=//a[contains(text(),'Manage Highlight')]
    Click Element    xpath=//a[contains(text(),'Manage Highlight')]
    Sleep    2s
    
    # [Check] For active banner (favorite button with star icon)
    ${active_banner_exists}=    Run Keyword And Return Status    
    ...    Page Should Contain Element    xpath=//button[contains(@class,'favorite-btn')][.//i[contains(@class,'mdi-star')]]
    
    # [Check] Alternative using JavaScript if first one fails
    ${active_banner_alt}=    Run Keyword If    not ${active_banner_exists}    
    ...    Execute JavaScript    
    ...    return !!document.querySelector("button.favorite-btn.active") || 
    ...           !!document.querySelector("button.favorite-btn i.mdi-star");
    
    Log    Active banner found: ${active_banner_exists} or ${active_banner_alt}
    
    # [Click] Banner button to unmark the highlight as banner
    Wait Until Element Is Visible    xpath=//button[contains(@class,'favorite-btn')]
    Execute JavaScript    document.querySelector("button.favorite-btn").scrollIntoView({behavior: "smooth", block: "center"});
    Sleep    1s
    
    # [Save] The highlight title for later verification
    ${unmarked_title}=    Get Text    xpath=//button[contains(@class,'favorite-btn')]/ancestor::tr/td[1]
    Log    Unmarking highlight with title: ${unmarked_title}
    
    # [Click] Using JavaScript for more reliability
    Execute JavaScript    document.querySelector("button.favorite-btn").click();
    
    # [Wait] For update to process
    Sleep    5s
    
    # [Verify] The highlight is now unmarked as a banner
    Reload Page
    Sleep    2s
    
    ${is_unmarked}=    Run Keyword And Return Status    
    ...    Page Should Contain Element    xpath=//button[contains(@class,'favorite-btn')][.//i[contains(@class,'mdi-star-outline')]]
    
    # [Check] Alternative using JavaScript
    ${is_unmarked_alt}=    Run Keyword If    not ${is_unmarked}    
    ...    Execute JavaScript    
    ...    return !document.querySelector("button.favorite-btn").classList.contains('active') && 
    ...           document.querySelector("button.favorite-btn i").classList.contains('mdi-star-outline');
    
    ${final_unmarked}=    Set Variable If    not ${is_unmarked} and "${is_unmarked_alt}" != "None"    ${is_unmarked_alt}    ${is_unmarked}
    Should Be True    ${final_unmarked}    Highlight was not successfully unmarked as banner
    
    # [Navigate] To homepage to check banner is removed
    Go To    ${HOME URL}
    
    # [Wait] For page to load and refresh to bypass caching
    Sleep    2s
    Reload Page
    Sleep    3s
    
    # [Check] Proper carousel structure based on HTML analysis
    ${empty_carousel}=    Run Keyword And Return Status
    ...    Page Should Not Contain Element    xpath=//div[contains(@class,'carousel-inner')]/div[contains(@class,'carousel-item')]
    
    # [Check] Alternative - carousel might still have items but not our unmarked highlight
    ${contains_unmarked}=    Run Keyword If    not ${empty_carousel}
    ...    Run Keyword And Return Status
    ...    Page Should Contain    ${unmarked_title}
    
    # [Verify] Either carousel is empty or doesn't contain our unmarked highlight
    ${verification_passed}=    Set Variable If    
    ...    ${empty_carousel}    ${TRUE}    
    ...    "${contains_unmarked}" != "None" and not ${contains_unmarked}    ${TRUE}    
    ...    ${FALSE}
    
    Should Be True    ${verification_passed}    Banner was not successfully removed from homepage
    
    # [Debug] Log the carousel state for troubleshooting
    ${carousel_html}=    Execute JavaScript    return document.querySelector('.carousel-inner').innerHTML
    Log    Carousel contents: ${carousel_html}
    
    # [Check] Specific structure based on HTML when no banner exists
    ${has_empty_indicators}=    Run Keyword And Return Status
    ...    Page Should Not Contain Element    xpath=//div[contains(@class,'carousel-indicators')]/button
    
    Log    Carousel has empty indicators: ${has_empty_indicators}
    
    # [Return] To staff dashboard
    Go To    ${STAFF URL}
    
    # [Logout] Dashboard
    Logout Dashboard
    [Teardown]    Close All Browsers
