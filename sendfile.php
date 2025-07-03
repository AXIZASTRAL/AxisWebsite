<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_name = htmlspecialchars($_POST['student_name']);
    $to = "your-email@example.com";  // เปลี่ยนเป็นอีเมลคุณ
    $subject = "ส่งงานจาก: " . $student_name;
    $message = "นักเรียนชื่อ $student_name ส่งงานมาให้ครับ";

    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['file']['tmp_name'];
        $file_name = basename($_FILES['file']['name']);

        $file_data = file_get_contents($file_tmp);
        $file_encoded = chunk_split(base64_encode($file_data));

        $separator = md5(time());
        $eol = "\r\n";

        $headers = "From: webmaster@yourdomain.com" . $eol;
        $headers .= "MIME-Version: 1.0" . $eol;
        $headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . $eol . $eol;

        $body = "--" . $separator . $eol;
        $body .= "Content-Type: text/plain; charset=\"UTF-8\"" . $eol;
        $body .= "Content-Transfer-Encoding: 7bit" . $eol . $eol;
        $body .= $message . $eol;

        $body .= "--" . $separator . $eol;
        $body .= "Content-Type: application/octet-stream; name=\"" . $file_name . "\"" . $eol;
        $body .= "Content-Transfer-Encoding: base64" . $eol;
        $body .= "Content-Disposition: attachment; filename=\"" . $file_name . "\"" . $eol . $eol;
        $body .= $file_encoded . $eol;
        $body .= "--" . $separator . "--";

        if (mail($to, $subject, $body, $headers)) {
            echo "ส่งงานเรียบร้อยแล้ว ขอบคุณครับ $student_name";
        } else {
            echo "เกิดข้อผิดพลาดในการส่งงาน";
        }
    } else {
        echo "กรุณาแนบไฟล์งาน";
    }
} else {
    echo "ไม่สามารถใช้งานหน้านี้ได้โดยตรง";
}
?>
