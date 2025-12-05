const tabButtons = document.querySelectorAll('.tab-btn');
const tabContents = document.querySelectorAll('.tab-content');

tabButtons.forEach(btn => {
    btn.addEventListener('click', () => {
        // ลบ active จากปุ่มทุกปุ่ม
        tabButtons.forEach(b => b.classList.remove('active'));
        // เพิ่ม active ให้ปุ่มที่คลิก
        btn.classList.add('active');

        // ซ่อนทุก tab-content
        tabContents.forEach(tab => tab.style.display = 'none');

        // แสดง tab-content ที่เลือก
        const target = document.getElementById(btn.dataset.tab);
        target.style.display = 'grid'; // ใช้ grid สำหรับ profile
        if(target.id === 'activities') {
            target.style.display = 'block';
        }
    });
});
