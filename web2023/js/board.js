function check_input(){
  if(!document.board_form.subject.value){
    swal('게시글 등록 실패',"제목을 입력해주세요!","warning");
    document.board_form.subject.focus();
    return;
  }
  if(!document.board_form.content.value){
    swal('게시글 등록 실패',"내용을 입력해주세요!","warning");
    document.board_form.content.focus();
    return;
  }
  document.board_form.submit();
}

function image_board_input(){
  if(!document.image_board_form.subject.value){
    swal('게시글 등록 실패',"제목을 입력해주세요!","warning");
    document.image_board_form.subject.focus();
    return;
  }
  if(!document.image_board_form.content.value){
    swal('게시글 등록 실패',"내용을 입력해주세요!","warning");
    document.image_board_form.content.focus();
    return;
  }
  document.image_board_form.submit();
}