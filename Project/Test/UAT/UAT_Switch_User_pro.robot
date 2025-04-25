@@ -0,0 +1,321 @@
* Settings *
Library           SeleniumLibrary

* Variables *

${SERVER}                    localhost:8000
${USER_USERNAME}             pusadee@kku.ac.th
${USER_PASSWORD}             123456789
${LOGIN URL}                  http://${SERVER}/login
${USER URL}                  http://${SERVER}/dashboard
${PROFILE URL}               http://${SERVER}/profile
${CHROME_BROWSER_PATH}       ${EXECDIR}${/}ChromeForTesting${/}chrome.exe
${CHROME_DRIVER_PATH}        ${EXECDIR}${/}ChromeForTesting${/}chromedriver.exe
@{LANGUAGES}
...    en
...    th
...    zn

@{EXPECTED_WORDS_EN}
...    Profile Settings
...    Name Title
...    First Name (English)
...    Last Name (English)
...    First Name (Thai)
...    Last Name (Thai)
...    Email
...    Account
...    Password
...    Expertise
...    Education
...    For teachers without a doctoral degree, please specify
...    Password Settings
...    Old Password
...    New Password
...    Confirm new password
...    Education History
...    Bachelor’s Degree
...    University Name
...    Degree Name
...    Year of Graduation
...    Master’s Degree
...    University Name
...    Degree Name
...    Year of Graduation
...    Doctoral Degree
...    University Name
...    Degree Name
...    Year of Graduation




@{EXPECTED_WORDS__TH}
...    บัญชี
...    รหัสผ่าน
...    ความเชี่ยวชาญ
...    การศึกษา
...    ตั้งค่าข้อมูลส่วนตัว
...    คำนำหน้าชื่อ
...    ชื่อ (ภาษาอังกฤษ)
...    นามสกุล (ภาษาอังกฤษ)
...    ชื่อ (ภาษาไทย)
...    นามสกุล (ภาษาไทย)
...    ตำแหน่งทางวิชาการ 
...    อีเมล
...    สำหรับอ.ผู้ที่ไม่มีคุณวุฒิปริญญาเอก โปรดระบุ
...    ตั้งค่ารหัสผ่าน
...    รหัสผ่านเก่า
...    รหัสผ่านใหม่
...    ยืนยันรหัสผ่านใหม่
...    ประวัติการศึกษา
...    ปริญญาตรี
...    ชื่อมหาวิทยาลัย
...    ชื่อวุฒิปริญญา
...    ปี พ.ศ. ที่จบ
...    ปริญญาโท
...    ชื่อมหาวิทยาลัย
...    ชื่อวุฒิปริญญา
...    ปี พ.ศ. ที่จบ
...    ปริญญาเอก
...    ชื่อมหาวิทยาลัย
...    ชื่อวุฒิปริญญา
...    ปี พ.ศ. ที่จบ



@{EXPECTED_WORDS_CN}
...    账户
...    密码
...    专长
...    教育
...    个人设置
...    称谓
...    名字 (英文)
...    姓氏 (英文)
...    名字 (泰文)
...    姓氏 (泰文)
...    电子邮件
...    学术职位
...    对于没有博士学位的教师，请注明
...    密码设置
...    旧密码
...    新密码
...    确认新密码
...    教育背景
...    学士学位
...    大学名称
...    学位名称
...    毕业年份
...    硕士学位
...    大学名称
...    学位名称
...    毕业年份
...    博士学位
...    大学名称
...    学位名称
...    毕业年份
...    

 

* Keywords *
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

User Login
    Input Text      id=username    ${USER_USERNAME}
    Input Text      id=password    ${USER_PASSWORD}
    Click Button    xpath=//button[@type='submit']
    Sleep    2s 
    Location Should Be    ${USER URL} 

Switch Language To
    [Arguments]    ${lang_code}    ${expected_language}
    # Click the language dropdown button
    Click Element    id=navbarDropdown
    # Wait for the dropdown menu to appear
    Wait Until Element Is Visible    css:ul.dropdown-menu[aria-labelledby="navbarDropdown"]    10s
    # Retrieve and log the text of the option
    ${option_text}=    Get Text    xpath=//a[contains(@href, "/language/${lang_code}")]
    Log    Option language is: ${option_text}
    # Click the language option
    Click Element    xpath=//a[contains(@href, "/language/${lang_code}")]
    Sleep    5s
    # Get the updated text from the dropdown button
    ${new_lang}=    Get Text    id=navbarDropdown
    Log    New language is: ${new_lang}
    Should Contain    ${new_lang}    ${expected_language}



* Test Cases *


Dashboard Page Switch Language To TH
    [Tags]    UAT001-UserProfile
    Open Browser To Login Page
    Login Page Should Be Open
    User Login

    ${current_url}=    Get Location
    Log To Console    After Login URL: ${current_url}

    Go To    ${PROFILE URL}
    Sleep    3s
    ${current_url}=    Get Location
    Log To Console    After Go To URL: ${current_url}
    Location Should Be    ${PROFILE URL}

    Click Element    id=navbarDropdown
    Wait Until Element Is Visible    css:ul.dropdown-menu[aria-labelledby="navbarDropdown"]    10s
    Click Element    xpath=//a[contains(@href, "/language/th")]
    Sleep    3s
    Reload Page
    Sleep    3s

    ${new_lang}=    Get Text    id=navbarDropdown
    Log To Console    New language after switch: ${new_lang}
    Should Contain    ${new_lang}    ไทย

     Wait Until Element Is Visible    id=account-tab    10s
    Click Element    id=account-tab

    Wait Until Element Is Visible    id=account-tab    10s
    Click Element    id=password-tab

     Wait Until Element Is Visible    id=account-tab    10s
    Click Element    id=expertise-tab

     Wait Until Element Is Visible    id=account-tab    10s
    Click Element    id=education-tab

    ${html_source}=    Get Source
    Log To Console    Page HTML: ${html_source}

    FOR    ${word}    IN    @{EXPECTED_WORDS__TH}
        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END

    Sleep    5s
    Close Browser


Dashboard Page Switch Language To En
    [Tags]    UAT001-UserProfile
    Open Browser To Login Page
    Login Page Should Be Open
    User Login

    ${current_url}=    Get Location
    Log To Console    After Login URL: ${current_url}

    Go To    ${PROFILE URL}
    Sleep    3s
    ${current_url}=    Get Location
    Log To Console    After Go To URL: ${current_url}
    Location Should Be    ${PROFILE URL}

    Click Element    id=navbarDropdown
    Wait Until Element Is Visible    css:ul.dropdown-menu[aria-labelledby="navbarDropdown"]    10s
    Click Element    xpath=//a[contains(@href, "/language/en")]
    Sleep    3s
    Reload Page
    Sleep    3s

    ${new_lang}=    Get Text    id=navbarDropdown
    Log To Console    New language after switch: ${new_lang}
    Should Contain    ${new_lang}    English

     Wait Until Element Is Visible    id=account-tab    10s
    Click Element    id=account-tab

    Wait Until Element Is Visible    id=account-tab    10s
    Click Element    id=password-tab

     Wait Until Element Is Visible    id=account-tab    10s
    Click Element    id=expertise-tab

     Wait Until Element Is Visible    id=account-tab    10s
    Click Element    id=education-tab

    ${html_source}=    Get Source
    Log To Console    Page HTML: ${html_source}

    FOR    ${word}    IN    @{EXPECTED_WORDS_EN}

        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END

    Sleep    5s
    Close Browser

Dashboard Page Switch Language To CN
    [Tags]    UAT001-UserProfile
    Open Browser To Login Page
    Login Page Should Be Open
    User Login

    ${current_url}=    Get Location
    Log To Console    After Login URL: ${current_url}

    Go To    ${PROFILE URL}
    Sleep    3s
    ${current_url}=    Get Location
    Log To Console    After Go To URL: ${current_url}
    Location Should Be    ${PROFILE URL}

    Click Element    id=navbarDropdown
    Wait Until Element Is Visible    css:ul.dropdown-menu[aria-labelledby="navbarDropdown"]    10s
    Click Element    xpath=//a[contains(@href, "/language/zh")]
    Sleep    3s
    Reload Page
    Sleep    3s

    ${new_lang}=    Get Text    id=navbarDropdown
    Log To Console    New language after switch: ${new_lang}
    Should Contain    ${new_lang}    中文

    Wait Until Element Is Visible    id=account-tab    10s
    Click Element    id=account-tab

    Wait Until Element Is Visible    id=account-tab    10s
    Click Element    id=password-tab

     Wait Until Element Is Visible    id=account-tab    10s
    Click Element    id=expertise-tab

     Wait Until Element Is Visible    id=account-tab    10s
    Click Element    id=education-tab


    ${html_source}=    Get Source
    Log To Console    Page HTML: ${html_source}

    FOR    ${word}    IN    @{EXPECTED_WORDS_CN}

        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END

    Sleep    5s
    Close Browser