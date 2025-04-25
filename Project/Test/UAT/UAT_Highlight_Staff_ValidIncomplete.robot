*** Settings ***
Library           SeleniumLibrary

*** Variables ***
${SERVER}                    localhost:8000
${STAFF_USERNAME}            staff@gmail.com
${STAFF_PASSWORD}            123456789
${LOGIN URL}                 http://${SERVER}/login
${STAFF URL}                 http://${SERVER}/dashboard
${HIGHLIGHT URL}             http://${SERVER}/highlight
${CHROME_BROWSER_PATH}       ${EXECDIR}${/}ChromeForTesting${/}chrome.exe
${CHROME_DRIVER_PATH}        ${EXECDIR}${/}ChromeForTesting${/}chromedriver.exe
${IMAGE_PATH}                ${EXECDIR}${/}highlight_image_test01.jpg
${ADDITIONAL_IMAGE_PATH}     ${EXECDIR}${/}additional_image_test01.jpg

*** Keywords ***
เปิดเบราว์เซอร์ไปยังหน้าล็อกอิน
    ${chrome_options}=    Evaluate    sys.modules['selenium.webdriver'].ChromeOptions()    sys
    ${chrome_options.binary_location}=    Set Variable    ${CHROME_BROWSER_PATH}
    Call Method    ${chrome_options}    add_argument    --no-sandbox
    ${service}=    Evaluate    sys.modules["selenium.webdriver.chrome.service"].Service(executable_path=r"${CHROME_DRIVER_PATH}")
    Create Webdriver    Chrome    options=${chrome_options}    service=${service}
    Go To    ${LOGIN URL}
    Maximize Browser Window
    Wait Until Page Contains    Login    timeout=20s

ล็อกอินในฐานะพนักงาน
    Wait Until Element Is Visible    id=username    timeout=20s
    Input Text    id=username    ${STAFF_USERNAME}
    Wait Until Element Is Visible    id=password    timeout=20s
    Input Text    id=password    ${STAFF_PASSWORD}
    Click Button    xpath=//button[@type='submit']
    Wait Until Location Is    ${STAFF_URL}    timeout=20s

ไปยังหน้าไฮไลต์
    Wait Until Element Is Visible    xpath=//a[contains(@href,'highlight')]    timeout=20s
    Click Element    xpath=//a[contains(@href,'highlight')]
    Wait Until Location Is    ${HIGHLIGHT_URL}    timeout=20s

ส่งฟอร์ม
    Wait Until Element Is Visible    xpath=//button[contains(.,'Upload')]    timeout=20s
    Execute JavaScript    document.querySelector("button.btn-primary").scrollIntoView({behavior: "smooth", block: "center"})
    Sleep    1s
    Click Element    xpath=//button[contains(.,'Upload')]
    Sleep    2s

ล้างข้อมูลฟอร์ม
    # ตรวจสอบว่ายังอยู่ที่หน้า Highlight
    ${current_location}=    Get Location
    Run Keyword If    '${current_location}' != '${HIGHLIGHT_URL}'    Go To    ${HIGHLIGHT_URL}
    Wait Until Element Is Visible    id=title    timeout=10s
    Clear Element Text    id=title
    Wait Until Element Is Visible    id=detail    timeout=10s
    Clear Element Text    id=detail
    Execute JavaScript    document.querySelector('#thumbnail').value = null
    Execute JavaScript    document.querySelector('#additional_images') ? document.querySelector('#additional_images').value = null : null

ออกจากระบบ
    Wait Until Element Is Visible    xpath=//a[contains(text(),'Logout')]    timeout=20s
    Click Element    xpath=//a[contains(text(),'Logout')]
    Wait Until Location Is    ${LOGIN_URL}    timeout=20s

*** Test Cases ***
ตรวจสอบการส่งฟอร์มเมื่อกรอกข้อมูลไม่ครบ
    [Tags]    UAT006-ValidateIncompleteFields
    เปิดเบราว์เซอร์ไปยังหน้าล็อกอิน
    ล็อกอินในฐานะพนักงาน
    ไปยังหน้าไฮไลต์

    # กรณี 1: ไม่กรอกทุกข้อ (หัวข้อ, รายละเอียด, รูปภาพว่าง)
    ส่งฟอร์ม
    Element Should Be Visible    id=title
    ${title_validation}=    Execute JavaScript    return document.querySelector('#title').validationMessage
    Should Be Equal    ${title_validation}    Please fill out this field.
    Element Should Be Visible    id=detail
    ${detail_validation}=    Execute JavaScript    return document.querySelector('#detail').validationMessage
    Should Be Equal    ${detail_validation}    Please fill out this field.
    Element Should Be Visible    id=thumbnail
    ${thumbnail_validation}=    Execute JavaScript    return document.querySelector('#thumbnail').validationMessage
    Should Be Equal    ${thumbnail_validation}    Please select a file.
    ${location}=    Get Location
    Should Be Equal    ${location}    ${HIGHLIGHT_URL}    msg=ฟอร์มไม่ควรถูกส่งเมื่อไม่กรอกทุกข้อ

    # กรณี 2: ไม่กรอกหัวข้อ (กรอกรายละเอียดและอัพรูปภาพ)
    Input Text    id=detail    รายละเอียดทดสอบ
    Choose File    id=thumbnail    ${IMAGE_PATH}
    ส่งฟอร์ม
    ${title_validation}=    Execute JavaScript    return document.querySelector('#title').validationMessage
    Should Be Equal    ${title_validation}    Please fill out this field.
    ${location}=    Get Location
    Should Be Equal    ${location}    ${HIGHLIGHT_URL}    msg=ฟอร์มไม่ควรถูกส่งเมื่อไม่กรอกหัวข้อ
    ล้างข้อมูลฟอร์ม

    # กรณี 3: ไม่กรอกรายละเอียด (กรอกหัวข้อและอัพรูปภาพ)
    Input Text    id=title    หัวข้อทดสอบ
    Choose File    id=thumbnail    ${IMAGE_PATH}
    ส่งฟอร์ม
    ${detail_validation}=    Execute JavaScript    return document.querySelector('#detail').validationMessage
    Should Be Equal    ${detail_validation}    Please fill out this field.
    ${location}=    Get Location
    Should Be Equal    ${location}    ${HIGHLIGHT_URL}    msg=ฟอร์มไม่ควรถูกส่งเมื่อไม่กรอกรายละเอียด
    ล้างข้อมูลฟอร์ม

    # กรณี 4: ไม่อัพรูป (กรอกหัวข้อและรายละเอียด)
    Input Text    id=title    หัวข้อทดสอบ
    Input Text    id=detail    รายละเอียดทดสอบ
    ส่งฟอร์ม
    ${thumbnail_validation}=    Execute JavaScript    return document.querySelector('#thumbnail').validationMessage
    Should Be Equal    ${thumbnail_validation}    Please select a file.
    ${location}=    Get Location
    Should Be Equal    ${location}    ${HIGHLIGHT_URL}    msg=ฟอร์มไม่ควรถูกส่งเมื่อไม่อัพรูป
    ล้างข้อมูลฟอร์ม

    # กรณี 5: กรอกครบทุกข้อยกเว้นแท็ก
    Input Text    id=title    หัวข้อทดสอบ
    Input Text    id=detail    รายละเอียดทดสอบ
    Choose File    id=thumbnail    ${IMAGE_PATH}
    ส่งฟอร์ม
    ${location}=    Get Location
    Should Not Be Equal    ${location}    ${HIGHLIGHT_URL}    msg=ฟอร์มควรถูกส่งเมื่อกรอกฟิลด์บังคับครบ (แท็กไม่บังคับ)
    ล้างข้อมูลฟอร์ม

    # กรณี 6: กรอกครบฟิลด์บังคับแต่ไม่อัพโหลด Additional Images 
    Input Text    id=title    หัวข้อทดสอบกรณี 6
    Input Text    id=detail    รายละเอียดทดสอบกรณี 6
    Choose File    id=thumbnail    ${IMAGE_PATH}
    ส่งฟอร์ม
    ${location}=    Get Location
    Should Not Be Equal    ${location}    ${HIGHLIGHT_URL}    msg=ฟอร์มควรถูกส่งเมื่อไม่ใส่ Additional Images เพราะเป็นฟิลด์เสริม
    ${additional_validation}=    Execute JavaScript    return document.querySelector('#additional_images') ? document.querySelector('#additional_images').validationMessage : ''
    Should Be Equal    ${additional_validation}    ${EMPTY}    msg=ไม่ควรมีข้อความ validation สำหรับฟิลด์ Additional Images

    # ออกจากระบบ
    ออกจากระบบ
    [Teardown]    Close All Browsers
