let user_id = $('#user_id').val();
$(document).ready(function(){

    function loadGroup(groupItem) {
        let groupId = groupItem.attr('group-id');

        currentGroup = groupId;


        // Bỏ active của tất cả nhóm
        $('.group-item').removeClass('active');

        // Thêm active cho nhóm được click
        groupItem.addClass('active');

        // AJAX load tin nhắn
        $.ajax({
            url: './pages/processing/chat.php',
            type: 'POST',
            data: {
                get_group: true,
                id_group: groupId,
                user_id: user_id
            },
            success: function(data){
                $('.chat-messages').html(data);
                $('.chat-messages').scrollTop($('.chat-messages')[0].scrollHeight); // scroll xuống cuối
                const groupName = groupItem.find('span').text();
                $('.chat-header').text(groupName);
            }
        });
    }

    // Khi click nhóm
    $('.group-item').on('click', function(){
        loadGroup($(this));
    });

    // Load group đầu tiên mặc định khi trang load
    let firstGroup = $('.group-item').first();
    if(firstGroup.length) {
        loadGroup(firstGroup);
    }
});


let currentGroup = $('.group-item.active').attr('group-id');

function loadMessages(groupId){
    $.ajax({
        url: './pages/processing/chat.php',
        type: 'POST',
        data: {get_group: true, id_group: groupId, user_id: user_id},
        success: function(data){
            let $chat = $('.chat-messages');
            let nearBottom = $chat.scrollTop() + $chat.innerHeight() >= $chat[0].scrollHeight - 50;

            // Chuyển data thành DOM tạm
            let $temp = $('<div>').html(data);

            // Append các message mới nếu chưa có
            $temp.children().each(function(){
                let id = $(this).data('msg-id');
                if($chat.find(`[data-msg-id='${id}']`).length === 0){
                    $chat.append($(this));
                }
            });

            // Scroll xuống nếu user đang ở gần cuối
            if(nearBottom){
                $chat.scrollTop($chat[0].scrollHeight);
            }
        }
    });
}


$('#chatForm').on('submit', function(e){
    e.preventDefault();

    let formData = new FormData(this);
    formData.append('send_message', true);
    formData.append('id_group', currentGroup);
    formData.append('user_id', user_id);

    $.ajax({
        url: './pages/processing/chat.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(data){
            $('#chatMessage').val('');
            $('#fileInput').val('');
            $('#imageInput').val('');

            loadMessages(currentGroup);
            $('.chat-messages').scrollTop($('.chat-messages')[0].scrollHeight); // scroll xuống cuối
        }
    });
});

// Khi chọn file
$('#fileInput').on('change', function(){
    if(this.files.length > 0){
        $('#chatForm').submit();
    }
});

// Khi chọn ảnh
$('#imageInput').on('change', function(){
    if(this.files.length > 0){
        $('#chatForm').submit();
    }
});


setInterval(function() {
    if(currentGroup) {
        loadMessages(currentGroup);
    }
}, 2000);


// Xử lý tìm kiếm nhóm
$('.group-search input').on('keyup', function() {
    let searchTerm = $(this).val().toLowerCase();

    $('.group-item').each(function() {
        let groupName = $(this).find('span').text().toLowerCase();
        if(groupName.indexOf(searchTerm) !== -1){
            $(this).show();
        } else {
            $(this).hide();
        }
    });
});

