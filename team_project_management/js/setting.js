const avatarInput = document.getElementById("avatarInput");
const cameraIcon = document.querySelector(".camera-icon");
const avatarForm = document.getElementById("avatarForm");



// click vào icon camera -> cũng chọn ảnh
cameraIcon.onclick = () => avatarInput.click();

// khi chọn ảnh -> auto submit form
avatarInput.addEventListener("change", () => {
    avatarForm.submit();
});

