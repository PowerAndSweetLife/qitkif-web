//const conn = new WebSocket('ws://localhost:9001');
const conn = new WebSocket('wss://qitkif.com/ws2/');
conn.onopen = function(e) {
    const data = {
        "type" : "register",
        "userId" : -1,
    };
    conn.send(JSON.stringify(data));
};

conn.onmessage = function(e) {
    let res = JSON.parse(e.data)
    if(in_message_panel && Number(res.idService) === Number($("#id-service-messenger").val()) && Number(res.sender.id) === Number($("#id-user-messenger").val())) {
        $.post(base_url('admin/messenger/markAsRead'), {idService: res.idService},function (data, textStatus, jqXHR) {});

        let piece_jointe = "";
        if(res.pieceJointe) {
            piece_jointe = `<div class="message-piece-jointe">
                                <img src="${base_url('public/piece_jointe/' + res.pieceJointe) }" onclick="zoomIn(this)">
                            </div>`
        }
        $(".message-wrapper").append(`<div class="alert message-list d-flex" role="alert">
            <div>
            <img src="${res.sender.photo ? base_url('public/images/profils/' . res.sender.photo) : base_url('public/images/avatar.png') }" class="photo-messenger">
            </div>
            <div class="ps-3 w-100">
                <div class="d-flex justify-content-between">
                    <strong class="alert-heading">${ res.sender.pseudo }</strong>
                    <span class="text-muted">${ res.date_ }</span>
                </div>
                ${res.message ? res.message : ""}
                ${piece_jointe}
            </div>
        </div>`)

        scrollTobottom('.message-wrapper');

    }else {
        $.getJSON(base_url('admin/messenger/getUnreadCount'),
            function (data, textStatus, jqXHR) {
                if(data.count > 0) {
                    $("#unread-message-count").text(data.count)
                } else {
                    $("#unread-message-count").text(null)
                }
            }
        );
    }
}

// conn.onmessage = function(e) {
//     let data = JSON.parse(e.data)
    
//     if(in_message_panel && Number(data.idService) === Number($("#id-service-messenger").val()) ) {
//         $.getJSON(base_url('admin/messenger/getLast'), {idUser: data.from, idService: data.idService},
//             function (res, textStatus, jqXHR) {
//                 if(res.message) {
//                     $('.messenger-body,.center-body').append(`
//                         <div class="message-left">
//                             <div class="message-content">
//                                 ${res.message}
//                             </div>
//                         </div>
//                     `)
//                 }
//                 if(res.pieceJointe) {
//                     $('.messenger-body,.center-body').append(`
//                         <div class="message-left">
//                             <div class="message-piece-jointe">
//                                 <img src="${base_url('public/piece_jointe/' + res.pieceJointe) }">
//                             </div>
//                         </div>
//                     `)
//                 }
//                 scrollTobottom('.messenger-body');
//                 scrollTobottom('.center-body');
//             }
//         );
        
//         $.post(base_url('admin/messenger/markAsRead'), {idService: data.idService},
//             function (data, textStatus, jqXHR) {
                
//             },
//         );
//     } else {
//         $.getJSON(base_url('admin/messenger/getUnreadCount'),
//             function (data, textStatus, jqXHR) {
//                 if(data.count > 0) {
//                     $("#unread-message-count").text(data.count)
//                 } else {
//                     $("#unread-message-count").text(null)
//                 }
//             }
//         );
//     }
// };

// var eventSource = new EventSource(base_url('realtime.php?usertype=admin'));
// // Event when receiving a message from the server
// eventSource.onmessage = function(event) {
//     updateMessage(JSON.parse(event.data));
// };
// eventSource.onerror = function(err) {
//     console.error("EventSource failed:", err);
// };

// $(document).ready(function () {
//     realtime();
// });

// function realtime() {
//     $.ajax({
//         type: "get",
//         url: base_url('realtime.php?usertype=admin'),
//         dataType: "json"
//     })
//     .done(res => {
//         if(res.updated) {
//             updateMessage(res);
//         } else {
//             realtime();
//         }
//     })
//     .fail(err => {
//         realtime();
//     });
// }

// function updateMessage(data) {
//     if(in_message_panel && Number(last.id_service) === Number($("#id-service-messenger").val()) ) {
//         let photo = `<img src="${base_url('public/images/avatar.png')}" class="photo-messenger">`
//         let piece_jointe = '';
//         if(last.sender === 'user') {
//             if(last.user.photo) {
//                 photo = `<img src="${base_url('public/images/profils/' + last.user.photo)}" class="photo-messenger">`
//             }
//         }else {
//             // to do ....
//         }

//         if(last.piece_jointe !== null) {
//             piece_jointe = `<div class="message-piece-jointe">
//                                 <img src="${ base_url('public/piece_jointe/' . last.piece_jointe) }" onclick="zoomIn(this)">
//                             </div>`
//         }
//         $('#message-content').append(`
//             <div class="alert message-list d-flex" role="alert">
//                 <div>
//                     ${photo}
//                 </div>
//                 <div class="ps-3 w-100">
//                     <div class="d-flex justify-content-between">
//                         <strong class="alert-heading">${ last.sender === 'user' ? last.user.pseudo : 'Moi' }</strong>
//                         <span class="text-muted">${ datetimeFormat(last.date_) }</span>
//                     </div>
//                     ${last.message ?? ''}
//                     ${piece_jointe}
//                 </div>
//             </div>
//         `)
//         scrollTobottom("#message-content");
        
//         $.ajax({
//             type: "post",
//             url: base_url('admin/messenger/markAsRead'),
//             data: {idService: last.id_service},
//         })
//         .always(() => {
//             realtime();
//         })
//     } else {
//         $.ajax({
//             type: "get",
//             url: base_url('admin/messenger/getUnreadCount'),
//             dataType: "json",
//         })
//         .done(data => {
//             if(data.count > 0) {
//                 $("#unread-message-count").text(data.count)
//             } else {
//                 $("#unread-message-count").text(null)
//             }
//         })
//         .always(() => {
//             realtime();
//         })
//     }
// }
