*** Settings ***
Library  SeleniumLibrary

*** Variables ***
${URL}  http://127.0.0.1:8002
${BANNER_UPLOAD_PAGE}  ${URL}/banners
${BANNER_IMAGE_TH}  /Users/nipatchapakdee/SoftwareEN/Project/Setup_project/git-group-repository-group-2/Project/Code/robot_tests/2_up.png
${BANNER_IMAGE_EN}  /Users/nipatchapakdee/SoftwareEN/Project/Setup_project/git-group-repository-group-2/Project/Code/robot_tests/1_up.png
${BANNER_IMAGE_ZH}  /Users/nipatchapakdee/SoftwareEN/Project/Setup_project/git-group-repository-group-2/Project/Code/robot_tests/3_up.png
${LOGIN_PAGE}  ${URL}/login
${USER_USERNAME}  admin@gmail.com
${USER_PASSWORD}  12345678

*** Test Cases ***
Upload Banner Images and Verify Success Message
    Open Browser  ${LOGIN_PAGE}  chrome
    Input Text  id=username  ${USER_USERNAME}
    Input Text  id=password  ${USER_PASSWORD}
    Click Button  xpath=//button[text()='Log In']
    Wait Until Page Contains  Dashboard  # รอจนกว่าจะเข้าสู่ Dashboard หรือหน้าแรก
    Go To  ${BANNER_UPLOAD_PAGE}
    # อัปโหลดรูปภาพทั้ง 3 ภาษา
    Choose File  name=image_th  ${BANNER_IMAGE_TH}
    Choose File  name=image_en  ${BANNER_IMAGE_EN}
    Choose File  name=image_zh  ${BANNER_IMAGE_ZH}
    Click Button  xpath=//button[text()='บันทึก']
    Wait Until Page Contains  อัปโหลดรูปภาพสำเร็จ
    Close Browser