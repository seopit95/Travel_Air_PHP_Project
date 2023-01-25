function check_input(){
  if(!document.register_form.id.value){
    swal('회원가입 실패',"아이디를 입력해주세요!","warning");
    document.register_form.id.focus();
    return;
  }
  if(!document.register_form.pass.value){
    swal('회원가입 실패',"비밀번호를 입력해주세요!","warning");
    document.register_form.pass1.focus();
    return;
  }
  if(!document.register_form.pass2.value){
    swal('회원가입 실패',"비밀번호를 입력해주세요!","warning");
    document.register_form.pass2.focus();
    return;
  }
  if(!document.register_form.name.value){
    swal('회원가입 실패',"이름을 입력해주세요!","warning");
    document.register_form.name.focus();
    return;
  }
  if(!document.register_form.phone1.value){
    swal('회원가입 실패',"연락처를 입력해주세요!","warning");
    document.register_form.phone1.focus();
    return;
  }
  if(!document.register_form.phone2.value){
    swal('회원가입 실패',"연락처를 입력해주세요!","warning");
    document.register_form.phone2.focus();
    return;
  }
  if(!document.register_form.phone3.value){
    swal('회원가입 실패',"연락처를 입력해주세요!","warning");
    document.register_form.phone3.focus();
    return;
  }
  if(!document.register_form.email1.value){
    swal('회원가입 실패',"이메일을 입력해주세요!","warning");
    document.register_form.email1.focus();
    return;
  }
  if(!document.register_form.email2.value){
    swal('회원가입 실패',"이메일을 입력해주세요!","warning");
    document.register_form.email2.focus();
    return;
  }
  if(document.register_form.pass.value != document.register_form.pass2.value){
    swal('회원가입 실패',"비밀번호가 일치하지 않아요!","warning");
    document.register_form.pass.focus();
    return;
  }

  document.register_form.submit();
}

function check_id(){

  window.open("./register_check_id.php?id="+ document.register_form.id.value, "IDcheck", "right=500, top=500, width=350, height=200, scrollbars=no, resizable=yes");
}