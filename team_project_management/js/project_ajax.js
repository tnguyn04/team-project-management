let id_project = $('#id_project').val();

$('#inviteForm').on('submit', function(e){
    e.preventDefault(); // ngăn reload

    let note = $('#inviteNote').val();

    $.ajax({
        url: './pages/processing/project_ajax.php',
        type: 'POST',
        data: { 
            'post-public': true, 
            'id_project': id_project,
            'request-desc': note 
        },
        dataType: 'json',
        success: function(res){
            if(res.status === "success"){
                $('#messageBox').html('<p style="color: green;">Đăng thành công!</p>');
            }
            
        }
    });
});



$('.delete-member').on('click', function(){
    let userId = $(this).data('user');
    let row = $(this).closest('.member-row');

    $.ajax({
        url: './pages/processing/project_ajax.php',
        type: 'POST',
        data: {
            delete_member: true,
            id_user: userId,
            id_project: id_project 
        },
        dataType: 'json',
        success: function(res){
            if(res.status === "success"){
                row.remove(); 
            }
            
        }
        
    });
});

$('.add-member').on('click', function(){
    let userId = $(this).data('user');
    let row = $(this).closest('.member-pending');

    $.ajax({
        url: './pages/processing/project_ajax.php',
        type: 'POST',
        data: {
            add_member: true,
            id_user: userId,
            id_project: id_project // thêm nếu cần
        },
        dataType: 'json',
        success: function(res){
            if(res.status === "success"){
                row.remove(); 
            }
            
        }
        
    });
});

//
$('#assignForm').on('submit', function(e){
    e.preventDefault(); // Ngăn reload trang

    let formData = new FormData(this);    
    formData.append("action", "assign_work"); 
    formData.append("id_project", id_project); 

    $.ajax({
        url: './pages/processing/project_ajax.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(res){
            if(res.status === "success") {
                $('#messageBoxAssign').html('<p style="color: green;">Giao việc thành công!</p>');
                document.getElementById("assignForm").reset()
            } else if(res.status === "error") {
                $('#messageBoxAssign').html('<p style="color: red;">Ngày bắt đầu không được lớn hơn ngày kết thúc!</p>');
            }
        }
    });
});

//
$('.workSubmit').on('submit', function(e) {
    e.preventDefault();

    let formData = new FormData(this); // bao gồm file và textarea

    $.ajax({
        url: './pages/processing/project_ajax.php',
        type: 'POST',
        data: formData,
        contentType: false,   // quan trọng để upload file
        processData: false,   // quan trọng để upload file
        dataType: 'json',
        success: function(res) {
            if(res.status === "success") {
                $('.messageWorkSubmited').html('<p style="color: green;">Nộp thành công!</p>');
                $('.workSubmit')[0].reset(); // reset form
                $('.file-name-submit').text("Chọn tệp đính kèm");
                // optional: refresh danh sách file đã nộp
            }
        }

    });
});

// Task detail
// $(document).on('click', '.task-card', function() {
//     let id = $(this).data('id');

//     // 1. Ẩn tất cả task-card
//     $('.task-card').hide();

//     // 2. Ẩn tất cả task-card-detail
//     $('.task-card-detail').addClass('hidden');

//     // 3. Hiện detail của task được click
//     $('#detail-' + id).removeClass('hidden');
// });


//
// $(document).on('click', '.task-card', function () {
//     let idCongViec = $(this).data('id');

//     $.ajax({
//         url: './pages/processing/task_detail.php', // file PHP xử lý
//         type: 'POST',
//         data: { idTaskDetail: idCongViec },
//         success: function(res) {
//             // chèn nội dung chi tiết vào div
//             $('.task-card').addClass('hidden');
//             $('#taskDetail').html(res);
//              // ẩn tất cả task-card
//             $('.task-card').hide();
//         },
//         error: function() {
//             alert('Lỗi khi tải chi tiết công việc.');
//         }
//     });
// });

$('.delete-notify').on('click', function(){
    let notifyId = $(this).data('notify');
    let row = $(this).closest('.post-item');

    $.ajax({
        url: './pages/processing/project_ajax.php',
        type: 'POST',
        data: {
            delete_notify: true,
            id_notify: notifyId,
        },
        dataType: 'json',
        success: function(res){
            if(res.status === "success"){
                row.remove(); 
            }
            
        }
        
    });
});
//
$('.delete-task').on('click', function(){
    let taskId = $(this).data('task');
    let row = $(this).closest('.task-card-leader');

    $.ajax({
        url: './pages/processing/project_ajax.php',
        type: 'POST',
        data: {
            delete_task: true,
            id_task: taskId,
        },
        dataType: 'json',
        success: function(res){
            if(res.status === "success"){
                row.remove(); 
            }
            
        }
        
    });
});

//
$('.rating i').on('click', function(){
    let star = $(this);
    let value = star.data('value'); // số sao
    let ratingBox = star.closest('.rating');
    let postId = ratingBox.data('id');
    let ratingInput = ratingBox.next('.rating-value');

    // lưu vào input hidden
    ratingInput.val(value);

    // gửi AJAX
    $.ajax({
        url: './pages/processing/project_ajax.php',
        type: 'POST',
        data: {
            IDNop: postId,
            rating: value
        },
        dataType: 'text',
        success: function(res){
            console.log(res); // debug: "Success" hoặc lỗi
        }
    });
});


$('.delete-prj').on('click', function(){
    $.ajax({
        url: './pages/processing/project_ajax.php',
        type: 'POST',
        data: {
            delete_prj: true,
            id_project: id_project 
        },
        dataType: 'json',
        success: function(res){
            if(res.status === "success"){
                window.location.href = '/team_project_management/team_project_management/home.php?page=project';
            }
            
        }
        
    });
});

$('.out-prj').on('click', function(){
    let userId = $(this).data('user');
    let groupId = $(this).data('group');
    $.ajax({
        url: './pages/processing/project_ajax.php',
        type: 'POST',
        data: {
            out_prj: true,
            id_project: id_project,
            id_user : userId,
            id_group : groupId
        },
        dataType: 'json',
        success: function(res){
            if(res.status === "success"){
                window.location.href = '/team_project_management/team_project_management/home.php?page=project';
            }
            
        }
        
    });
});