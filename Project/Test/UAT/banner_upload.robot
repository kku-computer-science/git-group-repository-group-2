*** Settings ***
Library  SeleniumLibrary

*** Variables ***
${URL}  http://127.0.0.1:8002
${HOME URL}    ${URL}/
${BANNER_UPLOAD_PAGE}  ${URL}/banners
${BANNER_IMAGE_TH}  /Users/nipatchapakdee/SoftwareEN/Project/Setup_project/git-group-repository-group-2/Project/Test/UAT/2_up.png
${BANNER_IMAGE_EN}  /Users/nipatchapakdee/SoftwareEN/Project/Setup_project/git-group-repository-group-2/Project/Test/UAT/1_up.png
${BANNER_IMAGE_ZH}  /Users/nipatchapakdee/SoftwareEN/Project/Setup_project/git-group-repository-group-2/Project/Test/UAT/3_up.png
${LOGIN_PAGE}  ${URL}/login
${USER_USERNAME}  admin@gmail.com
${USER_PASSWORD}  12345678

*** Keywords ***
Open Browser To Home Page
    ${chrome_options}=    Evaluate    sys.modules['selenium.webdriver'].ChromeOptions()    sys
    ${chrome_options.binary_location}=    Set Variable    ${CHROME_BROWSER_PATH}
    ${service}=    Evaluate    sys.modules["selenium.webdriver.chrome.service"].Service(executable_path=r"${CHROME_DRIVER_PATH}")
    Create Webdriver    Chrome    options=${chrome_options}    service=${service}
    Go To    ${HOME URL}
    Home Page Should Be Open
    Maximize Browser Window
    Wait Until Element Is Visible    css=.nav-item.dropdown    10s

Home Page Should Be Open
    Location Should Be    ${HOME URL}

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
Upload Banner Images and Verify Success Message EN
    Open Browser  ${LOGIN_PAGE}  chrome
    Input Text  id=username  ${USER_USERNAME}
    Input Text  id=password  ${USER_PASSWORD}
    Click Button  xpath=//button[text()='Log In']
    Wait Until Page Contains  Dashboard
    Go To  ${BANNER_UPLOAD_PAGE}
    Choose File  name=image_th  ${BANNER_IMAGE_TH}
    Choose File  name=image_en  ${BANNER_IMAGE_EN}
    Choose File  name=image_zh  ${BANNER_IMAGE_ZH}
    Click Button  xpath=//button[text()='Save']
    Wait Until Page Contains  อัปโหลดรูปภาพสำเร็จ

    # ✅ ตรวจสอบการแสดงผลในหน้า Index
    Go To  ${URL}   # ไปที่ localhost:8000
    Wait Until Element Is Visible    css=.nav-item.dropdown    10s

    # ตรวจสอบว่าแต่ละภาษามีรูปแสดงผลอยู่
    Wait Until Element Is Visible  xpath=//img[contains(@src, '/storage/banners/')]  timeout=5s

    # ✅ เปลี่ยนเป็นภาษาอังกฤษ และตรวจสอบรูป
    Go To    ${HOME URL}lang/en
    ${banner_en}  Get Element Attribute  xpath=//img[@alt='Banner Image EN']  src
    Should Contain  ${banner_en}  /storage/banners/

    Close Browser

Upload Banner Images and Verify Success Message TH
    Open Browser  ${LOGIN_PAGE}  chrome
    Input Text  id=username  ${USER_USERNAME}
    Input Text  id=password  ${USER_PASSWORD}
    Click Button  xpath=//button[text()='Log In']
    Wait Until Page Contains  Dashboard
    Go To  ${BANNER_UPLOAD_PAGE}
    Choose File  name=image_th  ${BANNER_IMAGE_TH}
    Choose File  name=image_en  ${BANNER_IMAGE_EN}
    Choose File  name=image_zh  ${BANNER_IMAGE_ZH}
    Click Button  xpath=//button[text()='Save']
    Wait Until Page Contains  อัปโหลดรูปภาพสำเร็จ

    # ✅ ตรวจสอบการแสดงผลในหน้า Index
    Go To  ${URL}   # ไปที่ localhost:8000
    Wait Until Element Is Visible    css=.nav-item.dropdown    10s

    # ตรวจสอบว่าแต่ละภาษามีรูปแสดงผลอยู่
    Wait Until Element Is Visible  xpath=//img[contains(@src, '/storage/banners/')]  timeout=5s

    # ✅ ตรวจสอบว่ารูปภาษาไทยแสดงผล
    Switch Language To  th  ไทย
    ${banner_th}  Get Element Attribute  xpath=//img[@alt='Banner Image TH']  src
    Should Contain  ${banner_th}  /storage/banners/

    Close Browser


Upload Banner Images and Verify Success Message CN
    Open Browser  ${LOGIN_PAGE}  chrome
    Input Text  id=username  ${USER_USERNAME}
    Input Text  id=password  ${USER_PASSWORD}
    Click Button  xpath=//button[text()='Log In']
    Wait Until Page Contains  Dashboard
    Go To  ${BANNER_UPLOAD_PAGE}
    Choose File  name=image_th  ${BANNER_IMAGE_TH}
    Choose File  name=image_en  ${BANNER_IMAGE_EN}
    Choose File  name=image_zh  ${BANNER_IMAGE_ZH}
    Click Button  xpath=//button[text()='Save']
    Wait Until Page Contains  อัปโหลดรูปภาพสำเร็จ

    # ✅ ตรวจสอบการแสดงผลในหน้า Index
    Go To  ${URL}   # ไปที่ localhost:8000
    Wait Until Element Is Visible    css=.nav-item.dropdown    10s

    # ตรวจสอบว่าแต่ละภาษามีรูปแสดงผลอยู่
    Wait Until Element Is Visible  xpath=//img[contains(@src, '/storage/banners/')]  timeout=5s

    # ✅ เปลี่ยนเป็นภาษาจีน และตรวจสอบรูป
    Switch Language To  zh  中文
    ${banner_zh}  Get Element Attribute  xpath=//img[@alt='Banner Image ZH']  src
    Should Contain  ${banner_zh}  /storage/banners/

    Close Browser