
const tabs = document.querySelectorAll('.tab-icon');
const contents = document.querySelectorAll('.feed-container');

tabs.forEach(tab => {
    tab.addEventListener('click', () => {
        console.log(document.querySelectorAll('.tab-icon'));
console.log(document.querySelectorAll('.feed-container'));

        const target = tab.dataset.tab; // lấy tab1, tab2, ...
        
        // Ẩn tất cả nội dung
        contents.forEach(c => c.classList.add('hidden'));

        // Hiện nội dung tương ứng
        const activeContent = document.querySelector(`.feed-container.${target}`);
        if (activeContent) activeContent.classList.remove('hidden');

        // Xoá active khỏi tất cả tab
        tabs.forEach(t => t.classList.remove('active-tab'));

        // Thêm active cho tab hiện tại
        tab.classList.add('active-tab');
    });
});

//
document.addEventListener("DOMContentLoaded", function() {
    const menus = document.querySelectorAll(".post-menu");

    menus.forEach(menu => {
        const icon = menu.querySelector(".menu-icon");
        const dropdown = menu.querySelector(".menu-dropdown");

        icon.addEventListener("click", (e) => {
            e.stopPropagation();

            // Đóng tất cả menu khác
            document.querySelectorAll(".menu-dropdown.show")
                .forEach(d => { if (d !== dropdown) d.classList.remove("show"); });

            // Toggle menu hiện tại
            dropdown.classList.toggle("show");
        });
    });

    // Click ra ngoài -> đóng tất cả
    document.addEventListener("click", () => {
        document.querySelectorAll(".menu-dropdown.show")
            .forEach(d => d.classList.remove("show"));
    });
});
//
const stars = document.querySelectorAll("#rating i");
let selectedRating = 0;

document.querySelectorAll(".rating").forEach(ratingBox => {

    const stars = ratingBox.querySelectorAll("i");
    let selectedRating = 0;

    stars.forEach(star => {

        star.addEventListener("mouseover", function () {
            highlightStars(stars, this.dataset.value);
        });

        star.addEventListener("mouseout", function () {
            highlightStars(stars, selectedRating);
        });

        star.addEventListener("click", function () {
            selectedRating = this.dataset.value;
            highlightStars(stars, selectedRating);
        });

    });

    function highlightStars(stars, count) {
        stars.forEach((s, i) => {
            s.classList.toggle("active", i < count);
        });
    }

});
//
const openFormBtn = document.getElementById("openFormBtn");
const createPostForm = document.getElementById("createPostForm");
const cancelPostBtn = document.getElementById("cancelPostBtn");
const editPostBtn = document.querySelectorAll('.edit-notify');

openFormBtn.addEventListener("click", () => {
    createPostForm.classList.toggle("hidden");
    document.getElementById("PostForm").reset()
});

cancelPostBtn.addEventListener("click", () => {
    createPostForm.classList.add("hidden");
    document.getElementById("PostForm").reset()
});
editPostBtn.forEach(btn => {
    btn.addEventListener("click", () => {
        createPostForm.classList.remove("hidden");

        const postItem = btn.closest('.post-item');
        const content = postItem.querySelector('.post-content').textContent.trim();
        const notifyId = btn.dataset.notify;

        // Nạp nội dung
        createPostForm.querySelector('.post-input').value = content;
        createPostForm.querySelector('input[name="id_notify"]').value = notifyId;

        // Xóa các hidden input cũ nếu có
        createPostForm.querySelectorAll('input[name="existing_files[]"]').forEach(el => el.remove());

        // Hiển thị tên file cũ và tạo hidden input
        const fileNames = [];
        postItem.querySelectorAll('.file-box .file-name').forEach(f => {
            const fileName = f.textContent.trim();
            fileNames.push(fileName);

            // Tạo hidden input
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'existing_files[]';
            hiddenInput.value = fileName;
            createPostForm.appendChild(hiddenInput);
        });

        const fileNameSpan = createPostForm.querySelector('#file-name');
        fileNameSpan.textContent = fileNames.length > 0 ? fileNames.join(', ') : "Chọn tệp đính kèm";

        createPostForm.scrollIntoView({ behavior: "smooth" });
    });
});



//

const addBtn = document.querySelector(".add-member-btn");
const requestBtn = document.querySelector(".request-btn");
const cancelBtn = document.getElementById("cancelAdd");

const listMember = document.querySelector(".list-member--approved");
const listMemberPending = document.querySelector(".list-member--pending");
const box = document.getElementById("addMemberBox");

// Click Add
addBtn.addEventListener("click", () => {
    const boxVisible = !box.classList.contains("hidden");
    box.classList.toggle("hidden");               // toggle box
    listMember.classList.toggle("hidden", !boxVisible); // member ẩn khi box mở, hiện khi box đóng
    listMemberPending.classList.add("hidden");    // pending luôn ẩn
});

// Click Request
requestBtn.addEventListener("click", () => {
    const pendingVisible = !listMemberPending.classList.contains("hidden");
    listMemberPending.classList.toggle("hidden");       // toggle pending
    listMember.classList.toggle("hidden", !pendingVisible); // member ẩn khi pending mở, hiện khi pending đóng
    box.classList.add("hidden");                        // box luôn ẩn
});

// Click Cancel
cancelBtn.addEventListener("click", () => {
    box.classList.add("hidden");
    listMemberPending.classList.add("hidden");
    listMember.classList.remove("hidden");             // member luôn hiện
});

// 
const editBtn = document.getElementById('editToggle');
const prjCard = document.querySelector('.project-card');
const editCard = document.querySelector('.edit-card');

editBtn.addEventListener('click', () => {
    prjCard.classList.add('hidden');    // ẩn thẻ gốc
    editCard.classList.remove('hidden'); // hiện thẻ edit
});


//
const openTaskBtn = document.getElementById("openTaskBtn");
const assignModal = document.querySelector(".assign-modal");
const cancelAssignBtn = document.getElementById("cancelAssignBtn");
const taskCards = document.querySelectorAll(".task-card-leader");
const editTaskBtn = document.querySelectorAll('.edit-task');

// Khi click nút "Giao công việc"
openTaskBtn.addEventListener("click", () => {
    // Ẩn tất cả task-card
    taskCards.forEach(card => card.classList.toggle("hidden"));

    // Hiện modal giao công việc
    assignModal.classList.toggle("hidden");
    assignModal.scrollIntoView({ behavior: "smooth" });
    document.getElementById("assignForm").reset()
});

// Khi click nút "Hủy" trong modal
cancelAssignBtn.addEventListener("click", () => {
    assignModal.classList.add("hidden");
    taskCards.forEach(card => card.classList.remove("hidden"));
    document.getElementById("assignForm").reset()
});

editTaskBtn.forEach(btn => {
    btn.addEventListener("click", () => {
        assignModal.classList.remove("hidden");
        taskCards.forEach(card => card.classList.add("hidden"));

        const taskItem = btn.closest('.task-card-leader');
        const form = assignModal.querySelector('#createTaskForm');

        // Nội dung + ID
        form.querySelector('#contentWork').value = taskItem.querySelector('.task-desc').textContent.trim();
        form.querySelector('input[name="id_task"]').value = btn.dataset.task;

        // Ngày bắt đầu/kết thúc
        form.querySelector('input[name="start_datetime"]').value = taskItem.dataset.start;
        form.querySelector('input[name="end_datetime"]').value = taskItem.dataset.end;

        // User
        const assignedUsers = taskItem.dataset.user.split(','); // nếu lưu "1,3" trong dataset

        form.querySelectorAll('input[name="member[]"]').forEach(checkbox => {
            checkbox.checked = assignedUsers.includes(checkbox.value);
        });

        // File cũ
        form.querySelectorAll('input[name="existing_files[]"]').forEach(el => el.remove());
        const fileNames = [];
        taskItem.querySelectorAll('.task-file-edit .file-name').forEach(f => {
            const name = f.textContent.trim();
            fileNames.push(name);

            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'existing_files[]';
            hiddenInput.value = name;
            form.appendChild(hiddenInput);
        });

        // Hiển thị file cũ trong span
        assignModal.querySelector('#file-name-work').textContent =
            fileNames.length ? fileNames.join(', ') : "Chọn tệp đính kèm";

        assignModal.scrollIntoView({ behavior: "smooth" });
    });
});

//




















