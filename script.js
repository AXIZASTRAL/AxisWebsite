function register() {
  const username = document.getElementById("register-username").value.trim();
  const password = document.getElementById("register-password").value.trim();
  const message = document.getElementById("message");

  if (!username || !password) {
    message.textContent = "กรุณากรอกชื่อผู้ใช้และรหัสผ่าน";
    return;
  }

  if (localStorage.getItem("user_" + username)) {
    message.textContent = "ชื่อผู้ใช้นี้มีอยู่แล้ว";
  } else {
    localStorage.setItem("user_" + username, password);
    message.textContent = "ลงทะเบียนสำเร็จ!";
  }
}

function login() {
  const username = document.getElementById("login-username").value.trim();
  const password = document.getElementById("login-password").value.trim();
  const message = document.getElementById("message");

  const savedPassword = localStorage.getItem("user_" + username);

  if (!savedPassword) {
    message.textContent = "ไม่มีบัญชีนี้ กรุณาลงทะเบียนก่อน";
    return;
  }

  if (password === savedPassword) {
    localStorage.setItem("currentUser", username);
    location.href = "dashboard.html";
  } else {
    message.textContent = "รหัสผ่านไม่ถูกต้อง";
  }
}
