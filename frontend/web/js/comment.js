function showReplies(comment_id){
    $('.replies'+ comment_id).removeClass('d-none')
    $('.showbtn'+ comment_id).addClass('d-none')
}


function hideReplies(comment_id){
    $('.replies'+ comment_id).addClass('d-none')
    $('.showbtn'+ comment_id).removeClass('d-none')
}


function showReplyField(comment_id){
    $('.replyField'+ comment_id).removeClass('d-none')
    $('.replybtn'+ comment_id).addClass('d-none')
}


function hideReplyField(comment_id){
    $('.replyField'+ comment_id).addClass('d-none')
    $('.replybtn'+ comment_id).removeClass('d-none')
}
