*** Settings ***
Resource          resource.robot

*** Variables ***
@{EXPECTED_WORDS_HOME}    รายงานจำนวนบทความทั้งหมด (สะสมในช่วง 5 ปี)    จำนวน    ปี    งานวิจัยทั้งหมด    ผลงานตีพิมพ์ (5 ปี ย้อนหลัง)
@{EXPECTED_WORDS_DEPARTMENT_CS}    นักวิจัย    สาขาวิชาวิทยาการคอมพิวเตอร์    งานวิจัยที่สนใจ    ค้นหา
@{EXPECTED_WORDS_DEPARTMENT_IT}    นักวิจัย    สาขาวิชาเทคโนโลยีสารสนเทศ    งานวิจัยที่สนใจ    ค้นหา
@{EXPECTED_WORDS_DEPARTMENT_GIS}    นักวิจัย    สาขาวิชาภูมิสารสนเทศศาสตร์    งานวิจัยที่สนใจ    ค้นหา
@{EXPECTED_WORDS_RESEARCH_PROJECT}    โครงการบริการวิชาการ / โครงการวิจัย    แสดง    รายการ    ค้นหา    ลำดับ    ปี    ชื่อโครงการ    รายละเอียด    หัวหน้าโครงการ    สถานะ    ปิดโครงการ
@{EXPECTED_WORDS_RESEARCH_GROUP}    กลุ่มวิจัย   ผู้ดูแลห้องปฏิบัติการ    รายละเอียดเพิ่มเติม
@{EXPECTED_WORDS_RESEARCH_GROUP_DETAIL}    ผู้ดูแลห้องปฏิบัติการ    นักศึกษา
@{EXPECTED_WORDS_REPORT}    สถิติจำนวนบทความทั้งหมด 5 ปี    สถิติจำนวนบทความที่ได้รับการอ้างอิง
@{EXPECTED_WORDS_NAV_BAR}    หน้าแรก    สาขาวิชา    โครงการวิจัย    กลุ่มวิจัย    รายงาน
@{EXPECTED_PATHS}    http://${SERVER}/researchers/1    http://${SERVER}/researchers/2    http://${SERVER}/researchers/3
@{EXPECTED_WORDS_DEPARTMENT_EN}    Computer Science    Infomation Technology    Geo-Informatics
@{EXPECTED_WORDS_DEPARTMENT_TH}    สาขาวิชาวิทยาการคอมพิวเตอร์    สาขาวิชาเทคโนโลยีสารสนเทศ    สาขาวิชาภูมิสารสนเทศศาสตร์


*** Test Cases ***
Open Home
    [Tags]    UAT001-OpenHome
    Open Browser To Home Page
    Sleep    5s
    Home Page Should Be Open
    [Teardown]    Close Browser

Open Researcher_CS
    [Tags]    UAT002-OpenResearcherCS
    Open Browser To Researcher_CS Page
    Sleep    5s
    Researcher_CS Page Should Be Open
    [Teardown]    Close Browser

Open Researcher_IT
    [Tags]    UAT003-OpenResearcherIT
    Open Browser To Researcher_IT Page
    Sleep    5s
    Researcher_IT Page Should Be Open
    [Teardown]    Close Browser

Open Researcher_GIS
    [Tags]    UAT004-OpenResearcherGIS
    Open Browser To Researcher_GIS Page
    Sleep    5s
    Researcher_GIS Page Should Be Open
    [Teardown]    Close Browser

Open Research_Project
    [Tags]    UAT005-OpenResearchProject
    Open Browser To Research_Project Page
    Sleep    5s
    Research_Project Page Should Be Open
    [Teardown]    Close Browser

Open Research_Group
    [Tags]    UAT006-OpenResearchGroup
    Open Browser To Research_Group Page
    Sleep    5s
    Research_Group Page Should Be Open
    [Teardown]    Close Browser

Open Research_Group_Detail
    [Tags]    UAT007-OpenResearchGroupDetail
    Open Browser To Research_Group_Detail Page
    Sleep    5s
    Research_Group_Detail Page Should Be Open
    [Teardown]    Close Browser

Open Report
    [Tags]    UAT008-OpenReport
    Open Browser To Report Page
    Sleep    5s
    Report Page Should Be Open
    [Teardown]    Close Browser

