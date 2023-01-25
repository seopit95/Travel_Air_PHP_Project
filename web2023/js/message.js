function check_input(){
  if(!document.message_form.rv_id.value){
    swal('문의글 등록 실패',"수신아이디를 입력해주세요!","warning");
    document.message_form.rv_id.focus();
    return;
  }
  if(!document.message_form.subject.value){
    swal('문의글 등록 실패',"제목을 입력해주세요!","warning");
    document.message_form.subject.focus();
    return;
  }
  if(!document.message_form.content.value){
    swal('문의글 등록 실패',"내용을 입력해주세요!","warning");
    document.message_form.content.focus();
    return;
  }
  document.message_form.submit();
}