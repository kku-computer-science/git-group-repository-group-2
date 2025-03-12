# Change log Sprint 3

**วันที่อัปเดตล่าสุด:** 12/03/2568  
version: 2.0 \
ผู้พัฒนา: กลุ่ม 2 section : 3

#### [14] (Task: *As an administrative staff, I want to present the highlights to all visitors.*)

### การปรับปรุงและแก้ไข
 - เพิ่มเมนู Upload Highlight
 - เพิ่ม views/highlight สำหน้าหน้าการจัดการไฮไลท์ในส่วนของสตาฟ
    - edit.blade.php
    - index.blade.php
    - show.blade.php
    - view.blade.php
 - เพิ่ม Model Highlight, Tag, Image, เพื่อเก็บข้อมูลและเชื่อมต่อกับDataBase
 - เพิ่มตาราง highlights , highlight_tag , tags , images เพื่อเก็บข้อมูล
 - เพิ่ม HighlightController ใช้จัดการไฮไลต์ 
 - HomeController เพิ่มฟังก์ชันสำหรับการแสดงไฮไลท์
 - เพิ่ม routes เพื่อกำหนดเส้นทางแสดงไฮไลท์
 - เพิ่มหน้า showHighlight.blade.php สำหรับแสดงรายละเอียดของไฮไลท์
 - เพิ่มหน้า searchByTag.blade.php สำหรับคลิกแท็กแล้วแสดงรายละเอียดนั้นๆ
 - แก้หน้า home.blade.php ให้แสดงไฮไลท์
 - เพิ่มหน้า allHighlights.blade.php สำหรับแสดงหน้าไฮไลท์ทั้งหมด
   
