<?php
// Lấy giá trị đánh giá sao từ dữ liệu gửi lên
$rate = $_POST['rate'];

// Xử lý đánh giá sao ở đây (lưu vào cơ sở dữ liệu, tính điểm trung bình, v.v.)
// ...

// Trả về kết quả (nếu cần)
echo "Đánh giá sao của bạn là: " . $rate;
?>
