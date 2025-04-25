*** Settings ***
Library           SeleniumLibrary

*** Variables ***
${SERVER}                    localhost:8000
${ADMIN_USERNAME}             admin@gmail.com
${ADMIN_PASSWORD}             12345678
${LOGIN URL}                  http://${SERVER}/login
${ADMIN URL}                  http://${SERVER}/dashboard
${PROFILE URL}                http://${SERVER}/profile
${FUNDS URL}                  http://${SERVER}/funds
${RESEARCHGROUP URL}          http://${SERVER}/researchGroups
${RESEARCHPROJECT URL}        http://${SERVER}/researchProjects
${PUBLISHEDRESEARCH URL}      http://${SERVER}/papers
${BOOKS URL}                  http://${SERVER}/books
${OTHERRESEARCH URL}          http://${SERVER}/patents
${USERS URL}                  http://${SERVER}/users
${CHROME_BROWSER_PATH}       ${EXECDIR}${/}ChromeForTesting${/}chrome.exe
${CHROME_DRIVER_PATH}        ${EXECDIR}${/}ChromeForTesting${/}chromedriver.exe
@{LANGUAGES}
...    en
...    th
...    zn

@{EXPECTED_WORDS_ADMIN_EN}
...    Research Information Management System
...    Logout
...    Dashboard
...    Profile
...    Research Project
...    User Profile
...    Option
...    Manage Fund
...    Research Group
...    Manage Publications
...    Published Research
...    Book
...    Other Research
...    Admin
...    Users
...    Role
...    Permission
...    Departments
...    Manage Programs
...    Manage Expertise
...    Manage Image
...    Welcome to the computer science research data management system.
...    Hello, Admin
...    Change Picture
...    Account
...    Password

@{EXPECTED_WORDS_DASHBOARD_TH}
...    ระบบการจัดการข้อมูลการวิจัย
...    ข้อมูลส่วนตัว
...    ออกจากระบบ
...    แดชบอร์ด
...    ข้อมูลผู้ใช้
...    ตัวเลือก
...    จัดการกองทุน
...    โครงการวิจัย
...    กลุ่มวิจัย
...    จัดการผลงานตีพิมพ์
...    ผลงานวิจัยที่เผยแพร่
...    หนังสือ
...    งานวิจัยอื่นๆ
...    ผู้ดูแลระบบ
...    ผู้ใช้
...    บทบาท
...    สิทธิ์
...    แผนก
...    จัดการหลักสูตร
...    จัดการความเชี่ยวชาญ
...    จัดการรูปภาพ
...    ยินดีต้อนรับสู่ระบบจัดการข้อมูลการวิจัยวิทยาการคอมพิวเตอร์
...    สวัสดี, ผู้ดูแลระบบ

@{EXPECTED_WORDS_DASHBOARD_CN}
...    研究信息管理系统
...    欢迎使用计算机科学研究数据管理系统
...    您好，管理员
...    仪表板


@{EXPECTED_WORDS_ADMIN_CN}
...    研究信息管理系统
...    英语
...    退出
...    仪表板
...    个人资料
...    用户资料
...    选项
...    管理资金
...    研究项目
...    研究小组
...    管理出版物
...    管理员
...    用户
...    角色
...    权限
...    部门
...    管理课程
...    管理专业知识
...    管理图片
...    
@{EXPECTED_WORDS_PROFILE_TH}
...    ตั้งค่าข้อมูลส่วนตัว
...    คำนำหน้าชื่อ
...    ชื่อ (ภาษาอังกฤษ)
...    ชื่อ (ภาษาไทย)
...    นามสกุล (ภาษาอังกฤษ)
...    นามสกุล (ภาษาไทย)
...    อีเมล
...    อัปเดต
...    ตั้งค่ารหัสผ่าน
...    รหัสผ่านเก่า
...    รหัสผ่านใหม่
...    ยืนยันรหัสผ่านใหม่
...    อัปเดต!!

@{EXPECTED_WORDS_PROFILE_CN}
...    账户
...    密码
...    个人设置
...    称谓
...    名字 (英文)
...    姓氏 (英文)
...    名字 (泰文)
...    姓氏 (泰文)
...    电子邮件
...    密码设置
...    旧密码
...    新密码
...    确认新密码


@{EXPECTED_WORDS_FUNDS_TH}
...    ทุนวิจัย
...    เพิ่ม
...    ลำดับที่	
...	   ชื่อทุน	
...	   ประเภททุน
...    ระดับทุน
...    ดำเนินการ
...   

@{EXPECTED_WORDS_FUNDS_CN}
...    研究资助
...    序号
...    资金名称
...    资金类型
...    资金级别
...    操作
...    添加

@{EXPECTED_WORDS_RESEARCHPROJECT_TH}
...    โครงการวิจัย
...    เพิ่ม
...    ลำดับที่
...    ปี
...    ชื่อโครงการ
...    หัวหน้าโครงการ
...    สมาชิก
...    ดำเนินการ
...    
@{EXPECTED_WORDS_RESEARCHPROJECT_CN}
...    研究项目
...    序号	年份
...    项目名称
...    项目负责人
...    成员
...    操作
...    添加

@{EXPECTED_WORDS_RESEARCHGROUP_TH}
...    กลุ่มวิจัย
...    เพิ่ม
...    ลำดับที่	
...	   ชื่อกลุ่ม(ไทย)
...    หัวหน้าโครงการ
...    สมาชิก
...    ดำเนินการ
...    
@{EXPECTED_WORDS_RESEARCHGROUP_CN}
...    研究小组
...    序号	组名(泰国)
...    项目负责人
...    成员
...    操作
...    添加f
...    
@{EXPECTED_WORDS_PUBLISHEDRESEARCH_TH}
...    งานวิจัยที่เผยแพร่
...    เพิ่ม
...    ลำดับที่
...    ชื่อบทความ
...    ประเภทบทความ
...    ปีที่ส่ง
...    ดำเนินการ
... 

@{EXPECTED_WORDS_PUBLISHEDRESEARCH_CN}
...    已发布的研究
...    序号
...    论文名称
...    论文类型
...    年份
...    操作
...    

@{EXPECTED_WORDS_BOOKS_TH}
...    หนังสือ
...    เพิ่ม
...    ลำดับที่
...    ชื่อหนังสือ
...    ปี
...    แหล่งที่มาของการเผยแพร่
...    หน้า
...    ดำเนินการ
...    
@{EXPECTED_WORDS_OTHERRESEARCH_TH}
...    งานวิจัยอื่นๆ (สิทธิบัตร, แบบจำลองการใช้งาน, ลิขสิทธิ์)
...    ลำดับที่
...    ชื่อผลงานวิจัย
...    ประเภทผลงานวิจัย
...    วันที่ลงทะเบียน
...    หมายเลขการลงทะเบียน
...    ผู้แต่งสิทธิบัตร
...    
@{EXPECTED_WORDS_USERS_TH}
...    ผู้ใช้
...    ภาควิชา
...    อีเมล
...    บทบาท
...    ดำเนินการ 
...    
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

Admin Login
    Input Text      id=username    ${ADMIN_USERNAME}
    Input Text      id=password    ${ADMIN_PASSWORD}
    Click Button    xpath=//button[@type='submit']
    Sleep    2s 
    Location Should Be    ${ADMIN URL} 

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



*** Test Cases ***
# Open Admin Page
#     [Tags]    UAT001-OpenAdminPage
#     Open Browser To Login Page
#     Login Page Should Be Open
#     Admin Login
#     Sleep    2s
#     Switch Language To    th    ไทย
#     Sleep    5s
#     Close Browser

Dashboard Page Switch Language To TH 001
    [Tags]    UAT001-OpenAdminPage
    Open Browser To Login Page
    Login Page Should Be Open
    Admin Login
    Sleep    2s
    Switch Language To    th    ไทย
    ${html_source}=    Get Source
    Log    HTML Source: ${html_source}
    FOR    ${word}    IN    @{EXPECTED_WORDS_DASHBOARD_TH}
        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END 

Dashboard Page Switch Language To TH 002
    [Tags]    UAT001-UserProfile
    Switch Language To    th    ไทย
    Go To    ${PROFILE URL}
    Location Should Be    ${PROFILE URL}
    Click Element    id=account-tab
    ${html_source}=    Get Source
    FOR    ${word}    IN    @{EXPECTED_WORDS_PROFILE_TH}
        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END 
    Sleep    3s
    Click Element    id=password-tab
    ${html_source}=    Get Source
    FOR    ${word}    IN    @{EXPECTED_WORDS_PROFILE_TH}
        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END 

Dashboard Page Switch Language To TH 003
    Switch Language To    th    ไทย
    Go To    ${FUNDS URL}
    Location Should Be    ${FUNDS URL}
    ${html_source}=    Get Source
    FOR    ${word}    IN    @{EXPECTED_WORDS_FUNDS_TH}
        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END 

Dashboard Page Switch Language To TH 004
    Switch Language To    th    ไทย
    Go To    ${RESEARCHPROJECT URL}
    Location Should Be    ${RESEARCHPROJECT URL}
    ${html_source}=    Get Source
    FOR    ${word}    IN    @{EXPECTED_WORDS_RESEARCHPROJECT_TH}
        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END 

Dashboard Page Switch Language To TH 005
    Switch Language To    th    ไทย
    Go To    ${RESEARCHGROUP URL}
    Location Should Be    ${RESEARCHGROUP URL}
    ${html_source}=    Get Source
    FOR    ${word}    IN    @{EXPECTED_WORDS_RESEARCHGROUP_TH}
        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END 


Dashboard Page Switch Language To TH 006
    Switch Language To    th    ไทย
    Go To    ${PUBLISHEDRESEARCH URL}
    Location Should Be    ${PUBLISHEDRESEARCH URL}
    ${html_source}=    Get Source
    FOR    ${word}    IN    @{EXPECTED_WORDS_PUBLISHEDRESEARCH_TH}
        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END 


Dashboard Page Switch Language To TH 007
    Switch Language To    th    ไทย
    Go To    ${BOOKS URL}
    Location Should Be    ${BOOKS URL}
    ${html_source}=    Get Source
    FOR    ${word}    IN    @{EXPECTED_WORDS_BOOKS_TH}
        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END 


Dashboard Page Switch Language To TH 008 
    Switch Language To    th    ไทย
    Go To    ${OTHERRESEARCH URL}
    Location Should Be    ${OTHERRESEARCH URL}
    ${html_source}=    Get Source
    FOR    ${word}    IN    @{EXPECTED_WORDS_OTHERRESEARCH_TH}
        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END 

Dashboard Page Switch Language To TH 009
    Switch Language To    th    ไทย
    Go To    ${USERS URL}
    Location Should Be    ${USERS URL}
    ${html_source}=    Get Source
    FOR    ${word}    IN    @{EXPECTED_WORDS_USERS_TH}
        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END 
    Sleep    5s
    Close Browser

Dashboard Page Switch Language To CN 001
    [Tags]    UAT002-OpenAdminPage
    Open Browser To Login Page
    Login Page Should Be Open
    Admin Login
    Sleep    2s
    Switch Language To    zh    中文
    ${html_source}=    Get Source
    Log    HTML Source: ${html_source}
    FOR    ${word}    IN    @{EXPECTED_WORDS_DASHBOARD_CN}
        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END 
    Sleep    5s
    Close Browser

Dashboard Page Switch Language To CN 002
    [Tags]    UAT002-UserProfile
    Switch Language To    zh    中文
    Go To    ${PROFILE URL}
    Location Should Be    ${PROFILE URL}
    Click Element    id=account-tab
    ${html_source}=    Get Source
    FOR    ${word}    IN    @{EXPECTED_WORDS_PROFILE_CN}
        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END 
    Sleep    3s
    Click Element    id=password-tab
    ${html_source}=    Get Source
    FOR    ${word}    IN    @{EXPECTED_WORDS_PROFILE_CN}
        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END 

Dashboard Page Switch Language To CN 003
    [Tags]    UAT003-FUNDS
    Switch Language To    zh    中文
    Go To    ${FUNDS URL}
    Location Should Be    ${FUNDS URL}
    ${html_source}=    Get Source
    FOR    ${word}    IN    @{EXPECTED_WORDS_FUNDS_CN}
        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END 

Dashboard Page Switch Language To CN 004
    [Tags]    UAT003-RESEARCHPROJECT
    Switch Language To    zh    中文
    Go To    ${RESEARCHPROJECT URL}
    Location Should Be    ${RESEARCHPROJECT URL}
    ${html_source}=    Get Source
    FOR    ${word}    IN    @{EXPECTED_WORDS_RESEARCHPROJECT_CN}
        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END 

Dashboard Page Switch Language To CN 005
    [Tags]    UAT003-RESEARCHPROJECT
    Switch Language To    zh    中文
    Go To    ${RESEARCHGROUP URL}
    Location Should Be    ${RESEARCHGROUP URL}
    ${html_source}=    Get Source
    FOR    ${word}    IN    @{EXPECTED_WORDS_RESEARCHGROUP_CN}
        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END 

Dashboard Page Switch Language To CN 006
    [Tags]    UAT003-RESEARCHPROJECT
    Switch Language To    zh    中文
    Go To    ${PUBLISHEDRESEARCH URL}
    Location Should Be    ${PUBLISHEDRESEARCH URL}
    ${html_source}=    Get Source
    FOR    ${word}    IN    @{EXPECTED_WORDS_PUBLISHEDRESEARCH_CN}
        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END 

# Dashboard Page Switch Language To TH 006
#     Switch Language To    th    ไทย
#     Go To    ${PUBLISHEDRESEARCH URL}
#     Location Should Be    ${PUBLISHEDRESEARCH URL}
#     ${html_source}=    Get Source
#     FOR    ${word}    IN    @{EXPECTED_WORDS_PUBLISHEDRESEARCH_TH}
#         Log    Checking for word: ${word}
#         Should Contain    ${html_source}    ${word}
#     END 